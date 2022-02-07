@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Chỉnh sửa thương hiệu sản phẩm
                        </header>
                        <div class="panel-body">
                        @foreach($edit_brand as $key =>$edit_value)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-brand/'.$edit_value->brand_id)}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên thương hiệu</label>
                                    <input type="text" name="brand_name" class="form-control" id="exampleInputEmail1" value="{{$edit_value->brand_name}}"  required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả</label>
                                    <textarea style="resize: none" rows="6" class="form-control" name="brand_desc" id="exampleInputPassword1" >{{$edit_value->brand_desc}}</textarea>
                                </div>

                                <button type="submit" name="update_brand" class="btn btn-info">cập nhật</button>
                            	</form>
                        	</div>
                        @endforeach
                        </div>
                    </section>

            </div>
@endsection