@extends('layout')
@section('content')
	<h2 class="title text-center">Chi tiết đơn đặt hàng #{{$order_code}}</h2>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{URL::to('/trang-chu')}}">Trang chủ</a></li>
    <li class="breadcrumb-item"><a href="{{URL::to('/history-order')}}">Lịch sử đặt hàng</a></li>
    <li class="breadcrumb-item active" aria-current="page">Chi tiết đơn đặt hàng #{{$order_code}}</li>
  </ol>
</nav>

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading text-align-left">
      Thông tin đơn hàng
    </div>

    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Mã đơn</th>
            <th>Tình trạng</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{$order_code}}</td>
            <td>
            @foreach($order as $key=>$ord_status)
              @if($ord_status->order_status==1)
                <span class="text-info">Đơn hàng mới</span>
              @elseif($ord_status->order_status==2)
                <span class="text-success">Đã xử lý</span>
              @else
                <span class="text-danger">Hủy đơn hàng</span>
              @endif
            @endforeach</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading text-align-left">
      Thông tin người mua
    </div>

    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên khách hàng</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Ngày đặt hàng</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{$customer->customer_name}}</td>
            <td>{{$customer->customer_phone}}</td>
            <td>{{$customer->customer_email}}</td>
            <td>{{$shipping->created_at}}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
<div class="panel panel-default">
    <div class="panel-heading text-align-left">
      Thông tin vận chuyển
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên người nhận</th>
            <th>Ngày nhận</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th>Hình thức thanh toán</th>
            <th>Ghi chú</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{$shipping->shipping_name}}</td>
            <td>{{$shipping->shipping_date_revice}}</td>
            <td>{{$shipping->shipping_address}}</td>
            <td>{{$shipping->shipping_phone}}</td>
            <td>@if($shipping->shipping_method=='direct_payment')
                  Thanh toán khi nhận hàng
                @elseif($shipping->shipping_method=='vnpay')
                  Thanh toán qua VN Pay
                @else
                  Thanh toán bằng chuyển khoản
                @endif
            </td>
            <td>{{$shipping->shipping_notes}}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading text-align-left">
      Chi tiết sản phẩm
    </div>
    <div class="table-responsive">
      <table class="table b-t b-light">
        <thead>
          <tr>
            <th>Stt</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng mua</th>
            <th>Giá</th>
            <th>Tổng tiền</th> 
          </tr>
        </thead>
        <tbody>
          @php $i=0;  $total=0; @endphp
          @foreach($order_details as$key=>$details)
            @php 
              $i++;
              $subtotal=$details->product_price*$details->product_sales_quantity;
              $total+=$subtotal
            @endphp
          <tr class="color_qty_{{$details->product_id}}">
            <td><i>{{$i}}</i></td>
            <td>{{$details->product_name}}</td>
            <td>{{$details->product_sales_quantity}}</td>
              
            <td>{{number_format($details->product_price,0,',','.')}}</td>
            <td>{{number_format($subtotal,0,',','.')}}</td>
          </tr>
          
          @endforeach
          
          <tr><td colspan="5"><p></p></td></tr>
          <tr class="panel-heading text-align-right">
            
            <td colspan="4">Tổng giá trị đơn hàng: </td>
            <td style="text-align: right;">{{number_format($total,0,',','.')}}</td>
          </tr>
          <tr class="panel-heading text-align-right">
            
            <td colspan="4">Mã coupon:  @php
                            if($details->product_coupon!='---'){
                              echo $details->product_coupon;
                            }else{
                              echo 'Không coupon';
                            }
                            @endphp
            </td>
            <td style="text-align: right;">
              @php
                $total_coupon=0;
                if($coupon_function==1){
                  $total_after_coupon= ($total*$coupon_number)/100;
                  $total_coupon= $total-$total_after_coupon;
                  echo '- '.number_format($total_after_coupon,0,',','.');
                }elseif($coupon_function==2){
                  $total_coupon= $total-$coupon_number;
                  echo '- '.number_format($coupon_number,0,',','.');
                }
              @endphp
            </td>
          </tr ><tr class="panel-heading text-align-right">
            
            <td colspan="4">Phí vận chuyển: </td>
            <td  style="text-align: right;">{{'+ '.number_format($details->product_feeship,0,',','.')}}</td>
          </tr>
          <tr class="panel-heading text-align-right" style="font-weight: bold;">
            
            <td colspan="4">Tổng: </td>
            <td  style="text-align: right;">{{number_format(($total_coupon+$details->product_feeship),0,',','.')}}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div><center><a href="{{URL::to('/history-order')}}" class="btn btn-warning"> <i class="fa fa-arrow-left mr-4"></i>Quay lại</a></center>
</div>




@endsection