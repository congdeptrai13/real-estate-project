@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <div class="row profile-body">

            <!-- middle wrapper start -->
            <div class="col-md-8 col-xl-8 middle-wrapper">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">ADD PROPERTY TYPE</h6>

                        <form class="forms-sample" method="POST" action="{{ route('update.type') }}">
                            @csrf
                            <input type="hidden" id="id" name="id" value="{{ $type->id }}">
                            <div class="mb-3">
                                <label for="old_password" class="form-label">Type Name</label>
                                <input type="text" class="form-control @error('type_name') is-invalid @enderror"
                                    id="type_name" name="type_name" placeholder="type name" value="{{ $type->type_name }}">
                                @error('type_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label for="new_password" class="form-label">Type Icon</label>
                                <input type="text" class="form-control @error('type_icon') is-invalid @enderror"
                                    id="type_icon" name="type_icon" placeholder="type icon" value="{{ $type->type_icon }}">
                                @error('type_icon')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary me-2"> Update </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
