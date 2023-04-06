@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm slider
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" enctype="multipart/form-data" action="{{URL::to('/store-slider')}}" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên slider</label>
                                    <input type="text" name="slider_name" class="form-control" id="exampleInputEmail1" placeholder="Tên slider" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả</label>
                                    <textarea style="resize: none" rows="6" class="form-control" name="slider_desc" id="exampleInputPassword1" placeholder="Mô tả"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">Hình ảnh</label>
                                    <input type="file" name="slider_image" onchange="previewfile(this)" class="form-control image-preview" id="exampleInput"  required>
                                    <img class="previewImg" src="{{asset('public/uploads/logo/no-image.png')}}" width="30%" >
                                </div>
                                
                                <div class="form-group">
                                	<label for="exampleInputPassword1">Hiển thị</label>
                                	<select name="slider_status" class="form-control m-bot15">
                               			<option value="0">Ẩn</option>
                                		<option value="1">Hiển</option>
                            		</select>
                                </div>

                                <button type="submit" name="store_brand" class="btn btn-info">Thêm</button>
                            	</form>
                        	</div>

                        </div>
                    </section>

            </div>
@endsection