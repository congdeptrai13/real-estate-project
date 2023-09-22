@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{ route('add.testimonial') }}"class="btn btn-info"> Testimonial Add </a>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Testimonial Table</h6>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($testimonials as $key => $type)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $type->name }}</td>
                                            <td>{{ $type->position }}</td>
                                            <td><img src="{{ asset($type->image) }}" alt=""></td>
                                            <td>
                                                <a href="{{ route('edit.testimonial', $type->id) }}" class="btn btn-warning">
                                                    Edit
                                                </a>
                                                <a href="{{ route('delete.testimonial', $type->id) }}" class="btn btn-danger"
                                                    id="delete">
                                                    Delete </a>

                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
