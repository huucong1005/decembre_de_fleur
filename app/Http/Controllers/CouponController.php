<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests;
use Session;
use App\Models\Coupon;
use Illuminate\Support\Facades\Redirect;
session_start();


class CouponController extends Controller
{
    public function add_coupon(){
        
        return view('admin.coupon.add_coupon');
    }

    public function store_coupon(Request $request){
        $data =$request->all();
        $coupon = new Coupon;

        $coupon->coupon_name = $data['coupon_name'];
        $coupon->coupon_number = $data['coupon_number'];
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_function = $data['coupon_function'];
        $coupon->coupon_quantity = $data['coupon_quantity'];

        $coupon->save();

        Session::put('message','Thêm mới mã giảm giá thành công !');
        return Redirect::to('list-coupon');  
    }

    public function list_coupon(){
        $coupon = Coupon::orderby('coupon_id', 'DESC')->get();    
        return view('admin.coupon.list_coupon')->with(compact('coupon'));
    }

    public function delete_coupon($coupon_id){   
        $coupon = Coupon::find($coupon_id);
        $coupon->delete();

        Session::put('message','Xóa mã giảm giá thành công !');
        return Redirect::to('list-coupon');  
    }

}