<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use App\Models\Post;
use App\Models\CategoryPost;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Facades\Redirect;
session_start();
use Toastr;

class PostController extends Controller
{
    public function add_post(){
        $category_post=CategoryPost::orderBy('cate_post_id','desc')->get();
       
        return view('admin.post.add_post')->with(compact('category_post'));
    }

    public function list_post(){
        $list_post = Post::with('cate_post')->orderBy('post_id','DESC')->paginate(5);
        
        return view('admin.post.list_post')->with(compact('list_post', $list_post));
    }

    public function store_post(Request $request){
        
        $data= $request->all();
        $post= new Post();

        $post->post_name = $data['post_name'];
        $post->post_slug = $data['post_slug'];
        $post->post_desc= $data['post_desc'];
        $post->post_content = $data['post_content'];

        $post->cate_post_id = $data['cate_post_id'];
        $post->post_status = $data['post_status'];
        $post->post_view = 0;

        $get_image=$request->file('post_image');
        if ($get_image) {
            $get_name_image=$get_image->getClientOriginalName();
            $name_image= current(explode('.',$get_name_image));
            $new_image = $name_image.rand(1000,9999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/post',$new_image);

            $post->post_image = $new_image;
            $post->save();
            Toastr::success('Thêm mới bài viết thành công !','Thành công');
            return Redirect::to('list-post');
        }else{
            Toastr::error('Bạn chưa thêm hình ảnh !','Thất bại');
            return redirect()->back();
        }
    }

    public function active_post($post_id){
         
        DB::table('post')->where('post_id',$post_id)->update(['post_status'=>1]);
        Toastr::success('Hiển thị bài viết thành công !','Thành công');
        return Redirect::to('list-post');
    }

    public function unactive_post($post_id){
         
        DB::table('post')->where('post_id',$post_id)->update(['post_status'=>0]);
        Toastr::success('Ẩn bài viết thành công !','Thành công');
        return Redirect::to('list-post');
    }

    public function edit_post($post_id){
         
        $category_post=CategoryPost::orderBy('cate_post_id','desc')->get();
        $post=Post::find($post_id);
       
        return view('admin.post.edit_post')->with(compact('post', 'category_post'));
    }

    public function update_post(Request $request, $post_id){
         
        $data= $request->all();
        $post= Post::find($post_id);

        $post->post_name = $data['post_name'];
        $post->post_slug = $data['post_slug'];
        $post->post_desc= $data['post_desc'];
        $post->post_content = $data['post_content'];
        $post->cate_post_id = $data['cate_post_id'];

        $get_image=$request->file('post_image');
        if ($get_image) {
            $get_name_image=$get_image->getClientOriginalName();
            $name_image= current(explode('.',$get_name_image));
            $new_image = $name_image.rand(1000,9999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/post',$new_image);

            $post->post_image = $new_image; 
        }

        $post->save();
        Toastr::success('Cập nhật bài viết thành công !','Thành công');
        return Redirect::to('list-post');

    }

    public function delete_post($post_id){
        $post=Post::find($post_id);

        $post_image =$post->post_image;

        unlink('public/uploads/post/'.$post_image);
        $post->delete();

        Toastr::success('Xóa bài viết thành công !','Thành công');
        return Redirect::to('list-post');
    }

// //end admin


    public function post_detail($post_slug){
       $category_product=Category::where('category_status','1')->orderby('category_order','asc')->get();
        $brand_product=Brand::where('brand_status','1')->orderby('brand_order','asc')->get();
        $category_post = CategoryPost::where('cate_post_status',1)->orderBy('cate_post_id', 'DESC')->get();

        $detail = DB::table('post')->join('category_post','category_post.cate_post_id','=','post.cate_post_id')
        ->where('post.post_slug',$post_slug)->get();

        $post_view=Post::where('post_slug',$post_slug)->first();
        $post_view->post_view=$post_view->post_view+1;
        $post_view->save();

        //product same category(recommended)
        foreach ($detail as $key => $value) {
            $cate_post_id= $value->cate_post_id;
        }
        $recommended_post = DB::table('post')
        ->join('category_post','category_post.cate_post_id','=','post.cate_post_id')->where('post_status',1)->whereNotIn('post_slug',[$post_slug])
        ->where('category_post.cate_post_id',$cate_post_id)->orderby('post.post_id','desc')->limit(3)->get();



        return view('pages.post.post_detail')->with('category',$category_product)->with('brand',$brand_product)->with('post_detail' ,$detail)->with('recommended',$recommended_post)->with('category_post',$category_post);
    }

    public function show_post_home(){
       $category_product=Category::where('category_status','1')->orderby('category_order','asc')->get();
        $brand_product=Brand::where('brand_status','1')->orderby('brand_order','asc')->get();
        $category_post = CategoryPost::where('cate_post_status',1)->orderBy('cate_post_id', 'DESC')->get();

        $cate_post_by_id = DB::table('post')->where('post_status', 1)->orderby('post_id','desc')->paginate(5);


        return view('pages.post.post_home')->with('category',$category_product)->with('brand',$brand_product)->with('cate_post_by_id', $cate_post_by_id)->with('category_post',$category_post);
    }

}
