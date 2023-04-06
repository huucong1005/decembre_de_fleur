@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Giảm giá tất cả
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" enctype="multipart/form-data" action="{{URL::to('/update-discount-all')}}" method="post">
                                    {{ csrf_field() }}
                                
                                <div class="form-group">
                                    <label for="exampleInput">Nhập % giảm giá cho tất cả sản phẩm</label>
                                    <input type="number" name="discount_all"class="form-control" id="exampleInput" required value="" max="80" min="0">
                                </div>

                                <button type="submit" name="update_discount" class="btn btn-info">Cập nhật</button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>

@endsection