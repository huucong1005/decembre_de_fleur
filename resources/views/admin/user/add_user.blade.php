@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm user
                        </header>
                        <div class="panel-body">
                            <?php
                                $message = Session::get('message');
                                if($message){
                                    echo '<br><span class="text-success">'.$message.'</span>';
                                    Session::put('message',null);
                                }
                            ?>
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/store-user')}}" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên user</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên user" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email user</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Nhập email" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Password</label>
                                    <input type="text" name="password" class="form-control" id="exampleInputEmail1" placeholder="Nhập password" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số điện thoại</label>
                                    <input type="text" name="phone" class="form-control" id="exampleInputEmail1" placeholder="Nhập số điện thoại" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Phân quyền</label>
                                    <select name="role_id[]" class="form-control select2_init" multiple required>
                                        <option value=""></option>

                                    @foreach($roles as $key => $role)
                                        <option value="{{$role->role_id}}">{{$role->role_name}}</option>
                                    @endforeach

                                    </select>
                                </div>

                                <button type="submit" name="store_user" class="btn btn-info">Thêm</button>
                            	</form>
                        	</div>

                        </div>
                    </section>

            </div>
@endsection