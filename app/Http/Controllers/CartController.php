<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Carbon\Carbon;
use Session;
use App\Models\CategoryPost;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Facades\Redirect;
use Cart;
use App\Models\Coupon;

session_start();

class CartController extends Controller
{
 //    public function add_cart(Request $request){
    	
 //    	$product_id=$request->product_id;
 //    	$quantity=$request->qty;
 //    	$product_info=DB::table('product')->where('product_id', $product_id)->first();

 //    	$data['id']=$product_info->product_id;
 //    	$data['qty']=$quantity;
 //    	$data['name']=$product_info->product_name;
 //    	$data['price']=$product_info->product_price;
 //    	$data['weight']='0';
 //    	$data['options']['image']=$product_info->product_image;

 //    	Cart::add($data);
 //    	return Redirect::to('/show-cart');

 //    	// Cart::destroy();
	// }

	// public function show_cart(Request $request){
	// 	$category_product=Category::where('category_status','1')->orderby('category_order','asc')->get();
 //    	$brand_product=Brand::where('brand_status','1')->orderby('brand_order','asc')->get();
 //    	$category_post = CategoryPost::where('cate_post_status',1)->orderBy('cate_post_id', 'DESC')->get();

 //    	return view('pages.cart.cart')->with('category',$category_product)->with('brand',$brand_product)->with('category_post',$category_post);
	// }

	// public function update_cart_quantity(Request $request){
	// 	$rowId = $request->rowId_qty;
	// 	$qty = $request->cart_quantity;
	// 	Cart::update($rowId, $qty);
	// 	return Redirect::to('/show-cart');
	// }

	// public function delete_cart($rowId){
	// 	Cart::update($rowId,0);//take quantity's product about 0,the product will delete
	// 	return Redirect::to('/show-cart');
	// }

	public function add_cart_ajax(Request $request){
		$data =$request->all();
		$session_id = substr(md5(microtime()),rand(0,26),5);
		$cart =Session::get('cart');
		if($cart==true){
			$is_avaiable =0;
			foreach($cart as $key => $val){
				if ($val['product_id']==$data['cart_product_id']){
					$is_avaiable++;
					$cart[$key] = array(
                    'session_id' 	=> $val['session_id'],
					'product_quantity' => $val['product_quantity'],
                    'product_name' 	=> $val['product_name'],
                    'product_id' 	=> $val['product_id'],
                    'product_image' => $val['product_image'],
                    'product_qty' 	=> $val['product_qty']+ $data['cart_product_qty'],
                    'product_cost' => $val['product_cost'],
                    'product_price' => $val['product_price']-($val['product_price']*($val['product_discount']/100)),
                	);
                	Session::put('cart',$cart);
				}
			}
			if($is_avaiable ==0){
				$cart[] = array(
				'session_id' 	=> $session_id,
				'product_name' 	=> $data['cart_product_name'],
				'product_quantity' => $data['cart_product_quantity'],
				'product_id' 	=> $data['cart_product_id'],
				'product_image' => $data['cart_product_image'],
				'product_qty' 	=> $data['cart_product_qty'],
				'product_cost' =>  $data['cart_product_cost'],
				'product_price' => ($data['cart_product_price']-($data['cart_product_price']*($data['cart_product_discount']/100))),
				);	
				Session::put('cart',$cart);
			}
		}else{
			$cart[] = array(
			'session_id' 	=> $session_id,
			'product_name' 	=> $data['cart_product_name'],
			'product_id' 	=> $data['cart_product_id'],
			'product_quantity' => $data['cart_product_quantity'],
			'product_image' => $data['cart_product_image'],
			'product_qty' 	=> $data['cart_product_qty'],
			'product_cost' =>  $data['cart_product_cost'],
			'product_price' => ($data['cart_product_price']-($data['cart_product_price']*($data['cart_product_discount']/100))),
			);			
			Session::put('cart',$cart);
		}
		
		Session::save();
	}


	public function show_cart_ajax(Request $request){
		$category_product=Category::where('category_status','1')->orderby('category_order','asc')->get();
    	$brand_product=Brand::where('brand_status','1')->orderby('brand_order','asc')->get();
    	$category_post = CategoryPost::where('cate_post_status',1)->orderBy('cate_post_id', 'DESC')->get();

    	return view('pages.cart.cart_ajax')->with('category',$category_product)->with('brand',$brand_product)->with('category_post',$category_post);
	}

	public function update_cart_ajax(Request $request){
		$data = $request->all();
		$cart =Session::get('cart');
		if ($cart==true) {
			$message ='';

			foreach($data['cart_qty']as $key => $qty){
				$i=0;
				foreach($cart as $session => $val){
					$i++;
					if ($val['session_id']==$key && $qty<=$cart[$session]['product_quantity']) {
						$cart[$session]['product_qty']=$qty;
						$message.='<p style="color:green;">'.$i.', Cập nhật số lượng cho sản phẩm '.$cart[$session]['product_name'].' thành công.</p>';
					}elseif ($val['session_id']==$key && $qty>$cart[$session]['product_quantity']) {
						$message.='<p style="color:red;">'.$i.', Cập nhật số lượng cho sản phẩm '.$cart[$session]['product_name'].' thất bại.</p>';
					}
				}
			}
			Session::put('cart',$cart);
			return Redirect()->back()->with('message',$message);
		}else{
			return Redirect()->back()->with('erorr','Cập nhật sản phẩm thất bại');
		}
	}

	public function delete_cart_ajax($session_id){
		$cart =Session::get('cart');
		if($cart ==true){
			foreach($cart as $key =>$val){
				if($val['session_id']==$session_id){
					unset($cart[$key]);
				}
			}
		Session::put('cart',$cart);
		return Redirect()->back()->with('message','Đã xóa sản phẩm');
		}else{
			return Redirect()->back()->with('message','Xóa sản phẩm thất bại');
		}
	}

	public function delete_all_cart_ajax(){
		$cart =Session::get('cart');
		if ($cart==true) {
			// Session::destroy();
			Session::forget('cart');
			Session::forget('coupon');
			return Redirect()->back()->with('message','Đã xóa sản phẩm');
		}else{
			return Redirect()->back()->with('message','Xóa sản phẩm thất bại');
		}
	}

	public function check_coupon(Request $request){
		$data = $request->all();
		$now = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
		$coupon = Coupon::where('coupon_code',$data['coupon'])->where('coupon_status',1)->where('coupon_end','>=',$now)->where('coupon_quantity','>',0)->first();
		if($coupon){
			$count_coupon =$coupon->count();
			if($count_coupon>0){
				$coupon_sesion= Session::get('coupon');
				if($coupon_sesion==true){
					$is_avaiable=0;
					if($is_avaiable==0){
						$cou[]= array(
							'coupon_code'=> $coupon->coupon_code,
							'coupon_number'=> $coupon->coupon_number,
							'coupon_function'=> $coupon->coupon_function,
						);
						Session::put('coupon',$cou);
					}		
				}else{
					$cou[]= array(
							'coupon_code'=> $coupon->coupon_code,
							'coupon_number'=> $coupon->coupon_number,
							'coupon_function'=> $coupon->coupon_function,
						);
						Session::put('coupon',$cou);
				}
				Session::save();
				return Redirect()->back()->with('message','Đã thêm phiếu giảm giá');
			}
		}
		else{
			return Redirect()->back()->with('error','Sai mã giảm giá hoặc chương trình đã hết hạn');
		}
		// print_r($data);
	}

	public function counter_cart()
	{
		$counter=count(Session::get('cart'));
		$output='';
		if($counter>0) {
			$output.='<span class="cart_counter">'.$counter.'</span>';
		}else{
			$output.='<span class="cart_counter">0</span>';
		} 
		echo $output;
		
	}
	public function preview_cart()
	{
		$counter=count(Session::get('cart'));
		$output='';
		if($counter>0) {
			
			$output.='<ul class="preview-cart">';

			foreach (Session::get('cart') as $key => $value) {
				$output.='
                    <li ><a href="#">
                    	<span style="width: 25%; margin-right: 10%" class="pull-left"><img src="'.asset('public/uploads/product/'.$value['product_image']).'" ></span>
                    	<span style="width: 70%, "> 
                        	<p>'.$value['product_name'].' 
                        		<a class="cart_quantity_delete" href="'.url('/delete-cart-ajax/'.$value['session_id']).'"><i class="fa fa-times pull-right" ></i></a>
                        		</p> 
                        	<span >Giá: '.$value['product_price'].'</span><span style="float: right;margin-right: 8%">x'.$value['product_qty'].'</span> 
                        </span>
                        
                    </a></li>';
                }

            $output.='</ul>';
		}else{
			$output.='<ul class="preview-cart">
                                        <li ><p>Giỏ hàng trống</p></li>
                                       </ul>';
		} 
		echo $output;
	}

	public function unset_coupon(){
		$coupon =Session::get('coupon');
		if ($coupon==true) {
			Session::forget('coupon');
			return Redirect()->back()->with('message','Đã xóa mã giảm giá');
		}else{
			return Redirect()->back()->with('message','#403# Không thể xóa');
		}
	}


}
