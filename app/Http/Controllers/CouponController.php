<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests;
use Carbon\Carbon;
use Session;
use DB;
use App\Models\Coupon;
use Illuminate\Support\Facades\Redirect;
session_start();
use Toastr;


class CouponController extends Controller
{


    public function add_coupon(){
         
        return view('admin.coupon.add_coupon');
    }

    public function active_coupon($coupon_id){
        DB::table('coupon')->where('coupon_id',$coupon_id)->update(['coupon_status'=>1]);
        Toastr::success('Kích hoạt coupon thành công !','Thành công');
        return Redirect::to('list-coupon');
    }

    public function unactive_coupon($coupon_id){
        DB::table('coupon')->where('coupon_id',$coupon_id)->update(['coupon_status'=>0]);
        Toastr::success('Đã khóa thành công !','Thành công');
        return Redirect::to('list-coupon');
    }

    public function store_coupon(Request $request){
         
        $data =$request->all();
        $coupon = new Coupon;

        $coupon->coupon_name = $data['coupon_name'];
        $coupon->coupon_number = $data['coupon_number'];
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_function = $data['coupon_function'];
        $coupon->coupon_quantity = $data['coupon_quantity'];
        $coupon->coupon_start = $data['coupon_start'];
        $coupon->coupon_end = $data['coupon_end'];
        $coupon->coupon_status = 1;

        $coupon->save();

        Toastr::success('Thêm mới thành công !','Thành công');
        return Redirect::to('list-coupon');  
    }

    public function list_coupon(){
         
        $all_coupon = Coupon::orderby('coupon_id', 'DESC')->get();    
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        return view('admin.coupon.list_coupon')->with(compact('all_coupon','now'));
    }

    public function delete_coupon($coupon_id){  
          
        $coupon = Coupon::find($coupon_id);
        $coupon->delete();

        Toastr::success('Đã xóa thành công !','Thành công');
        return Redirect::to('list-coupon');  
    }

}