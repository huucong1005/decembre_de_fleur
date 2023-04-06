<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Mail;
use Illuminate\Support\Str;
use PDF;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Feeship;
use App\Models\Coupon;
use App\Models\Shipping;
use App\Models\Contact;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Statistical;
use App\Models\CategoryPost;
use App\Models\Category;
use App\Models\Brand;
use Carbon\Carbon;
session_start();
use Toastr;

class OrderController extends Controller
{

    public function list_order(){

          
        $all_order = Order::with('shipping')->orderby('order_id','DESC')->get();
        return view('admin.order.list_order')->with(compact('all_order'));
    }

    public function view_order($order_code){
          
    
        // $order_details = OrderDetails::with('product')->where('order_code',$order_code)->get();
        $order_details = DB::table('order_details')->join('product','order_details.product_id','=','product.product_id')->select('order_details.*', 'product.product_name','product.product_id', 'product.product_quantity')->where('order_code',$order_code)->get();
        $order = Order::where('order_code',$order_code)->get();

        foreach($order as$key =>$details){
            $customer_id= $details->customer_id;
            $shipping_id= $details->shipping_id;
            $order_status= $details->order_status;
        }
        $customer = Customer::where('customer_id',$customer_id)->first();
        $shipping = Shipping::where('shipping_id',$shipping_id)->first();

       $order_details_product = DB::table('order_details')->join('product','order_details.product_id','=','product.product_id')->select('order_details.*', 'product.product_name','product.product_id', 'product.product_quantity')->where('order_code',$order_code)->get();
        // $order_details_product =OrderDetails::with('product')->where('order_code',$order_code)->get();

        
        foreach($order_details_product as$key =>$order_coupon){
            $product_coupon = $order_coupon->product_coupon;
        }

            if ($product_coupon!='---') {
                $coupon= Coupon::where('coupon_code',$product_coupon)->first();
                $coupon_function=$coupon->coupon_function;
                $coupon_number=$coupon->coupon_number;
            }else{
                $coupon_function=2;
                $coupon_number=0;
            }
              
            
        return view('admin.order.view_order')->with(compact('order_details','customer','shipping','order_details','coupon_function','coupon_number','order','order_status',));      
    }

    public function print_order($checkout_code){
        $pdf=\App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($checkout_code));
        return $pdf->stream();
    }

    public function print_order_convert($checkout_code){
        $order_details = OrderDetails::where('order_code',$checkout_code)->get();
        $order = Order::where('order_code',$checkout_code)->get();

        foreach($order as$key =>$details){
            $customer_id= $details->customer_id;
            $shipping_id= $details->shipping_id;
        }
        $customer = Customer::where('customer_id',$customer_id)->first();
        $shipping = Shipping::where('shipping_id',$shipping_id)->first();
        $contact = Contact::where('info_id',1)->first();

        $shipping_method='';
        if($shipping->shipping_method=='direct_payment'){
            $shipping_method='Thanh toán khi nhận hàng';
        }
        elseif($shipping->shipping_method=='vnpay'){
            $shipping_method='Thanh toán qua VN Pay';
        }else{
            $shipping_method='Thanh toán bằng chuyển khoản';
        }

        $order_details_product =OrderDetails::with('product')->where('order_code',$checkout_code)->get();


        foreach($order_details_product as$key =>$order_coupon){
            $product_coupon = $order_coupon->product_coupon;
        }

        if ($product_coupon!='---') {
            $coupon= Coupon::where('coupon_code',$product_coupon)->first();
            $coupon_function=$coupon->coupon_function;
            $coupon_number=$coupon->coupon_number;
        }else{
            $coupon_function=2;
            $coupon_number=0;
        }


        $output='';
        $output.='<style type="text/css" media="screen">
        .{font-family:DejaVu Sans;}  
        .text-align-left{text-align: left ! important;} 
        .text-align-right{text-align: right! important;}   

        .table{ border-collapse: collapse; }   td, th {border: 0px solid #dddddd; text-align: left; padding: 3px;} label{font-size: 18px;}

        .table-bodered{ border-collapse: collapse; width: 100%;}  .table-bodered th, .table-bodered> td {border: 1px solid #dddddd; text-align: left; padding: 3px;} label{font-size: 18px;}
        </style>
        <h1><center>Hóa đơn chi tiết</h1>
        <label>Mã đơn hàng: #'.$checkout_code.'</label><br><br>
        <label>Thông tin khách hàng:</label>
        <table class="table">
            <thead>
                <tr>
                    <th>Tên khách hàng</th>
                    <td>'.$customer->customer_name.'</td> 
                </tr>
            </thead>
            <tbody>  
                <tr>
                    <th>Số điện thoại</th>
                    <td>'.$customer->customer_phone.'</td>
                    
                </tr>
                <tr>
                    <th>Email</th>
                    <td>'.$customer->customer_email.'</td>
                </tr>
                <tr>
                    <th>Ngày đặt hàng</th>
                    <td>'.$shipping->created_at.'</td>
                </tr>
            </tbody>
        </table><br>';


         $output.='<label>Thông tin chuyển hàng:</label>
         <table class="table">
            <tbody>    
                <tr>
                    <th>Tên người nhận</th>
                    <td>'.$shipping->shipping_name.'</td>
                </tr>
                <tr>
                    <th>Địa chỉ</th>
                    <td>'.$shipping->shipping_address.'</td>
                </tr>
                <tr>
                    <th>Số điện thoại</th>
                    <td>'.$shipping->shipping_phone.'</td>
                </tr> 
                <tr>
                    <th>Hình thức thanh toán</th>
                    <td>'.$shipping_method.'</td>
                </tr>
                <tr rowspan="6">
                    <th>Ghi chú</th>
                    <td>'.$shipping->shipping_notes.'</td>
                </tr> 
                <tr></tr>  <tr></tr>  <tr></tr>  <tr></tr>  <tr></tr>  <tr></tr>    

            </tbody>
        </table><br>';

         $output.='<label>Chi tiết đơn đặt hàng:</label>
         <table class="table-bodered">
            <thead>
                <tr>
                    <th>Stt</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Tổng tiền</th> 
                </tr>
            </thead>
            <tbody>';
                
            $i=0;  
            $total=0;
        foreach($order_details_product as$key=>$details){
              $i++;
              $subtotal=$details->product_price*$details->product_sales_quantity;
              $total+=$subtotal;

        $output.='
            <tr>
                <td>'.$i.'</td>
                <td>'.$details->product_name.'</td>
                <td>'.$details->product_sales_quantity.'</td>
                <td class="text-align-right">'.number_format($details->product_price,0,',','.').'</td>
                <td class="text-align-right">'.number_format($subtotal,0,',','.').'</td>
            </tr>';
        }

        $output.='  
            </tbody>
        </table><br>';


        $output.='
        <table class="table">
            <tbody>    
                <tr>
                    <th>Tổng giá trị đơn hàng:</th>
                    <td class="text-align-right">'.number_format($total,0,',','.').'</td> 
                </tr>
                <tr>
                    <th>Coupon: ';

        $total_coupon=0;
        if($details->product_coupon!='---'){
            $output.=$details->product_coupon;
        }else{
            $output.='Không';
        } 

        $output.='</th>
                    <td class="text-align-right">';

        if($coupon_function==1){
            $total_after_coupon= ($total*$coupon_number)/100;
            $total_coupon= $total-$total_after_coupon;

            $output.='- '.number_format($total_after_coupon,0,',','.');
        }elseif($coupon_function==2){

            $total_coupon= $total-$coupon_number;
            $output.='- '.number_format($coupon_number,0,',','.');
        }
            
        $output.='  </td>
                </tr>
                <tr>
                    <th>Phí vận chuyển</th>
                    <td class="text-align-right">+ '.number_format($details->product_feeship,0,',','.').'</td>
                </tr>

                <tr>
                    <th>Tổng</th>
                    <th class="text-align-right">'.number_format(($total_coupon+$details->product_feeship),0,',','.').'</th>
                </tr>
            </tbody>
        </table><br>
        <div>
            <center>Cửa hàng hoa: '.$contact->info_name.'</center>
            <center>Địa chỉ: '.$contact->info_address.'</center>
            <center>Số điện thoại: '.$contact->info_contact.'</center>
            <center>Hóa đơn xuất ngày: '.date("d-m-Y").'</center>
        </div>';
        return $output;
    }

    public function update_order_qty(Request $request)
    {
        $data =$request->all();
        $order=Order::find($data['order_id']);
        $order->order_status=$data['order_status'];
        $order->save();
        $order_code= $order->order_code;

        //order date
        $order_date =$order->order_date;
        $statistical=Statistical::where('order_date',$order_date)->get();
        if($statistical){
            $statistical_count =$statistical->count();
        }else{
            $statistical_count=0;
        }


        if($order->order_status==2){

            $statistical_total_order=0;
            $statistical_total_order+= 1;
            $statistical_sales=0;
            $statistical_profit=0;
            $statistical_quantity=0;

            foreach($data['order_product_id'] as $key => $product_id){


                $product = Product::find($product_id);
                $product_quantity = $product->product_quantity;
                $product_sold = $product->product_sold;
                
                

                $now= Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');

                foreach($data['quantity'] as $key2 => $qty){
                    if ($key==$key2) {

                        $order_details = OrderDetails::with('product')->where('product_id',$product_id)->where('order_code',$order_code)->first();
                        $product_cost = $order_details->product_cost;
                        $product_price = $order_details->product_price;

                        $pro_remain =$product_quantity - $qty;
                        $product->product_quantity =$pro_remain;
                        $product->product_sold =$product_sold+$qty;
                        $product->save();

                        //update statistical 
                        $statistical_quantity += $qty;
                        $statistical_sales += $product_price*$qty;
                        $statistical_profit += (($product_price*$qty)-($product_cost*$qty));
                        
                    }
                }
            }
            if ($statistical_count>0) {
                $statistical_update=Statistical::where('order_date',$order_date)->first();
                $statistical_update->sales =$statistical_update->sales +=$statistical_sales;
                $statistical_update->profit =$statistical_update->profit +=$statistical_profit;
                $statistical_update->quantity =$statistical_update->quantity +=$statistical_quantity;
                $statistical_update->total_order =$statistical_update->total_order +=$statistical_total_order;
                $statistical_update->save();
            }else{
                $statistical_new=new Statistical;
                $statistical_new->order_date =$order_date;
                $statistical_new->sales =$statistical_sales;
                $statistical_new->profit =$statistical_profit;
                $statistical_new->quantity =$statistical_quantity;
                $statistical_new->total_order =$statistical_total_order;
                $statistical_new->save();
            }



            $title_mail= "Xác nhận đơn hàng đặt ngày ".$now;
            $customer=Customer::where('customer_id',$order->customer_id)->first();
            $data['email'][]=$customer->customer_email;
            
    
            foreach($data['order_product_id'] as $key3 => $product){
                
                foreach($data['quantity'] as $key4 => $qty){
                    if ($key3==$key4) {
                        
                        $order_details_mail = OrderDetails::with('product')->where('product_id',$product)->where('order_code',$order_code)->first();
                        $cart_array[]= array(
                            'product_name'=>$order_details_mail->product_name,
                            'product_price'=>$order_details_mail->product_price,
                            'product_qty'=>$qty
                        );
                    }
                }
                    
            }
            
            $details= OrderDetails::where('order_code',$order->order_code)->first();
            $coupon_mail=$details->product_coupon;
            $shipping=Shipping::where('shipping_id',$order->shipping_id)->first();

            $shipping_array= array(
                'customer_name'=>$customer->customer_name,
                'shipping_name'=>$shipping->shipping_name,
                'shipping_email'=>$shipping->shipping_email,
                'shipping_phone'=>$shipping->shipping_phone,
                'shipping_address'=>$shipping->shipping_address,
                'shipping_notes'=>$shipping->shipping_notes,
                'shipping_method'=>$shipping->shipping_method
            );

            $ordercode_mail =array(
                'coupon_code'=>$coupon_mail,
                'order_code'=>$order_code
            );

            Mail::send('admin.mail.confirm_order', ['cart_array'=>$cart_array, 'shipping_array'=>$shipping_array, 'code'=>$ordercode_mail],function($message) use($title_mail, $data){
                $message->to($data['email'])->subject($title_mail);
                $message->from($data['email'],$title_mail);
            });





        }else{

            $statistical_total_order=0;
            $statistical_total_order+= 1;
            $statistical_sales=0;
            $statistical_profit=0;
            $statistical_quantity=0;

            foreach($data['order_product_id'] as $key => $product_id){

                $product = Product::find($product_id);
                $product_quantity = $product->product_quantity;
                $product_sold = $product->product_sold;

                

                $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

                foreach($data['quantity'] as $key2 => $qty){
                    if ($key==$key2) {

                        $order_details = OrderDetails::with('product')->where('product_id',$product_id)->where('order_code',$order_code)->first();
                        $product_cost = $order_details->product_cost;
                        $product_price = $order_details->product_price;


                        $pro_remain =$product_quantity + $qty;
                        $product->product_quantity =$pro_remain;
                        $product->product_sold =$product_sold-$qty;
                        $product->save();

                        $statistical_quantity += $qty;
                        $statistical_sales += $product_price*$qty;
                        $statistical_profit += (($product_price*$qty)-($product_cost*$qty));
                    }
                }
            }

            $title_mail= "Thông báo hủy đơn hàng đặt ngày ".$now;
            $customer=Customer::where('customer_id',$order->customer_id)->first();
            $data['email'][]=$customer->customer_email;
            
    
            foreach($data['order_product_id'] as $key3 => $product){
                
                foreach($data['quantity'] as $key4 => $qty){
                    if ($key3==$key4) {
                        
                        $order_details_mail = OrderDetails::with('product')->where('product_id',$product)->where('order_code',$order_code)->first();
                        $cart_array[]= array(
                            'product_name'=>$order_details_mail->product_name,
                            'product_price'=>$order_details_mail->product_price,
                            'product_qty'=>$qty
                        );
                    }
                }
                    
            }
            
            $details= OrderDetails::where('order_code',$order->order_code)->first();
            $coupon_mail=$details->product_coupon;
            $shipping=Shipping::where('shipping_id',$order->shipping_id)->first();

            $shipping_array= array(
                'customer_name'=>$customer->customer_name,
                'shipping_name'=>$shipping->shipping_name,
                'shipping_email'=>$shipping->shipping_email,
                'shipping_phone'=>$shipping->shipping_phone,
                'shipping_address'=>$shipping->shipping_address,
                'shipping_notes'=>$shipping->shipping_notes,
                'shipping_method'=>$shipping->shipping_method
            );

            $ordercode_mail =array(
                'coupon_code'=>$coupon_mail,
                'order_code'=>$order_code
            );

            Mail::send('admin.mail.cancel_order', ['cart_array'=>$cart_array, 'shipping_array'=>$shipping_array, 'code'=>$ordercode_mail],function($message) use($title_mail, $data){
                $message->to($data['email'])->subject($title_mail);
                $message->from($data['email'],$title_mail);
            });
            

             $statistical_update=Statistical::where('order_date',$order_date)->first();
                $statistical_update->sales =$statistical_update->sales -=$statistical_sales;
                $statistical_update->profit =$statistical_update->profit -=$statistical_profit;
                $statistical_update->quantity =$statistical_update->quantity -=$statistical_quantity;
                $statistical_update->total_order =$statistical_update->total_order -=$statistical_total_order;
                $statistical_update->save();
        }



    }


    public function update_qty(Request $request){
        $data =$request->all();
        $order_details =OrderDetails::where('product_id',$data['ord_product_id'])->where('order_code',$data['order_code'])->first();
        $order_details->product_sales_quantity = $data['order_qty'];
        $order_details->save();
    }

    public function delete_order($order_code){
            
        $order = Order::where('order_code',$order_code)->first();
        $order->delete();
        Toastr::success('Xóa đơn hàng thành công !','Thành công');
        return redirect()->back();
    }


//end admin

    public function history_order(){
        $category_product=Category::where('category_status','1')->orderby('category_order','asc')->get();
        $brand_product=Brand::where('brand_status','1')->orderby('brand_order','asc')->get();
        $category_post = CategoryPost::where('cate_post_status',1)->orderBy('cate_post_id', 'DESC')->get();


       if(!Session::get('customer_id')) {
           return redirect('/login-checkout')->with('error','Hãy đăng nhập để xem lịch sử mua hàng !');
       }else{
        $all_order = Order::where('customer_id',Session::get('customer_id'))->orderby('order_date','DESC')->paginate(15);
        return view('pages.history_order.list_history_order')->with(compact('all_order'))->with('category',$category_product)->with('brand',$brand_product)->with('category_post',$category_post);
       }
    }

    public function view_history_order($order_code)
    {
        $category_product=Category::where('category_status','1')->orderby('category_order','asc')->get();
        $brand_product=Brand::where('brand_status','1')->orderby('brand_order','asc')->get();
        $category_post = CategoryPost::where('cate_post_status',1)->orderBy('cate_post_id', 'DESC')->get();


       if(!Session::get('customer_id')) {
           return redirect('/login-checkout')->with('error','Hãy đăng nhập để xem lịch sử mua hàng !');
       }else{

        $order_details = DB::table('order_details')->join('product','order_details.product_id','=','product.product_id')->select('order_details.*', 'product.product_name','product.product_id', 'product.product_quantity')->where('order_code',$order_code)->get();
        $order = Order::where('order_code',$order_code)->get();

        foreach($order as$key =>$details){
            $customer_id= $details->customer_id;
            $shipping_id= $details->shipping_id;
            $order_status= $details->order_status;
        }
        $customer = Customer::where('customer_id',$customer_id)->first();
        $shipping = Shipping::where('shipping_id',$shipping_id)->first();

       $order_details_product = DB::table('order_details')->join('product','order_details.product_id','=','product.product_id')->select('order_details.*', 'product.product_name','product.product_id', 'product.product_quantity')->where('order_code',$order_code)->get();
        // $order_details_product =OrderDetails::with('product')->where('order_code',$order_code)->get();

        
        foreach($order_details_product as$key =>$order_coupon){
            $product_coupon = $order_coupon->product_coupon;
        }

            if ($product_coupon!='---') {
                $coupon= Coupon::where('coupon_code',$product_coupon)->first();
                $coupon_function=$coupon->coupon_function;
                $coupon_number=$coupon->coupon_number;
            }else{
                $coupon_function=2;
                $coupon_number=0;
            }
              
            
        
        return view('pages.history_order.view_history_order')->with(compact('order_details','customer','shipping','order_details','coupon_function','coupon_number','order','order_status','order_code'))->with('category',$category_product)->with('brand',$brand_product)->with('category_post',$category_post);
       }
    }


    public function cancel_order($order_code){
         
        DB::table('order')->where('order_code',$order_code)->update(['order_status'=>3]);
        // Session::put('message','Đơn hàng đã bị hủy');
        return Redirect::to('/history-order');
    }

}
