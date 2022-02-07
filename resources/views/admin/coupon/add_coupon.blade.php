@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm mã giảm giá
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/store-coupon')}}" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên mã</label>
                                    <input type="text" name="coupon_name" class="form-control" id="exampleInputEmail1" placeholder="Tên mã giảm giá" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mã giảm giá</label>
                                    <input type="text" name="coupon_code" class="form-control" id="exampleInputEmail1" placeholder="Nhập mã giảm giá" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng mã</label>
                                    <input type="number" name="coupon_quantity" class="form-control" id="exampleInputEmail1" placeholder="Số lượng mã giảm giá" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Loại mã</label>
                                    <select name="coupon_function" class="form-control m-bot15">
                                        <option value="2">----chọn----</option>
                                        <option value="1">Giảm theo %</option>
                                        <option value="2">Giảm tiền</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nhập số % hoặc số tiền giảm</label>
                                    <input type="text" name="coupon_number" class="form-control" id="exampleInputEmail1" placeholder="..." required>
                                </div>

                                <button type="submit" name="store_coupon" class="btn btn-info">Thêm</button>
                            	</form>
                        	</div>

                        </div>
                    </section>

            </div>
@endsection