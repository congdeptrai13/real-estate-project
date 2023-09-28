@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{ route('add.roles.permission') }}"class="btn btn-info"> Add Roles Permission </a> &nbsp; &nbsp;
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Roles Permission Table</h6>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Roles Name</th>
                                        <th>Permission</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $key => $type)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $type->name }}</td>
                                            <td>
                                                @foreach ($type->permissions as $item)
                                                    <span class="badge bg-danger text-white"> {{ $item->name }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                <a href="{{ route('edit.roles.permission', $type->id) }}"
                                                    class="btn btn-warning">
                                                    Edit
                                                </a>
                                                <a href="{{ route('delete.roles.permission', $type->id) }}" class="btn btn-danger"
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
