@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      <div class="col-sm-2"></div>
      <div class="col-sm-8"><center>Danh sách user</center></div>
      <div class="col-sm-2">
        @can('add-user')
        <a class="btn btn-info" href="{{URL::to('/add-user')}}">Thêm user</a>    
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
            <th>Id</th>
            <th>Tên user</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Hành động</th>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $key => $user)
          <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->phone}}</td>
            <td>
              @can('edit-user')
              @if($user->email!='admin@gmail.com')
              <a href="{{URL::to('/edit-user/'.$user->id)}}" class="active styling-icon" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
              @endif
              @endcan
            <span style="margin: 0px 8px;"></span>
              @can('delete-user')
              @if($user->email!='admin@gmail.com')
              <a href="{{URL::to('/delete-user/'.$user->id)}}" class="active styling-icon" onclick="return confirm('Bạn có chắc muốn xóa user này ?')" ui-toggle-class=""><i class="fa fa-trash-o text-danger text"></i></a>
              @endif
              @endcan
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        {{-- <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>

        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            {{ $users->links( "pagination::bootstrap-4") }}
          </ul> 
        </div> --}}
        
      </div>
    </footer>
  </div>
</div>

@endsection