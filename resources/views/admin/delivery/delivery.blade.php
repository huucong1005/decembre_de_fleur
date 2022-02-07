@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm phí vận chuyển
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form>
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Chọn thành phố(tỉnh)</label>
                                    <select name="city" id="city" class="form-control m-bot15 choose city">
                                    	<option value="">----Chọn thành phố(tỉnh)----</option>
                                    	@foreach($city as $key=>$ci)
                                        <option value="{{$ci->id_tp}}">{{$ci->name_tp}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Chọn quận(huyện)</label>
                                    <select name="province" id="province" class="form-control m-bot15 choose province">
                                        <option value="">----Chọn quận(huyện)----</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Chọn phường(xã)</label>
                                    <select name="wards" id="wards" class="form-control m-bot15 wards">
                                        <option value="">----Chọn phường(xã)----</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Phí vận chuyển</label>
                                    <input type="text" name="fee_ship" class="form-control fee_ship" id="exampleInputEmail1">
                                </div>

                                <button type="button" name="add_delivery" class="btn btn-info add_delivery">Thêm</button>
                            	</form>
                        	</div>

                            <div id="load_delivery">
                                
                            </div>

                        </div>
                    </section>

            </div>
@endsection
