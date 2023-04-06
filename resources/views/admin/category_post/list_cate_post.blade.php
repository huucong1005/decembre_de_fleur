@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      <div class="col-sm-3"></div>
      <div class="col-sm-6"><center>Danh sách danh mục bài viết</center></div>
      <div class="col-sm-3">
        {{-- @can('add-category') --}}
        <a class="btn btn-info" href="{{URL::to('/add-cate-post')}}">Thêm danh mục bài viết</a>   
        {{-- @endcan          --}}
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
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Tên danh mục</th>
            <th>Slug</th>
            <th>Hiển thị</th>
            <th>Hành động</th>
          </tr>
        </thead>
        <tbody>
          @foreach($list_cate_post as $key => $catePostItem)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$catePostItem->cate_post_name}}</td>
            <td>{{$catePostItem->cate_post_slug}}</td>
            <td>
              <?php
              if($catePostItem->cate_post_status==0){
              ?>
              <a href="{{URL::to('/active-cate-post/'.$catePostItem->cate_post_id)}}"><i class="fa-eye-styling fa fa-eye-slash"></i></a>
              <?php
              }else{
              ?>
              <a href="{{URL::to('/unactive-cate-post/'.$catePostItem->cate_post_id)}}"><i class="fa-eye-styling fa fa-eye"></i></a>
              <?php 
              }
              ?>
            </td>
            <td>
              {{-- @can('edit-category') --}}
              <a href="{{URL::to('/edit-cate-post/'.$catePostItem->cate_post_id)}}" class="active styling-icon" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
              {{-- @endcan --}}
            <span style="margin: 0px 8px;"></span>
              {{-- @can('delete-category') --}}
              <a href="{{URL::to('/delete-cate-post/'.$catePostItem->cate_post_id)}}" class="active styling-icon" onclick="return confirm('Bạn có chắc muốn xóa danh mục này ?')" ui-toggle-class=""><i class="fa fa-trash-o text-danger text"></i></a>
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

            {{ $list_cate_post->links( "pagination::bootstrap-4") }}
          </ul> 
        </div>
      </div> --}}
    </footer>
  </div>
</div>

@endsection