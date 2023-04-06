@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm thông tin website
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                            @foreach($contact as$key=>$contactItem)
                                <form role="form" action="{{URL::to('/update-info/'.$contactItem->info_id)}}"  method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tên cửa hàng</label>
                                    <textarea style="resize: none" rows="1" class="form-control" name="info_name" id="exampleInputPassword1" placeholder="Địa chỉ" required >{{$contactItem->info_name}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Địa chỉ</label>
                                    <textarea style="resize: none" rows="2" class="form-control" name="info_address" id="exampleInputPassword1" placeholder="Địa chỉ" required >{{$contactItem->info_address}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Số tài khoản</label>
                                    <textarea style="resize: none" rows="2" class="form-control" name="info_bank" id="exampleInputPassword1" placeholder="banking" required >{{$contactItem->info_bank}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Số điện thoại</label>
                                    <textarea style="resize: none"  data-validation="number" data-validation-error-msg="Phải điền số" rows="1" class="form-control" name="info_contact" id="exampleInputPassword1" placeholder="Số điện thoại" required>{{$contactItem->info_contact}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Bản đồ (<a target="blank" href="https://www.google.com/maps/">Lấy bản đồ</a>)</label>
                                    <textarea style="resize: none" rows="5" class="form-control" name="info_map" id="exampleInputPassword1" placeholder="Địa chỉ" required>{{$contactItem->info_map}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hình ảnh logo</label>
                                    <input type="file" name="info_image" onchange="previewfile(this)" class="form-control image-preview" id="exampleInput">
                                    <img class="previewImg" src="{{URL::to('public/uploads/logo/'.$contactItem->info_image)}}" height="120" width="120">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Slogan</label>
                                    <input  type="text" name="info_slogan" value="{{$contactItem->info_slogan}}" class="form-control" id="exampleInputPassword1" >
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Fanpage facebook (<a target="blank" href="https://developers.facebook.com/docs/plugins/page-plugin">Lấy plugin fanpage</a>)</label>
                                    <textarea style="resize: none" rows="7" class="form-control" name="info_fanpage" id="exampleInputPassword1" placeholder="Địa chỉ" required>{{$contactItem->info_fanpage}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Địa chỉ gmail</label>
                                    <textarea style="resize: none" rows="1" class="form-control" name="info_gmail" id="exampleInputPassword1" placeholder="Địa chỉ" required>{{$contactItem->info_gmail}}</textarea>
                                </div>
                                <button type="submit" name="store_info" class="btn btn-info">Cập nhật</button>
                            	</form>
                            @endforeach
                        	</div>

                        </div>

                        <br>

                        <header class="panel-heading">
                            Thêm link social
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                             <table class="table table-striped b-t b-light">
                                <thead>
                                  <tr>
                                    <th>Tên</th>
                                    <th>Giá trị</th>
                                    <th>Hành động</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach($icon as$key=>$item)
                                    <form role="form" action="{{URL::to('/update-icon/'.$item->id_icon)}}" method="POST">
                                        {{ csrf_field() }}
                                  <tr>
                                    <td>{{$item->name}}</td>
                                    <td><input type="text" name="link" class="form-control" id="exampleInputPassword1" value="{{$item->link}}" required></td>
                                    <td><button type="submit" name="store_info" class="btn btn-info">Cập nhật</button></td>
                                  </tr>
                                    </form>
                                  @endforeach
                                </tbody>
                              </table>
                                
                            </div>

                        </div>

                        <br>
                         <header class="panel-heading">
                            Thêm thông tin đối tác
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form"  id="form_partner" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tên đối tác</label>
                                    <input type="text" name="name" id="name" class="form-control">
                               </div>

                               
                                <div class="form-group">
                                    <label for="exampleInputPassword1">link</label>
                                    <input type="text" name="link" id="link" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">image</label>
                                    <input type="file" name="image" id="image" class="form-control">
                                </div>

                                <button type="button" name="add_partner" class="btn btn-info add-partner">Thêm mới đối tác</button>
                                </form>
                            
                            </div>
                            <div class="position-center">
                                <div id="list_partner"></div>   
                            </div>

                        </div>
                    </section>

    <script type="text/javascript">
        list_partner();
        function delete_partner(id) {
           $.ajax({
                url : '{{url('/delete-partner')}}',
                method: 'GET',
                data: {id:id},
                success:function(data){
                    list_partner();
                } 
            });
        }
        function list_partner(){
             $.ajax({
                url : '{{url('/list-partner')}}',
                method: 'GET',
                success:function(data){
                    $('#list_partner').html(data);
                } 
            });
        }

        $('.add-partner').click(function(){
            var name= $('#name').val();
            var link= $('#link').val();
            var image= $('#image')[0].files[0];
            var form_data = new FormData();

            form_data.append('file',image);
            form_data.append('name',name);
            form_data.append('link',link);

            $.ajax({
                url : '{{url('/add-partner')}}',
                method: 'POST',
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                contentType: false,
                cache:false,
                processData:false,

                data:form_data,
                success:function(data){
                    list_partner();
                    $('#name').val('');
                    $('#link').val('');
                    alert('Thêm mới thành công');
                } 
            });
        })
    </script>

            </div>
@endsection