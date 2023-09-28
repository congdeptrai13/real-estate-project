@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <div class="page-content">

        <div class="row profile-body">

            <!-- middle wrapper start -->
            <div class="col-md-8 col-xl-8 middle-wrapper">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">EDIT ROLES</h6>

                        <form class="forms-sample" method="POST" action="{{ route('update.roles') }}" id="myForm">
                            @csrf
                            <input type="hidden" name="id" value="{{ $roles->id }}">
                            <div class="form-group mb-3">
                                <label for="amenity_name" class="form-label">Roles Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $roles->name }}">
                            </div>

                            <button type="submit" class="btn btn-primary me-2">Update</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
