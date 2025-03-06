@extends('admin.layouts.master')
@section('content')
<!-- CONTENT WRAPPER -->
<div class="ec-content-wrapper">
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-wrapper-2 breadcrumb-contacts">
            <h1>Projectors</h1>
            <p class="breadcrumbs"><span><a href="{{ route('admin.dashboard') }}">Home</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Projectors</p>
        </div>
        <div class="row">
            <div class="col-xl-4 col-lg-12">
                <div class="ec-cat-list card card-default mb-24px">
                    <div class="card-body">
                        <div class="ec-cat-form" id="projectorForm">
                            <h4>Add New Projectors</h4>
                            <form id="addProjectorForm">
                                @csrf
                                <div class="form-group row">
                                    <label for="make" class="col-12 col-form-label">Brand</label>
                                    <div class="col-12">
                                        <input id="makeName" name="make" class="form-control here" type="text" required>
                                        <span class="text-danger" id="makeError"></span>
                                    </div>
                                </div>
                                <div id="modelFields">
                                    <div class="form-group row modelField">
                                        <label for="model" class="col-12 col-form-label">Model</label>
                                        <div class="col-12">
                                            <input name="model[]" class="form-control here" type="text" required>
                                            <span class="text-danger modelError"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <button type="button" id="addModel" class="btn btn-success">Add More</button>
                                        <button type="button" id="removeModel" class="btn btn-danger" style="display: none;">Remove</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <button name="submit" type="submit" class="btn btn-primary btn-lg" style="background-color:#6466e8;width:100%">Submit</button>
                                    </div>
                                </div>
                            </form>
                            <div id="responseMessage" style="margin-top: 10px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-lg-12">
                <div class="ec-cat-list card card-default">
                    <div class="card-body">

                        @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @elseif(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif
                        <div class="table-responsive">
                            <table id="responsive-data-table" class="table">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Brand</th>
                                        <th>Model</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($projectors as $index => $projector)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $projector->make }}</td>
                                        <td>{{ $projector->model }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-outline-success editProjector" data-id="{{ $projector->id }}" data-make="{{ $projector->make }}" data-model="{{ $projector->model }}">Edit</button>
                                                <form action="{{ route('admin.projectors.delete', $projector->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Content -->
</div> <!-- End Content Wrapper -->

<!-- Edit Modal -->
<div class="modal fade" id="editProjectorModal" tabindex="-1" aria-labelledby="editProjectorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProjectorModalLabel">Edit Projector</h5>

            </div>
            <div class="modal-body">
                <form id="editProjectorForm">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="editMakeName" class="col-12 col-form-label">Make</label>
                        <div class="col-12">
                            <input id="editMakeName" name="make" class="form-control here" type="text" required>
                            <span class="text-danger" id="editMakeError"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="editModelName" class="col-12 col-form-label">Model</label>
                        <div class="col-12">
                            <input id="editModelName" name="model" class="form-control here" type="text" required>
                            <span class="text-danger" id="editModelError"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <button name="submit" type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
                <div id="editResponseMessage" style="margin-top: 10px;"></div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('script')
<script>
    $(document).ready(function() {
        // Add model field
        $('#addModel').click(function() {
            let modelField = `<div class="form-group row modelField">
                                <label for="model" class="col-12 col-form-label">Model</label>
                                <div class="col-12">
                                    <input name="model[]" class="form-control here" type="text" required>
                                    <span class="text-danger modelError"></span>
                                </div>
                            </div>`;
            $('#modelFields').append(modelField);
            // Show remove button if more than one model field
            if ($('#modelFields .modelField').length > 1) {
                $('#removeModel').show();
            }
        });

        // Remove model field
        $('#removeModel').click(function() {
            if ($('#modelFields .modelField').length > 1) {
                $('#modelFields .modelField').last().remove();
            }
            // Hide remove button if only one model field remains
            if ($('#modelFields .modelField').length === 1) {
                $('#removeModel').hide();
            }
        });

        // Submit form via AJAX
        $('#addProjectorForm').submit(function(e) {
            e.preventDefault();
            let isValid = true;
            $('#makeError').text('');
            $('span.modelError').text('');

            // Validate Make
            if (!$('#makeName').val()) {
                $('#makeError').text('Make is required.');
                isValid = false;
            }

            // Validate Models
            $('input[name="model[]"]').each(function() {
                if (!$(this).val()) {
                    $(this).next('.modelError').text('Model is required.');
                    isValid = false;
                }
            });

            if (isValid) {
                $.ajax({
                    url: "{{ route('admin.projectors.store') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success) {
                            $('#responseMessage').html('<div class="alert alert-success">Data inserted successfully</div>');
                            setTimeout(function() {
                                location.reload();
                            }, 2000);
                        } else {
                            $('#responseMessage').html('<div class="alert alert-danger">Failed to insert data</div>');
                        }
                    },
                    error: function(response) {
                        $('#responseMessage').html('<div class="alert alert-danger">An error occurred</div>');
                    }
                });
            }
        });

        // Edit Projector
        $(document).on('click', '.editProjector', function() {
            const id = $(this).data('id');
            const make = $(this).data('make');
            const model = $(this).data('model');

            $('#editMakeName').val(make);
            $('#editModelName').val(model);
            $('#editProjectorForm').attr('data-id', id);

            $('#editProjectorModal').modal('show');
        });

        // Update form via AJAX
        $('#editProjectorForm').submit(function(e) {
            e.preventDefault();
            const id = $(this).attr('data-id');
            let isValid = true;
            $('#editMakeError').text('');
            $('#editModelError').text('');

            // Validate Make
            if (!$('#editMakeName').val()) {
                $('#editMakeError').text('Make is required.');
                isValid = false;
            }

            // Validate Model
            if (!$('#editModelName').val()) {
                $('#editModelError').text('Model is required.');
                isValid = false;
            }

            if (isValid) {
                $.ajax({
                    url: "{{ route('admin.projectors.update', '') }}/" + id,
                    method: "PUT",
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success) {
                            $('#editResponseMessage').html('<div class="alert alert-success">Data updated successfully</div>');
                            setTimeout(function() {
                                location.reload();
                            }, 2000);
                        } else {
                            $('#editResponseMessage').html('<div class="alert alert-danger">Failed to update data</div>');
                        }
                    },
                    error: function(response) {
                        $('#editResponseMessage').html('<div class="alert alert-danger">An error occurred</div>');
                    }
                });
            }
        });
    });
</script>
@endpush


