@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm bài viết
                        </header>
                        <?php
                            $message = Session::get('message');
                            if($message){
                            echo '<br><span class="text-success">'.$message.'</span>';
                            Session::put('message',null);
                        }
    ?>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" enctype="multipart/form-data" action="{{URL::to('/store-post')}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInput">Tên bài viết</label>
                                    <input type="text" data-validation="length" data-validation-length="min3" data-validation-error-msg="Phải điền ít nhất 3 kí tự"  name="post_name" class="form-control" placeholder="Tên sản phẩm" required id="slug" onkeyup="ChangeToSlug();" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" name="post_slug" class="form-control " id="convert_slug" placeholder="slug">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">Hình ảnh bài viết</label>
                                    <input type="file" name="post_image" class="form-control" id="exampleInput"  required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">Mô tả bài viết</label>
                                    <textarea style="resize: none" rows="3" class="form-control" name="post_desc" id="ckeditor5" placeholder="Mô tả"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">Nội dung bài viết</label>
                                    <textarea style="resize: none" rows="6" class="form-control" name="post_content" id="ckeditor6" placeholder="Mô tả"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">Danh mục bài viết</label>
                                    <select name="cate_post_id" class="form-control m-bot15">
                                    @foreach($category_post as $key => $catePostItem)                                     
                                        <option value="{{$catePostItem->cate_post_id}}">{{$catePostItem->cate_post_name}}</option>
                                    @endforeach    
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">Hiển thị</label>
                                    <select name="post_status" class="form-control m-bot15">
                                        <option value="1">Hiển</option>
                                        <option value="0">Ẩn</option>
                                    </select>
                                </div>

                                <button type="submit" name="store_post" class="btn btn-info">Thêm</button>
                            	</form>
                        	</div>

                        </div>
                    </section>

            </div>
<script src="{{asset('public/backend/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript">
    CKEDITOR.replace('ckeditor5',{
        filebrowserImageUploadUrl:"{{url('uploads-ckeditor?_token='.csrf_token())}}",
        filebrowserBrowseUrl:"{{url('file-browser?_token='.csrf_token())}}",
        filebrowserUploadMethod:'form'
    });
    CKEDITOR.replace('ckeditor6',{
        filebrowserImageUploadUrl:"{{url('uploads-ckeditor?_token='.csrf_token())}}",
        filebrowserBrowseUrl:"{{url('file-browser?_token='.csrf_token())}}",
        filebrowserUploadMethod:'form'
});</script>

@endsection