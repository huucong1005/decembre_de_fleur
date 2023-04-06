@extends('admin_layout')
@section('admin_content')
<h3>Tổng quát</h3>

<!-- //market-->
<div class="market-updates row">
	<div class="col-md-3 market-update-gd">
		<div class="market-update-block clr-block-2">
			<div class="col-md-4 market-update-right">
				<i class="fa fa-eye"> </i>
			</div>
			 <div class="col-md-8 market-update-left">
			 <h4>Khách ghé thăm</h4>
			<h3>{{$visitor_this_month_count}}</h3>
			<p>lượt truy cập/tháng này </p>
		  </div>
		  <div class="clearfix"> </div>
		</div>
	</div>
	<div class="col-md-3 market-update-gd">
		<div class="market-update-block clr-block-1">
			<div class="col-md-4 market-update-right">
				<i class="fa fa-th" ></i>
			</div>
			<div class="col-md-8 market-update-left">
			<h4>Sản phẩm</h4>
				<h3>{{$product_active_count}}/{{$product_count}}</h3>
				<p>đang kinh doanh</p>
			</div>
		  <div class="clearfix"> </div>
		</div>
	</div>
	<div class="col-md-3 market-update-gd">
		<div class="market-update-block clr-block-3">
			<div class="col-md-4 market-update-right">
				<i class="fa fa-usd"></i>
			</div>
			<div class="col-md-8 market-update-left">
				<h4>Bài viết</h4>
				<h3>{{$post_active_count}}/{{ $post_count}}</h3>
				<p>đang hiển thị</p>
			</div>
		  <div class="clearfix"> </div>
		</div>
	</div>
	<div class="col-md-3 market-update-gd">
		<div class="market-update-block clr-block-4">
			<div class="col-md-4 market-update-right">
				<i class="fa fa-shopping-cart" aria-hidden="true"></i>
			</div>
			<div class="col-md-8 market-update-left">
				<h4>Đơn hàng mới</h4>
				<h3>{{$new_order_count}}</h3>
				<p>đơn chưa được xử lý</p>
			</div>
		  <div class="clearfix"> </div>
		</div>
	</div>
   <div class="clearfix"> </div>
</div>	
<!-- //market-->

<h3>Thống kê doanh số</h3>
<!-- calender-->
	<div class="row">
		<div class="panel-body">
			
				<form action="" autocomplete="off">
				@csrf
					<div class="col-md-2">
						<p>Từ ngày:</p> 
						<input type="text" id="datepicker1" readonly class="form-control">
					</div>

					<div class="col-md-2">
						<p>Đến ngày:</p> 
						<input type="text" id="datepicker2" readonly class="form-control">
					</div>

					<div class="col-md-1">
						<br><input type="button" id="btn-dashboard-filter" class="btn btn-info btn-sm" value="Lọc kết quả">
					</div>
					<div class="col-md-2">
						<br><h3 style="margin-top: 4px;"><center>hay là ...</center></h3 class="mt-1">
					</div>

					<div class="col-md-2">
						<p>Lọc theo:</p>
						<select name="sort" id="sort" class="dashboard-filter form-control" >
			                <option value="">--- Chọn ---</option>
			                <option value="week"> 7 ngày qua </option>
			                <option value="lastmonth"> tháng trước </option>
			                <option value="thismonth"> tháng này </option>
			                <option value="year"> 365 ngày qua </option>
            			</select>
       					 
					</div>
					<div class="col-md-3"></div>
				</form>
				<br>

		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div id="myfirstchart" style="height: 250px;"></div>
		</div>
	</div>

<!-- calender-->

{{-- count table access --}}
<br><h3>Thống kê truy cập</h3><br>

<div class="row">
		<div class="col-md-12">
			<table class="table table-bordered table-dark">
				<thead>
				    <tr>
				      <th scope="col">Đang online</th>
				      <th scope="col">Truy cập tháng trước</th>
				      <th scope="col">Truy cập tháng này</th>
				      <th scope="col">Truy cập năm nay</th>
				      <th scope="col">Tổng truy cập</th>
				    </tr>
				</thead>
				<tbody>
				    <tr>
				      <td>{{$visitor_count}}</td>
				      <td>{{$visitor_last_month_count}}</td>
				      <td>{{$visitor_this_month_count}}</td>
				      <td>{{$visitor_year_count}}</td>
				      <td>{{$visitor_total_count}}</td>
				      
				    </tr>
				</tbody>
			</table>
		</div>
	</div>
{{-- count table access --}}

<br><h3>Thống kê dữ liệu</h3><br>

<div class="row">
	<div class="col-md-3 col-xs-12">
		<h4>Bộ đếm số liệu</h4>
		<div id="donut-chart"></div>
	</div>
	<div class="col-md-4 col-xs-12">
		<h4>Bài viết xem nhiều</h4>
		<ol class="list_view">
			@foreach($post_view as $key=>$postItem)
			<li>
				<a href="{{URL::to('/tin-tuc/'.$postItem->post_slug)}}" target="blank" title="{{$postItem->post_name}}">{{$postItem->post_name}} | <span style="color: black;">Lượt view:	{{$postItem->post_view}}</span></a>
			</li>
			@endforeach
		</ol>
	</div>
	<div class="col-md-4 col-xs-12">
		<h4>Sản phẩm xem nhiều</h4>
		<ol class="list_view">
			@foreach($product_view as $key=>$productItem)
			<li>
				<a href="{{URL::to('chi-tiet-san-pham/'.$productItem->product_slug)}}" target="blank" title="{{$productItem->product_name}}">{{$productItem->product_name}} | <span style="color: black;">Lượt view:	{{$productItem->product_view}}</span></a>
			</li>
			@endforeach
		</ol>
	</div>
	<div class="col-md-1 col-xs-12"></div>
</div>

{{-- 		<div class="row">
			<div class="panel-body">
				<div class="col-md-12 w3ls-graph">
					
						<div class="agileinfo-grap">
							<div class="agileits-box">
								<header class="agileits-box-header clearfix">
									<h3>Visitor Statistics</h3>
										<div class="toolbar">
											
											
										</div>
								</header>
								<div class="agileits-box-body clearfix">
									<div id="hero-area"></div>
								</div>
							</div>
						</div>

				</div>
			</div>
		</div> --}}

{{-- 	<div class="agil-info-calendar">
		 
		<div class="col-md-6 agile-calendar">
			<div class="calendar-widget">
                <div class="panel-heading ui-sortable-handle">
					<span class="panel-icon">
                      <i class="fa fa-calendar-o"></i>
                    </span>
                    <span class="panel-title"> Calendar Widget</span>
                </div>
				
					<div class="agile-calendar-grid">
						<div class="page">
							
							<div class="w3l-calendar-left">
								<div class="calendar-heading">
									
								</div>
								<div class="monthly" id="mycalendar"></div>
							</div>
							
							<div class="clearfix"> </div>
						</div>
					</div>
			</div>
		</div>
		 
		<div class="col-md-6 w3agile-notifications">
			<div class="notifications">
				
					<header class="panel-heading">
						Notification 
					</header>
					<div class="notify-w3ls">
						<div class="alert alert-info clearfix">
							<span class="alert-icon"><i class="fa fa-envelope-o"></i></span>
							<div class="notification-info">
								<ul class="clearfix notification-meta">
									<li class="pull-left notification-sender"><span><a href="#">Jonathan Smith</a></span> send you a mail </li>
									<li class="pull-right notification-time">1 min ago</li>
								</ul>
								<p>
									Urgent meeting for next proposal
								</p>
							</div>
						</div>
						<div class="alert alert-danger">
							<span class="alert-icon"><i class="fa fa-facebook"></i></span>
							<div class="notification-info">
								<ul class="clearfix notification-meta">
									<li class="pull-left notification-sender"><span><a href="#">Jonathan Smith</a></span> mentioned you in a post </li>
									<li class="pull-right notification-time">7 Hours Ago</li>
								</ul>
								<p>
									Very cool photo jack
								</p>
							</div>
						</div>
						<div class="alert alert-success ">
							<span class="alert-icon"><i class="fa fa-comments-o"></i></span>
							<div class="notification-info">
								<ul class="clearfix notification-meta">
									<li class="pull-left notification-sender">You have 5 message unread</li>
									<li class="pull-right notification-time">1 min ago</li>
								</ul>
								<p>
									<a href="#">Anjelina Mewlo, Jack Flip</a> and <a href="#">3 others</a>
								</p>
							</div>
						</div>
						<div class="alert alert-warning ">
							<span class="alert-icon"><i class="fa fa-bell-o"></i></span>
							<div class="notification-info">
								<ul class="clearfix notification-meta">
									<li class="pull-left notification-sender">Domain Renew Deadline 7 days ahead</li>
									<li class="pull-right notification-time">5 Days Ago</li>
								</ul>
								<p>
									Next 5 July Thursday is the last day
								</p>
							</div>
						</div>
						<div class="alert alert-info clearfix">
							<span class="alert-icon"><i class="fa fa-envelope-o"></i></span>
							<div class="notification-info">
								<ul class="clearfix notification-meta">
									<li class="pull-left notification-sender"><span><a href="#">Jonathan Smith</a></span> send you a mail </li>
									<li class="pull-right notification-time">1 min ago</li>
								</ul>
								<p>
									Urgent meeting for next proposal
								</p>
							</div>
						</div>
						
					</div>
				
			</div>
		</div>
			
        <div class="clearfix"> </div> 
	</div>  --}}


		<!-- tasks -->
{{-- 		<div class="agile-last-grids">
				<div class="col-md-4 agile-last-left">
					<div class="agile-last-grid">
						<div class="area-grids-heading">
							<h3>Monthly</h3>
						</div>
						<div id="graph7"></div>
						<script>
						// This crosses a DST boundary in the UK.
						Morris.Area({
						  element: 'graph7',
						  data: [
							{x: '2013-03-30 22:00:00', y: 3, z: 3},
							{x: '2013-03-31 00:00:00', y: 2, z: 0},
							{x: '2013-03-31 02:00:00', y: 0, z: 2},
							{x: '2013-03-31 04:00:00', y: 4, z: 4}
						  ],
						  xkey: 'x',
						  ykeys: ['y', 'z'],
						  labels: ['Y', 'Z']
						});
						</script>

					</div>
				</div>
				<div class="col-md-4 agile-last-left agile-last-middle">
					<div class="agile-last-grid">
						<div class="area-grids-heading">
							<h3>Daily</h3>
						</div>
						<div id="graph8"></div>
						<script>
						/* data stolen from http://howmanyleft.co.uk/vehicle/jaguar_'e'_type */
						var day_data = [
						  {"period": "2016-10-01", "licensed": 3407, "sorned": 660},
						  {"period": "2016-09-30", "licensed": 3351, "sorned": 629},
						  {"period": "2016-09-29", "licensed": 3269, "sorned": 618},
						  {"period": "2016-09-20", "licensed": 3246, "sorned": 661},
						  {"period": "2016-09-19", "licensed": 3257, "sorned": 667},
						  {"period": "2016-09-18", "licensed": 3248, "sorned": 627},
						  {"period": "2016-09-17", "licensed": 3171, "sorned": 660},
						  {"period": "2016-09-16", "licensed": 3171, "sorned": 676},
						  {"period": "2016-09-15", "licensed": 3201, "sorned": 656},
						  {"period": "2016-09-10", "licensed": 3215, "sorned": 622}
						];
						Morris.Bar({
						  element: 'graph8',
						  data: day_data,
						  xkey: 'period',
						  ykeys: ['licensed', 'sorned'],
						  labels: ['Licensed', 'SORN'],
						  xLabelAngle: 60
						});
						</script>
					</div>
				</div>
				<div class="col-md-4 agile-last-left agile-last-right">
					<div class="agile-last-grid">
						<div class="area-grids-heading">
							<h3>Yearly</h3>
						</div>
						<div id="graph9"></div>
						<script>
						var day_data = [
						  {"elapsed": "I", "value": 34},
						  {"elapsed": "II", "value": 24},
						  {"elapsed": "III", "value": 3},
						  {"elapsed": "IV", "value": 12},
						  {"elapsed": "V", "value": 13},
						  {"elapsed": "VI", "value": 22},
						  {"elapsed": "VII", "value": 5},
						  {"elapsed": "VIII", "value": 26},
						  {"elapsed": "IX", "value": 12},
						  {"elapsed": "X", "value": 19}
						];
						Morris.Line({
						  element: 'graph9',
						  data: day_data,
						  xkey: 'elapsed',
						  ykeys: ['value'],
						  labels: ['value'],
						  parseTime: false
						});
						</script>

					</div>
				</div>
				<div class="clearfix"> </div>
			</div> --}}
		<!-- //tasks -->

{{-- 		<div class="agileits-w3layouts-stats">
					<div class="col-md-4 stats-info widget">
						<div class="stats-info-agileits">
							<div class="stats-title">
								<h4 class="title">Browser Stats</h4>
							</div>
							<div class="stats-body">
								<ul class="list-unstyled">
									<li>GoogleChrome <span class="pull-right">85%</span>  
										<div class="progress progress-striped active progress-right">
											<div class="bar green" style="width:85%;"></div> 
										</div>
									</li>
									<li>Firefox <span class="pull-right">35%</span>  
										<div class="progress progress-striped active progress-right">
											<div class="bar yellow" style="width:35%;"></div>
										</div>
									</li>
									<li>Internet Explorer <span class="pull-right">78%</span>  
										<div class="progress progress-striped active progress-right">
											<div class="bar red" style="width:78%;"></div>
										</div>
									</li>
									<li>Safari <span class="pull-right">50%</span>  
										<div class="progress progress-striped active progress-right">
											<div class="bar blue" style="width:50%;"></div>
										</div>
									</li>
									<li>Opera <span class="pull-right">80%</span>  
										<div class="progress progress-striped active progress-right">
											<div class="bar light-blue" style="width:80%;"></div>
										</div>
									</li>
									<li class="last">Others <span class="pull-right">60%</span>  
										<div class="progress progress-striped active progress-right">
											<div class="bar orange" style="width:60%;"></div>
										</div>
									</li> 
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-8 stats-info stats-last widget-shadow">
						<div class="stats-last-agile">
							<table class="table stats-table ">
								<thead>
									<tr>
										<th>S.NO</th>
										<th>PRODUCT</th>
										<th>STATUS</th>
										<th>PROGRESS</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th scope="row">1</th>
										<td>Lorem ipsum</td>
										<td><span class="label label-success">In progress</span></td>
										<td><h5>85% <i class="fa fa-level-up"></i></h5></td>
									</tr>
									<tr>
										<th scope="row">2</th>
										<td>Aliquam</td>
										<td><span class="label label-warning">New</span></td>
										<td><h5>35% <i class="fa fa-level-up"></i></h5></td>
									</tr>
									<tr>
										<th scope="row">3</th>
										<td>Lorem ipsum</td>
										<td><span class="label label-danger">Overdue</span></td>
										<td><h5 class="down">40% <i class="fa fa-level-down"></i></h5></td>
									</tr>
									<tr>
										<th scope="row">4</th>
										<td>Aliquam</td>
										<td><span class="label label-info">Out of stock</span></td>
										<td><h5>100% <i class="fa fa-level-up"></i></h5></td>
									</tr>
									<tr>
										<th scope="row">5</th>
										<td>Lorem ipsum</td>
										<td><span class="label label-success">In progress</span></td>
										<td><h5 class="down">10% <i class="fa fa-level-down"></i></h5></td>
									</tr>
									<tr>
										<th scope="row">6</th>
										<td>Aliquam</td>
										<td><span class="label label-warning">New</span></td>
										<td><h5>38% <i class="fa fa-level-up"></i></h5></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="clearfix"> </div>
		</div> --}}

<script type="text/javascript">
    $(function(){
        $( "#datepicker1" ).datepicker({
            changeMonth: true,
            changeYear: true,
            prevText:"Tháng trước",
            nextText:"Tháng sau",
            dateFormat:"yy-mm-dd",
            dayNamesMin: ["T2","T3","T4","T5","T6","T7","CN"],
            duration: "slow"
        });
        $( "#datepicker2" ).datepicker({
            changeMonth: true,
            changeYear: true,
            prevText:"Tháng trước",
            nextText:"Tháng sau",
            dateFormat:"yy-mm-dd",
            dayNamesMin: ["T2","T3","T4","T5","T6","T7","CN"],
            duration: "slow"
        });

    });
</script>

<script type="text/javascript">
    $(document).ready(function(){  
        var donut = Morris.Donut({
          element: 'donut-chart',
          resize: true,
          colors: [
            '#459743',
            '#78ca76',
            '#0877f3',
            '#76b5c5',
            '#d3412c',
            '#A2349a',
            '#F38808'
          ],
          //labelColor:"#cccccc", // text color
          //backgroundColor: '#333333', // border color
          data: [
            {label:"Sản phẩm ẩn",   value:<?php echo $product_unactive_count ?>},
            {label:"Sản phẩm hiện", value:<?php echo $product_active_count ?>},
            {label:"Bài viết ẩn",   value:<?php echo $post_unactive_count ?>},
            {label:"Bài viết hiện", value:<?php echo $post_active_count ?>},
            {label:"Khách hàng",    value:<?php echo $customer_count ?>},
            {label:"Slider",        value:<?php echo $slider_count ?>},
            {label:"Đơn hàng mới",  value:<?php echo $new_order_count ?>}
          ]
        });

    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        chart30daysorder();

//morrist type: Line, Bar, Area
        var chart = new Morris.Area({
          // ID of the element in which to draw the chart.
          element: 'myfirstchart',
          // Chart data records -- each entry in this array corresponds to a point on
          // the chart.
          lineColors:['#819C79','#fc8710','#A4ADD3','#FF6541','#766B56'],

          pointFillColors:['#ffffff'],
          pointStrokeColors:['black'],

          gridTextColor:['black'],
          //set opaciti for Area type
          fillOpacity:0.2,
          hideHover:'auto',
          parseTime:false,
          smooth:false,
          resize:true,
          // The name of the data record attribute that contains x-values.
          xkey: 'period',
          // A list of names of data record attributes that contain y-values.
          ykeys: ['order','sales','profit','quantity'],
          behaveLikeLine:true,
          // Labels for the ykeys -- will be displayed when you hover over the
          labels: ['Đơn hàng','Doanh số','Lợi nhuận','Số lượng']
        });

        function chart30daysorder() {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url : '{{url('/days-order')}}',
                method: 'POST',
                dataType:'JSON',
                data: {_token:_token},
                success:function(data){
                    chart.setData(data);
                } 
            });
        };

        $('.dashboard-filter').change(function() {
            var _token = $('input[name="_token"]').val();
            var dashboard_value=$(this).val();

            $.ajax({
                url : '{{url('/dashboard-filter')}}',
                method: 'POST',
                dataType:'JSON',
                data: {_token:_token,dashboard_value:dashboard_value},
                success:function(data){
                    chart.setData(data);
                } 
            });
        });

        $('#btn-dashboard-filter').click(function() {
            var _token = $('input[name="_token"]').val();
            var date_from=$('#datepicker1').val();
            var date_to=$('#datepicker2').val();

            $.ajax({
                url : '{{url('/filter-by-date')}}',
                method: 'POST',
                dataType:'JSON',
                data: {_token:_token,date_to:date_to,date_from:date_from},
                success:function(data){
                    chart.setData(data);
                } 
            });
        });

    });
</script>

@endsection