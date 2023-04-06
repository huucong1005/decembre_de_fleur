@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      <div class="col-sm-2"></div>
      <div class="col-sm-8"><center>Danh sách slider</center></div>
      <div class="col-sm-2">
        @can('add-slider')
          <a class="btn btn-info" href="{{URL::to('/add-slider')}}">Thêm slider</a>
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
            {{-- <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th> --}}
            <th>Tên slider</th>
            <th>Hình ảnh</th>
            <th style="width: 45%;">Mô tả</th>
            <th>Hiển thị</th> 
            <th>Hành động</th>
          </tr>
        </thead>
        <tbody>
         @foreach($all_slider as $key => $slider)
          <tr>
            {{-- <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td> --}}
            <td>{{$slider->slider_name}}</td>
            <td><img src="public/uploads/slider/{{$slider->slider_image}}" height="90" width="120"></td>
            <td>{{$slider->slider_desc}}</td>
            <td>
              <?php
              if($slider->slider_status==0){
              ?>
              <a href="{{URL::to('/active-slider/'.$slider->slider_id)}}"><i class="fa-eye-styling fa fa-eye-slash"></i></a>
              <?php
              }else{
              ?>
              <a href="{{URL::to('/unactive-slider/'.$slider->slider_id)}}"><i class="fa-eye-styling fa fa-eye"></i></a>
              <?php 
              }
              ?>
            </td>
            <td>
              @can('edit-slider')
              <a href="{{URL::to('/edit-slider/'.$slider->slider_id)}}" class="active styling-icon" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
              @endcan
            <span style="margin: 0px 8px;"></span>
              @can('delete-slider')
              <a href="{{URL::to('/delete-slider/'.$slider->slider_id)}}" class="active styling-icon" onclick="return confirm('Bạn có chắc muốn xóa slide này ?')" ui-toggle-class=""><i class="fa fa-trash-o text-danger text"></i></a>
              @endcan
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
            {{ $all_slider->links( "pagination::bootstrap-4") }}
          </ul> 
        </div>
      </div> --}}
    </footer>
  </div>
</div>

@endsection