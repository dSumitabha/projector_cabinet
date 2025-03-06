@extends('frontend.layouts.master')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<style>
    .small-checkbox {
        transform: scale(0.8);
        margin-top: 2px;
    }
</style>
<style>
    .sidebar {
        height: 100vh;
        background: #f8f9fa;
        padding: 20px;
    }

    .sidebar a {
        display: block;
        padding: 10px;
        margin-bottom: 5px;
        color: #333;
        text-decoration: none;
        border-radius: 5px;
    }

    .sidebar a.active,
    .sidebar a:hover {
        background: #007bff;
        color: #fff;
    }


    .profile-heading {
        font-weight: bold;
    }

    .profile-card {
        border-radius: 10px;
        background-color: #f8f9fa;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .profile-img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 15px;
    }

    .profile-text {
        color: #555;
        font-size: 16px;
        font-weight: 500;
    }

    .edit-profile-btn {
        font-weight: 600;
        font-size: 16px;
        padding: 10px 25px;
        border-radius: 30px;
    }
</style>
<div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row ec_breadcrumb_inner">
                    <div class="col-md-6 col-sm-12">
                        <h2 class="ec-breadcrumb-title">User Profile</h2>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <!-- ec-breadcrumb-list start -->
                        <ul class="ec-breadcrumb-list">
                            <li class="ec-breadcrumb-item"><a href="{{ route('all_products') }}">Home</a></li>
                            <li class="ec-breadcrumb-item active">Profile</li>
                        </ul>
                        <!-- ec-breadcrumb-list end -->
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <!-- Sidebar -->
                    <nav class="col-md-3 col-lg-2 sidebar">
                        <h4 class="mb-4">Dashboard</h4>
                        <a class="tab-link active" data-target="#profile">My Profile</a>
                        {{-- <a class="tab-link" data-target="#orders">My Orders</a> --}}
                        <a class="tab-link" data-target="#address">Address</a>
                        <a class="tab-link" data-target="#settings">Settings</a>
                        <a class="tab-link" data-target="#changePass">Change Password</a>

                    </nav>

                    <!-- Content -->
                    <div class="col-md-9 col-lg-10 tab-content p-4">
                        <!-- Profile Section -->
                        <div class="tab-pane fade show active" id="profile">
                            <div class="card shadow-sm border-0 profile-card p-4">
                                <div class="text-center">
                                    <img src="{{ url('/') }}/admin/assets/img/user/u8.jpg" alt="User Image"
                                        class="rounded-circle profile-img mb-3" style="width: 120px; height: 120px; object-fit: cover; border: 4px solid #ddd;">
                                    <h4 class="fw-bold mb-1">{{ Auth::user()->name }}</h4>
                                    <p class="text-muted">{{ Auth::user()->email }}</p>
                                </div>

                                <hr class="my-3">

                                <div class="profile-details">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-envelope text-primary me-3 fs-5"></i>

                                            <p class="fw-bold mb-1 text-muted">Email Address</p>

                                            <input type="text" class="form-control" name="name" placeholder="Enter full name" value="{{ Auth::user()->email }}" readonly>

                                    </div>

                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-phone text-success me-3 fs-5"></i>

                                            <p class="fw-bold mb-1 text-muted">Phone Number</p>
                                            <input type="text" class="form-control" name="name"  value="{{ Auth::user()->phone_number }}" readonly>


                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Orders Section -->
                        {{-- <div class="tab-pane fade" id="orders">
                            <h2>My Orders</h2>
                            <p>List of your orders.</p>
                        </div> --}}

                        <!-- Wishlist Section -->
                        <div class="tab-pane fade" id="address">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h2>My Address</h2>
                                <button class="btn btn-success" id="add-address-btn">Add Address</button>
                            </div>

                            <!-- New Address Form -->
                            <div id="new-address-form" class="card mt-4" style="display: none;">
                                <div class="card-header">
                                    <h5 class="card-title">Add New Address</h5>
                                </div>
                                <div class="card-body">
                                    <form id="profile_address_1" action="{{ route('save.address') }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <div class="mb-3 row">
                                            <div class="col-md-6">
                                                <label class="form-label">First Name</label>
                                                <input type="text" class="form-control" name="first_namee" placeholder="Enter First Name">
                                                <span class="text-danger error-text first_namee_error"></span>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Last Name</label>
                                                <input type="text" class="form-control" name="last_namee" placeholder="Enter Last Name">
                                                <span class="text-danger error-text last_namee_error"></span>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Address</label>
                                            <input type="text" class="form-control" name="addresss" placeholder="Enter Address">
                                            <span class="text-danger error-text addresss_error"></span>
                                        </div>

                                        <div class="mb-3 row">
                                            <div class="col-md-4">
                                                <label class="form-label">Country</label>
                                                <input type="text" class="form-control" name="countryy" placeholder="Enter Country">
                                                <span class="text-danger error-text countryy_error"></span>
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label">State</label>
                                                <input type="text" class="form-control" name="statee" placeholder="Enter State">
                                                <span class="text-danger error-text statee_error"></span>
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label">City</label>
                                                <input type="text" class="form-control" name="cityy" placeholder="Enter City">
                                                <span class="text-danger error-text cityy_error"></span>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <div class="col-md-4">
                                                <label class="form-label">Zip</label>
                                                <input type="text" class="form-control" name="zipp" placeholder="Enter Zip">
                                                <span class="text-danger error-text zipp_error"></span>
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label">Phone</label>
                                                <input type="text" class="form-control" name="phonee" placeholder="Enter Phone Number">
                                                <span class="text-danger error-text phonee_error"></span>
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label">Email</label>
                                                <input type="text" class="form-control" name="emaill" placeholder="Enter Email">
                                                <span class="text-danger error-text emaill_error"></span>
                                            </div>
                                        </div>

                                        <div class="mb-3 d-flex flex-column align-items-start">
                                            <label class="form-label">Mark the Address As Active</label>
                                            <div>
                                                <label>
                                                    <input type="checkbox" name="is_active" value="active" class="form-check-input small-checkbox" data-form="profile_address_"> Active
                                                </label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Save Address</button>
                                    </form>
                                </div>
                            </div>
                            <br>

                            <!-- Existing Addresses -->
                            @if(!empty($user_address))
                            @foreach($user_address as $address)
                            <div class="card shadow-sm border-0 mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center bg-light">
                                    <h5 class="mb-0">Address #{{ $loop->iteration }}</h5>
                                    <form action="{{ route('delete.address', $address->id) }}" method="POST" class="delete-address-form">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="btn btn-outline-danger btn-sm" style="color:red">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                                <div class="card-body">
                                    <form id="profile_address_update_{{$address->id}}" action="{{ route('update.address', $address->id) }}" method="POST">
                                        @csrf
                                        @method('POST')

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">First Name</label>
                                                <input type="text" class="form-control" name="first_name" value="{{$address->first_name}}" placeholder="Enter First Name">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Last Name</label>
                                                <input type="text" class="form-control" name="last_name" value="{{$address->last_name}}" placeholder="Enter Last Name">
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Address</label>
                                            <input type="text" class="form-control" name="address" value="{{ $address->street1 }}" placeholder="Enter Address">
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">Country</label>
                                                <input type="text" class="form-control" name="country" value="{{ $address->country }}" placeholder="Enter Country">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">State</label>
                                                <input type="text" class="form-control" name="state" value="{{ $address->state }}" placeholder="Enter State">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">City</label>
                                                <input type="text" class="form-control" name="city" value="{{ $address->city }}" placeholder="Enter City">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">Zip</label>
                                                <input type="text" class="form-control" name="zip" value="{{ $address->zip }}" placeholder="Enter Zip">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">Phone</label>
                                                <input type="text" class="form-control" name="phone" value="{{ $address->phone }}" placeholder="Enter Phone Number">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">Email</label>
                                                <input type="email" class="form-control" name="email" value="{{ $address->email }}" placeholder="Enter Email">
                                            </div>
                                        </div>

                                        <div class="mb-3 d-flex flex-column align-items-start">
                                            <input type="checkbox" name="is_active" value="active" class="form-check-input small-checkbox" {{ $address->is_active == 'active' ? 'checked' : '' }}>
                                            <label class="form-label fw-semibold mt-1">Mark the Address As Active</label>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Update Address</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                            @endif
                        </div>


                        <!-- Settings Section -->
                        <div class="tab-pane fade" id="settings">
                            <h2>Profile Settings</h2>
                            <form id="profile_update_form" action="{{ route('profile.update') }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter full name" value="{{ Auth::user()->name }}">
                                    <span class="text-danger error-text name_error"></span> <!-- Error message for name -->
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Email Address</label>
                                    <input type="text" class="form-control" name="email" placeholder="Enter email" value="{{ Auth::user()->email }}">
                                    <span class="text-danger error-text email_error"></span> <!-- Error message for email -->
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" name="phone" placeholder="Enter phone number" value="{{ Auth::user()->phone_number }}">
                                    <span class="text-danger error-text phone_error"></span> <!-- Error message for phone -->
                                </div>

                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </form>

                        </div>

                        <div class="tab-pane fade" id="changePass">
                            <h2>Change Password</h2>
                            <form id="change_password_form" action="{{ route('change.password') }}" method="post">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">Old Password</label>
                                    <input type="password" class="form-control" name="old_password" placeholder="Enter Old Password">
                                    <span class="text-danger error-text old_password_error"></span> <!-- Error message for name -->
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">New Password</label>
                                    <input type="password" class="form-control" name="new_password" placeholder="Enter New Password">
                                    <span class="text-danger error-text new_password_error"></span> <!-- Error message for email -->
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="Enter Confirm Password">
                                    <span class="text-danger error-text password_confirmation_error"></span> <!-- Error message for phone -->
                                </div>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@push('script')
<script>
    $(document).ready(function() {
        // On page load, check for hash in the URL
        var activeTab = window.location.hash; // Get the active tab hash from URL

        if (activeTab) {
            // Deactivate all tabs
            $('.tab-link').removeClass('active');

            // Activate the tab that corresponds to the hash
            $('a[data-target="' + activeTab + '"]').addClass('active');

            // Show the corresponding tab content
            $('.tab-pane').removeClass('show active');
            $(activeTab).addClass('show active');
        }

        // When a tab link is clicked, activate it
        $('.tab-link').on('click', function(e) {
            e.preventDefault();

            var target = $(this).data('target');

            // Deactivate all tabs
            $('.tab-link').removeClass('active');
            $(this).addClass('active');

            // Show the corresponding tab content
            $('.tab-pane').removeClass('show active');
            $(target).addClass('show active');

            // Update the URL hash
            window.location.hash = target;
        });
    });

    $('#profile_update_form').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: new FormData(this),
            processData: false,
            dataType: 'json',
            contentType: false,
            beforeSend: function() {
                $(document).find('span.error-text').text('');
            },
            success: function(data) {
                if (data.status == 400) {
                    $.each(data.error, function(key, value) {
                        $('span.' + key + '_error').text(value[0]); // Display errors on the form
                    });
                } else if (data.status == 200) {
                    toastr.success(data.msg); // Show success message

                }
            }
        });
    });

    $('#change_password_form').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: new FormData(this),
            processData: false,
            dataType: 'json',
            contentType: false,
            beforeSend: function() {
                $(document).find('span.error-text').text('');
            },
            success: function(data) {
                if (data.status == 400) {
                    $.each(data.error, function(key, value) {
                        $('span.' + key + '_error').text(value[0]);
                    });
                } else if (data.status == 200) {
                    toastr.success(data.msg);
                    $('#change_password_form')[0].reset();


                }
            }
        });
    });


    $('#profile_address_1').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: new FormData(this),
            processData: false,
            dataType: 'json',
            contentType: false,
            beforeSend: function() {
                $(document).find('span.error-text').text('');
            },
            success: function(data) {
                if (data.status == 400) {
                    $.each(data.error, function(key, value) {
                        $('span.' + key + '_error').text(value[0]);
                    });
                } else if (data.status == 200) {
                    toastr.success(data.msg);
                    window.location.hash = "#address"; // Set the hash to the wishlist tab

                    window.location.reload();

                }
            },
            error: function(xhr) {
                toastr.error('An error occurred while saving the address.');
            }
        });
    });

    // Use event delegation to handle the form submission for each individual form
    $(document).on('submit', '[id^=profile_address_update_]', function(e) {
        e.preventDefault();

        var form = $(this); // Get the specific form that was submitted

        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: new FormData(form[0]), // Use the form element to get form data
            processData: false,
            dataType: 'json',
            contentType: false,
            beforeSend: function() {
                form.find('span.error-text').text(''); // Clear previous errors
            },
            success: function(data) {
                if (data.status == 400) {
                    // Loop through the errors and display them next to each input
                    $.each(data.error, function(key, value) {
                        form.find('span.' + key + '_error').text(value[0]);
                    });
                } else if (data.status == 200) {
                    toastr.success(data.msg);
                    window.location.hash = "#address"; // Set the hash to the wishlist tab
                    window.location.reload();
                }
            }
        });
    });



    $(document).on('click', '.delete-address-btn', function(e) {
        e.preventDefault(); // Prevent the default form submission

        // Get the form that is associated with the delete button
        var form = $(this).closest('form');

        // Show SweetAlert2 confirmation
        Swal.fire({
            title: 'Are you sure?',
            text: 'This address will be deleted permanently!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // If the user confirms, submit the form
                form.submit();
            } else {
                // If user cancels, show the cancelled message
                Swal.fire(
                    'Cancelled',
                    'Your address is safe.',
                    'info'
                );
            }
        });
    });
</script>

<script>
    document.getElementById('add-address-btn').addEventListener('click', function() {
        const newAddressForm = document.getElementById('new-address-form');
        newAddressForm.style.display = newAddressForm.style.display === 'none' ? 'block' : 'none';
    });
</script>
@endpush
