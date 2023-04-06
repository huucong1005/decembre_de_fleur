@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm sản phẩm
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" enctype="multipart/form-data" action="{{URL::to('/store-product')}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInput">Tên sản phẩm</label>
                                    <input type="text" data-validation="length" data-validation-length="min3" data-validation-error-msg="Phải điền ít nhất 3 kí tự"  name="product_name" class="form-control" placeholder="Tên sản phẩm" required id="slug" onkeyup="ChangeToSlug();" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" name="product_slug" class="form-control " id="convert_slug" placeholder="slug">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">Số lượng</label>
                                    <input type="text" data-validation="number" data-validation-error-msg="Phải điền số"  name="product_quantity" class="form-control" id="exampleInput" placeholder="Số lượng sản phẩm" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">Giá nhập sản phẩm</label>
                                    <input type="text" data-validation="number" data-validation-error-msg="Phải điền số"  name="product_cost" class="form-control" id="exampleInput" placeholder="Giá nhập sản phẩm" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">Giá bán sản phẩm</label>
                                    <input type="text" data-validation="number" data-validation-error-msg="Phải điền số"  name="product_price" class="form-control" id="exampleInput" placeholder="Giá bán sản phẩm" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">Hình ảnh sản phẩm</label>
                                    <input type="file" name="product_image" onchange="previewfile(this)" class="form-control image-preview" id="exampleInput"  required>
                                    <img class="previewImg" src="{{asset('public/uploads/logo/no-image.png')}}" width="30%" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">Mô tả sản phẩm</label>
                                    <textarea style="resize: none" rows="3" class="form-control" name="product_desc" id="ckeditor1" placeholder="Mô tả"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">Nội dung sản phẩm</label>
                                    <textarea style="resize: none" rows="6" class="form-control" name="product_content" id="ckeditor2" placeholder="Mô tả"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">Tags sản phẩm (dấu , để sang tags mới)</label>
                                    <input type="text" data-role="tagsinput" name="product_tags" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">Danh mục sản phẩm</label>
                                    <select name="product_category" class="form-control m-bot15">
                                    @foreach($category_product as $key => $category)

                                        @if($category->category_parent==0)
                                            <option disabled value="{{$category->category_id}}">{{$category->category_name}}</option>
                                        @endif

                                        @foreach($category_product as $key => $category2)
                                            @if($category2->category_parent==$category->category_id)
                                                <option value="{{$category2->category_id}}">----{{$category2->category_name}}</option>
                                            @endif
                                        @endforeach
                                        
                                    @endforeach    
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">Thương hiệu</label>
                                    <select name="product_brand" class="form-control m-bot15">
                                    @foreach($brand_product as $key => $brand)
                                        <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                    @endforeach  
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">Hiển thị</label>
                                    <select name="product_status" class="form-control m-bot15">
                                        <option value="1">Hiển</option>
                                        <option value="0">Ẩn</option>
                                    </select>
                                </div>

                                <button type="submit" name="store_product" class="btn btn-info">Thêm</button>
                            	</form>
                        	</div>

                        </div>
                    </section>

            </div>
<script src="{{asset('public/backend/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript">
    CKEDITOR.replace('ckeditor1',{
        filebrowserImageUploadUrl:"{{url('uploads-ckeditor?_token='.csrf_token())}}",
        filebrowserBrowseUrl:"{{url('file-browser?_token='.csrf_token())}}",
        filebrowserUploadMethod:'form'
    });
    CKEDITOR.replace('ckeditor2',{
        filebrowserImageUploadUrl:"{{url('uploads-ckeditor?_token='.csrf_token())}}",
        filebrowserBrowseUrl:"{{url('file-browser?_token='.csrf_token())}}",
        filebrowserUploadMethod:'form'
    });

</script>
@endsection