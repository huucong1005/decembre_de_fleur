<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Models\Statistical;
use App\Models\Visitor;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Post;
use App\Models\Slider;
use App\Models\Order;
use App\Models\Icon;
use App\Models\Partner;
use App\Models\Contact;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*',function($view){
            $contact =Contact::where('info_id',1)->get();
            $icon =Icon::orderBy('id_icon','asc')->get(); 
            $partner =Partner::orderBy('partner_id','asc')->get(); 
            $post_policy = Post::where('cate_post_id',6)->get();
            $post_store = Post::where('cate_post_id',7)->get();

            $min_price= Product::min('product_price');
            $min_price_range= $min_price-(($min_price/100)*10);
            $max_price= Product::max('product_price');
            $max_price_range= $max_price+(($max_price/100)*10);

            $customer_count= Customer::all()->count();
            $slider_count= Slider::all()->count();
            $product_count= Product::all()->count();
            $product_active_count= Product::where('product_status','1')->get()->count();
            $product_unactive_count= Product::where('product_status','0')->get()->count();
            $post_active_count= Post::where('post_status','1')->get()->count();
            $post_count= Post::all()->count();
            $post_unactive_count= Post::where('post_status','0')->get()->count();
            $new_order_count= Order::where('order_status','1')->get()->count();

            $view->with('min_price',$min_price)->with('max_price',$max_price)->with('max_price_range',$max_price_range)->with('min_price_range',$min_price_range)->with('customer_count',$customer_count)->with('slider_count',$slider_count)->with('product_count',$product_count)->with('product_active_count',$product_active_count)->with('product_unactive_count',$product_unactive_count)->with('post_active_count',$post_active_count)->with('post_count',$post_count)->with('post_unactive_count',$post_unactive_count)->with('new_order_count',$new_order_count)->with('icon',$icon)->with('partner',$partner)->with('contact',$contact)->with('post_policy',$post_policy)->with('post_store',$post_store);
        });
    }
}
