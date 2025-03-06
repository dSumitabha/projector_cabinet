<header class="ec-main-header" id="header">
	<nav class="navbar navbar-static-top navbar-expand-lg">
		<!-- Sidebar toggle button -->
		<button id="sidebar-toggler" class="sidebar-toggle"></button>
		<!-- search form -->
		<div class="search-form d-lg-inline-block">
			<div class="input-group">
				{{-- <input type="text" name="query" id="search-input" class="form-control"
					placeholder="search.." autofocus autocomplete="off" />
				<button type="button" name="search" id="search-btn" class="btn btn-flat">
					<i class="mdi mdi-magnify"></i>
				</button> --}}
			</div>
			<div id="search-results-container">
				<ul id="search-results"></ul>
			</div>
		</div>

		<!-- navbar right -->
		<div class="navbar-right">
			<ul class="nav navbar-nav">
				<!-- User Account -->
				<li class="dropdown user-menu">
					<button class="dropdown-toggle nav-link ec-drop" data-bs-toggle="dropdown"
						aria-expanded="false">
						<img src="{{ url('/') }}/admin/assets/img/user/blank_profile.webp" class="user-image" alt="User Image" />
					</button>
					<ul class="dropdown-menu dropdown-menu-right ec-dropdown-menu">
						<!-- User image -->
						<li class="dropdown-header">
							<img src="{{ url('/') }}/admin/assets/img/user/blank_profile.webp" class="img-circle" alt="User Image" />
							<div class="d-inline-block">
								John Deo <small class="pt-1">john.example@gmail.com</small>
							</div>
						</li>
						<li>
							<a href="{{ route('admin.admin_profile') }}">
								<i class="mdi mdi-account"></i> My Profile
							</a>
						</li>


						<li class="dropdown-footer">
							<a href="{{ route('admin.admin_logout') }}" method="POST"> <i class="mdi mdi-logout"></i> Log Out </a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
</header>
