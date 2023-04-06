@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      <div class="col-sm-2"></div>
      <div class="col-sm-8"><center>Danh sách danh mục sản phẩm</center></div>
      <div class="col-sm-2">
        @can('add-category')
        <a class="btn btn-info" href="{{URL::to('/add-category')}}">Thêm danh mục</a>   
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
    <form action="">
      @csrf
    <div class="table-responsive"><br>
      <table class="table table-striped b-t b-light" id="dataTableList">
        <thead>
          <tr>
            {{-- <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th> --}}
            <th>Thứ tự</th>
            <th>Tên danh mục</th>
            <th>Slug</th>
            <th>Thuộc danh mục</th>
            <th>Hiển thị</th>
            <th>Hành động</th>
          </tr>
        </thead>
        <tbody id="category_order">
          @foreach($list_category as $key => $category)
          <tr id="{{$category->category_id}}">
            {{-- <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td> --}}
            <td>{{$category->category_order}}</td>
            <td>{{$category->category_name}}</td>
            <td>{{$category->category_slug}}</td>
            <td>
              @if($category->category_parent==0)
                - - -
              @else
                @foreach($category_parent as$key =>$subItem)
                  @if( $subItem->category_id==$category->category_parent)
                    {{$subItem->category_name}}
                  @endif
                @endforeach
              @endif  
            </td>
            <td>
              <?php
              if($category->category_status==0){
              ?>
              <a href="{{URL::to('/active-category/'.$category->category_id)}}"><i class="fa-eye-styling fa fa-eye-slash"></i></a>
              <?php
              }else{
              ?>
              <a href="{{URL::to('/unactive-category/'.$category->category_id)}}"><i class="fa-eye-styling fa fa-eye"></i></a>
              <?php 
              }
              ?>
            </td>
            <td>
              @can('edit-category')
              <a href="{{URL::to('/edit-category/'.$category->category_id)}}" class="active styling-icon" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
              @endcan
            <span style="margin: 0px 8px;"></span>
              @can('delete-category')
              <a href="{{URL::to('/delete-category/'.$category->category_id)}}" class="active styling-icon" onclick="return confirm('Bạn có chắc muốn xóa danh mục này ?')" ui-toggle-class=""><i class="fa fa-trash-o text-danger text"></i></a>
              @endcan
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    </form>
    <footer class="panel-footer">
{{--       <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            {{ $list_category->links( "pagination::bootstrap-4") }}
          </ul> 
        </div>
      </div> --}}
    </footer>
  </div>
</div>

@endsection