@extends('layout')
@section('content')
	<h2 class="title text-center">Lịch sử đặt hàng</h2>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{URL::to('/trang-chu')}}">Trang chủ</a></li>
    <li class="breadcrumb-item active" aria-current="page">Lịch sử đặt hàng</li>
  </ol>
</nav>

<div class="table-responsive"><br>
      <table class="table table-bordered b-t b-light" id="dataTableList">
        <thead>
          <tr>
            <th>Stt</th>
            <th>Mã đơn hàng</th>
            <th>Tình trạng đơn hàng</th>
            <th>Ngày đặt hàng</th>
            <th>Ngày nhận hàng</th>
            <th>Hành động</th>
          </tr>
        </thead>
        <tbody>
          @php
            $i=0;
          @endphp
          @foreach($all_order as $key => $order)
          @php
            $i++;
          @endphp
          <tr>
            <td><i>{{$i}}</i></td>
            <td>{{$order->order_code}}</td>
            <td>@if($order->order_status==1)
                  <span class="text-info">Đơn hàng mới</span>
                @elseif($order->order_status==2)
                  <span class="text-success">Đã xử lý</span>
                @else
                  <span class="text-danger">Hủy đơn hàng</span>
                @endif
            </td>
            <td>{{$order->created_at}}</td>
            <td>{{$order->shipping->shipping_date_revice}}</td>
            <td>
              
              <a href="{{URL::to('/view-history-order/'.$order->order_code)}}" class="active styling-icon" ui-toggle-class=""><i class="fa fa-eye text-success mr-2"></i>Chi tiết</a>
              
            <span style="margin: 0px 10px;"></span>
            @if($order->order_status==1) 
              <a href="{{URL::to('/cancel-order/'.$order->order_code)}}" class="active styling-icon" onclick="return confirm('Bạn có chắc muốn hủy đơn này ?')" ui-toggle-class=""><i class="fa fa-power-off mr-2 text-danger "></i>Hủy</a>
            @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div>
    	<div class="pagination pagination-sm m-t-none m-b-none">
        {{ $all_order->links("pagination::bootstrap-4") }}
    </div>
    </div>


@endsection