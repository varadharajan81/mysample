<div class="sidebar sidebar-style-2">
	<div class="sidebar-wrapper scrollbar scrollbar-inner">
		<div class="sidebar-content">
			<div class="user">
				<div class="avatar-sm float-left mr-2">
					<img src="{{URL::asset('../assets/img/profile.jpg')}}" alt="..." class="avatar-img rounded-circle">
				</div>
				<div class="info">
					<a href="#" aria-expanded="true">
						<span>
							<span class="user-level">{{ Auth::user()->name }}</span>
							<span class="user-level">{{ Auth::user()->user_type_id == 2 ? 'Bank Staff' : 'Administrator' }}</span>
						</span>
					</a>
				</div>
			</div>
			<ul class="nav nav-success">
				<li class="nav-item {{ ($module_name == '' || $module_name == 'home' || $module_name == 'home.edit' || $module_name == 'home.index' || $module_name == 'home.create') ? 'active': '' }}">
					<a href="{{ url('home') }}">
						<i class="fas fa-home"></i>
						<p>Dashboard</p>
					</a>
				</li>
				@if(Auth::user()->user_type_id == 1)
				<li class="nav-item {{ ($module_name == '' || $module_name == 'customers' || $module_name == 'customers.edit' || $module_name == 'customers.index' || $module_name == 'customers.create') ? 'active': '' }}">
					<a href="{{ url('customers') }}">
						<i class="fas fa-users"></i>
						<p>Customers</p>
					</a>
				</li>
				@endif
				<li class="nav-item {{ ($module_name == '' || $module_name == 'loanapplications' || $module_name == 'loanapplications.edit' || $module_name == 'loanapplications.index' || $module_name == 'loanapplications.create') ? 'active': '' }}">
					<a href="{{ url('loanapplications') }}">
						<!-- <i class="fas fa-shipping-fast"></i> -->
						<i class="fas fa-tasks"></i>
						<p>Loan Applications</p>
					</a>
				</li>
				<li class="nav-item {{ ($module_name == '' || $module_name == 'reports') ? 'active': '' }} ">
					<a href="{{ url('reports') }}">
						<i class="far fa-chart-bar"></i>
						<p>Reports</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="{{ route('logout') }}"
					   onclick="event.preventDefault();
						document.getElementById('logout-form').submit();">
						<i class="fas fa-power-off"></i>
						<p>{{ __('Logout') }}</p>
					</a>

					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						@csrf
					</form>
				</li>
			</ul>
		</div>
	</div>
</div>
