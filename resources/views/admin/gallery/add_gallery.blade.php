@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            Thêm thư viện ảnh
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
            	<input type="hidden" value="{{$product}}" name="product" class="product">

                <form  action="{{URL::to('/store-gallery/'.$product)}}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="col-md-2">
                        <label for="exampleInput">Thêm ảnh: </label>
                    </div>
                    <div class="col-md-8">
                        <input type="file" class="form-control" id="file" name="file[]"  accept="image/*" multiple>
                        <span id="error_gallery"></span>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" name="upload" class="btn btn-info">Thêm</button>
                    </div>
                </form>

            	<form action="">
            	@csrf
            	   <div id="gallery_load"></div>	
            	</form>

            </div>
        </div>
    </section>	

</div>

<script type="text/javascript">
    $(document).ready(function(){
        gallery_load();

        function gallery_load(){
            var product_id=$('.product').val();
            var _token = $('input[name="_token"]').val();

            // alert(product_id);
             $.ajax({
                url : '{{url('/select-gallery')}}',
                method: 'POST',
                data: {_token:_token,product_id:product_id},
                success:function(data){
                    $('#gallery_load').html(data);
                } 
            });
        }
        $('#file').change(function(){
            gallery_load();
            var error ='';
            var files = $('#file')[0].files;

            if (files.length>5) {
                error+='<p>Chỉ đc chọn tối đa 5 ảnh!</p>';
            }

            if(files.length==''){
                error+='<p>chưa có ảnh để upload!</p>';
            }

            if(files.size() >2000000){
                error+='<p>file quá lớn (>2MB)!</p>';
            }

            if(error==''){

            }else{
                $('#file').val('');
                $('#error_gallery').html('<span class="text-danger">'+error+'</span>');
                return false;
            }
        });

        $(document).on('blur','.edit_gallery_name',function(){
            var gallery_id =$(this).data('gallery_id');
            var gallery_text =$(this).text();
            var _token = $('input[name="_token"]').val();

            // alert(product_id);
             $.ajax({
                url : '{{url('/update-gallery-name')}}',
                method: 'POST',
                data: {_token:_token,gallery_text:gallery_text,gallery_id:gallery_id},
                success:function(data){
                    gallery_load();
                    $('#error_gallery').html('<span class="text-danger">Name updated !</span>');
                    window.setTimeout(function(){
                        $('#error_gallery').html('');
                    },1500);
                } 
            });
        });

        $(document).on('click','.delete-gallery',function(){
            var gallery_id =$(this).data('gallery_id');
            var _token = $('input[name="_token"]').val();

            if (confirm('Bạn chắc chắn xóa hình ảnh này chứ ?')) {
                $.ajax({
                url : '{{url('/delete-gallery')}}',
                method: 'POST',
                data: {_token:_token,gallery_id:gallery_id},
                    success:function(data){
                        gallery_load();
                        $('#error_gallery').html('<span class="text-danger">Image deleted !</span>');
                        window.setTimeout(function(){
                        $('#error_gallery').html('');
                        },1500);
                    } 
                });
            }
             
        });

    });
</script>


@endsection