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
                                    <input type="text" name="category_name" class="form-control"  id="slug" onkeyup="ChangeToSlug();" value="{{$edit_value->category_name}}"  required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" name="category_slug" class="form-control" id="convert_slug" value="{{$edit_value->category_slug}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Danh mục gốc</label>
                                    <select name="category_parent" class="form-control m-bot15">

                                        <option value="0">Danh mục gốc</option> 
                                        @foreach($category_parent as $key => $val)
                                        <option {{$val->category_id==$edit_value->category_parent ? 'selected' : ''}} value="{{$val->category_id}}">{{$val->category_name}}</option> 
                                        @endforeach

                                    </select>
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