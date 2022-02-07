<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Cart;
use App\Models\City;
use App\Models\Province;
use App\Models\Wards;
use App\Models\Feeship;
session_start();

class CheckoutController extends Controller
{
    public function AuthLogin(){
        $admin_id =Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('login')->send();
        }
    }

    public function login_checkout(Request $request){
    	$category_product=DB::table('category')->where('category_status','1')->orderby('category_id','desc')->get();
    	$brand_product=DB::table('brand')->where('brand_status','1')->orderby('brand_id','desc')->get();

    	return view('pages.checkout.login_checkout')->with('category',$category_product)->with('brand',$brand_product);
    }

    public function logout_checkout(){
        Session::flush();
        return Redirect::to('/login-checkout');
    }

    public function add_customer(Request $request){
    	$data= array();
    	$data['customer_name']=$request->customer_name;
    	$data['customer_phone']=$request->customer_phone;
    	$data['customer_email']=$request->customer_email;
    	$data['customer_password']=$request->customer_password;

    	$customer_id =DB::table('customer')->insertGetId($data);

    	Session::put('customer_id', $customer_id);
    	Session::put('customer_name', $request->customer_name);

    	return Redirect::to('/checkout');
    }

    public function login_customer(Request $request){
        $email = $request->email_account;
        $password = $request->password_account;

        $result= DB::table('customer')->where('customer_email', $email)->where('customer_password', $password)->first();

        
        if($result){
            Session::put('customer_id', $result->customer_id);
            return Redirect::to('/checkout');
        }else{
            return Redirect::to('/login-checkout');
        }
        
    }

    public function checkout(){
    	$category_product=DB::table('category')->where('category_status','1')->orderby('category_id','desc')->get();
    	$brand_product=DB::table('brand')->where('brand_status','1')->orderby('brand_id','desc')->get();

         $city=City::orderby('id_tp','ASC')->get();

    	return view('pages.checkout.checkout')->with('category',$category_product)->with('brand',$brand_product)->with('city',$city);
    }

    public function restore_checkout(Request $request){
        $data= array();
        $data['shipping_name']=$request->shipping_name;
        $data['shipping_phone']=$request->shipping_phone;
        $data['shipping_email']=$request->shipping_email;
        $data['shipping_notes']=$request->shipping_notes;
        $data['shipping_address']=$request->shipping_address;

        $shipping_id =DB::table('shipping')->insertGetId($data);

        Session::put('shipping_id', $shipping_id);

        return Redirect::to('/payment');
    }

    public function payment(){
        $category_product=DB::table('category')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product=DB::table('brand')->where('brand_status','1')->orderby('brand_id','desc')->get();

        return view('pages.checkout.payment')->with('category',$category_product)->with('brand',$brand_product);
    }

    public function order_place(Request $request){
        //insert payment
        $payment_data= array();
        $payment_data['payment_method']=$request->payment_option;
        $payment_data['payment_status']='đang chờ xử lý';   

        $payment_id =DB::table('payment')->insertGetId($payment_data);


        //insert  order
        $order_data= array();
        $order_data['customer_id']=Session::get('customer_id');
        $order_data['shipping_id']=Session::get('shipping_id');
        $order_data['payment_id']=$payment_id;
        $order_data['order_total']= Cart::total();
        $order_data['order_status']='đang chờ xử lý';
        
        $order_id =DB::table('order')->insertGetId($order_data);


        //insert  order details
        $content = Cart::content();
        foreach ($content as $v_content) {
            $order_details_data= array();
            $order_details_data['order_id']=$order_id;
            $order_details_data['product_id']=$v_content->id;
            $order_details_data['product_name']=$v_content->name;
            $order_details_data['product_price']=$v_content->price;
            $order_details_data['product_sales_quantity']=$v_content->qty;

            DB::table('order_details')->insert($order_details_data);
        }
        
        if ($payment_data['payment_method']=='transfer_money') {

            echo 'chuyen tien ATM';

        } elseif ($payment_data['payment_method']=='direct_payment'){
            Cart::destroy();
            
            $category_product=DB::table('category')->where('category_status','1')->orderby('category_id','desc')->get();
            $brand_product=DB::table('brand')->where('brand_status','1')->orderby('brand_id','desc')->get();

            return view('pages.checkout.handcash')->with('category',$category_product)->with('brand',$brand_product);
        }
        
        // return Redirect::to('/payment');
    }

    public function manage_order(){

        $this->AuthLogin();
        $all_order = DB::table('order')
        ->join('customer','order.customer_id','=','customer.customer_id')
        ->select('order.*', 'customer.customer_name')
        ->orderby('order.order_id','desc')->get();
        $manage_order = view('admin.order.manage_order')->with('all_order',$all_order);
        return view('admin_layout')->with('admin.order.manage_order',$manage_order);
    }

    public function view_order($order_id){
        $this->AuthLogin();
        $order_by_id = DB::table('order')
        ->join('customer','order.customer_id','=','customer.customer_id')
        ->join('shipping','order.shipping_id','=','shipping.shipping_id')
        ->join('order_details','order.order_id','=','order_details.order_id')
        ->select('order.*','customer.*','shipping.*','order_details.*')->first();

        $manage_order_by_id = view('admin.order.view_order')->with('order_by_id',$order_by_id);
        return view('admin_layout')->with('admin.order.view_order',$manage_order_by_id);
    }


    public function select_delivery_home(Request $request){
        $data = $request->all();
        if ($data['action']) {
            $output ='';
            if($data['action']=="city"){
                $select_province =Province::where('id_tp', $data['ma_id'])->orderby('id_qh','ASC')->get();
                    $output='<option value="">----Chọn quận(huyện)----</option>';
                foreach($select_province as $key => $province){
                    $output.='<option value="'.$province->id_qh.'">'.$province->name_qh.'</option>';
                }
                
            }else{
                $select_wards=Wards::where('id_qh', $data['ma_id'])->orderby('id_xptt','ASC')->get();
                    $output='<option value="">----Chọn phường(xã)----</option>';
                foreach($select_wards as $key => $wards){
                    $output.='<option value="'.$wards->id_xptt.'">'.$wards->name_xptt.'</option>';
                }
                
            }
                    
        }
        echo $output;
    }



}
