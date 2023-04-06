@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật sản phẩm
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                @foreach($edit_product as $key =>$product)
                                <form role="form" enctype="multipart/form-data" action="{{URL::to('/update-product/'.$product->product_id)}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInput">Tên sản phẩm</label>
                                    <input type="text" name="product_name" class="form-control"  id="slug" onkeyup="ChangeToSlug();" value="{{$product->product_name}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" name="product_slug" class="form-control" id="convert_slug" value="{{$product->product_slug}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">Số lượng</label>
                                    <input type="number" name="product_quantity" class="form-control" id="exampleInput" value="{{$product->product_quantity}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">Giá nhập sản phẩm</label>
                                    <input type="text" name="product_cost" class="form-control" id="exampleInput" value="{{$product->product_cost}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">Giá bán sản phẩm</label>
                                    <input type="text" name="product_price" class="form-control" id="exampleInput" value="{{$product->product_price}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">Hình ảnh sản phẩm</label>
                                    <input type="file" name="product_image" class="form-control image-preview" onchange="previewfile(this)" id="exampleInput">
                                    <img class="previewImg" src="{{URL::to('public/uploads/product/'.$product->product_image)}}" height="150" width="120">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">Mô tả sản phẩm</label>
                                    <textarea style="resize: none" rows="3" class="form-control" name="product_desc"  id="ckeditor3" >{{$product->product_desc}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">Nội dung sản phẩm</label>
                                    <textarea style="resize: none" rows="6" class="form-control" name="product_content"  id="ckeditor4">{{$product->product_content}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">Tags sản phẩm (dấu , để sang tags mới)</label>
                                    <input type="text" data-role="tagsinput" value="{{$product->product_tags}}" name="product_tags" class="form-control">
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
                                                <option {{$category2->category_id==$product->category_id ? 'selected': ''}} value="{{$category2->category_id}}">----{{$category2->category_name}}</option>
                                                }
                                                }
                                            @endif
                                        @endforeach
                                        
                                    @endforeach  
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">Thương hiệu</label>
                                    <select name="product_brand" class="form-control m-bot15">
                                    @foreach($brand_product as $key => $brand)
                                    @if($brand->brand_id==$product->brand_id)
                                        <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                    @else
                                        <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                    @endif
                                    @endforeach  
                                    </select>
                                </div>
                                <button type="submit" name="update_product" class="btn btn-info">Cập nhật</button>
                                </form>
                                @endforeach
                            </div>

                        </div>
                    </section>

            </div>
<script src="{{asset('public/backend/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript">
    CKEDITOR.replace('ckeditor3',{
        filebrowserImageUploadUrl:"{{url('uploads-ckeditor?_token='.csrf_token())}}",
        filebrowserBrowseUrl:"{{url('file-browser?_token='.csrf_token())}}",
        filebrowserUploadMethod:'form'
    });
    CKEDITOR.replace('ckeditor4',{
        filebrowserImageUploadUrl:"{{url('uploads-ckeditor?_token='.csrf_token())}}",
        filebrowserBrowseUrl:"{{url('file-browser?_token='.csrf_token())}}",
        filebrowserUploadMethod:'form'
    });

</script>
@endsection