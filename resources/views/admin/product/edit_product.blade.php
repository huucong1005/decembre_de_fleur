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
                                    <input type="text" name="product_name" class="form-control" id="exampleInput" value="{{$product->product_name}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">Giá sản phẩm</label>
                                    <input type="text" name="product_price" class="form-control" id="exampleInput" value="{{$product->product_price}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">Hình ảnh sản phẩm</label>
                                    <input type="file" name="product_image" class="form-control" id="exampleInput">
                                    <img src="{{URL::to('public/uploads/product/'.$product->product_image)}}" height="150" width="120">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">Mô tả sản phẩm</label>
                                    <textarea style="resize: none" rows="3" class="form-control" name="product_desc" id="exampleInput" >{{$product->product_desc}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">Nội dung sản phẩm</label>
                                    <textarea style="resize: none" rows="6" class="form-control" name="product_content" id="exampleInput">{{$product->product_content}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">Danh mục sản phẩm</label>
                                    <select name="product_category" class="form-control m-bot15">
                                    @foreach($category_product as $key => $category)
                                        @if($category->category_id==$product->category_id)
                                        <option selected value="{{$category->category_id}}">{{$category->category_name}}</option>
                                        @else
                                         <option value="{{$category->category_id}}">{{$category->category_name}}</option>
                                         @endif
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
@endsection