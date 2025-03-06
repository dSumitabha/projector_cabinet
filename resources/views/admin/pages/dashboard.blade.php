@extends('admin.layouts.master')
@section('content')
<div class="ec-content-wrapper ">
	<div class="content">
		<!-- Top Statistics -->
		<div class="row">
			<div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
				<div class="card card-mini dash-card card-1">
					<div class="card-body">
						<h2 class="mb-1">1,503</h2>
						<p>Total Signups</p>
						<span class="mdi mdi-account-arrow-left"></span>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
				<div class="card card-mini dash-card card-2">
					<div class="card-body">
						<h2 class="mb-1">79,503</h2>
						<p>Total Visitors</p>
						<span class="mdi mdi-account-clock"></span>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
				<div class="card card-mini dash-card card-3">
					<div class="card-body">
						<h2 class="mb-1">15,503</h2>
						<p>Total Order</p>
						<span class="mdi mdi-package-variant"></span>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
				<div class="card card-mini dash-card card-4">
					<div class="card-body">
						<h2 class="mb-1">$98,503</h2>
						<p>Total Revenue</p>
						<span class="mdi mdi-currency-usd"></span>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<!-- Recent Order Table -->
		<div class="col-8 p-b-15">
				<div class="card card-table-border-none card-default recent-orders" id="recent-orders">
					<div class="card-header justify-content-between">
						<h2>Recent Orders</h2>
						<div class="date-range-report">
							<span></span>
						</div>
					</div>
					<div class="card-body pt-0 pb-5">
						<table class="table card-table table-responsive table-responsive-large"
							style="width:100%">
							<thead>
								<tr>
									<th>Order ID</th>
									<th>Product Name</th>
									
									<th class="d-none d-lg-table-cell">Order Date</th>
									<th class="d-none d-lg-table-cell">Order Cost</th>
									<th>Status</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>24541</td>
									<td>
										<a class="text-dark" href=""> Coach Swagger</a>
									</td>

									<td class="d-none d-lg-table-cell">Oct 20, 2018</td>
									<td class="d-none d-lg-table-cell">$230</td>
									<td>
										<span class="badge badge-success">Completed</span>
									</td>
									<td class="text-right">
										<div class="dropdown show d-inline-block widget-dropdown">
											<a class="dropdown-toggle icon-burger-mini" href=""
												role="button" id="dropdown-recent-order1"
												data-bs-toggle="dropdown" aria-haspopup="true"
												aria-expanded="false" data-display="static"></a>
											<ul class="dropdown-menu dropdown-menu-right">
												<li class="dropdown-item">
													<a href="#">View</a>
												</li>
												<li class="dropdown-item">
													<a href="#">Remove</a>
												</li>
											</ul>
										</div>
									</td>
								</tr>
								<tr>
									<td>24541</td>
									<td>
										<a class="text-dark" href=""> Toddler Shoes, Gucci Watch</a>
									</td>

									<td class="d-none d-lg-table-cell">Nov 15, 2018</td>
									<td class="d-none d-lg-table-cell">$550</td>
									<td>
										<span class="badge badge-primary">Delayed</span>
									</td>
									<td class="text-right">
										<div class="dropdown show d-inline-block widget-dropdown">
											<a class="dropdown-toggle icon-burger-mini" href="#"
												role="button" id="dropdown-recent-order2"
												data-bs-toggle="dropdown" aria-haspopup="true"
												aria-expanded="false" data-display="static"></a>
											<ul class="dropdown-menu dropdown-menu-right">
												<li class="dropdown-item">
													<a href="#">View</a>
												</li>
												<li class="dropdown-item">
													<a href="#">Remove</a>
												</li>
											</ul>
										</div>
									</td>
								</tr>
								<tr>
									<td>24541</td>
									<td>
										<a class="text-dark" href=""> Hat Black Suits</a>
									</td>
									<td class="d-none d-lg-table-cell">Nov 18, 2018</td>
									<td class="d-none d-lg-table-cell">$325</td>
									<td>
										<span class="badge badge-warning">On Hold</span>
									</td>
									<td class="text-right">
										<div class="dropdown show d-inline-block widget-dropdown">
											<a class="dropdown-toggle icon-burger-mini" href="#"
												role="button" id="dropdown-recent-order3"
												data-bs-toggle="dropdown" aria-haspopup="true"
												aria-expanded="false" data-display="static"></a>
											<ul class="dropdown-menu dropdown-menu-right">
												<li class="dropdown-item">
													<a href="#">View</a>
												</li>
												<li class="dropdown-item">
													<a href="#">Remove</a>
												</li>
											</ul>
										</div>
									</td>
								</tr>
								<tr>
									<td>24541</td>
									<td>
										<a class="text-dark" href=""> Backpack Gents, Swimming Cap Slin</a>
									</td>

									<td class="d-none d-lg-table-cell">Dec 13, 2018</td>
									<td class="d-none d-lg-table-cell">$200</td>
									<td>
										<span class="badge badge-success">Completed</span>
									</td>
									<td class="text-right">
										<div class="dropdown show d-inline-block widget-dropdown">
											<a class="dropdown-toggle icon-burger-mini" href="#"
												role="button" id="dropdown-recent-order4"
												data-bs-toggle="dropdown" aria-haspopup="true"
												aria-expanded="false" data-display="static"></a>
											<ul class="dropdown-menu dropdown-menu-right">
												<li class="dropdown-item">
													<a href="#">View</a>
												</li>
												<li class="dropdown-item">
													<a href="#">Remove</a>
												</li>
											</ul>
										</div>
									</td>
								</tr>
								<tr>
									<td>24541</td>
									<td>
										<a class="text-dark" href=""> Speed 500 Ignite</a>
									</td>

									<td class="d-none d-lg-table-cell">Dec 23, 2018</td>
									<td class="d-none d-lg-table-cell">$150</td>
									<td>
										<span class="badge badge-danger">Cancelled</span>
									</td>
									<td class="text-right">
										<div class="dropdown show d-inline-block widget-dropdown">
											<a class="dropdown-toggle icon-burger-mini" href="#"
												role="button" id="dropdown-recent-order5"
												data-bs-toggle="dropdown" aria-haspopup="true"
												aria-expanded="false" data-display="static"></a>
											<ul class="dropdown-menu dropdown-menu-right">
												<li class="dropdown-item">
													<a href="#">View</a>
												</li>
												<li class="dropdown-item">
													<a href="#">Remove</a>
												</li>
											</ul>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>

				<!-- Doughnut Chart -->
			<div class="col-xl-4 col-md-12 p-b-15">
				
				<div class="card card-default">
					<div class="card-header justify-content-center">
						<h2>Orders Overview</h2>
					</div>
					<div class="card-body">
						<canvas id="doChart"></canvas>
					</div>
					<a href="#" class="pb-5 d-block text-center text-muted"></a>
					<div class="card-footer d-flex flex-wrap bg-white p-0">
						<div class="col-6">
							<div class="p-20">
								<ul class="d-flex flex-column justify-content-between">
									<li class="mb-2"><i class="mdi mdi-checkbox-blank-circle-outline mr-2"
											style="color: #4c84ff"></i>Order Completed</li>
									<li class="mb-2"><i class="mdi mdi-checkbox-blank-circle-outline mr-2"
											style="color: #80e1c1 "></i>Order Unpaid</li>
									<li><i class="mdi mdi-checkbox-blank-circle-outline mr-2"
											style="color: #ff7b7b "></i>Order returned</li>
								</ul>
							</div>
						</div>
						<div class="col-6 border-left">
							<div class="p-20">
								<ul class="d-flex flex-column justify-content-between">
									<li class="mb-2"><i class="mdi mdi-checkbox-blank-circle-outline mr-2"
											style="color: #8061ef"></i>Order Pending</li>
									<li class="mb-2"><i class="mdi mdi-checkbox-blank-circle-outline mr-2"
											style="color: #ffa128"></i>Order Canceled</li>
									<li><i class="mdi mdi-checkbox-blank-circle-outline mr-2"
											style="color: #7be6ff"></i>Order Broken</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<!-- New Customer -->
			<div class="col-xl-12">
				<!-- New Customers -->
				<div class="card ec-cust-card card-table-border-none card-default">
					<div class="card-header justify-content-between ">
						<h2>New Customers</h2>
						<div>
							<button class="text-black-50 mr-2 font-size-20">
								<i class="mdi mdi-cached"></i>
							</button>
							<div class="dropdown show d-inline-block widget-dropdown">
								<a class="dropdown-toggle icon-burger-mini" href="#" role="button"
									id="dropdown-customar" data-bs-toggle="dropdown" aria-haspopup="true"
									aria-expanded="false" data-display="static">
								</a>
								<ul class="dropdown-menu dropdown-menu-right">
									<li class="dropdown-item"><a href="#">Action</a></li>
									<li class="dropdown-item"><a href="#">Another action</a></li>
									<li class="dropdown-item"><a href="#">Something else here</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="card-body pt-0 pb-15px">
						<table class="table ">
							<tbody>
								<tr>
									<td>
										<div class="media">
											<div class="media-image mr-3 rounded-circle">
												<a href=""><img
														class="profile-img rounded-circle w-45"
														src="{{ url('/') }}/admin/assets/img/user/u1.jpg"
														alt="customer image"></a>
											</div>
											<div class="media-body align-self-center">
												<a href="">
													<h6 class="mt-0 text-dark font-weight-medium">Selena
														Wagner</h6>
												</a>
												<small>@selena.oi</small>
											</div>
										</div>
									</td>
									<td>2 Orders</td>
									<td class="text-dark d-none d-md-block">$150</td>
								</tr>
								<tr>
									<td>
										<div class="media">
											<div class="media-image mr-3 rounded-circle">
												<a href=""><img
														class="profile-img rounded-circle w-45"
														src="{{ url('/') }}/admin/assets/img/user/u2.jpg"
														alt="customer image"></a>
											</div>
											<div class="media-body align-self-center">
												<a href="">
													<h6 class="mt-0 text-dark font-weight-medium">Walter
														Reuter</h6>
												</a>
												<small>@walter.me</small>
											</div>
										</div>
									</td>
									<td>5 Orders</td>
									<td class="text-dark d-none d-md-block">$200</td>
								</tr>
								<tr>
									<td>
										<div class="media">
											<div class="media-image mr-3 rounded-circle">
												<a href=""><img
														class="profile-img rounded-circle w-45"
														src="{{ url('/') }}/admin/assets/img/user/u3.jpg"
														alt="customer image"></a>
											</div>
											<div class="media-body align-self-center">
												<a href="">
													<h6 class="mt-0 text-dark font-weight-medium">Larissa
														Gebhardt</h6>
												</a>
												<small>@larissa.gb</small>
											</div>
										</div>
									</td>
									<td>1 Order</td>
									<td class="text-dark d-none d-md-block">$50</td>
								</tr>
								<tr>
									<td>
										<div class="media">
											<div class="media-image mr-3 rounded-circle">
												<a href=""><img
														class="profile-img rounded-circle w-45"
														src="{{ url('/') }}/admin/assets/img/user/u4.jpg"
														alt="customer image"></a>
											</div>
											<div class="media-body align-self-center">
												<a href="">
													<h6 class="mt-0 text-dark font-weight-medium">Albrecht
														Straub</h6>
												</a>
												<small>@albrech.as</small>
											</div>
										</div>
									</td>
									<td>2 Orders</td>
									<td class="text-dark d-none d-md-block">$100</td>
								</tr>
								<tr>
									<td>
										<div class="media">
											<div class="media-image mr-3 rounded-circle">
												<a href=""><img
														class="profile-img rounded-circle w-45"
														src="{{ url('/') }}/admin/assets/img/user/u5.jpg"
														alt="customer image"></a>
											</div>
											<div class="media-body align-self-center">
												<a href="">
													<h6 class="mt-0 text-dark font-weight-medium">Leopold
														Ebert</h6>
												</a>
												<small>@leopold.et</small>
											</div>
										</div>
									</td>
									<td>1 Order</td>
									<td class="text-dark d-none d-md-block">$60</td>
								</tr>
								<tr>
									<td>
										<div class="media">
											<div class="media-image mr-3 rounded-circle">
												<a href=""><img
														class="profile-img rounded-circle w-45"
														src="{{ url('/') }}/admin/assets/img/user/u3.jpg"
														alt="customer image"></a>
											</div>
											<div class="media-body align-self-center">
												<a href="">
													<h6 class="mt-0 text-dark font-weight-medium">Larissa
														Gebhardt</h6>
												</a>
												<small>@larissa.gb</small>
											</div>
										</div>
									</td>
									<td>1 Order</td>
									<td class="text-dark d-none d-md-block">$50</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- End New Customer -->
		</div>
	</div> <!-- End Content -->
</div> <!-- End Content Wrapper -->
@endsection