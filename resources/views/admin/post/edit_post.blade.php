@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật bài viết
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
                                <form role="form" enctype="multipart/form-data" action="{{URL::to('/update-post/'.$post->post_id)}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInput">Tên bài viết</label>
                                    <input type="text" data-validation="length" data-validation-length="min3" data-validation-error-msg="Phải điền ít nhất 3 kí tự"  name="post_name" class="form-control" placeholder="Tên sản phẩm" required id="slug" onkeyup="ChangeToSlug();"  value="{{$post->post_name}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" name="post_slug" class="form-control " id="convert_slug" placeholder="slug" value="{{$post->post_slug}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">Hình ảnh bài viết</label>
                                    <input type="file" name="post_image" class="form-control" id="exampleInput" >
                                    <img src="{{URL::to('public/uploads/post/'.$post->post_image)}}" height="120" width="200">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">Mô tả bài viết</label>
                                    <textarea style="resize: none" rows="3" class="form-control" name="post_desc" id="ckeditor7" placeholder="Mô tả">{{$post->post_desc}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">Nội dung bài viết</label>
                                    <textarea style="resize: none" rows="6" class="form-control" name="post_content" id="ckeditor8" placeholder="Mô tả">{{$post->post_content}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">Danh mục bài viết</label>
                                    <select name="cate_post_id" class="form-control m-bot15">
                                    @foreach($category_post as $key => $catePostItem)                                     
                                        <option {{$post->cate_post_id==$catePostItem->cate_post_id ? 'selected' : ''}} value="{{$catePostItem->cate_post_id}}">{{$catePostItem->cate_post_name}}</option>
                                    @endforeach    
                                    </select>
                                </div>
                                <button type="submit" name="update_post" class="btn btn-info">Cập nhật</button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>
<script src="{{asset('public/backend/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript">
    CKEDITOR.replace('ckeditor7',{
        filebrowserImageUploadUrl:"{{url('uploads-ckeditor?_token='.csrf_token())}}",
        filebrowserBrowseUrl:"{{url('file-browser?_token='.csrf_token())}}",
        filebrowserUploadMethod:'form'
    });
    CKEDITOR.replace('ckeditor8',{
        filebrowserImageUploadUrl:"{{url('uploads-ckeditor?_token='.csrf_token())}}",
        filebrowserBrowseUrl:"{{url('file-browser?_token='.csrf_token())}}",
        filebrowserUploadMethod:'form'
    });
</script>
@endsection