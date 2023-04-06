@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Chỉnh sửa slider
                        </header>
                        <div class="panel-body">
                        @foreach($edit_slider as $key =>$edit_value)
                            <div class="position-center">
                                <form role="form" enctype="multipart/form-data" action="{{URL::to('/update-slider/'.$edit_value->slider_id)}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên slider</label>
                                    <input type="text" name="slider_name" class="form-control" id="exampleInputEmail1" value="{{$edit_value->slider_name}}"  required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả</label>
                                    <textarea style="resize: none" rows="6" class="form-control" name="slider_desc" id="exampleInputPassword1" >{{$edit_value->slider_desc}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">Hình ảnh</label>
                                    <input type="file" name="slider_image" onchange="previewfile(this)" class="form-control image-preview" id="exampleInput"  required>
                                    <img src="{{URL::to('public/uploads/slider/'.$edit_value->slider_image)}}" height="150" width="120">
                                </div>

                                <button type="submit" name="update_slider" class="btn btn-info">cập nhật</button>
                            	</form>
                        	</div>
                        @endforeach
                        </div>
                    </section>

            </div>
@endsection