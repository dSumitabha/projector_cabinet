@extends('admin.layouts.master')
@section('content')
    <!-- CONTENT WRAPPER -->
    <style>
        .td-cost-price {
            font-weight: 600;
            color: #4caf50;
            /* Green */
        }

        .td-profit-percentage {
            font-weight: 600;
            color: #ff9800;
            /* Orange */
        }

        .td-selling-price {
            font-weight: 600;
            color: #f44336;
            /* Red */
        }

        .td-name {
            font-weight: 600;
            color: rgb(28, 28, 94);
            /* Red */
        }

        .td-product-id {
            font-weight: 600;
            color: rgb(6, 6, 153);
            /* Red */
        }

        .td-product-type {
            font-weight: 500;
            color: rgb(75, 75, 110);
            /* Red */
        }

        .td-product-frontend-name {
            font-weight: 600;
            color: rgb(87, 30, 114);
            /* Red */
        }
    </style>
    <div class="content">
        <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
            <div>
                <h1>Product</h1>
                <p class="breadcrumbs"><span><a href="{{ route('admin.dashboard') }}">Home</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>Product
                </p>
            </div>
            <div>
                <a href="{{ route('admin.products.add') }}" class="btn btn-primary"> Add New Product</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div style="text-align: right; margin-bottom: 10px;">
                    <form id ="deleteAllForm" action="{{ route('admin.products.deleteAll') }}" method="POST"
                        style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger alldeleteProductAssociated"
                            style="border-top-left-radius: 0; border-bottom-left-radius: 0;">Delete All</button>
                    </form>

                </div>
                <div class="card card-default">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @elseif(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="table-responsive"  style="max-height: 500px; overflow-y: auto; border: 1px solid #ddd;">
                            <table id="responsive-data-table" class="table table-striped" style="width:100%">
                                <thead style="position: sticky; top: 0; background: white; z-index: 2;">
                                    <tr>
                                        <th>Simulation ID</th>
                                        <th>Product ID</th>
                                        <th>Packaging Product ID</th>
                                        <th>Layout ID</th>
                                        <th>Fusion ID</th>
                                        <th>Render ID</th>
                                        <th>Product Center Channel Placement</th>
                                        <th>Front-End Name</th>
                                        <th>Front-End Description</th>
                                        <th>Product Name</th>
                                        <th>Product Type</th>
                                        <th>Cabinet Length</th>
                                        <th>Cabinet Height</th>
                                        <th>Cabinet Depth</th>
                                        <th>Cost Price ($)</th>
                                        <th>Profit %</th>
                                        <th>Profit Margin</th>
                                        <th>Selling Price ($)</th>
                                        <th>GS1</th>
                                        <th>GS1 Type</th>
                                        <th>DIY</th>
                                        <th>Has Doors</th>
                                        <th>Profile</th>
                                        <th>Size</th>
                                        <th>Color</th>


                                        <th>Off Wall</th>
                                        <th>Floor Raising Screen</th>
                                        <th>Depth of Middle Section</th>
                                        <th>Depth of Side Sections</th>
                                        <th>Center Channel Chamber Length</th>
                                        <th>Center Channel Chamber Depth</th>
                                        <th>Center Channel Chamber Height</th>
                                        <th>Compatible with Projectors</th>
                                        <th>Compatible with Center Channels</th>
                                        <th>Center Channel Placement</th>
                                        <th>Variable Height Projector Platform</th>
                                        <th>Variable Height Center Channel Platform</th>
                                        <th>Variable Depth Center Channel Platform</th>
                                        <th>Angling Mechanism for Center Channel</th>
                                        <th>Enclosed UST Projector</th>
                                        <th>Enclosed Center Channel</th>
                                        <th>Open Back Design</th>
                                        <th>Silent Fan for Flushing Heat from AVR</th>
                                        <th>Adjustable Height Legs</th>
                                        <th>Remote Friendly</th>

                                        <th>Is Floor Raising Screen Embedded Within Cabinet</th>
                                        <th>Material</th>
                                        <th>Installation Required</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product->parent_product_id }}</td>
                                            <td class="td-product-id">{{ $product->product_id }}</td>
                                            <td>{{ $product->packaging_product_id ?? 'NULL' }}</td>
                                            <td>{{ $product->layout_id ?? 'NULL' }}</td>
                                            <td>{{ $product->fusion_id ?? 'NULL' }}</td>
                                            <td>{{ $product->render_id ?? 'NULL' }}</td>
                                            <td>{{ $product->product_center_channel_placement ?? 'NULL' }}</td>
                                            <td class="td-product-frontend-name">
                                                {{ $product->product_frontend_name ?? 'NULL' }}</td>
                                            <td class="td-product-frontend-name">
                                                {{ $product->product_frontend_description ?? 'NULL' }}</td>
                                            <td class="td-name">{{ $product->product_name }}</td>
                                            <td class="td-product-type">{{ $product->product_type }}</td>
                                            <td>{{ $product->length_of_cabinet ?? 'NULL' }}</td>
                                            <td>{{ $product->height_of_cabinet ?? 'NULL' }}</td>
                                            <td>{{ $product->depth_of_cabinet ?? 'NULL' }}</td>
                                            <td class="td-cost-price">{{ $product->cost_price ?? 'NULL' }}</td>
                                            <td class="td-profit-percentage">{{ $product->profit_percentage ?? 'NULL' }}
                                            <td class="td-profit-percentage">{{ $product->profit_margin ?? 'NULL' }}
                                            </td>
                                            <td class="td-selling-price">{{ $product->selling_price ?? 'NULL' }}</td>
                                            <td>{{ $product->gs1 ?? 'NULL' }}</td>
                                            <td>{{ $product->gs1_type ?? 'NULL' }}</td>
                                            <td>{{ $product->diy ?? 'NULL' }}</td>
                                            <td>{{ $product->has_doors ?? 'NULL' }}</td>
                                            <td>{{ $product->profile ?? 'NULL' }}</td>
                                            <td>{{ $product->size ?? 'NULL' }}</td>
                                            <td>{{ $product->color ?? 'NULL' }}</td>


                                            <td>{{ $product->off_wall ?? 'NULL' }}</td>
                                            <td>{{ $product->floor_raising_screen ?? 'NULL' }}</td>
                                            <td>{{ $product->depth_of_middle_section ?? 'NULL' }}</td>
                                            <td>{{ $product->depth_of_side_sections ?? 'NULL' }}</td>
                                            <td>{{ $product->center_channel_chamber_length ?? 'NULL' }}</td>
                                            <td>{{ $product->center_channel_chamber_depth ?? 'NULL' }}</td>
                                            <td>{{ $product->center_channel_chamber_height ?? 'NULL' }}</td>
                                            <td>{{ $product->compatable_with_projectors ?? 'NULL' }}</td>
                                            <td>{{ $product->compatable_with_center_channels ?? 'NULL' }}</td>
                                            <td>{{ $product->center_channel_placement ?? 'NULL' }}</td>
                                            <td>{{ $product->variable_height_projector_platform ?? 'NULL' }}</td>
                                            <td>{{ $product->variable_height_center_channel_platform ?? 'NULL' }}</td>
                                            <td>{{ $product->variable_depth_center_channel_platform ?? 'NULL' }}</td>
                                            <td>{{ $product->angling_mechanism_for_center_channel ?? 'NULL' }}</td>
                                            <td>{{ $product->enclosed_ust_projector ?? 'NULL' }}</td>
                                            <td>{{ $product->enclosed_center_channel ?? 'NULL' }}</td>
                                            <td>{{ $product->open_back_design ?? 'NULL' }}</td>
                                            <td>{{ $product->silent_fan_for_flushing_heat_from_avr ?? 'NULL' }}</td>
                                            <td>{{ $product->adjustable_height_legs ?? 'NULL' }}</td>
                                            <td>{{ $product->remote_friendly ?? 'NULL' }}</td>

                                            <td>{{ $product->is_floor_raising_screen_embedded_within_cabinet ?? 'NULL' }}
                                            </td>
                                            <td>{{ $product->material ?? 'NULL' }}</td>
                                            <td>{{ $product->installation_required ?? 'NULL' }}</td>

                                            <td>
                                                <div class="btn-group mb-1">
                                                    <button type="button" class="btn btn-outline-success edit-product"
                                                        data-id="{{ $product->id }}"
                                                        data-parent-product-id="{{ $product->parent_product_id }}"
                                                        data-product-id="{{ $product->product_id }}"
                                                        data-product-frontend-name="{{ $product->product_frontend_name ?? 'NULL' }}"
                                                        data-product-name="{{ $product->product_name }}"
                                                        data-product-type="{{ $product->product_type }}"
                                                        data-gs1="{{ $product->gs1 ?? 'NULL' }}"
                                                        data-gs1-type="{{ $product->gs1_type ?? 'NULL' }}"
                                                        data-length="{{ $product->length_of_cabinet }}"
                                                        data-height="{{ $product->height_of_cabinet }}"
                                                        data-depth="{{ $product->depth_of_cabinet }}"
                                                        data-diy="{{ $product->diy ?? 'NULL' }}"
                                                        data-has-doors="{{ $product->has_doors ?? 'NULL' }}"
                                                        data-profile="{{ $product->profile ?? 'NULL' }}"
                                                        data-size="{{ $product->size ?? 'NULL' }}"
                                                        data-color="{{ $product->color ?? 'NULL' }}"
                                                        data-profit-percentage="{{ $product->profit_percentage  }}"
                                                        data-profit-margin="{{ $product->profit_margin  }}"
                                                        data-packaging-product-id="{{ $product->packaging_product_id ?? 'NULL' }}"
                                                        data-layout-id="{{ $product->layout_id ?? 'NULL' }}"
                                                        data-fusion-id="{{ $product->fusion_id ?? 'NULL' }}"
                                                        data-render-id="{{ $product->render_id ?? 'NULL' }}"
                                                        data-frontend-description="{{ $product->product_frontend_description ?? 'NULL' }}"
                                                        data-product-center-channel-placement="{{ $product->product_center_channel_placement ?? 'NULL' }}"
                                                        data-off-wall="{{ $product->off_wall ?? 'NULL' }}"
                                                        data-floor-raising-screen="{{ $product->floor_raising_screen ?? 'NULL' }}"
                                                        data-depth-of-middle-section="{{ $product->depth_of_middle_section ?? 'NULL' }}"
                                                        data-depth-of-side-sections="{{ $product->depth_of_side_sections ?? 'NULL' }}"
                                                        data-center-channel-chamber-length="{{ $product->center_channel_chamber_length ?? 'NULL' }}"
                                                        data-center-channel-chamber-depth="{{ $product->center_channel_chamber_depth ?? 'NULL' }}"
                                                        data-center-channel-chamber-height="{{ $product->center_channel_chamber_height ?? 'NULL' }}"
                                                        data-compatable-with-projectors="{{ $product->compatable_with_projectors ?? 'NULL' }}"
                                                        data-compatable-with-center-channels="{{ $product->compatable_with_center_channels ?? 'NULL' }}"
                                                        data-center-channel-placement="{{ $product->center_channel_placement ?? 'NULL' }}"
                                                        data-variable-height-projector-platform="{{ $product->variable_height_projector_platform ?? 'NULL' }}"
                                                        data-variable-height-center-channel-platform="{{ $product->variable_height_center_channel_platform ?? 'NULL' }}"
                                                        data-variable-depth-center-channel-platform="{{ $product->variable_depth_center_channel_platform ?? 'NULL' }}"
                                                        data-angling-mechanism-for-center-channel="{{ $product->angling_mechanism_for_center_channel ?? 'NULL' }}"
                                                        data-enclosed-ust-projector="{{ $product->enclosed_ust_projector ?? 'NULL' }}"
                                                        data-enclosed-center-channel="{{ $product->enclosed_center_channel ?? 'NULL' }}"
                                                        data-open-back-design="{{ $product->open_back_design ?? 'NULL' }}"
                                                        data-silent-fan-for-flushing-heat-from-avr="{{ $product->silent_fan_for_flushing_heat_from_avr ?? 'NULL' }}"
                                                        data-adjustable-height-legs="{{ $product->adjustable_height_legs ?? 'NULL' }}"
                                                        data-remote-friendly="{{ $product->remote_friendly ?? 'NULL' }}"
                                                        data-off-wall-cabinet="{{ $product->off_wall_cabinet ?? 'NULL' }}"
                                                        data-is-floor-raising-screen-embedded-within-cabinet="{{ $product->is_floor_raising_screen_embedded_within_cabinet ?? 'NULL' }}"
                                                        data-material="{{ $product->material ?? 'NULL' }}"
                                                        data-installation-required="{{ $product->installation_required ?? 'NULL' }}"
                                                         data-bs-toggle="modal" data-bs-target="#editProductModal"
                                                        >
                                                        Edit
                                                    </button>
                                                    <button type="button" class="btn btn-outline-danger"
                                                        onclick="confirmDelete('{{ route('admin.products.delete', ['id' => $product->id]) }}')"
                                                        style="border-top-left-radius: 0; border-bottom-left-radius: 0;">Delete
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>


                            <!-- Edit Product Modal -->
                            <div class="modal fade" id="editProductModal" tabindex="-1"
                                aria-labelledby="editProductModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form id="editProductForm" class="row g-3 p-3">
                                            <div class="modal-body">
                                                <!-- Hidden field for product ID -->
                                                <input type="hidden" id="edit_product_id" name="product_id">

                                                <!-- Parent Product ID -->
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="edit_parent_product_id" class="form-label">Parent
                                                            Product Id <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control"
                                                            id="edit_parent_product_id" name="parent_product_id">
                                                        <div class="invalid-feedback mb-3"></div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="edit_product_unique_id" class="form-label">Product Id
                                                            <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control"
                                                            id="edit_product_unique_id" name="product_unique_id">
                                                        <div class="invalid-feedback mb-3"></div>
                                                    </div>
                                                    <!-- Parent Product Name -->

                                                </div>

                                                <!-- Product Front-End Name -->
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="edit_product_frontend_name" class="form-label">Product
                                                            Front-End name</label>
                                                        <input type="text" class="form-control"
                                                            id="edit_product_frontend_name" name="product_frontend_name">
                                                        <div class="invalid-feedback mb-3"></div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="edit_product_frontend_description" class="form-label">Product
                                                            Front-End Description</label>
                                                        <input type="text" class="form-control"
                                                            id="edit_product_frontend_description" name="product_frontend_description">
                                                        <div class="invalid-feedback mb-3"></div>
                                                    </div>
                                                </div>

                                                <!-- Product Name -->
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="edit_product_name" class="form-label">Product Name
                                                            <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="edit_product_name"
                                                            name="product_name">
                                                        <div class="invalid-feedback mb-3"></div>
                                                    </div>

                                                    <!-- Product Type -->
                                                    <div class="col-md-6">
                                                        <label for="edit_product_type" class="form-label">Product Type
                                                            <span class="text-danger">*</span></label>
                                                        <select name="product_type" id="edit_product_type"
                                                            class="form-select">
                                                            <optgroup label="Select Product Type">
                                                                <option value="Parent Product">Parent Product</option>
                                                                <option value="Child Product">Child Product</option>
                                                            </optgroup>
                                                        </select>
                                                        <div class="invalid-feedback mb-3"></div>
                                                    </div>
                                                </div>

                                                <!-- GS1 -->
                                                <div class="row mb-3">
                                                    <div class="col-md-3">
                                                        <label for="edit_gs1" class="form-label">GS1</label>
                                                        <input type="text" class="form-control" id="edit_gs1"
                                                            name="gs1">
                                                    </div>

                                                    <!-- GS1 Type -->
                                                    <div class="col-md-3">
                                                        <label for="edit_gs1_type" class="form-label">GS1 Type</label>
                                                        <input type="text" class="form-control" id="edit_gs1_type"
                                                            name="gs1_type">
                                                    </div>
                                                </div>

                                                <!-- Cabinet Dimensions -->
                                                <div class="row mb-3">
                                                    <div class="col-md-4">
                                                        <label for="edit_length_of_cabinet" class="form-label">Length of
                                                            the Cabinet (inches)</label>
                                                        <input type="text" class="form-control"
                                                            id="edit_length_of_cabinet" name="length_of_cabinet">
                                                        <div class="invalid-feedback mb-3"></div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="edit_height_of_cabinet" class="form-label">Height of
                                                            the Cabinet (inches)</label>
                                                        <input type="text" class="form-control"
                                                            id="edit_height_of_cabinet" name="height_of_cabinet">
                                                        <div class="invalid-feedback mb-3"></div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="edit_depth_of_cabinet" class="form-label">Depth of the
                                                            Cabinet (inches)</label>
                                                        <input type="text" class="form-control"
                                                            id="edit_depth_of_cabinet" name="depth_of_cabinet">
                                                        <div class="invalid-feedback mb-3"></div>
                                                    </div>
                                                </div>

                                                <!-- DIY -->
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="edit_diy" class="form-label">DIY</label>
                                                        <select class="form-select" id="edit_diy" name="diy">
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                        </select>
                                                        <div class="invalid-feedback mb-3">Please select Yes or No.</div>
                                                    </div>

                                                    <!-- Has Doors -->
                                                    <div class="col-md-6">
                                                        <label for="edit_has_doors" class="form-label">Has Door</label>
                                                        <select class="form-select" id="edit_has_doors" name="has_doors">
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                        </select>
                                                        <div class="invalid-feedback mb-3">Please select Yes or No.</div>
                                                    </div>
                                                </div>

                                                <!-- Additional Fields -->
                                                <div class="row mb-3">
                                                    <div class="col-md-4">
                                                        <label for="edit_profile" class="form-label">Profile</label>
                                                        <input type="text" class="form-control" id="edit_profile"
                                                            name="profile">
                                                        <div class="invalid-feedback mb-3"></div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="edit_size" class="form-label">Size</label>
                                                        <input type="text" class="form-control" id="edit_size"
                                                            name="size">
                                                        <div class="invalid-feedback mb-3"></div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="edit_color" class="form-label">Color</label>
                                                        <input type="text" class="form-control" id="edit_color"
                                                            name="color">
                                                        <div class="invalid-feedback mb-3">Please provide a valid color.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="edit_packaging_product_id" class="form-label">Packaging Product ID</label>
                                                        <input type="text" class="form-control" id="edit_packaging_product_id" name="packaging_product_id">
                                                        <div class="invalid-feedback mb-3"></div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="edit_layout_id" class="form-label">Layout ID</label>
                                                        <input type="text" class="form-control" id="edit_layout_id" name="layout_id">
                                                        <div class="invalid-feedback mb-3"></div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="edit_fusion_id" class="form-label">Fusion ID</label>
                                                        <input type="text" class="form-control" id="edit_fusion_id" name="fusion_id">
                                                        <div class="invalid-feedback mb-3"></div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="edit_render_id" class="form-label">Render ID</label>
                                                        <input type="text" class="form-control" id="edit_render_id" name="render_id">
                                                        <div class="invalid-feedback mb-3"></div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="edit_product_center_channel_placement" class="form-label">Product Center Channel Placement</label>
                                                        <input type="text" class="form-control" id="edit_product_center_channel_placement" name="product_center_channel_placement">
                                                        <div class="invalid-feedback mb-3"></div>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="edit_off_wall" class="form-label">Off Wall</label>
                                                        <input type="text" class="form-control" id="edit_off_wall" name="off_wall">
                                                        <div class="invalid-feedback mb-3"></div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="edit_floor_raising_screen" class="form-label">Floor Raising Screen</label>
                                                        <input type="text" class="form-control" id="edit_floor_raising_screen" name="floor_raising_screen">
                                                        <div class="invalid-feedback mb-3"></div>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="edit_depth_of_middle_section" class="form-label">Depth of Middle Section</label>
                                                        <input type="text" class="form-control" id="edit_depth_of_middle_section" name="depth_of_middle_section">
                                                        <div class="invalid-feedback mb-3"></div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="edit_depth_of_side_sections" class="form-label">Depth of Side Sections</label>
                                                        <input type="text" class="form-control" id="edit_depth_of_side_sections" name="depth_of_side_sections">
                                                        <div class="invalid-feedback mb-3"></div>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="edit_center_channel_chamber_length" class="form-label">Center Channel Chamber Length</label>
                                                        <input type="text" class="form-control" id="edit_center_channel_chamber_length" name="center_channel_chamber_length">
                                                        <div class="invalid-feedback mb-3"></div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="edit_center_channel_chamber_depth" class="form-label">Center Channel Chamber Depth</label>
                                                        <input type="text" class="form-control" id="edit_center_channel_chamber_depth" name="center_channel_chamber_depth">
                                                        <div class="invalid-feedback mb-3"></div>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="edit_center_channel_chamber_height" class="form-label">Center Channel Chamber Height</label>
                                                        <input type="text" class="form-control" id="edit_center_channel_chamber_height" name="center_channel_chamber_height">
                                                        <div class="invalid-feedback mb-3"></div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="edit_compatable_with_projectors" class="form-label">Compatible with Projectors</label>
                                                        <input type="text" class="form-control" id="edit_compatable_with_projectors" name="compatable_with_projectors">
                                                        <div class="invalid-feedback mb-3"></div>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="edit_compatable_with_center_channels" class="form-label">Compatible with Center Channels</label>
                                                        <input type="text" class="form-control" id="edit_compatable_with_center_channels" name="compatable_with_center_channels">
                                                        <div class="invalid-feedback mb-3"></div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="edit_center_channel_placement" class="form-label">Center Channel Placement</label>
                                                        <input type="text" class="form-control" id="edit_center_channel_placement" name="center_channel_placement">
                                                        <div class="invalid-feedback mb-3"></div>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="edit_variable_height_projector_platform" class="form-label">Variable Height Projector Platform</label>
                                                        <input type="text" class="form-control" id="edit_variable_height_projector_platform" name="variable_height_projector_platform">
                                                        <div class="invalid-feedback mb-3"></div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="edit_variable_height_center_channel_platform" class="form-label">Variable Height Center Channel Platform</label>
                                                        <input type="text" class="form-control" id="edit_variable_height_center_channel_platform" name="variable_height_center_channel_platform">
                                                        <div class="invalid-feedback mb-3"></div>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="edit_variable_depth_center_channel_platform" class="form-label">Variable Depth Center Channel Platform</label>
                                                        <input type="text" class="form-control" id="edit_variable_depth_center_channel_platform" name="variable_depth_center_channel_platform">
                                                        <div class="invalid-feedback mb-3"></div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="edit_angling_mechanism_for_center_channel" class="form-label">Angling Mechanism for Center Channel</label>
                                                        <input type="text" class="form-control" id="edit_angling_mechanism_for_center_channel" name="angling_mechanism_for_center_channel">
                                                        <div class="invalid-feedback mb-3"></div>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="edit_enclosed_ust_projector" class="form-label">Enclosed UST Projector</label>
                                                        <input type="text" class="form-control" id="edit_enclosed_ust_projector" name="enclosed_ust_projector">
                                                        <div class="invalid-feedback mb-3"></div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="edit_enclosed_center_channel" class="form-label">Enclosed Center Channel</label>
                                                        <input type="text" class="form-control" id="edit_enclosed_center_channel" name="enclosed_center_channel">
                                                        <div class="invalid-feedback mb-3"></div>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="edit_open_back_design" class="form-label">Open Back Design</label>
                                                        <input type="text" class="form-control" id="edit_open_back_design" name="open_back_design">
                                                        <div class="invalid-feedback mb-3"></div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="edit_silent_fan_for_flushing_heat_from_avr" class="form-label">Silent Fan for Flushing Heat from AVR</label>
                                                        <input type="text" class="form-control" id="edit_silent_fan_for_flushing_heat_from_avr" name="silent_fan_for_flushing_heat_from_avr">
                                                        <div class="invalid-feedback mb-3"></div>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="edit_adjustable_height_legs" class="form-label">Adjustable Height Legs</label>
                                                        <input type="text" class="form-control" id="edit_adjustable_height_legs" name="adjustable_height_legs">
                                                        <div class="invalid-feedback mb-3"></div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="edit_remote_friendly" class="form-label">Remote Friendly</label>
                                                        <input type="text" class="form-control" id="edit_remote_friendly" name="remote_friendly">
                                                        <div class="invalid-feedback mb-3"></div>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="edit_off_wall_cabinet" class="form-label">Off Wall Cabinet</label>
                                                        <input type="text" class="form-control" id="edit_off_wall_cabinet" name="off_wall_cabinet">
                                                        <div class="invalid-feedback mb-3"></div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="edit_is_floor_raising_screen_embedded_within_cabinet" class="form-label">Is Floor Raising Screen Embedded within Cabinet</label>
                                                        <input type="text" class="form-control" id="edit_is_floor_raising_screen_embedded_within_cabinet" name="is_floor_raising_screen_embedded_within_cabinet">
                                                        <div class="invalid-feedback mb-3"></div>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="edit_material" class="form-label">Material</label>
                                                        <input type="text" class="form-control" id="edit_material" name="material">
                                                        <div class="invalid-feedback mb-3"></div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="edit_installation_required" class="form-label">Installation Required</label>
                                                        <input type="text" class="form-control" id="edit_installation_required" name="installation_required">
                                                        <div class="invalid-feedback mb-3"></div>
                                                    </div>
                                                </div>


                                                <!-- Profit Percentage -->
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="edit_profit_percentage" class="form-label">Profit %
                                                            <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control"
                                                            id="edit_profit_percentage" name="profit_percentage"
                                                            pattern="^\d+(\.\d{1,2})?$"
                                                            title="Please enter a valid profit percentage (e.g., 10 or 10.5)">
                                                        <div class="invalid-feedback mb-3">Enter a valid percentage (e.g.,
                                                            10 or 10.5).</div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="edit_profit_margin" class="form-label">Profit Margin
                                                            <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control"
                                                            id="edit_profit_margin" name="profit_margin"
                                                            pattern="^\d+(\.\d{1,2})?$"
                                                            title="Please enter a valid profit margin">
                                                        <div class="invalid-feedback mb-3">Enter a valid margin .</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Content -->
@endsection
@push('script')
    <script></script>

    <script>
        $(document).ready(function() {
            $(document).on('click', '.edit-product', function() {
                var productId = $(this).data('id');
                var parentProductId = $(this).data('parent-product-id');
                var productUniqueId = $(this).data('product-id');
                var productName = $(this).data('product-name');
                var productFrontendName = $(this).data('product-frontend-name');
                var productFrontendDescription = $(this).data('frontend-description');
                var productType = $(this).data('product-type');
                var gs1 = $(this).data('gs1');
                var gs1Type = $(this).data('gs1-type');
                var length = $(this).data('length');
                var height = $(this).data('height');
                var depth = $(this).data('depth');
                var diy = $(this).data('diy');
                var hasDoors = $(this).data('has-doors');
                var profile = $(this).data('profile');
                var size = $(this).data('size');
                var color = $(this).data('color');
                var profitPercentage = $(this).data('profit-percentage');  // Added for Profit Percentage field
                var profitMargin = $(this).data('profit-margin');  // Added for Profit Percentage field

                var packagingProductId = $(this).data('packaging-product-id');
                var layoutId = $(this).data('layout-id');
                var fusionId = $(this).data('fusion-id');
                var renderId = $(this).data('render-id');
                var productCenterChannelPlacement = $(this).data('product-center-channel-placement');
                var offWall = $(this).data('off-wall');
                var floorRaisingScreen = $(this).data('floor-raising-screen');
                var depthOfMiddleSection = $(this).data('depth-of-middle-section');
                var depthOfSideSections = $(this).data('depth-of-side-sections');
                var centerChannelChamberLength = $(this).data('center-channel-chamber-length');
                var centerChannelChamberDepth = $(this).data('center-channel-chamber-depth');
                var centerChannelChamberHeight = $(this).data('center-channel-chamber-height');
                var compatableWithProjectors = $(this).data('compatable-with-projectors');
                var compatableWithCenterChannels = $(this).data('compatable-with-center-channels');
                var centerChannelPlacement = $(this).data('center-channel-placement');
                var variableHeightProjectorPlatform = $(this).data('variable-height-projector-platform');
                var variableHeightCenterChannelPlatform = $(this).data(
                    'variable-height-center-channel-platform');
                var variableDepthCenterChannelPlatform = $(this).data(
                    'variable-depth-center-channel-platform');
                var anglingMechanismForCenterChannel = $(this).data('angling-mechanism-for-center-channel');
                var enclosedUstProjector = $(this).data('enclosed-ust-projector');
                var enclosedCenterChannel = $(this).data('enclosed-center-channel');
                var openBackDesign = $(this).data('open-back-design');
                var silentFanForFlushingHeatFromAvr = $(this).data('silent-fan-for-flushing-heat-from-avr');
                var adjustableHeightLegs = $(this).data('adjustable-height-legs');
                var remoteFriendly = $(this).data('remote-friendly');
                var offWallCabinet = $(this).data('off-wall-cabinet');
                var isFloorRaisingScreenEmbeddedWithinCabinet = $(this).data(
                    'is-floor-raising-screen-embedded-within-cabinet');
                var material = $(this).data('material');
                var installationRequired = $(this).data('installation-required');

                // Populate the modal fields
                $('#edit_product_id').val(productId);
                $('#edit_parent_product_id').val(parentProductId);
                $('#edit_product_unique_id').val(productUniqueId);
                $('#edit_product_frontend_name').val(productFrontendName);
                $('#edit_product_frontend_description').val(productFrontendDescription);
                $('#edit_product_name').val(productName);
                $('#edit_product_type').val(productType);
                $('#edit_gs1').val(gs1);
                $('#edit_gs1_type').val(gs1Type);
                $('#edit_length_of_cabinet').val(length);
                $('#edit_height_of_cabinet').val(height);
                $('#edit_depth_of_cabinet').val(depth);
                $('#edit_diy').val(diy);
                $('#edit_has_doors').val(hasDoors);
                $('#edit_profile').val(profile);
                $('#edit_size').val(size);
                $('#edit_color').val(color);
                $('#edit_packaging_product_id').val(packagingProductId);
                $('#edit_layout_id').val(layoutId);
                $('#edit_fusion_id').val(fusionId);
                $('#edit_render_id').val(renderId);
                $('#edit_product_center_channel_placement').val(productCenterChannelPlacement);
                $('#edit_off_wall').val(offWall);
                $('#edit_floor_raising_screen').val(floorRaisingScreen);
                $('#edit_depth_of_middle_section').val(depthOfMiddleSection);
                $('#edit_depth_of_side_sections').val(depthOfSideSections);
                $('#edit_center_channel_chamber_length').val(centerChannelChamberLength);
                $('#edit_center_channel_chamber_depth').val(centerChannelChamberDepth);
                $('#edit_center_channel_chamber_height').val(centerChannelChamberHeight);
                $('#edit_compatable_with_projectors').val(compatableWithProjectors);
                $('#edit_compatable_with_center_channels').val(compatableWithCenterChannels);
                $('#edit_center_channel_placement').val(centerChannelPlacement);
                $('#edit_variable_height_projector_platform').val(variableHeightProjectorPlatform);
                $('#edit_variable_height_center_channel_platform').val(variableHeightCenterChannelPlatform);
                $('#edit_variable_depth_center_channel_platform').val(variableDepthCenterChannelPlatform);
                $('#edit_angling_mechanism_for_center_channel').val(anglingMechanismForCenterChannel);
                $('#edit_enclosed_ust_projector').val(enclosedUstProjector);
                $('#edit_enclosed_center_channel').val(enclosedCenterChannel);
                $('#edit_open_back_design').val(openBackDesign);
                $('#edit_silent_fan_for_flushing_heat_from_avr').val(silentFanForFlushingHeatFromAvr);
                $('#edit_adjustable_height_legs').val(adjustableHeightLegs);
                $('#edit_remote_friendly').val(remoteFriendly);
                $('#edit_off_wall_cabinet').val(offWallCabinet);
                $('#edit_is_floor_raising_screen_embedded_within_cabinet').val(
                    isFloorRaisingScreenEmbeddedWithinCabinet);
                $('#edit_material').val(material);
                $('#edit_installation_required').val(installationRequired);
                $('#edit_profit_percentage').val(profitPercentage);
                $('#edit_profit_margin').val(profitMargin);
            });
        });
    </script>



    <script>
        $(document).ready(function() {
            $('#editProductForm').on('submit', function(e) {
                e.preventDefault();

                let form = $(this);
                let url = '{{ route('admin.products.update') }}';
                var csrfToken = '{{ csrf_token() }}';
                $.ajax({
                    url: url,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: form.serialize(),
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                title: 'Success!',
                                text: 'Product updated successfully.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Close the modal
                                    $('#editProductModal').modal('hide');
                                    // Optionally, reload the page or update the product list
                                    location.reload();
                                }
                            });
                        }
                    },
                    error: function(xhr) {
                        // Handle validation errors
                        if (xhr.status === 404) {
                            // Product not found
                            Swal.fire({
                                title: 'Error!',
                                text: 'Product not found.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        } else if (xhr.status === 422) {
                            // Validation errors
                            let errors = xhr.responseJSON.errors;
                            if (errors) {
                                $.each(errors, function(key, value) {
                                    // Find the field with the corresponding name attribute
                                    let field = form.find('[name="' + key + '"]');
                                    field.addClass('is-invalid');
                                    field.next('.invalid-feedback').text(value[0]);
                                });
                            }
                        } else {
                            // Other errors
                            Swal.fire({
                                title: 'Error!',
                                text: 'An unexpected error occurred. Please try again.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    }
                });
            });
        });
    </script>

    <script>
        function confirmDelete(deleteUrl) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this data!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If user confirms, redirect to the delete URL
                    window.location.href = deleteUrl;
                }
            });
        }
        $(document).ready(function() {
            $('.delete-product-btn').on('click', function(e) {
                e.preventDefault();

                let form = $(this).closest('.delete-product-form');
                let productId = form.data('id');
                let url = form.attr('action');


                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: 'GET',

                            data: form.serialize(),
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        title: 'Deleted!',
                                        text: 'Product has been deleted.',
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            // Optionally, remove the deleted product from the UI or reload the page
                                            location.reload();
                                        }
                                    });
                                }
                            },
                            error: function(xhr) {
                                if (xhr.status === 404) {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'Product not found.',
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'An error occurred while deleting the product. Please try again.',
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>
    <script>
        document.querySelector('.alldeleteProductAssociated').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the form from submitting immediately

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete all!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteAllForm').submit(); // Submit the form
                }
            });
        });
    </script>
@endpush
