<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Models\Slider;
session_start();
use Toastr;



class SliderController extends Controller
{


    public function list_slider(){
        $all_slider = Slider::orderBy('slider_id','DESC')->get();
        return view('admin.slider.list_slider')->with(compact('all_slider'));
    }

    public function add_slider(){
        return view('admin.slider.add_slider');
    }

    public function store_slider(Request $request){
        $data= $request->all();

        $get_image=$request->file('slider_image');

        if ($get_image) {
            $get_name_image=$get_image->getClientOriginalName();
            $name_image= current(explode('.',$get_name_image));
            $new_image = $name_image.rand(100,999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/slider',$new_image);

            $slider =new Slider();
            $slider->slider_name =$data['slider_name'];
            $slider->slider_desc=$data['slider_desc'];
            $slider->slider_image=$new_image;
            $slider->slider_status=$data['slider_status'];
            $slider->save();

           Toastr::success('Thêm mới banner thành công !','Thành công');
            return Redirect::to('list-slider');
        }else{
            Toastr::error('Chưa thêm hình ảnh cho banner!','Thất bại');
            return Redirect::to('add-slider');
        }

    }

    public function active_slider($slider_id){
         
        DB::table('slider')->where('slider_id',$slider_id)->update(['slider_status'=>1]);
        Toastr::success('Kích hoạt hiển thị thành công !','Thành công');
        return Redirect::to('list-slider');
    }

    public function unactive_slider($slider_id){
         
        DB::table('slider')->where('slider_id',$slider_id)->update(['slider_status'=>0]);
        Toastr::success('Ẩn banner thành công !','Thành công');
        return Redirect::to('list-slider');
    }

    public function delete_slider($slider_id){

        $slider=Slider::find($slider_id);

        $slider_image =$slider->slider_image;

        unlink('public/uploads/slider/'.$slider_image);
        $slider->delete();

       Toastr::success('Xóa banner thành công !','Thành công');
        return Redirect::to('list-slider');

    }

    public function edit_slider($slider_id){
         
        $edit_slider = DB::table('slider')->where('slider_id',$slider_id)->get();
        $manager_slider = view('admin.slider.edit_slider')->with('edit_slider',$edit_slider);
        return view('admin_layout')->with('admin.slider.edit_slider',$manager_slider);
    }

    public function update_slider(Request $request, $slider_id){
         
        
        $data= array();
        $data['slider_name'] = $request->slider_name;
        $data['slider_desc'] = $request->slider_desc;

        $get_image=$request->file('slider_image');

        if ($get_image) {
            $get_name_image=$get_image->getClientOriginalName();
            $name_image= current(explode('.',$get_name_image));
            $new_image = $name_image.rand(1000,9999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/slider',$new_image);
            $data['slider_image']=$new_image;
            DB::table('slider')->where('slider_id',$slider_id)->update($data);
            Toastr::success('cập nhật banner thành công !','Thành công');
            return Redirect::to('list-slider');
        }

        DB::table('slider')->where('slider_id',$slider_id)->update($data);
        Toastr::success('Cập nhật banner thành công !','Thành công');
        return Redirect::to('list-slider');
    }

}
