@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm danh mục sản phẩm
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/store-category')}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục</label>
                                    <input type="text" name="category_name" class="form-control" placeholder="Tên danh mục" required id="slug" onkeyup="ChangeToSlug();" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" name="category_slug" class="form-control " id="convert_slug" placeholder="slug">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả</label>
                                    <textarea style="resize: none" rows="6" class="form-control" name="category_desc" id="exampleInputPassword1" placeholder="Mô tả"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Danh mục gốc</label>
                                    <select name="category_parent" class="form-control m-bot15">
                                        <option value="0">Danh mục gốc</option> 
                                        @foreach($category_parent as $key => $val)
                                        <option value="{{$val->category_id}}">{{$val->category_name}}</option> 
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                	<label for="exampleInputPassword1">Hiển thị</label>
                                	<select name="category_status" class="form-control m-bot15">
                                        <option value="1">Hiển</option>
                                        <option value="0">Ẩn</option>
                            		</select>
                                </div>

                                <button type="submit" name="store_category" class="btn btn-info">Thêm</button>
                            	</form>
                        	</div>

                        </div>
                    </section>

            </div>
@endsection