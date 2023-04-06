<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Customer;
use App\Models\Role;
use App\Models\Coupon;
use App\Models\RoleUser;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use PHPUnit\Exception;
use Toastr;


class AdminController extends Controller
{

    private $user;
    private $role;

    public function __construct(User $user, Role $role)
    {
        $this->user=$user;
        $this->role=$role;
    }


    public function index(){
        if (Auth()->check()) {
            return Redirect::to('/dashboard');
        }else{
    	   return view('admin_login');
        }
    }


//so sanh email, password cua form vs DB de login
    public function dashboard( Request $request){

        $remember = $request->has('remember_me') ? true : false;
        if (Auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ], $remember)) {

            Session::put('admin_name',Auth::user()->name);
            Session::put('admin_id',Auth::user()->id);
            return Redirect::to('/dashboard');
        }else{
    		Session::put('message','Tài khoản hoặc mật khẩu không đúng !');
    		return Redirect::to('/login');
    	}
    	
    }

    public function logout(){
    	Auth()->logout();
        Session::put('admin_name',null);
        Session::put('admin_id',null);
    	return Redirect::to('/login');
    }



    public function file_browser(Request $request)
    {
        $paths =glob(public_path('uploads/ckeditor/*'));
        $fileNames =array();
        foreach($paths as $path){
            array_push($fileNames,basename($path));
        }$data=array('fileNames'=>$fileNames);
        return view('admin.images.file_browser')->with($data);
    }

    public function ckeditor_image(Request $request) { 
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
        
            $request->file('upload')->move('public/uploads/ckeditor', $fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('public/uploads/ckeditor/'.$fileName); 
            $msg = 'Image uploaded successfully'; 
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
               
            @header('Content-type: text/html; charset=utf-8'); 
            echo $response;
        } 
    }







    public function list_user(){
        $users=$this->user->get();
        return view('admin.user.list_user', compact('users'));
    }

     public function add_user()
    {
        $roles = $this->role->all();
        return view('admin.user.add_user', compact('roles'));
    }


     public function store_user(Request $request)
    {

        $emailCount=User::where('email',$request->email)->count();
        if ($emailCount==1) {
            Toastr::error('Email đã tồn tại !','Thất bại');
            return Redirect::to('add-user');
        }else{
            try {
            DB::beginTransaction();
            $user = $this->user->create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password)
            ]);
            $user->roles()->attach($request->role_id);
            DB::commit();
            Toastr::success('Thêm mới người dùng thành công !','Thành công');
            return Redirect::to('list-user');

            } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message :' . $exception->getMessage() . '  -- Line: ' . $exception->getLine());
            }
        }
        
    }

    public function edit_user($id){
        $roles = $this->role->all();
        $user = $this->user->find($id);
        $rolesOfUser = $user->roles;
        return view('admin.user.edit_user', compact('roles', 'user', 'rolesOfUser'));
    }


    public function update_user(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $this->user->find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password)
            ]);
            $user = $this->user->find($id);
            $user->roles()->sync($request->role_id);
            DB::commit();
            Toastr::success('Cập nhật người dùng thành công !','Thành công');
            return  Redirect::to('list-user');
        }catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message :' . $exception->getMessage() . '--- Line: ' . $exception->getLine());
            Toastr::error('Cập nhật user thất bại, email đã tồn tại !','Thất bại');
            return  Redirect::to('list-user');
        }

    }

    public function delete_user($id){
        $user = $this->user->find($id);
        $user->delete();
        DB::table('role_user')->where('user_id',$id)->delete();
        Toastr::success('Đã xóa người dùng khỏi hệ thống','Thành công');
        return Redirect::to('list-user');
    }






    public function send_coupon($coupon_quantity,$coupon_code,$coupon_number,$coupon_function){
        $customer= Customer::get();

        $coupon=Coupon::where('coupon_code',$coupon_code)->first();
        $coupon_start=$coupon->coupon_start;
        $coupon_end=$coupon->coupon_end;

        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $title_mail= "Mã khuyến mãi ngày ".$now;

        $data=[];
        foreach($customer as $value){
            $data['email'][]=$value->customer_email;
        }

        $couponItem=array(
            'coupon_start'=>$coupon_start,
            'coupon_end'=>$coupon_end,
            'coupon_quantity'=>$coupon_quantity,
            'coupon_code'=>$coupon_code,
            'coupon_number'=>$coupon_number,
            'coupon_function'=>$coupon_function
        );

        Mail::send('admin.mail.send_coupon',['couponItem'=>$couponItem], function($message) use($title_mail,$data){
            $message->to($data['email'])->subject($title_mail);
            $message->from($data['email'],$title_mail);
        });

        return Redirect()->back()->with('message', 'Đã gửi mail mã khuyến mãi đến khách hàng');

    }

}
