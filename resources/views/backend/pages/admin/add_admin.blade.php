@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <div class="page-content">

        <div class="row profile-body">

            <!-- middle wrapper start -->
            <div class="col-md-8 col-xl-8 middle-wrapper">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">ADD ADMIN</h6>

                        <form class="forms-sample" method="POST" action="{{ route('store.admin') }}" id="myForm">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Admin User Name</label>
                                <input type="text" name="username" id="name" class="form-control" required="">
                            </div>
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">Admin Name</label>
                                <input type="text" name="name" id="email" class="form-control" required="">
                            </div>
                            <div class="form-group mb-3">
                                <label for="phone" class="form-label">Admin Email</label>
                                <input type="text" name="email" id="phone" class="form-control" required="">
                            </div>
                            <div class="form-group mb-3">
                                <label for="address" class="form-label">Admin Phone</label>
                                <input type="text" name="phone" id="address" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="address" class="form-label">Admin Adress</label>
                                <input type="text" name="address" id="address" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="password" class="form-label">Admin Password</label>
                                <input type="password" name="password" id="password" class="form-control" required="">
                            </div>
                            <div class="form-group mb-3">
                                <label for="password" class="form-label">Select Role</label>
                                <select class="form-select" id="exampleFormControlSelect1" name="role">
                                    @foreach ($roles as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary me-2">Add New</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
