@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      <div class="col-sm-2"></div>
      <div class="col-sm-8"><center>Danh sách thương hiệu sản phẩm</center></div>
      <div class="col-sm-2">
          @can('add-brand')
            <a class="btn btn-info" href="{{URL::to('/add-brand')}}">Thêm thương hiệu</a>   
          @endcan   
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
            <th>Thứ tự</th>
            <th>Tên thương hiệu</th>
            <th>Slug</th>
            <th>Hiển thị</th>
            <th>Hành động</th>
          </tr>
        </thead>
        <tbody id="brand_order">
          @foreach($list_brand as $key => $brand)
          <tr id="{{$brand->brand_id}}">
            <td>{{$brand->brand_order}}</td>
            <td>{{$brand->brand_name}}</td>
            <td>{{$brand->brand_slug}}</td>
            <td>

              <?php
              if($brand->brand_status==0){
              ?>
              <a href="{{URL::to('/active-brand/'.$brand->brand_id)}}"><i class="fa-eye-styling fa fa-eye-slash"></i></a>
              <?php
              }else{
              ?>
              <a href="{{URL::to('/unactive-brand/'.$brand->brand_id)}}"><i class="fa-eye-styling fa fa-eye"></i></a>
              <?php 
              }
              ?>

            </td>
            <td>
              @can('edit-brand')
              <a href="{{URL::to('/edit-brand/'.$brand->brand_id)}}" class="active styling-icon" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
              @endcan
              <span style="margin: 0px 8px;"></span>
              @can('delete-brand')
              <a href="{{URL::to('/delete-brand/'.$brand->brand_id)}}" class="active styling-icon" onclick="return confirm('Bạn có chắc muốn xóa thương hiệu này ?')" ui-toggle-class=""><i class="fa fa-trash-o text-danger text"></i></a>
              @endcan
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
   {{--  <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            {{ $list_brand->links( "pagination::bootstrap-4") }}
          </ul> 
        </div>
 
      </div>
    </footer>--}}
  </div>
</div>

@endsection