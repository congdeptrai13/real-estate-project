@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{ route('export') }}"class="btn btn-danger"> Download Xlsx </a>
            </ol>
        </nav>
        <div class="row profile-body">

            <!-- middle wrapper start -->
            <div class="col-md-8 col-xl-8 middle-wrapper">
                <div class="card">
                    <div class="card-body">
                        
                        <h6 class="card-title">IMPORT PERMISSION</h6>

                        <form class="forms-sample" method="POST" action="{{ route('import') }}" id="myForm" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="amenity_name" class="form-label">Xlsx file import</label>
                                <input type="file" name="import_file" class="form-control">
                            </div>
                          
                            <button type="submit" class="btn btn-warning me-2">Upload</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
