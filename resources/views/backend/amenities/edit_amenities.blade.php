@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <div class="row profile-body">

            <!-- middle wrapper start -->
            <div class="col-md-8 col-xl-8 middle-wrapper">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">UPDATE</h6>

                        <form class="forms-sample" method="POST" action="{{ route('update.amenity') }}">
                            @csrf
                            <input type="hidden" id="id" name="id" value="{{ $amenity->id }}">
                            <div class="mb-3">
                                <label for="old_password" class="form-label">Amenity Name</label>
                                <input type="text" class="form-control @error('amenity_name') is-invalid @enderror"
                                    id="amenity_name" name="amenity_name" placeholder="amenity name"
                                    value="{{ $amenity->amenity_name }}">
                                @error('amenity_name')
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
