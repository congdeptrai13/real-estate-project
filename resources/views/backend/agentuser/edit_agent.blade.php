@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <div class="page-content">

        <div class="row profile-body">

            <!-- middle wrapper start -->
            <div class="col-md-8 col-xl-8 middle-wrapper">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">Edit Agent</h6>

                        <form class="forms-sample" method="POST" action="{{ route('update.agent') }}" id="myForm">
                            @csrf
                            <input type="hidden" name="id" value="{{ $agent->id }}">

                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Agent Name</label>
                                <input type="text" name="name" id="name" class="form-control" required=""
                                    value="{{ $agent->name }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">Agent Email</label>
                                <input type="text" name="email" id="email" class="form-control" required=""
                                    value="{{ $agent->email }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="phone" class="form-label">Agent Phone</label>
                                <input type="text" name="phone" id="phone" class="form-control" required=""
                                    value="{{ $agent->phone }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="address" class="form-label">Agent Adress</label>
                                <input type="text" name="address" id="address" class="form-control"
                                    value="{{ $agent->address }}">
                            </div>

                            <button type="submit" class="btn btn-primary me-2">Update</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    email: {
                        required: true,
                    },
                    phone: {
                        required: true,
                    },
                    password: {
                        required: true,
                    },

                },
                messages: {
                    name: {
                        required: 'Please Enter name',
                    },
                    email: {
                        required: 'Please Enter Email',
                    },
                    phone: {
                        required: 'Please Enter Phone',
                    },
                    password: {
                        required: 'Please Enter Password',
                    },


                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>
@endsection
