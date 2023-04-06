@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            Sửa quyền
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

            <form role="form" action="{{URL::to('/update-roles/'.$role->role_id)}}" method="post">
            {{ csrf_field() }}
                <div class="form-group">
                    <label for="exampleInputEmail1">Tên quyền</label>
                    <input type="text" name="role_name" class="form-control" value="{{$role->role_name}}" id="exampleInputEmail1"  required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Mô tả</label>
                    <textarea style="resize: none" rows="6" class="form-control" name="role_desc" id="exampleInputPassword1" placeholder="Mô tả">{{$role->role_desc}}</textarea>
                </div>
                <div class="checkbox">
                <label>
                    <input type="checkbox" class="checkall"> Chẹck all 
                </label>
                </div>
            
                @foreach($permissionsParent as $permissionParentItem)
                <div class="panel card panel-default">
                    <div class="panel-heading text-align-left" style="font-size: 0.92rem !important;">
                        <label for="">
                            <input type="checkbox" class="checkbox_wrapper" value="">
                        </label>
                        {{$permissionParentItem->permission_name}}
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped b-t b-light">
                        <tr>
                            @foreach($permissionParentItem->permissionChildrent as $permissionChildrentItem )
                                <td>
                                    <label for="">
                                    <input name="permission_id[]" type="checkbox" class="checkbox_childrent" value="{{$permissionChildrentItem->permission_id}}"
                                    {{$permissionsChecked->contains('permission_id',$permissionChildrentItem->permission_id) ? 'checked' : ''}}>
                                </label> 
                                {{$permissionChildrentItem->permission_name}}
                            </td>
                            @endforeach
                        </tr>
                        </table>
                    </div>
                </div>
                @endforeach

                <button type="submit" name="update_roles" class="btn btn-info">Cập nhật</button>
            </form>
            </div>
        </div>
    </section>
</div>
@endsection