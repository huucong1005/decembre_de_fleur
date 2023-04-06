@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      <div class="col-sm-2"></div>
      <div class="col-sm-8"><center>Danh sách sản phẩm</center></div>
      <div class="col-sm-2">@can('add-product')
        <a class="btn btn-info" href="{{URL::to('/add-product')}}">Thêm sản phẩm</a>  
        @endcan</div>
      
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
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Hình ảnh</th>
            <th>Danh mục</th>
            <th>Thương hiệu</th>
            <th>Hiển thị</th>
            <th>Hành động</th>
          </tr>
        </thead>
        <tbody>
          @foreach($list_product as $key => $product)
          <tr>
            <td>
              <p>{{$product->product_name}}</p><br>
              <p>(.../{{$product->product_slug}})</p><br>
              <a class="btn btn-sm btn-default" href="{{URL::to('/add-gallery/'.$product->product_id)}}">Thêm gallery</a>  
            </td>
            <td>{{$product->product_quantity}}</td>
            <td><img src="public/uploads/product/{{$product->product_image}}" height="120" width="90"></td>
            <td>{{$product->category->category_name}}</td>
            <td>{{$product->brand->brand_name}}</td>
            <td>
              <?php
              if($product->product_status==0){
              ?>
              <a href="{{URL::to('/active-product/'.$product->product_id)}}"><i class="fa-eye-styling fa fa-eye-slash"></i></a>
              <?php
              }else{
              ?>
              <a href="{{URL::to('/unactive-product/'.$product->product_id)}}"><i class="fa-eye-styling fa fa-eye"></i></a>
              <?php 
              }
              ?>
            </td>
            <td>
              @can('edit-product')
              <a href="{{URL::to('/edit-product/'.$product->product_id)}}" class="active styling-icon" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
              @endcan
              <span style="margin: 0px 8px;"></span>
              @can('delete-product')
              <a href="{{URL::to('/delete-product/'.$product->product_id)}}" class="active styling-icon" onclick="return confirm('Bạn có chắc muốn xóa danh mục này ?')" ui-toggle-class=""><i class="fa fa-trash-o text-danger text"></i></a>
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
            {{ $list_product->links( "pagination::bootstrap-4") }}
          </ul> 
        </div>

      </div> --}}
    </footer>
  </div>
</div>

@endsection