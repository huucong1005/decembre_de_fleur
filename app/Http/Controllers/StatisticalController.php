<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Statistical;
use App\Models\Visitor;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Post;
use App\Models\Slider;
use App\Models\Order;
use DB;
use Carbon\Carbon;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Exception;

class StatisticalController extends Controller
{
    public function show_dashboard(Request $request){
            $user_ip_address = $request->ip();

            $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
            $dauthangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
            $cuoithangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

            $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->startOfYear()->toDateString(); 
            $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString(); 

            $visitor_last_month=Visitor::whereBetween('date_visitor',[$dauthangtruoc,$cuoithangtruoc])->get();
            $visitor_last_month_count=$visitor_last_month->count();

            $visitor_this_month=Visitor::whereBetween('date_visitor',[$dauthangnay,$now])->get();
            $visitor_this_month_count=$visitor_this_month->count();

            $visitor_year=Visitor::whereBetween('date_visitor',[$sub365days,$now])->get();
            $visitor_year_count=$visitor_year->count();

            $visitor_current=Visitor::where('ip_address',$user_ip_address)->where('date_visitor',$now)->get();
            $visitor_count=$visitor_current->count();

            if ($visitor_count<1) {
                $visitor =new Visitor();
                $visitor->ip_address = $user_ip_address;
                $visitor->date_visitor = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
                $visitor->save();
            }

            $visitor_total= Visitor::all();
            $visitor_total_count=$visitor_total->count();

            $customer_count= Customer::all()->count();
            $slider_count= Slider::all()->count();
            $product_count= Product::all()->count();
            $product_active_count= Product::where('product_status','1')->get()->count();
            $product_unactive_count= Product::where('product_status','0')->get()->count();
            $post_active_count= Post::where('post_status','1')->get()->count();
            $post_count= Post::all()->count();
            $post_unactive_count= Post::where('post_status','0')->get()->count();
            $new_order_count= Order::where  ('order_status','1')->get()->count();

            $post_view=Post::orderby('post_view','desc')->limit(10)->get();
            $product_view=Product::orderby('product_view','desc')->limit(10)->get();

            return view('admin.dashboard')->with(compact('visitor_last_month_count','visitor_this_month_count','visitor_year_count','visitor_count','visitor_total_count','customer_count','slider_count','product_active_count','product_unactive_count','post_active_count','post_unactive_count','new_order_count','product_count','post_count','post_view','product_view'));
    }

    public function dashboard_filter(Request $request){
        $data=$request->all();

        // $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        // $tomorrow = Carbon::now('Asia/Ho_Chi_Minh')->addDay()->format('d-m-Y H:i:s');
        // $lastWeek =  Carbon::now('Asia/Ho_Chi_Minh')->subWeek()->format('d-m-Y H:i:s'); 
        // $sub15days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(15)->format('d-m-Y H:i:s'); 
        // $sub30days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(30)->format('d-m-Y H:i:s'); 


        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dauthangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoithangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString(); 
        $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->startOfYear()->toDateString(); 

        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString(); 

        if ($data['dashboard_value']=='week') {

            $get =Statistical::whereBetween('order_date',[$sub7days,$now])->orderby('order_date','asc')->get();

        }elseif ($data['dashboard_value']=='lastmonth') {

            $get =Statistical::whereBetween('order_date',[$dauthangtruoc,$cuoithangtruoc])->orderby('order_date','asc')->get();

        }elseif ($data['dashboard_value']=='thismonth') {

            $get =Statistical::whereBetween('order_date',[$dauthangnay,$now])->orderby('order_date','asc')->get();
        }
        else{

            $get =Statistical::whereBetween('order_date',[$sub365days,$now])->orderby('order_date','asc')->get();
        }

        foreach($get as $key => $value){
            $chart_data[]=array(
                'period'=> $value->order_date,
                'order'=> $value->total_order,
                'sales'=> $value->sales,
                'profit'=> $value->profit,
                'quantity'=> $value->quantity
                
            );
        }
        echo $data= json_encode($chart_data);
        
    }

    public function filter_by_date(Request $request)
    {
        $data=$request->all();
        $date_from=$data['date_from'];
        $date_to=$data['date_to'];

        $get =Statistical::whereBetween('order_date',[$date_from,$date_to])->orderby('order_date','asc')->get();

        foreach($get as $key => $value){
            $chart_data[]=array(
                'period'=> $value->order_date,
                'order'=> $value->total_order,
                'sales'=> $value->sales,
                'profit'=> $value->profit,
                'quantity'=> $value->quantity
                
            );
        }
        echo $data= json_encode($chart_data);
    }

    public function days_order(){
        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString(); 

        $get =Statistical::whereBetween('order_date',[$dauthangnay,$now])->orderby('order_date','asc')->get();

        foreach($get as $key => $value){
            $chart_data[]=array(
                'period'=> $value->order_date,
                'order'=> $value->total_order,
                'sales'=> $value->sales,
                'profit'=> $value->profit,
                'quantity'=> $value->quantity
                
            );
        }
        echo $data= json_encode($chart_data);

    }


}
