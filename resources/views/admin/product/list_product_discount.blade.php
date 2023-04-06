@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      <div class="col-sm-2"></div>
      <div class="col-sm-8"><center>Quản lý giá sản phẩm</center></div>
      <div class="col-sm-2">
        <a class="btn btn-info" href="{{URL::to('/edit-discount-all')}}">Giảm giá tất cả</a>   
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
            <th>Tên sản phẩm</th>
            <th>Hình ảnh</th>
            <th>Số lượng</th>
            <th>Giá nhập</th>
            <th>Giá bán</th>
            <th>Giảm (%)</th>
            <th>Giá thực</th>
            <th>Hành động</th>
          </tr>
        </thead>
        <tbody>
          @foreach($list_product_discount as $key => $product)
          <tr>
            <td>
              <p>{{$product->product_name}}</p><br>
              <p>(.../{{$product->product_slug}})</p><br>
            </td>
            <td><img src="public/uploads/product/{{$product->product_image}}" height="120" width="90"></td>
            <td>{{$product->product_quantity}}</td>
            <td>{{number_format($product->product_cost,0,',','.') }} VND</td>
            <td>{{number_format($product->product_price,0,',','.') }} VND</td>
            <td><p>{{$product->product_discount}} %</p><hr>
                <p>= {{number_format((($product->product_price*$product->product_discount)/100),0,',','.') }} VND</p></td>
            <td><b>{{number_format(($product->product_price - (($product->product_price*$product->product_discount)/100)),0,',','.') }}</b> VND</td>
            
            <td>
              
              <a href="{{URL::to('/edit-product-discount/'.$product->product_id)}}" class="active styling-icon" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
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