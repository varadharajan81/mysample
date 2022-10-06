@extends('layouts.default')

@section ('title', 'Admin Dashboard')

@section('content')
	<div class="panel-header bg-success-gradient">
		<div class="page-inner py-5">
			<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
				<div>
					<h2 class="text-white pb-2 fw-bold">Dashboard</h2>
					<h5 class="text-white op-7 mb-2">My Sample {{ Auth::user()->user_type_id == 2 ? 'Bank Staff' : 'Administrator' }} Dashboard</h5>
				</div>
				<div class="ml-md-auto py-2 py-md-0">
					@if(Auth::user()->user_type_id == 1)
					<a href="{{ url('bank_branches/create') }}" class="btn btn-white btn-border btn-round mr-2">Add Branch</a>
					@else
					<a href="{{ url('loans/create') }}" class="btn btn-white btn-border btn-round mr-2">
						Upload Loans
					</a>
					@endif
					<a href="{{ url('creditmanagers/create') }}" class="btn btn-white btn-border btn-round mr-2">Add Credit Manager</a>
				</div>
			</div>
		</div>
	</div>
	<div class="page-inner mt--5">
		<div class="row mt--2">
			<div class="col-md-6">
				<div class="card full-height">
					<div class="card-body">
						<div class="card-title">Overall statistics</div>
						<div class="card-category">Daily information about statistics in system</div>
						<div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
							@if(Auth::user()->user_type_id == 1)
							<div class="px-2 pb-2 pb-md-0 text-center">
								<div id="circles1" data-circle='{"count": {{$user_count}},"color":"#bd2130"}'><div class="circles-wrp" style="position: relative; display: inline-block;"></div></div>
								<h6 class="fw-bold mt-3 mb-0">New Users</h6>
							</div>
							<div class="px-2 pb-2 pb-md-0 text-center">
								<div id="circles2" data-circle='{"count": {{$bank_count}}, "color":"#2BB930"}'><div class="circles-wrp" style="position: relative; display: inline-block;"></div></div>
								<h6 class="fw-bold mt-3 mb-0">Banks</h6>
							</div>
							@endif
							<div class="px-2 pb-2 pb-md-0 text-center">
								<div id="circles3" data-circle='{"count": {{$agent_count}}, "color":"#f1f1f1"}'><div class="circles-wrp" style="position: relative; display: inline-block;"></div></div>
								<h6 class="fw-bold mt-3 mb-0">CreditManagers</h6>
							</div>
							<div class="px-2 pb-2 pb-md-0 text-center">
								<div id="circles4" data-circle='{"count": "{{$product_count}}", "color":"#f1f1f1"}'><div class="circles-wrp" style="position: relative; display: inline-block;">{{ $product_count }}</div></div>
								<!--<div id="circles4" data-circle='{"count": "{{$user->convnumber($product_count)}}", "color":"#f1f1f1"}'><div class="circles-wrp" style="position: relative; display: inline-block;">{{ $user->convnumber($product_count) }}</div></div> -->
								<h6 class="fw-bold mt-3 mb-0">Loans</h6>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card full-height">
					<div class="card-body">
						<div class="card-title">Total sales statistics</div>
						<div class="row py-3">
							<div class="col-md-4 d-flex flex-column justify-content-around">
								<div>
									<h6 class="fw-bold text-uppercase text-success op-8">Overall</h6>
									<h3 class="fw-bold">Rs. {{ $total_sales }}</h3>
								</div>
								<div>
									<h6 class="fw-bold text-uppercase text-danger op-8 text-nowrap">This Week</h6>
									<h3 class="fw-bold">Rs. {{ $total_sales }}</h3>
								</div>
							</div>
							<div class="col-md-8">
								<div id="chart-container"><div style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;" class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
									<canvas id="totalIncomeChart" style="display: block; width: 275px; height: 150px;" width="275" height="150" class="chartjs-render-monitor"></canvas>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row row-card-no-pd">
			<div class="col-sm-12 col-md-12"><div class="card-title">LoanApplication statistics</div></div>
			<div class="col-sm-6 col-md-3">
				<div class="card card-stats card-round">
					<div class="card-body ">
						<div class="row">
							<div class="col-5">
								<div class="icon-big text-center">
									<i class="fas fa-shopping-bag text_color_grey"></i>
								</div>
							</div>
							<div class="col-7 col-stats">
								<div class="numbers">
									<p class="card-category">LoanApplications</p>
									<h4 class="card-title">{{ $order_count }}</h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-md-3">
				<div class="card card-stats card-round">
					<div class="card-body ">
						<div class="row">
							<div class="col-5">
								<div class="icon-big text-center">
									<i class="fas fa-check-square text_color_pink"></i>
								</div>
							</div>
							<div class="col-7 col-stats">
								<div class="numbers">
									<p class="card-category">Accepted</p>
									<h4 class="card-title">{{ $order_accepted_count }}</h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-md-3">
				<div class="card card-stats card-round">
					<div class="card-body ">
						<div class="row">
							<div class="col-5">
								<div class="icon-big text-center">
									<i class="fas fa-print text_color_yellow"></i>
								</div>
							</div>
							<div class="col-7 col-stats">
								<div class="numbers">
									<p class="card-category">Pickup Print</p>
									<h4 class="card-title">{{ $order_pickup_print_count }}</h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-md-3">
				<div class="card card-stats card-round">
					<div class="card-body ">
						<div class="row">
							<div class="col-5">
								<div class="icon-big text-center">
									<i class="fas fa-box text_color_orange"></i>
								</div>
							</div>
							<div class="col-7 col-stats">
								<div class="numbers">
									<p class="card-category">Packed</p>
									<h4 class="card-title">{{ $order_shipped_count }}</h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		<!-- </div> -->
		<!-- <div class="row"> -->

			<div class="col-sm-6 col-md-3">
				<div class="card card-stats card-round">
					<div class="card-body ">
						<div class="row">
							<div class="col-5">
								<div class="icon-big text-center">
									<i class="fas fa-receipt text_color_violet"></i>
								</div>
							</div>
							<div class="col-7 col-stats">
								<div class="numbers">
									<p class="card-category">Invoiced</p>
									<h4 class="card-title"> {{ $order_invoiced_count }} </h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-md-3">
				<div class="card card-stats card-round">
					<div class="card-body ">
						<div class="row">
							<div class="col-5">
								<div class="icon-big text-center">
									<i class="fas fa-check-double text_color_blue"></i>
								</div>
							</div>
							<div class="col-7 col-stats">
								<div class="numbers">
									<p class="card-category">Delivered</p>
									<h4 class="card-title">{{ $order_delivered_count }}</h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-md-3">
				<div class="card card-stats card-round">
					<div class="card-body ">
						<div class="row">
							<div class="col-5">
								<div class="icon-big text-center">
									<i class="far fa-money-bill-alt text_color_green"></i>
								</div>
							</div>
							<div class="col-7 col-stats">
								<div class="numbers">
									<p class="card-category text-nowrap">Cash Received</p>
									<h4 class="card-title">{{ $order_cash_received_count }}</h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-md-3">
				<div class="card card-stats card-round">
					<div class="card-body ">
						<div class="row">
							<div class="col-5">
								<div class="icon-big text-center bubble-shadow-small">
									<i class="fas fa-window-close text_color_red"></i>
								</div>
							</div>
							<div class="col-7 col-stats">
								<div class="numbers">
									<p class="card-category">Rejected</p>
									<h4 class="card-title">{{ $order_rejected_count }}</h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						<div class="card-title">Top Loans</div>
					</div>
					<div class="card-body pb-0">

						@foreach($top_loanapplications as $key => $product)
						<div class="d-flex">
							<div class="flex-1 pt-1 ml-2">
								<span class="h4 fw-bold">{{ $product['name'] }}</span>
							</div>
							<div class="d-flex ml-auto align-items-center">
								<h3 class="text-info fw-bold">Rs. {{ $product['loan_amount'] }}</h3>
							</div>
						</div>
						<div class="separator-dashed"></div>
						@endforeach

						<div class="pull-in">
							<canvas id="topLoansChart"></canvas>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card full-height">
					<div class="card-header">
						<div class="card-head-row">
							<div class="card-title">LoanApplications</div>
						</div>
					</div>
					<div class="card-body">
						<div class="d-flex">
							<div class="avatar avatar-online">
								<span class="avatar-title rounded-circle border border-white bg-info">J</span>
							</div>
							<div class="flex-1 ml-3 pt-1">
								<h6 class="text-uppercase fw-bold mb-1">Joko Subianto <span class="text-warning pl-3">pending</span></h6>
								<span class="text-muted">I am facing some trouble with my viewport. When i start my</span>
							</div>
							<div class="float-right pt-1">
								<small class="text-muted">8:40 PM</small>
							</div>
						</div>
						<div class="separator-dashed"></div>
						<div class="d-flex">
							<div class="avatar avatar-offline">
								<span class="avatar-title rounded-circle border border-white bg-secondary">P</span>
							</div>
							<div class="flex-1 ml-3 pt-1">
								<h6 class="text-uppercase fw-bold mb-1">Prabowo Widodo <span class="text-success pl-3">open</span></h6>
								<span class="text-muted">I have some query regarding the license issue.</span>
							</div>
							<div class="float-right pt-1">
								<small class="text-muted">1 Day Ago</small>
							</div>
						</div>
						<div class="separator-dashed"></div>
						<div class="d-flex">
							<div class="avatar avatar-away">
								<span class="avatar-title rounded-circle border border-white bg-danger">L</span>
							</div>
							<div class="flex-1 ml-3 pt-1">
								<h6 class="text-uppercase fw-bold mb-1">Lee Chong Wei <span class="text-muted pl-3">closed</span></h6>
								<span class="text-muted">Is there any update plan for RTL version near future?</span>
							</div>
							<div class="float-right pt-1">
								<small class="text-muted">2 Days Ago</small>
							</div>
						</div>
						<div class="separator-dashed"></div>
						<div class="d-flex">
							<div class="avatar avatar-offline">
								<span class="avatar-title rounded-circle border border-white bg-secondary">P</span>
							</div>
							<div class="flex-1 ml-3 pt-1">
								<h6 class="text-uppercase fw-bold mb-1">Peter Parker <span class="text-success pl-3">open</span></h6>
								<span class="text-muted">I have some query regarding the license issue.</span>
							</div>
							<div class="float-right pt-1">
								<small class="text-muted">2 Day Ago</small>
							</div>
						</div>
						<div class="separator-dashed"></div>
						<div class="d-flex">
							<div class="avatar avatar-away">
								<span class="avatar-title rounded-circle border border-white bg-danger">L</span>
							</div>
							<div class="flex-1 ml-3 pt-1">
								<h6 class="text-uppercase fw-bold mb-1">Logan Paul <span class="text-muted pl-3">closed</span></h6>
								<span class="text-muted">Is there any update plan for RTL version near future?</span>
							</div>
							<div class="float-right pt-1">
								<small class="text-muted">2 Days Ago</small>
							</div>
						</div>
						<div class="separator-dashed"></div>
						<div class="d-flex">
							<div class="avatar avatar-away">
								<span class="avatar-title rounded-circle border border-white bg-danger">L</span>
							</div>
							<div class="flex-1 ml-3 pt-1">
								<h6 class="text-uppercase fw-bold mb-1">Logan Paul <span class="text-muted pl-3">closed</span></h6>
								<span class="text-muted">Is there any update plan for RTL version near future?</span>
							</div>
							<div class="float-right pt-1">
								<small class="text-muted">2 Days Ago</small>
							</div>
						</div>
						<div class="separator-dashed"></div>
						<div class="d-flex">
							<div class="avatar avatar-away">
								<span class="avatar-title rounded-circle border border-white bg-danger">L</span>
							</div>
							<div class="flex-1 ml-3 pt-1">
								<h6 class="text-uppercase fw-bold mb-1">Logan Paul <span class="text-muted pl-3">closed</span></h6>
								<span class="text-muted">Is there any update plan for RTL version near future?</span>
							</div>
							<div class="float-right pt-1">
								<small class="text-muted">2 Days Ago</small>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
@endsection
