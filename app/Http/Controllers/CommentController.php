<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Rating;
use Session;
use DB;
use Illuminate\Support\Facades\Redirect;
session_start();
use Toastr;

class CommentController extends Controller{

    public function list_comment(){
        $list_comment=Comment::with('product')->orderBy('comment_status', 'ASC')->get();
        return view('admin.comment.list_comment')->with(compact('list_comment'));
}

public function active_comment($comment_id){
        DB::table('comment')->where('comment_id',$comment_id)->update(['comment_status'=>1]);
         Toastr::success('Hiển thị bình luận thành công !','Thành công');
        return Redirect::to('list-comment');
    }

public function unactive_comment($comment_id){
        DB::table('comment')->where('comment_id',$comment_id)->update(['comment_status'=>0]);
         Toastr::success('Ẩn bình luận thành công !','Thành công');
        return Redirect::to('list-comment');
    }

    public function reply_comment(Request $request)
    {
        $data= $request->all();
        $comment=new Comment;
        $comment->comment =$data['comment'];
        $comment->comment_product_id= $data['comment_product_id'];
        $comment->comment_name= 'Admin';
        $comment->comment_parent_comment= $data['comment_id'];
        $comment->comment_status= 1;
        $comment->save();

    }

    public function delete_comment($comment_id){
        DB::table('comment')->where('comment_parent_comment',$comment_id)->delete();

        $comment =Comment::find( $comment_id);
        $comment->delete();

         Toastr::success('Xóa bình luận thành công !','Thành công');
        return Redirect::to('list-comment');
    }





//end admin

    public function load_comment(Request $request){
        $product_id=$request->product_id;
        $comment= Comment::where('comment_product_id',$product_id)->where('comment_status',1)->orderBy('comment_date', 'DESC')->get();
        $output='';
        foreach($comment as$key=>$commentItem){
            if($commentItem->comment_parent_comment==0){
            $output.='
            <div class="comment_cover row">
                
                <div class="col-md-2">
                    <img src="'.url('../public/uploads/logo/unknow.jpg').'" width="80%" class="img img-responsive img-thumbnail" alt="">
                </div>
                <div class="col-md-10" style="margin-left:-4%">
                    <p>
                        <span style="color:blue;">@'.$commentItem->comment_name.'</span> 
                        <span style="margin-left:20px;"> ('.$commentItem->comment_date.')</span>
                    </p>
                    <p>'.$commentItem->comment.'</p>  
                </div>
            </div><p></p>';

            foreach($comment as$key=>$reply_comment){
                if ($reply_comment->comment_parent_comment==$commentItem->comment_id) {
                    $output.='
            <div class="comment_cover row" style="margin-left:8%;">
                <div class="col-md-2">
                    <img src="'.url('../public/uploads/logo/logo.jpg').'" width="70%" class="img img-responsive img-thumbnail" alt="">
                </div>
                <div class="col-md-10" style="margin-left:-5%">
                    <p>
                        <span style="color:green;">@Admin</span> 
                        <span style="margin-left:20px;"> ('.$reply_comment->comment_date.')</span>
                    </p>
                    <p>'.$reply_comment->comment.'</p>  
                </div>
            </div><br> ';
                }
            }
        }
            
        }
        $output.='';
        echo $output;
        
    }

    public function send_comment(Request $request){
        $product_id=$request->product_id;
        $comment_name=$request->comment_name;
        $comment_content=$request->comment_content;

        $comment=new Comment();
        $comment->comment=$comment_content;
        $comment->comment_name= $comment_name;
        $comment->comment_product_id= $product_id;
        $comment->comment_status= 0;
        $comment->comment_parent_comment= 0;
        $comment->save();
    }

    public function add_rating(Request $request)
    {
        $data=$request->all();
        $rating= new Rating();
        $rating->product_id= $data['product_id'];
        $rating->rating=$data['index'];
        $rating->save();
        echo 'done';

    }



}
