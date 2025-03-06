@extends('admin.layouts.master')
@section('content')
    <style>
        style>.text-danger {
            color: red;
        }

        .custom-border {
            border: 2px solid #007bff;
            /* Custom blue color */
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 5px;
        }
    </style>
    <!-- CONTENT WRAPPER -->
    <div class="ec-content-wrapper">

        <div class="content">
            <div class="breadcrumb-wrapper breadcrumb-wrapper-2 breadcrumb-contacts">
                <h1>Center Channel Speakers</h1>
                <p class="breadcrumbs"><span><a href="{{ route('admin.dashboard') }}">Home</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>Speakers
                </p>
            </div>

            <div class="row">
                <div class="col-xl-4 col-lg-12">
                    <div class="ec-cat-list card card-default mb-24px">
                        <div class="card-body">
                            <div class="ec-cat-form" id="speakerForm">
                                <h4>Add New Speakers</h4>
                                <form id="addSpeakerForm">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="make" class="col-12 col-form-label">Brand</label>
                                        <div class="col-12">
                                            <input id="makeName" name="brand" class="form-control here" type="text"
                                                required>
                                            <span class="text-danger" id="brandError"></span>
                                        </div>
                                    </div>
                                    <div id="modelFields">
                                        <div class="form-group row modelField">
                                            <label for="model" class="col-12 col-form-label">Model</label>
                                            <div class="col-12">
                                                <input name="model[]" class="form-control here" type="text" required>
                                                <span class="text-danger " id="modelError"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="release_year" class="col-12 col-form-label">Release Year</label>
                                            <div class="col-12">
                                                <input name="release_year[]" class="form-control here" type="number"
                                                    required>
                                                <span class="text-danger" id="releaseYearError"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="height" class="col-12 col-form-label">Height (inches)</label>
                                            <div class="col-12">
                                                <input name="height[]" class="form-control here" type="number"required
                                                    step="0.01">
                                                <span class="text-danger " id="heightError"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="width" class="col-12 col-form-label">Width (inches)</label>
                                            <div class="col-12">
                                                <input name="width[]" class="form-control here" type="number" required
                                                    step="0.01">
                                                <span class="text-danger " id="widthError"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="depth" class="col-12 col-form-label">Depth (inches)</label>
                                            <div class="col-12">
                                                <input name="depth[]" class="form-control here" type="number" required
                                                    step="0.01">
                                                <span class="text-danger " id="depthError"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <button type="button" id="addModel" class="btn btn-success">Add More Model In
                                                Same Brand</button>
                                            <button type="button" id="removeModel" class="btn btn-danger mt-3"
                                                style="display: none;">Remove</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <button name="submit" type="submit" class="btn btn-primary btn-lg"
                                                style="background-color:#6466e8;width:100%">Submit</button>
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

                            @if (session('success'))
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
                                            <th>Release Year</th>
                                            <th>Height</th>
                                            <th>Width</th>
                                            <th>Depth</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $index => $values)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $values->brand }}</td>
                                                <td>{{ $values->model }}</td>
                                                <td>{{ $values->release_year }}</td>
                                                <td>{{ $values->height }}</td>
                                                <td>{{ $values->width }}</td>
                                                <td>{{ $values->depth }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-outline-success editSpeaker"
                                                            data-id="{{ $values->id }}"
                                                            data-make="{{ $values->brand }}"
                                                            data-model="{{ $values->model }}"
                                                            data-release_year="{{ $values->release_year }}"
                                                            data-height="{{ $values->height }}"
                                                            data-width="{{ $values->width }}"
                                                            data-depth="{{ $values->depth }}">Edit</button>
                                                        <form action="{{ route('admin.speakers.delete', $values->id) }}"
                                                            method="POST" style="display:inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-outline-danger"
                                                                style="border-top-left-radius: 0; border-bottom-left-radius: 0;">Delete</button>
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
        </div>
    </div>


    <!-- Edit Modal -->
    <div class="modal fade" id="editSpeakerModal" tabindex="-1" aria-labelledby="editSpeakerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSpeakerModalLabel">Edit Speaker</h5>

                </div>
                <div class="modal-body">
                    <form id="editSpeakerForm">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="editMakeName" class="col-12 col-form-label">Brand</label>
                            <div class="col-12">
                                <input id="editMake" name="make" class="form-control here" type="text" required>
                                <span class="text-danger" id="editMakeError"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="editModelName" class="col-12 col-form-label">Model</label>
                            <div class="col-12">
                                <input id="editModel" name="model" class="form-control here" type="text" required>
                                <span class="text-danger" id="editModelError"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="editReleaseYear" class="col-12 col-form-label">Release Year</label>
                            <div class="col-12">
                                <input id="editReleaseYear" name="release_year" class="form-control here" type="text"
                                    required>
                                <span class="text-danger" id="editReleaseYearError"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="editHeight" class="col-12 col-form-label">Height</label>
                            <div class="col-12">
                                <input id="editHeight" name="height" class="form-control here" type="text" required>
                                <span class="text-danger" id="editHeightError"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="editWidth" class="col-12 col-form-label">Width</label>
                            <div class="col-12">
                                <input id="editWidth" name="width" class="form-control here" type="text" required>
                                <span class="text-danger" id="editWidthError"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="editDepth" class="col-12 col-form-label">Depth</label>
                            <div class="col-12">
                                <input id="editDepth" name="depth" class="form-control here" type="text" required>
                                <span class="text-danger" id="editDepthError"></span>
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

            function toggleRemoveButton() {
                if ($('#modelFields .modelField').length > 1) {
                    $('#removeModel').show();
                } else {
                    $('#removeModel').hide();
                }
            }


            // Add more model fields
            $('#addModel').click(function() {
                let newModelFields = `
            <div class="modelField custom-border">
                <div class="form-group row ">
                    <label for="model" class="col-12 col-form-label">Model</label>
                    <div class="col-12">
                        <input name="model[]" class="form-control here" type="text" required>
                        <span class="text-danger modelError"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="release_year" class="col-12 col-form-label">Release Year</label>
                    <div class="col-12">
                        <input name="release_year[]" class="form-control here" type="number" required>
                        <span class="text-danger releaseYearError"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="height" class="col-12 col-form-label">Height (inches)</label>
                    <div class="col-12">
                        <input name="height[]" class="form-control here" type="number" step="0.01" required>
                        <span class="text-danger heightError"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="width" class="col-12 col-form-label">Width (inches)</label>
                    <div class="col-12">
                        <input name="width[]" class="form-control here" type="number" step="0.01" required>
                        <span class="text-danger widthError"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="depth" class="col-12 col-form-label">Depth (inches)</label>
                    <div class="col-12">
                        <input name="depth[]" class="form-control here" type="number" step="0.01" required>
                        <span class="text-danger depthError"></span>
                    </div>
                </div>
            </div>
            `;
                $('#modelFields').append(newModelFields);
                toggleRemoveButton();
            });

            // Remove last model fields
            $('#removeModel').click(function() {

                $('#modelFields .modelField').last().remove();
                toggleRemoveButton();
            });

            // Initialize remove button visibility
            toggleRemoveButton();

            $('#addSpeakerForm').on('submit', function(event) {
                event.preventDefault();

                $.ajax({
                    url: '{{ route('admin.speakers.store') }}',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success) {
                            $('#responseMessage').html('<div class="alert alert-success">' +
                                response.message + '</div>');

                            setTimeout(function() {
                                location.reload();
                            }, 2000);
                        } else {
                            $('#responseMessage').html('<div class="alert alert-danger">' +
                                response.message + '</div>');
                        }
                    },
                    error: function(xhr, status, error) {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('#' + key + 'Error').text(value[0]);
                        });
                    }
                });
            });

            // Remove error messages on focus
            $('input, select').on('focus', function() {
                $(this).next('.text-danger').text('');
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $('#editSpeakerForm').on('submit', function(event) {
                event.preventDefault();
                const id = $(this).attr('data-id');

                $.ajax({
                    url: '{{ route("admin.speakers.update", ":id") }}'.replace(':id', id),
                    method: 'PUT',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success) {
                            $('#editResponseMessage').html('<div class="alert alert-success">' +
                                response.message + '</div>');
                                setTimeout(function() {
                                location.reload();
                            }, 2000);
                        } else {
                            $('#editResponseMessage').html('<div class="alert alert-danger">' +
                                response.message + '</div>');
                        }
                    },
                    error: function(xhr, status, error) {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('#edit' + key.charAt(0).toUpperCase() + key.slice(1) +
                                'Error').text(value[0]);
                        });
                    }
                });
            });

            // Remove error messages on focus
            $('input').on('focus', function() {
                var fieldName = $(this).attr('name');
                $('#edit' + fieldName.charAt(0).toUpperCase() + fieldName.slice(1) + 'Error').text('');
            });
        });
        $(document).ready(function() {
            $(document).on('click', '.editSpeaker', function() {


                var id = $(this).data('id');

                var make = $(this).data('make');

                var model = $(this).data('model');
                var release_year = $(this).data('release_year');
                var height = $(this).data('height');
                var width = $(this).data('width');
                var depth = $(this).data('depth');


                $('#editMake').val(make);
                $('#editModel').val(model);
                $('#editReleaseYear').val(release_year);
                $('#editHeight').val(height);
                $('#editWidth').val(width);
                $('#editDepth').val(depth);
                $('#editSpeakerForm').attr('data-id', id);
                $('#editSpeakerModal').modal('show');
            });
        });
    </script>
@endpush
