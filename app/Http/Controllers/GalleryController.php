<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Session;
use App\Models\Gallery;
use DB;
use Illuminate\Support\Facades\Redirect;
session_start();
use Toastr;


class GalleryController extends Controller
{
    public function add_gallery($product_id)
    {
        $product= $product_id;
       return view('admin.gallery.add_gallery')->with(compact('product'));
    }

    public function delete_gallery(Request $request){
        $gallery_id= $request->gallery_id;
        $gallery =Gallery::find( $gallery_id);

        unlink('public/uploads/gallery/'.$gallery->gallery_image);
        $gallery->delete();

    }

    public function update_gallery_name(Request $request){
        $gallery_id= $request->gallery_id;
        $gallery_text= $request->gallery_text;

        $gallery =Gallery::find( $gallery_id);
        $gallery->gallery_name= $gallery_text;
        $gallery->save();
    }

    public function select_gallery(Request $request)
    {
        $product_id= $request->product_id;
        $gallery =Gallery::where('product_id',$product_id)->get();
        $galleryCount =$gallery->count();
        $output='';
        $output.='
         <form>
                    '.csrf_field().'
            <table class="table table-striped" id="dataTableList">
                        <thead>
                            <tr>
                                <th>Stt</th>
                                <th>Tên hình</th>
                                <th>Hình ảnh</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>';

        if ($galleryCount>0) {
            $i=0;
            foreach($gallery as $key =>$galleryItem){
                $i++;

                $output.='
               
                    <tr>
                        <td>'.$i.'</td>
                        <td contenteditable class="edit_gallery_name" data-gallery_id="'.$galleryItem->gallery_id.'">'.$galleryItem->gallery_name.'</td>
                        <td><img src="'.url('public/uploads/gallery/'.$galleryItem->gallery_image).'" width="100" class="img-thumbnail"></td>
                        <td>
                            <a type="button" data-gallery_id="'.$galleryItem->gallery_id.'" class="active styling-icon delete-gallery"  ui-toggle-class=""><i class="fa fa-trash-o text-danger text"></i></a>
                        </td>
                    </tr>';
            }
        }else{
            $output.='
                <tr>
                    <td colspan="4"><center>Chưa có ảnh nào trong thư viện !</center></td>
                </tr>';
        }

        $output.='
            </tbody>
        </table>
        </form>';


        echo($output);
        
    }

    public function store_gallery(Request $request, $product_id){
        $get_image =$request->file('file');

        if ($get_image) {
            foreach($get_image as $image){
                $get_name_image=$image->getClientOriginalName();
                $name_image= current(explode('.',$get_name_image));
                $new_image = $name_image.rand(100,999).'.'.$image->getClientOriginalExtension();
                $image->move('public/uploads/gallery',$new_image);

                $gallery =new Gallery();
                $gallery->gallery_image=$new_image;
                $gallery->gallery_name=$new_image;
                $gallery->product_id=$product_id;

                $gallery->save();
            }
        }
       Toastr::success('Thêm mới ảnh thành công !','Thành công');
        return redirect()->back();
        
    }


}
