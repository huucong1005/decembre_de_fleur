@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm danh mục bài viết
                        </header>
                        <?php
                                $message = Session::get('message');
                                if($message){
                                    echo '<br><span class="text-success">'.$message.'</span>';
                                    Session::put('message',null);
                                }
                            ?>
                        <div class="panel-body">
                            
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/store-cate-post')}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục</label>
                                    <input type="text" name="cate_post_name" class="form-control" placeholder="Tên danh mục" required id="slug" onkeyup="ChangeToSlug();" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" name="cate_post_slug" class="form-control " id="convert_slug" placeholder="slug">
                                </div>                            
                                <div class="form-group">
                                	<label for="exampleInputPassword1">Hiển thị</label>
                                	<select name="cate_post_status" class="form-control m-bot15">
                                        <option value="1">Hiển</option>
                                        <option value="0">Ẩn</option>
                            		</select>
                                </div>

                                <button type="submit" name="store_cate_post" class="btn btn-info">Thêm</button>
                            	</form>
                        	</div>

                        </div>
                    </section>

            </div>
@endsection