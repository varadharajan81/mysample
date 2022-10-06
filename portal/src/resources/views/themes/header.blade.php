<nav class="navbar navbar-header navbar-expand-lg" data-background-color="green2">

	<div class="container-fluid">
		<div class="collapse" id="search-nav">
			<form role="form" id="search" action="{{ url('loanapplications/search') }}" name="search" value="{{ old('q') }}" method="get" class="navbar-left navbar-form nav-search mr-md-3">
				<div class="input-group">
					<div class="input-group-prepend">
						<button type="submit" class="btn btn-search pr-1">
							<i class="fa fa-search search-icon"></i>
						</button>
					</div>
					<input type="text" id="searchtxt" placeholder="Search ..." class="form-control">
				</div>
			</form>
		</div>
		<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
			<li class="nav-item toggle-nav-search hidden-caret">
				<a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
					<i class="fa fa-search"></i>
				</a>
			</li>
			<li class="nav-item dropdown hidden-caret">
				<a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fa fa-bell"></i>
					<span class="notification">3</span>
				</a>
				<ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
					<li>
						<div class="dropdown-title">You have 3 new notification</div>
					</li>
					<li>
						<div class="notif-scroll scrollbar-outer">
							<div class="notif-center">
								<a href="#">
									<div class="notif-icon notif-primary"> <i class="fa fa-user-plus"></i> </div>
									<div class="notif-content">
										<span class="block">
											New user registered
										</span>
										<span class="time">5 minutes ago</span>
									</div>
								</a>
								<a href="#">
									<div class="notif-icon notif-success"> <i class="fa fa-comment"></i> </div>
									<div class="notif-content">
										<span class="block">
											Customer raised a query
										</span>
										<span class="time">12 minutes ago</span>
									</div>
								</a>
								<a href="#">
									<div class="notif-icon notif-danger"> <i class="fa fa-heart"></i> </div>
									<div class="notif-content">
										<span class="block">
											Got new subscription
										</span>
										<span class="time">17 minutes ago</span>
									</div>
								</a>
							</div>
						</div>
					</li>
					<li>
						<a class="see-all" href="javascript:void(0);">See all notifications<i class="fa fa-angle-right"></i> </a>
					</li>
				</ul>
			</li>
		</ul>
	</div>
</nav>
