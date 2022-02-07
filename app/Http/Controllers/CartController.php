<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Cart;
use App\Models\Coupon;

session_start();

class CartController extends Controller
{
    public function add_cart(Request $request){
    	
    	$product_id=$request->product_id;
    	$quantity=$request->qty;
    	$product_info=DB::table('product')->where('product_id', $product_id)->first();

    	$data['id']=$product_info->product_id;
    	$data['qty']=$quantity;
    	$data['name']=$product_info->product_name;
    	$data['price']=$product_info->product_price;
    	$data['weight']='0';
    	$data['options']['image']=$product_info->product_image;

    	Cart::add($data);
    	return Redirect::to('/show-cart');

    	// Cart::destroy();
	}

	public function show_cart(Request $request){
		$category_product=DB::table('category')->where('category_status','1')->orderby('category_id','desc')->get();
    	$brand_product=DB::table('brand')->where('brand_status','1')->orderby('brand_id','desc')->get();

    	return view('pages.cart.cart')->with('category',$category_product)->with('brand',$brand_product);
	}

	public function update_cart_quantity(Request $request){
		$rowId = $request->rowId_qty;
		$qty = $request->cart_quantity;
		Cart::update($rowId, $qty);
		return Redirect::to('/show-cart');
	}

	public function delete_cart($rowId){
		Cart::update($rowId,0);//take quantity's product about 0,the product will delete
		return Redirect::to('/show-cart');
	}

	public function add_cart_ajax(Request $request){
		$data =$request->all();
		$session_id = substr(md5(microtime()),rand(0,26),5);
		$cart =Session::get('cart');
		if($cart==true){
			$is_avaiable =0;
			foreach($cart as $key => $val){
				if ($val['product_id']==$data['cart_product_id']){
					$is_avaiable++;
				}
			}
			if($is_avaiable ==0){
				$cart[] = array(
				'session_id' 	=> $session_id,
				'product_name' 	=> $data['cart_product_name'],
				'product_id' 	=> $data['cart_product_id'],
				'product_image' => $data['cart_product_image'],
				'product_qty' 	=> $data['cart_product_qty'],
				'product_price' => $data['cart_product_price'],
				);	
				Session::put('cart',$cart);
			}
		}else{
			$cart[] = array(
			'session_id' 	=> $session_id,
			'product_name' 	=> $data['cart_product_name'],
			'product_id' 	=> $data['cart_product_id'],
			'product_image' => $data['cart_product_image'],
			'product_qty' 	=> $data['cart_product_qty'],
			'product_price' => $data['cart_product_price'],
			);			
			Session::put('cart',$cart);
		}
		
		Session::save();
	}
	
	public function show_cart_ajax(Request $request){
		$category_product=DB::table('category')->where('category_status','1')->orderby('category_id','desc')->get();
    	$brand_product=DB::table('brand')->where('brand_status','1')->orderby('brand_id','desc')->get();

    	return view('pages.cart.cart_ajax')->with('category',$category_product)->with('brand',$brand_product);
	}

	public function update_cart_ajax(Request $request){
		$data = $request->all();
		$cart =Session::get('cart');
		if ($cart==true) {
			foreach($data['cart_qty']as $key => $qty){
				foreach($cart as $session => $val){
					if ($val['session_id']==$key) {
						$cart[$session]['product_qty']=$qty;
					}
				}
			}
			Session::put('cart',$cart);
			return Redirect()->back()->with('message','Cập nhật sản phẩm');
		}else{
			return Redirect()->back()->with('message','Cập nhật sản phẩm thất bại');
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
		$coupon = Coupon::where('coupon_code',$data['coupon'])->first();
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
