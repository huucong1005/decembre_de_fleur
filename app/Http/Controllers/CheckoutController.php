<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SocialCustomer; 
use Socialite; 
use Mail;
use Illuminate\Support\Str;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Cart;
use Carbon\Carbon;
use App\Models\CategoryPost;
use App\Models\Category;
use App\Models\Brand;
use App\Models\City;
use App\Models\Province;
use App\Models\Customer;
use App\Models\Wards;
use App\Models\Feeship;
use App\Models\Coupon;

use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetails;
session_start();

class CheckoutController extends Controller
{


    public function login_checkout(Request $request){
    	$category_product=Category::where('category_status','1')->orderby('category_order','asc')->get();
        $brand_product=Brand::where('brand_status','1')->orderby('brand_order','asc')->get();
        $category_post = CategoryPost::where('cate_post_status',1)->orderBy('cate_post_id', 'DESC')->get();

        Session::put('url.intended',url()->previous());

    	return view('pages.checkout.login_checkout')->with('category',$category_product)->with('brand',$brand_product)->with('category_post',$category_post);
    }

    public function logout_checkout(){
        Session::flush();
        return Redirect::to('/trang-chu');
        // return redirect()->back();
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
            Session::put('customer_name', $result->customer_name);
            // return Redirect::to('/checkout');
            return Redirect::to(Session::get('url.intended'));
            
        }else{
            return Redirect::to('/login-checkout')->with('error','Sai tên đăng nhập hoặc mật khẩu !');
        }
        
    }


    public function customer_login_google(){
        config(['services.google.redirect'=> env('GOOGLE_CLIENT_URL')]);
        return Socialite::driver('google')->redirect();
    }

    public function callback_customer_google()
    {
        config(['services.google.redirect'=> env('GOOGLE_CLIENT_URL')]);
        $users = Socialite::driver('google')->stateless()->user();
        $authUser = $this->findOrCreateCustomer($users,'google');

        if ($authUser) { 
            $account_name = Customer::where('customer_id',$authUser->user)->first();
            Session::put('customer_name',$account_name->customer_name);
            Session::put('customer_id',$account_name->customer_id);
        }elseif($customer_new){
            $account_name = Customer::where('customer_id',$authUser->user)->first();
            Session::put('customer_name',$account_name->customer_name);
            Session::put('customer_id',$account_name->customer_id);
        }
        return Redirect::to(Session::get('url.intended'));
    }


    public function findOrCreateCustomer($users,$provider){
        $authUser = SocialCustomer::where('provider_user_id', $users->id)->where('provider_user_email', $users->email)->first();

        if($authUser){
            return $authUser;
        }else{
            $customer_new = new SocialCustomer([
                'provider_user_id' => $users->id,
                'provider_user_email' => $users->email,
                'provider' => strtoupper($provider)
            ]);

            $customer = Customer::where('customer_email',$users->email)->first();

            if(!$customer){
                $customer = Customer::create([
                    'customer_name' => $users->name,
                    'customer_email' => $users->email,
                    'customer_password' => '',
                    'customer_phone' => '',
                ]);
            }
            $customer_new->customer()->associate($customer);
            $customer_new->save();
    
            return $customer_new;

        }
    }



    public function customer_login_facebook(){
        config(['services.facebook.redirect'=> env('FACEBOOK_CLIENT_REDIRECT')]);
        return Socialite::driver('facebook')->stateless()->redirect();
    }

    public function callback_customer_facebook(){
        config(['services.facebook.redirect'=> env('FACEBOOK_CLIENT_REDIRECT')]);

        $provider = Socialite::driver('facebook')->user();
        $account = SocialCustomer::where('provider','facebook')->where('provider_user_id',$provider->getId())->first();

        if($account!=NULL){
            $account_name = Customer::where('customer_id',$account->user)->first();
            Session::put('customer_id',$account_name->customer_id);
            Session::put('customer_name',$account_name->customer_name);
            return Redirect::to(Session::get('url.intended'));
        }elseif($account==NULL){
            $customer_login = new SocialCustomer([
                'provider_user_id' => $provider->getId(),
                'provider_user_email' => $provider->getEmail(),
                'provider' => 'facebook'
            ]);

            $customer = Customer::where('customer_email',$provider->getEmail())->first();

            if(!$customer){

                $customer = Customer::create([
                    'customer_name' => $provider->getName(),
                    'customer_email' => $provider->getEmail(),
                    'customer_password' => '',
                    'customer_phone' => ''                
                ]);

        }
        $customer_login->customer()->associate($customer);
        $customer_login->save();

        $account_new = Customer::where('customer_id',$customer_login->user)->first();

        Session::put('customer_id',$account_new->customer_id);
        Session::put('customer_name',$account_new->customer_name);
        return Redirect::to(Session::get('url.intended'));
        }
}

    public function checkout(){
    	$category_product=Category::where('category_status','1')->orderby('category_order','asc')->get();
        $brand_product=Brand::where('brand_status','1')->orderby('brand_order','asc')->get();
        $category_post = CategoryPost::where('cate_post_status',1)->orderBy('cate_post_id', 'DESC')->get();

         $city=City::orderby('id_tp','ASC')->get();

    	return view('pages.checkout.checkout')->with('category',$category_product)->with('brand',$brand_product)->with('city',$city)->with('category_post',$category_post);
    }

    // public function restore_checkout(Request $request){
    //     $data= array();
    //     $data['shipping_name']=$request->shipping_name;
    //     $data['shipping_phone']=$request->shipping_phone;
    //     $data['shipping_email']=$request->shipping_email;
    //     $data['shipping_notes']=$request->shipping_notes;
    //     $data['shipping_address']=$request->shipping_address;

    //     $shipping_id =DB::table('shipping')->insertGetId($data);

    //     Session::put('shipping_id', $shipping_id);

    //     return Redirect::to('/payment');
    // }

    // public function payment(){
    //     $category_product=DB::table('category')->where('category_status','1')->orderby('category_order','asc')->get();
    //     $brand_product=DB::table('brand')->where('brand_status','1')->orderby('brand_order','asc')->get();
    //     $category_post = CategoryPost::where('cate_post_status',1)->orderBy('cate_post_id', 'DESC')->get();

    //     return view('pages.checkout.payment')->with('category',$category_product)->with('brand',$brand_product)->with('category_post',$category_post);
    // }

    // public function order_place(Request $request){
    //     //insert payment
    //     $payment_data= array();
    //     $payment_data['payment_method']=$request->payment_option;
    //     $payment_data['payment_status']='đang chờ xử lý';   

    //     $payment_id =DB::table('payment')->insertGetId($payment_data);


    //     //insert  order
    //     $order_data= array();
    //     $order_data['customer_id']=Session::get('customer_id');
    //     $order_data['shipping_id']=Session::get('shipping_id');
    //     $order_data['payment_id']=$payment_id;
    //     $order_data['order_total']= Cart::total();
    //     $order_data['order_status']='đang chờ xử lý';
        
    //     $order_id =DB::table('order')->insertGetId($order_data);


    //     //insert  order details
    //     $content = Cart::content();
    //     foreach ($content as $v_content) {
    //         $order_details_data= array();
    //         $order_details_data['order_id']=$order_id;
    //         $order_details_data['product_id']=$v_content->id;
    //         $order_details_data['product_name']=$v_content->name;
    //         $order_details_data['product_price']=$v_content->price;
    //         $order_details_data['product_sales_quantity']=$v_content->qty;

    //         DB::table('order_details')->insert($order_details_data);
    //     }
        
    //     if ($payment_data['payment_method']=='transfer_money') {

    //         echo 'chuyen tien ATM';

    //     } elseif ($payment_data['payment_method']=='direct_payment'){
    //         Cart::destroy();
            
    //         $category_product=DB::table('category')->where('category_status','1')->orderby('category_order','asc')->get();
    //         $brand_product=DB::table('brand')->where('brand_status','1')->orderby('brand_order','asc')->get();
    //         $category_post = CategoryPost::where('cate_post_status',1)->orderBy('cate_post_id', 'DESC')->get();

    //         return view('pages.checkout.handcash')->with('category',$category_product)->with('brand',$brand_product)->with('category_post',$category_post);
    //     }
        
        // return Redirect::to('/payment');
    //}


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

    public function confirm_order(Request $request){
        $data = $request->all();

        
        date_default_timezone_set('Asia/Ho_Chi_Minh');
    // shipping tbl
        $shipping = new Shipping();
        $shipping->shipping_name = $data['shipping_name'];
        $shipping->shipping_email = $data['shipping_email'];
        $shipping->shipping_phone = $data['shipping_phone'];
        $shipping->shipping_address = $data['shipping_address'];
        $shipping->shipping_notes = $data['shipping_notes'];
        $shipping->shipping_method = $data['shipping_method'];
        $shipping->shipping_date_revice =  $data['shipping_date_revice']; 
        $shipping->created_at =  now();

        $shipping->save();


        $shipping_id = $shipping->shipping_id;
        $checkout_code= substr(md5(microtime()),rand(0,26),8);
        
    // order tbl
        $order = new Order;
        $order->customer_id = Session::get('customer_id');
        $order->shipping_id = $shipping_id;
        $order->order_status= 1;
        $order->order_code =  $checkout_code; 
        

        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $today= Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        $order_date= Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        
        $order->created_at =  $today;
        $order->order_date =  $order_date;

        $order->save();



    // order_details tbl
        if (Session::get('cart')==true) {
            foreach(Session::get('cart') as $key=>$cart){
                $order_details = new OrderDetails;
                $order_details->order_code= $checkout_code;
                $order_details->product_id =$cart['product_id'];
                $order_details->product_name =$cart['product_name'];
                $order_details->product_cost =$cart['product_cost'];
                $order_details->product_price =$cart['product_price'];
                $order_details->product_sales_quantity =$cart['product_qty'];
                $order_details->product_coupon =$data['order_coupon'];
                $order_details->product_feeship =$data['order_fee'];
                $order_details->save();
            }
        }

        if ($data['order_coupon']!='---') {
            $coupon= Coupon::where('coupon_code',$data['order_coupon'])->first();     
            $coupon->coupon_quantity = $coupon->coupon_quantity -1;
            $coupon_mail= $coupon->coupon_code;
            $coupon->save();
        }else{
            $coupon_mail= '---';
        }


        $now= Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $title_mail= "Thông báo đơn hàng đặt ngày ".$now;
        $customer=Customer::find(Session::get('customer_id'));
        $data['email'][]=$customer->customer_email;
        
        if (Session::get('cart')==true) {
            foreach(Session::get('cart') as $key=>$cart_mail){
                $cart_array[]= array(
                    'product_name'=>$cart_mail['product_name'],
                    'product_price'=>$cart_mail['product_price'],
                    'product_qty'=>$cart_mail['product_qty']
                );
            }
        }

        $shipping_array= array(
            'customer_name'=>$customer->customer_name,
            'shipping_name'=>$data['shipping_name'],
            'shipping_email'=>$data['shipping_email'],
            'shipping_phone'=>$data['shipping_phone'],
            'shipping_address'=>$data['shipping_address'],
            'shipping_notes'=>$data['shipping_notes'],
            'shipping_method'=>$data['shipping_method']
        );

        $ordercode_mail =array(
            'coupon_code'=>$coupon_mail,
            'order_code'=>$checkout_code
        );

        
        Session::forget('coupon');
        Session::forget('fee');
        Session::forget('cart');

        // Mail::send('pages.mail.notify_order', ['cart_array'=>$cart_array, 'shipping_array'=>$shipping_array, 'code'=>$ordercode_mail],function($message) use($title_mail, $data){
        //     $message->to($data['email'])->subject($title_mail);
        //     $message->from($data['email'],$title_mail);
        // });
    }


    public function vnpay_payment( Request $request)
    {
        $data=$request->all();
        $code_order= rand(100000,999999);
       $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
$vnp_Returnurl = "http://eshop.abc/checkout";
$vnp_TmnCode = "C6BMXFZM";//Mã website tại VNPAY 
$vnp_HashSecret = "KUQWBAJCTPBLKOIZHZBNAOCCGRWKJGIR"; //Chuỗi bí mật

$vnp_TxnRef =  $code_order; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
$vnp_OrderInfo = 'test thanh toan vnpay';
$vnp_OrderType = 'billpayment';
$vnp_Amount = $data['total_vnpay']*100;
$vnp_Locale = 'vn';
$vnp_BankCode = 'NCB';
$vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
//Add Params of 2.0.1 Version
// $vnp_ExpireDate = $_POST['txtexpire'];
//Billing

$inputData = array(
    "vnp_Version" => "2.1.0",
    "vnp_TmnCode" => $vnp_TmnCode,
    "vnp_Amount" => $vnp_Amount,
    "vnp_Command" => "pay",
    "vnp_CreateDate" => date('YmdHis'),
    "vnp_CurrCode" => "VND",
    "vnp_IpAddr" => $vnp_IpAddr,
    "vnp_Locale" => $vnp_Locale,
    "vnp_OrderInfo" => $vnp_OrderInfo,
    "vnp_OrderType" => $vnp_OrderType,
    "vnp_ReturnUrl" => $vnp_Returnurl,
    "vnp_TxnRef" => $vnp_TxnRef

);

if (isset($vnp_BankCode) && $vnp_BankCode != "") {
    $inputData['vnp_BankCode'] = $vnp_BankCode;
}
if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
    $inputData['vnp_Bill_State'] = $vnp_Bill_State;
}

//var_dump($inputData);
ksort($inputData);
$query = "";
$i = 0;
$hashdata = "";
foreach ($inputData as $key => $value) {
    if ($i == 1) {
        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
    } else {
        $hashdata .= urlencode($key) . "=" . urlencode($value);
        $i = 1;
    }
    $query .= urlencode($key) . "=" . urlencode($value) . '&';
}

$vnp_Url = $vnp_Url . "?" . $query;
if (isset($vnp_HashSecret)) {
    $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
    $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
}
$returnData = array('code' => '00'
    , 'message' => 'success'
    , 'data' => $vnp_Url);
    if (isset($_POST['redirect'])) {
        header('Location: ' . $vnp_Url);
        die();
    } else {
        echo json_encode($returnData);
    }
    // vui lòng tham khảo thêm tại code demo
    }


}
