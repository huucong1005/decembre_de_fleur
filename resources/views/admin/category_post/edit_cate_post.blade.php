@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Chỉnh sửa danh mục bài viết
                        </header>
                        <div class="panel-body">
                        @foreach($edit_cate_post as $key =>$edit_value)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-cate-post/'.$edit_value->cate_post_id)}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục</label>
                                    <input type="text" name="cate_post_name" class="form-control"  id="slug" onkeyup="ChangeToSlug();" value="{{$edit_value->cate_post_name}}"  required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" name="cate_post_slug" class="form-control" id="convert_slug" value="{{$edit_value->cate_post_slug}}">
                                </div>   
                                <button type="submit" name="update_cate_post" class="btn btn-info">cập nhật</button>
                            	</form>
                        	</div>
                        @endforeach
                        </div>
                    </section>

            </div>
@endsection