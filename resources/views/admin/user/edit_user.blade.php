@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Chỉnh sửa user
                        </header>
                        <div class="panel-body">
                        
                            <div class="position-center">
                                <form role="form" enctype="multipart/form-data" action="{{URL::to('/update-user/'.$user->id)}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên user</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" value="{{$user->name}}"  required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email user</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Nhập email" required value="{{$user->email}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Password mới</label>
                                    <input type="text" name="password" class="form-control" id="exampleInputEmail1" placeholder="Nhập password" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số điện thoại</label>
                                    <input type="text" name="phone" class="form-control" id="exampleInputEmail1" placeholder="Nhập số điện thoại" required value="{{$user->phone}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Phân quyền</label>
                                    <select name="role_id[]" class="form-control select2_init" multiple required>
                                        <option value=""></option>

                                    @foreach($roles as $key => $role)
                                        <option
                                        {{$rolesOfUser->contains('role_id',$role->role_id) ? 'selected' : ''}}
                                         value="{{$role->role_id}}">{{$role->role_name}}</option>
                                    @endforeach

                                    </select>
                                </div>
                                
                                <button type="submit" name="update_user" class="btn btn-info">Cập nhật</button>
                                </form>
                            </div>
                        </div>
                    </section>

            </div>
@endsection