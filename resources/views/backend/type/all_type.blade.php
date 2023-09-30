@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{ route('add.type') }}"class="btn btn-info"> Property Type Add </a>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Property Type Table</h6>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Type Name</th>
                                        <th>Type Icon</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($types as $key => $type)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $type->type_name }}</td>
                                            <td>{{ $type->type_icon }}</td>
                                            <td>
                                                @if (Auth::User()->can('edit.type'))
                                                    <a href="{{ route('edit.type', $type->id) }}" class="btn btn-warning">
                                                        Edit
                                                    </a>
                                                @endif
                                                @if (Auth::User()->can('delete.type'))
                                                    <a href="{{ route('delete.type', $type->id) }}" class="btn btn-danger"
                                                        id="delete">
                                                        Delete </a>
                                                @endif
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
