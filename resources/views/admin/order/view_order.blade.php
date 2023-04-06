@extends('admin_layout')
@section('admin_content')

<div class="panel panel-default"><div class="panel-heading">
      Chi tiết đơn đặt hàng
</div></div>

<div class="table-agile-info">
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

  <br><br>
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
            <th>Tồn kho</th>
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
            <td>{{$details->product_quantity}}</td>
            {{-- <td>{{$details->product->product_quantity}}</td> --}}
 
              @if($order_status!=2)
            <td>
              <form action="">
              @csrf
              <input type="number"  min="0" value="{{$details->product_sales_quantity}}" name="product_sales_quantity" class="order_qty_{{$details->product_id}}" style=" width: 90px;">
              <input type="hidden" class="product_qty_{{$details->product_id}}" value="{{$details->product_quantity}}" name="product_qty">
              {{-- <input type="hidden" class="product_qty_{{$details->product_id}}" value="{{$details->product->product_quantity}}" name="product_qty"> --}}
              <input type="hidden" class="order_code" value="{{$details->order_code}}" name="order_code">
              <input type="hidden" class="order_product_id" value="{{$details->product_id}}" name="order_product_id">
              <button type="" name="update_quantity_order" data-product_id="{{$details->product_id}}" class="btn btn-info update_quantity_order">Cập nhật</button>
              </form>
            </td>
              @else 
            <td>
              <input type="number" disabled  min="1" value="{{$details->product_sales_quantity}}" name="product_sales_quantity" class="order_qty_{{$details->product_id}}" style=" width: 90px;">
              <input type="hidden" class="product_qty_{{$details->product_id}}" value="{{$details->product_quantity}}" name="product_qty">
              {{-- <input type="hidden" class="product_qty_{{$details->product_id}}" value="{{$details->product->product_quantity}}" name="product_qty"> --}}
              <input type="hidden" class="order_code" value="{{$details->order_code}}" name="order_code">
              <input type="hidden" class="order_product_id" value="{{$details->product_id}}" name="order_product_id">
            </td>
              @endif
            <td>{{number_format($details->product_price,0,',','.')}}</td>
            <td>{{number_format($subtotal,0,',','.')}}</td>
          </tr>
          
          @endforeach
          <tr>
            <td colspan="6">
            @foreach($order as $key=>$ord_status)
            @if($ord_status->order_status==1)
              <form action="">
                @csrf
                <select class="form-control order_details"  name="" id="">
                  <option id="{{$ord_status->order_id}}" selected value="1">Đơn hàng mới</option>
                  <option id="{{$ord_status->order_id}}" value="2">Đã xử lý</option>
                </select>
              </form>
            @elseif($ord_status->order_status==2)
              <form action="">
                @csrf
                <select class="form-control order_details"  name="" id="">
                  <option id="{{$ord_status->order_id}}" selected value="2">Đã xử lý</option>
                  <option id="{{$ord_status->order_id}}" value="3">Hủy đơn hàng</option>
                </select>
              </form>
            @else
              <form action="">
                @csrf
                <select class="form-control order_details"  name="" id="">
                  <option id="{{$ord_status->order_id}}" value="2">Đã xử lý</option>
                  <option id="{{$ord_status->order_id}}" selected value="3">Hủy đơn hàng</option>
                </select>
              </form>
            @endif
            @endforeach
            </td>
          </tr>
          <tr><td> </td></tr>
          <tr class="panel-heading text-align-right">
            <td colspan="5">Tổng giá trị đơn hàng: </td>
            <td>{{number_format($total,0,',','.')}}</td>
          </tr>
          <tr class="panel-heading text-align-right">
            <td colspan="5">Mã coupon:  @php
                            if($details->product_coupon!='---'){
                              echo $details->product_coupon;
                            }else{
                              echo 'Không coupon';
                            }
                            @endphp
            </td>
            <td>
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
            <td colspan="5">Phí vận chuyển: </td>
            <td >{{'+ '.number_format($details->product_feeship,0,',','.')}}</td>
          </tr>
          <tr class="panel-heading text-align-right" style="font-weight: bold;">
            <td colspan="5">Tổng: </td>
            <td >{{number_format(($total_coupon+$details->product_feeship),0,',','.')}}</td>
          </tr>
        </tbody>
      </table>
      @if($order_status==2)
      <a target="blank" class="btn btn-warning" style="float: right; padding:8px 15px; margin:15px 25px;" href="{{url('/print-order/'.$details->order_code)}}"><i class="fa fa-print" style="margin-right: 10px;"></i> In đơn hàng</a>
      @endif
    </div>
  </div>
</div>


@endsection