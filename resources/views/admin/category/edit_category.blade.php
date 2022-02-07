@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Chỉnh sửa danh mục sản phẩm
                        </header>
                        <div class="panel-body">
                        @foreach($edit_category as $key =>$edit_value)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-category/'.$edit_value->category_id)}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục</label>
                                    <input type="text" name="category_name" class="form-control" id="exampleInputEmail1" value="{{$edit_value->category_name}}"  required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả</label>
                                    <textarea style="resize: none" rows="6" class="form-control" name="category_desc" id="exampleInputPassword1" >{{$edit_value->category_desc}}</textarea>
                                </div>

                                <button type="submit" name="update_category" class="btn btn-info">cập nhật</button>
                            	</form>
                        	</div>
                        @endforeach
                        </div>
                    </section>

            </div>
@endsection