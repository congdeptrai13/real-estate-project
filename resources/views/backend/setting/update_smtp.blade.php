@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <div class="row profile-body">

            <!-- middle wrapper start -->
            <div class="col-md-8 col-xl-8 middle-wrapper">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">UPDATE SMTP</h6>

                        <form class="forms-sample" method="POST" action="{{ route('update.smtp.mailer') }}">
                            @csrf
                            <input type="hidden" id="id" name="id" value="{{ $smtp->id }}">
                            <div class="mb-3">
                                <label for="old_password" class="form-label">mail</label>
                                <input type="text" class="form-control @error('amenity_name') is-invalid @enderror"
                                    id="amenity_name" name="mail" placeholder="amenity name" value="{{ $smtp->mail }}">
                            </div>
                            <div class="mb-3">
                                <label for="old_password" class="form-label">host</label>
                                <input type="text" class="form-control @error('amenity_name') is-invalid @enderror"
                                    id="amenity_name" name="host" placeholder="amenity name" value="{{ $smtp->host }}">
                            </div>
                            <div class="mb-3">
                                <label for="old_password" class="form-label">post</label>
                                <input type="text" class="form-control @error('amenity_name') is-invalid @enderror"
                                    id="amenity_name" name="post" placeholder="amenity name" value="{{ $smtp->post }}">
                            </div>
                            <div class="mb-3">
                                <label for="old_password" class="form-label">username</label>
                                <input type="text" class="form-control @error('amenity_name') is-invalid @enderror"
                                    id="amenity_name" name="username" placeholder="amenity name"
                                    value="{{ $smtp->username }}">
                            </div>
                            <div class="mb-3">
                                <label for="old_password" class="form-label">password</label>
                                <input type="text" class="form-control @error('amenity_name') is-invalid @enderror"
                                    id="amenity_name" name="password" placeholder="amenity name"
                                    value="{{ $smtp->password }}">
                            </div>
                            <div class="mb-3">
                                <label for="old_password" class="form-label">encryption</label>
                                <input type="text" class="form-control @error('amenity_name') is-invalid @enderror"
                                    id="amenity_name" name="encryption" placeholder="amenity name"
                                    value="{{ $smtp->encryption }}">
                            </div>
                            <div class="mb-3">
                                <label for="old_password" class="form-label">from_address</label>
                                <input type="text" class="form-control @error('amenity_name') is-invalid @enderror"
                                    id="amenity_name" name="from_address" placeholder="amenity name"
                                    value="{{ $smtp->from_address }}">
                            </div>

                            <button type="submit" class="btn btn-primary me-2"> Update </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
