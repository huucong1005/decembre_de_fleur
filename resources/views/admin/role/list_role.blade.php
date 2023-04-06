@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      <div class="col-sm-2"></div>
      <div class="col-sm-8"><center>Danh sách phân quyền</center></div>
      <div class="col-sm-2">
        @can('add-role')
        <a class="btn btn-info" href="{{URL::to('/add-roles')}}">Thêm phân quyền</a>      
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
            <th>Tên quyền</th>
            <th>Mô tả quyền lực</th>
            <th>Hành động</th>
          </tr>
        </thead>
        <tbody>
          @foreach($roles as $item)
          <tr>
            <td>{{$item->role_name}}</td>
            <td>{{$item->role_desc}}</td>
            <td> 
              @can('edit-role')
              @if($item->role_name!='Admin')
              <a href="{{URL::to('/edit-roles/'.$item->role_id)}}" class="active styling-icon" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
              @endif
              @endcan
            <span style="margin: 0px 8px;"></span>
              @can('delete-role')
              @if($item->role_name!='Admin')
              <a href="{{URL::to('/delete-roles/'.$item->role_id)}}" class="active styling-icon" onclick="return confirm('Bạn có chắc muốn xóa quyền này ?')" ui-toggle-class=""><i class="fa fa-trash-o text-danger text"></i></a>
              @endif
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
            {{ $roles->links( "pagination::bootstrap-4") }}
          </ul> 
        </div>
      </div> --}}
    </footer>
  </div>
</div>

@endsection