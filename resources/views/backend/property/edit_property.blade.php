@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <div class="page-content">

        <div class="row profile-body">

            <!-- middle wrapper start -->
            <div class="col-md-12 col-xl-12 middle-wrapper">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Edit Property</h6>
                        <form id="myForm" method="POST" action="{{ route('update.property') }}"
                            enctype="multipart/form-data">
                            @csrf

                            <input type="text" hidden name="id" value="{{ $property->id }}">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Property Name</label>
                                        <input type="text" class="form-control" name="property_name"
                                            value="{{ $property->property_name }}">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Property Status</label>
                                        <select class="form-select" id="exampleFormControlSelect1" name="property_status">
                                            <option selected="" disabled="">Select Status</option>
                                            <option value="rent"
                                                {{ $property->property_status == 'rent' ? 'selected' : '' }}>For Rent
                                            </option>
                                            <option value="buy"
                                                {{ $property->property_status == 'buy' ? 'selected' : '' }}>For Buy</option>
                                        </select>
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Lowest Price</label>
                                        <input type="text" class="form-control" name="lowest_price"
                                            value="{{ $property->lowest_price }}">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Max Price</label>
                                        <input type="text" class="form-control" name="max_price"
                                            value="{{ $property->max_price }}">
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">BedRooms</label>
                                        <input type="text" class="form-control" name="bedrooms"
                                            value="{{ $property->bedrooms }}">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">BathRooms</label>
                                        <input type="text" class="form-control" name="bathrooms"
                                            value="{{ $property->bathrooms }}">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">Garage</label>
                                        <input type="text" class="form-control" name="garage"
                                            value="{{ $property->garage }}">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">Garage Size</label>
                                        <input type="text" class="form-control" name="garage_size"
                                            value="{{ $property->garage_size }}">
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->

                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">Address</label>
                                        <input type="text" class="form-control" name="address"
                                            value="{{ $property->address }}">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">City</label>
                                        <input type="text" class="form-control" name="city"
                                            value="{{ $property->city }}">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">State</label>
                                        <input type="text" class="form-control" name="state"
                                            value="{{ $property->state }}">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">Postal Code</label>
                                        <input type="text" class="form-control" name="postal_code"
                                            value="{{ $property->postal_code }}">
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">Property Size</label>
                                        <input type="text" class="form-control" name="property_size"
                                            value="{{ $property->property_size }}">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">Property Video</label>
                                        <input type="text" class="form-control" name="property_video"
                                            value="{{ $property->property_video }}">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">Neighborhood</label>
                                        <input type="text" class="form-control" name="neighborhood"
                                            value="{{ $property->neighborhood }}">
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">Latitude</label>
                                        <input type="text" class="form-control" name="latitude"
                                            value="{{ $property->latitude }}">
                                        <a href="https://www.latlong.net/" target="_blank"> Go here to get Latitude from
                                            address </a>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">Longitude</label>
                                        <input type="text" class="form-control" name="longitude"
                                            value="{{ $property->longitude }}">
                                        <a href="https://www.latlong.net/" target="_blank"> Go here to get Longitude from
                                            address </a>
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label"> Property Type </label>
                                        <select class="form-select" id="exampleFormControlSelect1" name="ptype_id">
                                            <option selected="" disabled="">Select Type</option>
                                            @foreach ($propertyType as $ptype)
                                                <option value="{{ $ptype->id }}"
                                                    {{ $ptype->id == $property->ptype_id ? 'selected' : '' }}>
                                                    {{ $ptype->type_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">Property Amenities</label>
                                        <select class="js-example-basic-multiple form-select" multiple="multiple"
                                            data-width="100%" name="amenities_id[]">
                                            @foreach ($amenities as $amenity)
                                                <option value="{{ $amenity->id }}"
                                                    {{ in_array($amenity->id, $property_ami) ? 'selected' : '' }}>
                                                    {{ $amenity->amenity_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">Agent </label>
                                        <select class="form-select" id="exampleFormControlSelect1" name="agent_id">
                                            <option selected="" disabled="">Select Agent</option>
                                            @foreach ($activeAgent as $agent)
                                                <option value="{{ $agent->id }}"
                                                    {{ $agent->id == $property->agent_id ? 'selected' : '' }}>
                                                    {{ $agent->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">Short Description</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" name="short_description" rows="3">{{ $property->short_description }}</textarea>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">Long Description</label>
                                        <textarea class="form-control" name="long_description" id="tinymceExample" rows="10">{!! $property->long_description !!}</textarea>
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" name="featured" value="1"
                                                class="form-check-input" id="checkInline"
                                                {{ $property->featured == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="checkInline">
                                                Featured Property
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" name="hot" value="1"
                                                class="form-check-input" id="checkInlineChecked"
                                                {{ $property->hot == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="checkInlineChecked">
                                                Hot Property
                                            </label>
                                        </div>
                                    </div>
                                </div><!-- Col -->

                            </div><!-- Row -->

                            <button type="submit" class="btn btn-primary submit">Submit form</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- change image --}}
    <div class="page-content" style="margin-top: -35px;">

        <div class="row profile-body">

            <!-- middle wrapper start -->
            <div class="col-md-12 col-xl-12 middle-wrapper">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Edit Property</h6>
                        <form id="myForm" method="POST" action="{{ route('update.property.thumbnail') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $property->id }}">
                            <input type="hidden" name="old_img" value="{{ $property->property_thumnail }}">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Main Thumbnail</label>
                                        <input type="file" class="form-control" name="property_thumbnail"
                                            onChange="mainThumbUrl(this)">
                                        <img src="" id="mainThumb">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <img src="{{ asset($property->property_thumnail) }}" id="mainThumb"
                                            style="width: 100px; height: 100px;">
                                    </div>
                                </div><!-- Col -->
                            </div>
                            <button type="submit" class="btn btn-primary submit">Submit form</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top: 20px;">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Update Multi Image</h4>
                        <div class="table-responsive">
                            <form action="{{ route('update.property.multiimage') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $property->id }}">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Image</th>
                                            <th>Change Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($multiImage as $key => $img)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td class="py-1">
                                                    <img src="{{ asset($img->photo_name) }}" alt="image">
                                                </td>
                                                <td>
                                                    <input type="file" class="form-control"
                                                        name="multiImg[{{ $img->id }}]">
                                                </td>
                                                <td>
                                                    <input type="submit" value="Change Image" class="btn btn-primary">
                                                    <a href="{{ route('delete.property.multiimage', $img->id) }}"
                                                        id="delete" class="btn btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- end change image --}}
    <!--========== End of add multiple class with ajax ==============-->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    property_name: {
                        required: true,
                    },
                    property_status: {
                        required: true,
                    },
                    lowest_price: {
                        required: true,
                    },
                    max_price: {
                        required: true,
                    },
                    ptype_id: {
                        required: true,
                    },

                },
                messages: {
                    property_name: {
                        required: 'Please Enter property name',
                    },
                    property_status: {
                        required: 'Please Enter property status',
                    },
                    lowest_price: {
                        required: 'Please Enter lowest price',
                    },
                    max_price: {
                        required: 'Please Enter maximum price',
                    },
                    ptype_id: {
                        required: 'Please select property type',
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

    <script type="text/javascript">
        function mainThumbUrl(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#mainThumb').attr("src", e.target.result).width(80).height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#multiImg').on('change', function() { //on file input change
                if (window.File && window.FileReader && window.FileList && window
                    .Blob) //check File API supported browser
                {
                    var data = $(this)[0].files; //this file data

                    $.each(data, function(index, file) { //loop though each file
                        if (/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file
                                .type)) { //check supported file type
                            var fRead = new FileReader(); //new filereader
                            fRead.onload = (function(file) { //trigger function on successful read
                                return function(e) {
                                    var img = $('<img/>').addClass('thumb').attr('src',
                                            e.target.result).width(100)
                                        .height(80); //create image element 
                                    $('#preview_img').append(
                                        img); //append image to output element
                                };
                            })(file);
                            fRead.readAsDataURL(file); //URL representing the file's data.
                        }
                    });

                } else {
                    alert("Your browser doesn't support File API!"); //if File API is absent
                }
            });
        });
    </script>
@endsection
