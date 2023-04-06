<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use App\Models\Contact;
use App\Models\Icon;
use App\Models\Partner;
use App\Models\Slider;
use App\Models\CategoryPost;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Facades\Redirect;
session_start();
use Toastr;

class ContactController extends Controller
{


public function add_info()
{
    $contact =Contact::where('info_id',1)->get();
    $icon =Icon::orderBy('id_icon','desc')->get();
    return view('admin.info.add_info')->with(compact('contact','icon'));
}

public function store_info(Request $request)
{
    $data=$request->all();
    $contact= new Contact();
    $contact->info_name=$data['info_name'];
    $contact->info_address=$data['info_address'];
    $contact->info_contact=$data['info_contact'];
    $contact->info_map=$data['info_map'];
    $contact->info_fanpage=$data['info_fanpage'];
    $contact->info_gmail=$data['info_gmail'];
    $contact->info_slogan=$data['info_slogan'];
    $contact->info_bank=$data['info_bank'];

    $get_image=$request->file('info_image');
        if ($get_image) {
            $get_name_image=$get_image->getClientOriginalName();
            $name_image= current(explode('.',$get_name_image));
            $new_image = $name_image.rand(1000,9999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/logo',$new_image);
            $contact->info_image=$new_image;
            
        }
    $contact->save();
     Toastr::success('Thêm mới thành công !','Thành công');
    return Redirect::to('add-info');
}

public function update_info(Request $request, $info_id)
{
    $data=$request->all();
    $contact= Contact::find($info_id);
    $contact->info_address=$data['info_address'];
    $contact->info_name=$data['info_name'];
    $contact->info_contact=$data['info_contact'];
    $contact->info_map=$data['info_map'];
    $contact->info_fanpage=$data['info_fanpage'];
    $contact->info_gmail=$data['info_gmail'];
    $contact->info_slogan=$data['info_slogan'];
    $contact->info_bank=$data['info_bank'];


    $get_image=$request->file('info_image');
        if ($get_image) {
            unlink('public/uploads/logo/'.$contact->info_image);
            $get_name_image=$get_image->getClientOriginalName();
            $name_image= current(explode('.',$get_name_image));
            $new_image = $name_image.rand(1000,9999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/logo',$new_image);
            $contact->info_image=$new_image;
            
        }
    $contact->save();
     Toastr::success('Cập nhật thông tin thành công !','Thành công');
    return Redirect::to('add-info');
}

public function update_icon(Request $request, $id_icon)
{
    $data=$request->all();
    $icon= Icon::find($id_icon);
    $icon->link=$data['link'];

    $icon->save();
    return Redirect::to('add-info');
}

public function add_partner(Request $request){
    $data =$request->all();
    $partner = new Partner;

    $name= $data['name'];
    $link= $data['link'];
    $get_image=$request->file('file');
    $path='public/uploads/logo/';

    if ($get_image) {
        $get_name_image=$get_image->getClientOriginalName();
        $name_image= current(explode('.',$get_name_image));
        $new_image = $name_image.rand(1000,9999).'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path,$new_image);
        $partner->partner_image=$new_image;
    }
    $partner->partner_name =$name; 
    $partner->partner_link =$link;
    $partner->save();
}

public function list_partner(){
    $partner = Partner::orderBy('partner_id', 'asc')->get();
    $output='';
    $output.='  <table class="table table-striped">
    <thead>
      <tr>
        <th>Tên đối tác</th>
        <th>Link</th>
        <th>Hình ảnh</th>
        <th>xóa</th>
      </tr>
    </thead>
    <tbody>';
    foreach ($partner as $partnerItem) {
        $output.='
    <tr>
        <td>'.$partnerItem->partner_name.'</td>
        <td>'.$partnerItem->partner_link.'</td>
        <td><img height="64px" width="128px" src="'.url('/public/uploads/logo/'.$partnerItem->partner_image).'"></td>
        <td><button id="'.$partnerItem->partner_id.'" class="btn btn-danger" onclick="delete_partner(this.id)"> Xóa</button></td>
    </tr>';
    }
    $output.='
    </tbody>
  </table>';
  echo $output;
}

public function delete_partner()
{
   $id=$_GET['id'];
   $partner = Partner::find($id);
   $partner->delete();
}


// end admin
    public function contact()
    {
        $category_post = CategoryPost::where('cate_post_status',1)->orderBy('cate_post_id', 'DESC')->get();

        // slide
        $slider =Slider::orderBy('slider_id','DESC')->where('slider_status','1')->get();
        $slider_count=Slider::orderBy('slider_id','DESC')->where('slider_status','1')->count();

        $category_product=Category::where('category_status','1')->orderby('category_order','asc')->get();
        $brand_product=Brand::where('brand_status','1')->orderby('brand_order','asc')->get();
        $contact =Contact::where('info_id',1)->get();

        return view('pages.contact.contact')->with('category',$category_product)->with('brand',$brand_product)->with('category_post',$category_post)->with('slider',$slider)->with('slider_count',$slider_count)->with('contact',$contact);

    }
}



