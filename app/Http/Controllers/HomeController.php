<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Session;
use Carbon\Carbon;
use Mail;
use DB;

use App\Models\Slider;
use App\Models\Icon;
use App\Models\Customer;
use App\Models\CategoryPost;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
session_start();

class HomeController extends Controller
{
    public function index(){
        $category_post = CategoryPost::where('cate_post_status',1)->orderBy('cate_post_id', 'DESC')->get();
        $icon= Icon::orderBy('id_icon','asc')->get();

        //slide
        $slider =Slider::orderBy('slider_id','DESC')->where('slider_status','1')->get();
        $slider_active_count=Slider::orderBy('slider_id','DESC')->where('slider_status','1')->count();

    	$category_product=Category::where('category_status','1')->orderby('category_order','asc')->get();
    	$brand_product=Brand::where('brand_status','1')->orderby('brand_order','asc')->get();

        $brand_product_tabs = Brand::where('brand_status',1)->orderBy('brand_order','asc')->get();

    	// $list_product = DB::table('product')->join('category','category.category_id','=','product.category_id')->join('brand','brand.brand_id','=','product.brand_id')->orderby('product.product_id','desc')->get();
  
    	$all_product=Product::orderBy('product_id','DESC')->where('product_status','1')->paginate(9);
        $recommended_product=Product::orderBy('product_sold','DESC')->where('product_status','1')->limit(3)->get();
    	return view('pages.home')->with('category',$category_product)->with('brand',$brand_product)->with('brand_product_tabs',$brand_product_tabs)->with('all_product',$all_product)->with('recommended_product',$recommended_product)->with('slider',$slider)->with('slider_active_count',$slider_active_count)->with('category_post',$category_post)->with('icon',$icon);
    }

    public function product_tabs(Request $request)
    {
       $data= $request->all();
       $output='';
       $product=Product::where('product_status','1')->where('brand_id', $data['brand_id'])->orderBy('product_id','desc')->limit(4)->get();

       $product_count=$product->count();
       $output.='<div class="tab-content">';

       if ($product_count>0) {
           foreach($product as$key=>$productItem){
            $output.='
            <div class="tab-pane fade active in" id="tshirt" >
                <div class="col-sm-3">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="'.url('public/uploads/product/'.$productItem->product_image).'" alt="'.$productItem->product_name.'" />
                                <h2>'.number_format($productItem->product_price).' VND</h2>
                                <p>'.$productItem->product_name.'</p>
                                <a href="'.url('chi-tiet-san-pham/'.$productItem->product_slug).'" class="btn btn-default add-to-cart"><i class="fa fa-eye"></i>Chi tiết</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>';
           }
       }else{
        $output.='<div class="tab-pane fade active in" id="tshirt" >
                <div class="col-sm-12">
                    <center>Chưa có sản phẩm nào ở đây!</center>
                </div
                </div>';
       }

       $output.='</div>';

       echo $output;

    }

    public function send_mail(){
    $to_name ="HuuCong";
    $to_email = "cong05102000@gmail.com";

    $data = array("name"=>"Thư từ khách hàng","body"=>"thư gửi từ khách hàng ");  //body of mail.blade.php

    Mail::send('pages.mail.send_mail',$data,function($message) use ($to_name,$to_email){

        $message->to($to_email)->subject("Thư phản hồi");  //subject email

        $message->from($to_email,$to_name);  //send from this email
    });
    return redirect('')->with('message','');
    }


    public function customer_forget_password(){

        $category_post = CategoryPost::where('cate_post_status',1)->orderBy('cate_post_id', 'DESC')->get();

        $category_product=Category::where('category_status','1')->orderby('category_order','asc')->get();
        $brand_product=Brand::where('brand_status','1')->orderby('brand_order','asc')->get();

       
        return view('pages.checkout.forget_password')->with('category',$category_product)->with('brand',$brand_product)->with('category_post',$category_post);
    }

    public function send_mail_recover_password(Request $request){
        $data=$request->all();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
        $title_mail= "Lấy lại mật khẩu ngày ".$now;
        $customer =Customer::where('customer_email','=',$data['email_account'])->get();
        foreach($customer as$key =>$value){
            $customer_id=$value->customer_id;
        }
        if ($customer) {
            $count_customer=$customer->count();
            if ($count_customer==0) {
                return redirect()->back()->with('error', 'Email này chưa được đăng kí tài khoản');
            }else{
                $token_random =Str::random(20);
                $customer=Customer::find($customer_id);
                $customer->customer_token=$token_random;
                $customer->save();

                $to_email =$data['email_account'];
                $link_reset_pass=url('/update-new-pass?email='.$to_email.'&token='.$token_random);

                $data = array('name'=>$title_mail,'body'=>$link_reset_pass,'email'=>$data['email_account']);

                Mail::send('pages.mail.send_mail_reset_password',['data'=>$data], function($message) use($title_mail,$data){
                    $message->to($data['email'])->subject($title_mail);
                    $message->from($data['email'],$title_mail);
                });
                return redirect()->back()->with('message', 'Hãy kiểm tra hòm thư của bạn !');
            }
        }
        
    } 

    public function update_new_pass()
    {
        $category_post = CategoryPost::where('cate_post_status',1)->orderBy('cate_post_id', 'DESC')->get();

        $category_product=Category::where('category_status','1')->orderby('category_order','asc')->get();
        $brand_product=Brand::where('brand_status','1')->orderby('brand_order','asc')->get();

       
        return view('pages.checkout.new_password')->with('category',$category_product)->with('brand',$brand_product)->with('category_post',$category_post);
        
    }
    public function confirm_password(Request $request)
    {
        $data=$request->all();
        $token_random =Str::random(20);
        $customer =Customer::where('customer_email','=',$data['email'])->where('customer_token','=',$data['token'])->get();
        $count_customer=$customer->count();

        if ($count_customer>0) {
            foreach($customer as$key =>$value){
                $customer_id=$value->customer_id;
            }
            $reset=Customer::find($customer_id);
            $reset->customer_password=$data['password_account'];
            $reset->customer_token=$token_random;
            $reset->save();
            return redirect('show-cart-ajax')->with('message', 'Mật khẩu đã được cập nhập, hãy quay lại trang đăng nhập.');
        }else{
            return redirect('customer-forget-password')->with('error', 'vui lòng nhập lại email, đường dẫn của bạn đã hết hạn !');
        } 

    }



}

