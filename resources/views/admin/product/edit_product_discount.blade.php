@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật sản phẩm
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                @foreach($edit_product_discount as $key =>$product)
                                <form role="form" enctype="multipart/form-data" action="{{URL::to('/update-product-discount/'.$product->product_id)}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInput">Tên sản phẩm</label>
                                    <input type="text" name="product_name" disabled class="form-control" value="{{$product->product_name}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">Hình ảnh sản phẩm</label>
                                    <img class="previewImg" src="{{URL::to('public/uploads/product/'.$product->product_image)}}" height="150" width="120">
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
                                    <label for="exampleInput">Giảm % giá bán</label>
                                    <input type="text" name="product_discount" class="form-control" id="exampleInput" value="{{$product->product_discount}}">
                                </div>
                                <button type="submit" name="update_product" class="btn btn-info">Cập nhật</button>
                                </form>
                                @endforeach
                            </div>

                        </div>
                    </section>

            </div>
@endsection