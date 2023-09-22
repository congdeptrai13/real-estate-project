@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{ route('add.blog.post') }}"class="btn btn-info"> Add Post</a>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Post Table</h6>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>post title</th>
                                        <th>category</th>
                                        <th>post Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $key => $type)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $type->post_title }}</td>
                                            <td>{{ $type->cat->category_name }}</td>
                                            <td><img src="{{ asset($type->post_image) }}" alt=""></td>
                                            <td>
                                                <a href="{{ route('edit.blog.post', $type->id) }}"
                                                    class="btn btn-warning">
                                                    Edit
                                                </a>
                                                <a href="{{ route('delete.post', $type->id) }}"
                                                    class="btn btn-danger" id="delete">
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
