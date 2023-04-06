@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      <div class="col-sm-2">
        
      </div>
      <div class="col-sm-8"><center>Danh sách mã giảm giá</center></div>
      <div class="col-sm-2">
        @can('add-coupon')
          <a class="btn btn-info" href="{{URL::to('/add-coupon')}} ">Thêm Coupon</a>      
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
            </th>--}}
            <th>Tên mã</th>
            <th>Mã giảm giá</th>
            <th>Số lượng mã</th>
            <th>Loại mã giảm</th>
            <th>Số giảm</th>
            <th>Ngày bắt đầu</th>
            <th>Ngày kết thúc</th>
            <th>Tình trạng</th>
            <th>Hết hạn</th>
            <th>Hành động</th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_coupon as $key => $coupon)
          <tr>
            {{-- <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td> --}}
            <td>
              {{$coupon->coupon_name}}<p style="margin-top: 10px;"></p>
              @if($coupon->coupon_status==1 && $coupon->coupon_quantity>0 && $coupon->coupon_end>$now)
                <a class="btn btn-default btn-xs" href="{{URL::to('/send-coupon',[
                  'coupon_quantity'=>$coupon->coupon_quantity,
                  'coupon_code'=>$coupon->coupon_code,
                  'coupon_number'=>$coupon->coupon_number,
                  'coupon_function'=>$coupon->coupon_function
                ])}}">Gửi email <br>cho khách</a>
              @endif
            </td>
            <td>{{$coupon->coupon_code}}</td>
            <td>{{$coupon->coupon_quantity}}</td>

            <td>
              <?php   if($coupon->coupon_function==1){    ?>
              Giảm theo %
              <?php   }else{    ?>
              Giảm theo tiền
              <?php   }         ?>
            </td>

            <td>
              <?php   if($coupon->coupon_function==1){    ?>
              Giảm {{$coupon->coupon_number}} %
              <?php   }else{    ?>
              Giảm {{$coupon->coupon_number}} VND
              <?php   }         ?>
            </td>
            <td>{{$coupon->coupon_start}}</td>
            <td>{{$coupon->coupon_end}}</td>
            <td>
              <?php
              if($coupon->coupon_status==0){
              ?>
              <a href="{{URL::to('/active-coupon/'.$coupon->coupon_id)}}"><i class="fa-eye-styling fa fa-lock"></i></a>
              <?php
              }else{
              ?>
              <a href="{{URL::to('/unactive-coupon/'.$coupon->coupon_id)}}"><i class="fa-eye-styling fa fa-unlock"></i></a>
              <?php 
              }
              ?>
            </td>
            <td>
              
                @if($coupon->coupon_end>=$now)
                  <p style="color: green;">còn hạn</p>
                @else
                  <p style="color: red;">hết hạn</p>
                @endif
               
            </td>
            <td>
              @can('delete-coupon')
              <a href="{{URL::to('/delete-coupon/'.$coupon->coupon_id)}}" class="active styling-icon" onclick="return confirm('Bạn có chắc muốn xóa mã này ?')" ui-toggle-class=""><i class="fa fa-trash-o text-danger text"></i></a>
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
            {{ $all_coupon->links( "pagination::bootstrap-4") }}
          </ul> 
        </div>
      </div> --}}
    </footer>
  </div>
</div>

@endsection