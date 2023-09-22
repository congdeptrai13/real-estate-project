@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <div class="page-content">

        <div class="row profile-body">

            <!-- middle wrapper start -->
            <div class="col-md-12 col-xl-12 middle-wrapper">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">ADD POST</h6>

                        <form class="forms-sample" method="POST" action="{{ route('store.blog.post') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="state_name" class="form-label">Post Title</label>
                                        <input type="text" class="form-control" id="post_title" name="post_title"
                                            placeholder="State name">
                                    </div>
                                </div>

                                <div class="col-sm-6">

                                    <div class="mb-3">
                                        <label for="image" class="form-label">Blog Category</label>
                                        <select class="form-select" id="exampleFormControlSelect1" name="blogcat_id">
                                            <option selected="" disabled="">Select Category</option>
                                            @foreach ($blogcat as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label class="form-label">Short Description</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="short_description" rows="3"></textarea>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label class="form-label">Long Description</label>
                                    <textarea class="form-control" name="long_description" id="tinymceExample" rows="10"></textarea>
                                </div>
                            </div><!-- Col -->

                            <div class="col-sm-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Post Tags</label>
                                    <input name="post_tags" id="tags" value="Realestate," />
                                </div>
                            </div><!-- Col -->

                            <div class="mb-3">
                                <label for="image" class="form-label">Post Photo</label>
                                <input type="file" class="form-control" id="image" name="post_image">
                            </div>
                            <div class="mb-3">
                                <img id="showImage" class="wd-80 rounded-circle" src="{{ url('upload/no_image.jpg') }}"
                                    alt="profile">
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Add New</button>
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
