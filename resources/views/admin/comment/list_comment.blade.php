@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      <center>Danh sách bình luận</center>
      </div>  
    </div>
    <?php
      $message = Session::get('message');
      if($message){
        echo '<br><span class="text-success">'.$message.'</span>';
        Session::put('message',null);
      }
    ?>
    <div id="notify_comment"></div>
    <div class="table-responsive"><br>
      <table class="table table-striped b-t b-light" id="dataTableList">
        <thead>
          <tr>
            <th>Duyệt</th>
            <th>Người bình luận</th>
            <th>Bình luận</th>
            <th>Sản phẩm</th>
            <th>Hành động</th>
          </tr>
        </thead>
        <tbody>
          @foreach($list_comment as $key => $comment)
          <?php
              if($comment->comment_parent_comment==0){
          ?>

          <tr>
            <td>

              <?php
              if($comment->comment_status==0){
              ?>
              <a href="{{URL::to('/active-comment/'.$comment->comment_id)}}"><i class="fa-eye-styling fa fa-eye-slash"></i></a>
              <?php
              }else{
              ?>
              <a href="{{URL::to('/unactive-comment/'.$comment->comment_id)}}"><i class="fa-eye-styling fa fa-eye"></i></a>
              <?php 
              }
              ?>

            </td>
            <td style="width: 15%"><p>{{$comment->comment_name}}</p><br><p>({{$comment->comment_date}})</p></td>
            <td style="width: 46%">
              {{$comment->comment}}<br>

              <ul class="list_rep">
                Trả lời:
                @foreach($list_comment as $key=>$comment_reply)
                  @if($comment_reply->comment_parent_comment==$comment->comment_id)
                <li>{{$comment_reply->comment}}</li>
                  @endif
                @endforeach

              </ul>
              
              <textarea style="width: 100%; resize: none; margin-bottom:5px; " rows="2" class="form-control reply_comment_{{$comment->comment_id}}"></textarea><br>
              <button class="btn btn-default btn-xs btn-reply-comment" data-comment_id="{{$comment->comment_id}}" data-product_id="{{$comment->comment_product_id}}">Trả lời</button>


            </td>
            <td style="width: 20%"><a target="blank" href="{{URL::to('chi-tiet-san-pham/'.$comment->product->product_slug)}}">{{$comment->product->product_name}}</a></td>            
            <td>
              {{-- @can('delete-comment') --}}
              <a href="{{URL::to('/delete-comment/'.$comment->comment_id)}}" class="active styling-icon" onclick="return confirm('Bạn có chắc muốn xóa bình luận này ?')" ui-toggle-class=""><i class="fa fa-trash-o text-danger text"></i></a>
              {{-- @endcan --}}
            </td>
          </tr>

          <?php 
              }
          ?>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        
        {{-- <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            {{ $list_comment->links( "pagination::bootstrap-4") }}
          </ul> 
        </div> --}}

      </div>
    </footer>
  </div>
</div>

<script type="text/javascript">
    $('.btn-reply-comment').click(function() {
        var comment_id=$(this).data('comment_id');

        var comment=$('.reply_comment_'+comment_id).val();
        
        var comment_product_id=$(this).data('product_id');

        // alert(comment);alert(comment_product_id);alert(comment_id);
        $.ajax({
                url : '{{url('/reply-comment')}}',
                method: 'POST',
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {comment_product_id:comment_product_id, comment:comment, comment_id:comment_id},
                success:function(data){
                     $('.reply_comment_'+comment_id).val();
                     // $('#notify_comment').html('<span class="text text-success">Trả lười bình luận thành công</span>');
                     alert('Đã trả lời bình luận');
                     // $('#notify_comment').fadeOut(3000);
                     location.reload();
                } 
        });

    });
</script>


@endsection