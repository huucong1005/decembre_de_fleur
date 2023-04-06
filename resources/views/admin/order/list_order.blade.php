@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách đơn đặt hàng
    </div>
    <?php
      $message = Session::get('message');
      if($message){
        echo '<br><span class="text-success">'.$message.'</span>';
        Session::put('message',null);
      }
    ?>
   {{--  <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>                
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div> --}}
    <div class="table-responsive"><br>
      <table class="table table-striped b-t b-light" id="dataTableList">
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
                  Đơn hàng mới
                @elseif($order->order_status==2)
                  Đã xử lý
                @else
                  Hủy đơn hàng
                @endif
            </td>
            <td>{{$order->created_at}}</td>
            <td>{{$order->shipping->shipping_date_revice}}</td>
            <td>
              @can('edit-order')
              <a href="{{URL::to('/view-order/'.$order->order_code)}}" class="active styling-icon" ui-toggle-class=""><i class="fa-eye-styling fa fa-eye text-success text-active"></i></a>
              @endcan
            <span style="margin: 0px 8px;"></span>
              @can('delete-order')
              <a href="{{URL::to('/delete-order/'.$order->order_code)}}" class="active styling-icon" onclick="return confirm('Bạn có chắc muốn xóa danh mục này ?')" ui-toggle-class=""><i class="fa fa-trash-o text-danger text"></i></a>
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

            {{ $all_order->links( "pagination::bootstrap-4") }}
          </ul> 
        </div>
        
      </div> --}}
    </footer>
  </div>
</div>

@endsection