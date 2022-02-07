@extends('admin_layout')
@section('admin_content')

<div class="panel-heading">
      Chi tiết đơn đặt hàng
</div><br><br>

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Thông tin người mua
    </div>

    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên khách hàng</th>
            <th>Số điện thoại</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{$order_by_id->customer_name}}</td>
            <td>{{$order_by_id->customer_phone}}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
<div class="panel panel-default">
    <div class="panel-heading">
      Thông tin vận chuyển
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên người nhận</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{$order_by_id->shipping_name}}</td>
            <td>{{$order_by_id->shipping_address}}</td>
            <td>{{$order_by_id->shipping_phone}}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <br><br>
  <div class="panel panel-default">
    <div class="panel-heading">
      Chi tiết sản phẩm
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá</th>
            <th>Tổng tiền</th> 
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
          </tr>
        </thead>
        <tbody>
    
          <tr>
            <td>{{$order_by_id->product_name}}</td>
            <td>{{$order_by_id->product_sales_quantity}}</td>
            <td>{{$order_by_id->product_price}}</td>
            <td>{{$order_by_id->product_price*$order_by_id->product_sales_quantity}}</td>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
          </tr>

        </tbody>
      </table>
    </div>
  </div>
</div>


@endsection