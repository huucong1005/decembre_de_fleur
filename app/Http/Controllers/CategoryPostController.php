<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use App\Models\Category;
use App\Models\Brand;
use App\Models\CategoryPost;
use App\Models\Post;
use Illuminate\Support\Facades\Redirect;
session_start();
use Toastr;

class CategoryPostController extends Controller
{
    public function add_cate_post(){
        return view('admin.category_post.add_cate_post');
    }

    public function list_cate_post(){
        $list_cate_post = DB::table('category_post')->orderBy('cate_post_id', 'DESC')->get();
        $manager_cate_post = view('admin.category_post.list_cate_post')->with('list_cate_post',$list_cate_post);
        return view('admin_layout')->with('admin.category_post.list_cate_post',$manager_cate_post);
    }

    public function store_cate_post(Request $request){
         $cate_post_count= DB::table('category_post')->where('cate_post_slug',$request->cate_post_slug)->count();

        if ($cate_post_count==0) {
           $data= array();
            $data['cate_post_name'] = $request->cate_post_name;
            $data['cate_post_slug'] = $request->cate_post_slug;
            $data['cate_post_status'] = $request->cate_post_status;

            DB::table('category_post')->insert($data);
            Toastr::success('Thêm danh mục bài viết thành công !','Thành công');
            return Redirect::to('list-cate-post');
        }else{
            Toastr::error('Danh mục bài viết này đã tồn tại !','Thất bại');
            return Redirect::to('add-cate-post');        
        }
    }

    public function active_cate_post($cate_post_id){
         
        DB::table('category_post')->where('cate_post_id',$cate_post_id)->update(['cate_post_status'=>1]);
        Toastr::success('Hiển thị danh mục bài viết thành công !','Thành công');
        return Redirect::to('list-cate-post');
    }

    public function unactive_cate_post($cate_post_id){
         
        DB::table('category_post')->where('cate_post_id',$cate_post_id)->update(['cate_post_status'=>0]);
        Toastr::success('Ẩn danh mục bài viết thành công !','Thành công');
        return Redirect::to('list-cate-post');
    }

    public function edit_cate_post($cate_post_id){
         
        $edit_cate_post = DB::table('category_post')->where('cate_post_id',$cate_post_id)->get();
        $manager_category_post = view('admin.category_post.edit_cate_post')->with('edit_cate_post',$edit_cate_post);
        return view('admin_layout')->with('admin.category_post.edit_cate_post',$manager_category_post);
    }


    public function update_cate_post(Request $request, $cate_post_id){
       $data= array();
        $data['cate_post_name'] = $request->cate_post_name;
        $data['cate_post_slug'] = $request->cate_post_slug;

        DB::table('category_post')->where('cate_post_id',$cate_post_id)->update($data);
        Toastr::success('Cập nhật danh mục bài viết thành công !','Thành công');
        return Redirect::to('list-cate-post');
    }

    public function delete_cate_post($cate_post_id){

        $post_count= Post::where('cate_post_id',$cate_post_id)->count();

        if($post_count!=0) {
            Toastr::error('Thất bại! danh mục này vẫn đang tồn tại các bài viết !','Thất bại');
            return Redirect::to('list-cate-post'); 
        }else{
            DB::table('category_post')->where('cate_post_id',$cate_post_id)->delete();
            Toastr::success('Xóa danh mục bài viết thành công !','Thành công');
            return Redirect::to('list-cate-post');
         }  
            
            
    }
        
//end admin


    public function show_cate_post($cate_post_slug){
       $category_product=Category::where('category_status','1')->orderby('category_order','asc')->get();
        $brand_product=Brand::where('brand_status','1')->orderby('brand_order','asc')->get();
        $category_post = CategoryPost::where('cate_post_status',1)->orderBy('cate_post_id', 'DESC')->get();

        $cate_post_by_id = DB::table('post')->join('category_post','post.cate_post_id','=','category_post.cate_post_id')->where('category_post.cate_post_slug', $cate_post_slug)->where('post_status', 1)->orderby('post_id','desc')->paginate(5);

        $cate_post_name=DB::table('category_post')->where('category_post.cate_post_slug',$cate_post_slug)->limit(1)->get();

        return view('pages.post.cate_post')->with('category',$category_product)->with('brand',$brand_product)->with('cate_post_by_id', $cate_post_by_id)->with('category_post',$category_post)->with('cate_post_name', $cate_post_name);
    }


}
