@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      <div class="col-sm-2"></div>
      <div class="col-sm-8"><center>Danh sách bài viết</center></div>
      <div class="col-sm-2">
        {{-- @can('add-post') --}}
        <a class="btn btn-info" href="{{URL::to('/add-post')}}">Thêm bài viết</a>  
        {{-- @endcan --}}
      </div>
    </div>
    <?php
      $message = Session::get('message');
      if($message){
        echo '<br><span class="text-success">'.$message.'</span>';
        Session::put('message',null);
      }
    ?>
    <div class="table-responsive"><br>
      <table class="table table-striped b-t b-light" id="dataTableList">
        <thead>
          <tr>
            {{-- <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th> --}}
            <th>Tên bài viết</th>
            <th>Hình ảnh</th>
            <th>Danh mục</th>
            <th>Hiển thị</th>
            <th>Hành động</th>
          </tr>
        </thead>
        <tbody>
          @foreach($list_post as $key => $post)
          <tr>
            {{-- <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td> --}}
            <td><p>{{$post->post_name}}</p><br><p>{{$post->post_slug}}</p></td>
           {{--  <td>{{$post->post_slug}}</td> --}}
            <td><img src="public/uploads/post/{{$post->post_image}}" height="120" width="200"></td>
            <td>{{$post->cate_post->cate_post_name}}</td>
            <td>
              <?php
              if($post->post_status==0){
              ?>
              <a href="{{URL::to('/active-post/'.$post->post_id)}}"><i class="fa-eye-styling fa fa-eye-slash"></i></a>
              <?php
              }else{
              ?>
              <a href="{{URL::to('/unactive-post/'.$post->post_id)}}"><i class="fa-eye-styling fa fa-eye"></i></a>
              <?php 
              }
              ?>
            </td>
            <td>
              {{-- @can('edit-post') --}}
              <a href="{{URL::to('/edit-post/'.$post->post_id)}}" class="active styling-icon" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
              {{-- @endcan --}}
            <span style="margin: 0px 8px;"></span>
              {{-- @can('delete-post') --}}
              <a href="{{URL::to('/delete-post/'.$post->post_id)}}" class="active styling-icon" onclick="return confirm('Bạn có chắc muốn xóa bài viết này ?')" ui-toggle-class=""><i class="fa fa-trash-o text-danger text"></i></a>
              {{-- @endcan --}}
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      {{-- <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>


        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            {{ $list_post->links( "pagination::bootstrap-4") }}
          </ul> 
        </div>

      </div> --}}
    </footer>
  </div>
</div>

@endsection