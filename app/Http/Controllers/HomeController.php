<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Mail;
use Illuminate\Support\Facades\Redirect;
session_start();

class HomeController extends Controller
{
    public function index(){
    	$category_product=DB::table('category')->where('category_status','1')->orderby('category_id','desc')->get();
    	$brand_product=DB::table('brand')->where('brand_status','1')->orderby('brand_id','desc')->get();

    	// $list_product = DB::table('product')->join('category','category.category_id','=','product.category_id')->join('brand','brand.brand_id','=','product.brand_id')->orderby('product.product_id','desc')->get();
  
    	$all_product=DB::table('product')->where('product_status','1')->orderby('product_id','desc')->limit(6)->get();
    	return view('pages.home')->with('category',$category_product)->with('brand',$brand_product)->with('all_product',$all_product);
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

}
