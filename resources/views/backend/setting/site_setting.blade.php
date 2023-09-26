@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <div class="page-content">

        <div class="row profile-body">

            <!-- middle wrapper start -->
            <div class="col-md-8 col-xl-8 middle-wrapper">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">UPDATE Setting</h6>

                        <form class="forms-sample" method="POST" action="{{ route('update.site.setting') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="id" name="id" value="{{ $setting->id }}">
                            <div class="mb-3">
                                <label for="old_password" class="form-label">support_phone</label>
                                <input type="text" class="form-control" id="support_phone" name="support_phone"
                                    value="{{ $setting->support_phone }}">
                            </div>
                            <div class="mb-3">
                                <label for="old_password" class="form-label">address_company</label>
                                <input type="text" class="form-control" id="address_company" name="address_company"
                                    value="{{ $setting->address_company }}">
                            </div>
                            <div class="mb-3">
                                <label for="old_password" class="form-label">email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    value="{{ $setting->email }}">
                            </div>
                            <div class="mb-3">
                                <label for="old_password" class="form-label">facebook</label>
                                <input type="text" class="form-control" id="facebook" name="facebook"
                                    value="{{ $setting->facebook }}">
                            </div>
                            <div class="mb-3">
                                <label for="old_password" class="form-label">twitter</label>
                                <input type="text" class="form-control" id="twitter" name="twitter"
                                    value="{{ $setting->twitter }}">
                            </div>
                            <div class="mb-3">
                                <label for="old_password" class="form-label">copyright</label>
                                <input type="text" class="form-control" id="copyright" name="copyright"
                                    value="{{ $setting->copyright }}">
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Photo</label>
                                <input class="form-control" type="file" name="logo" id="image">
                            </div>
                            <div class="mb-3">
                                <img id="showImage" class="wd-80 rounded-circle" src="{{ asset($setting->logo) }}"
                                    alt="profile">
                            </div>


                            <button type="submit" class="btn btn-primary me-2"> Update </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#image").on("change", function(event) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#showImage").attr("src", e.target.result);
                }
                reader.readAsDataURL(event.target.files[0]);
            })
        })
    </script>
@endsection
