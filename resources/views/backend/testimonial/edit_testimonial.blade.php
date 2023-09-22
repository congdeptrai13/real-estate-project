@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <div class="page-content">

        <div class="row profile-body">

            <!-- middle wrapper start -->
            <div class="col-md-8 col-xl-8 middle-wrapper">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">UPDATE TESTIMONIAL</h6>

                        <form class="forms-sample" method="POST" action="{{ route('update.testimonial') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $testimonials->id }}">
                            <div class="mb-3">
                                <label for="state_name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="state_name" name="name"
                                    placeholder="testimonial name" value="{{ $testimonials->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="state_name" class="form-label">Position</label>
                                <input type="text" class="form-control" id="state_name" name="position"
                                    placeholder="position" value="{{ $testimonials->position }}">
                            </div>
                            <div class="mb-3">
                                <label for="state_name" class="form-label">Message</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="message" rows="3">{{ $testimonials->message }}</textarea>
                            </div>


                            <div class="mb-3">
                                <label for="image" class="form-label">Photo</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                            <div class="mb-3">
                                <img id="showImage" class="wd-80 rounded-circle" src="{{ asset($testimonials->image) }}"
                                    alt="profile">
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Update Testimonial</button>
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
