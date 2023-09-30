@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{ route('add.amenity') }}"class="btn btn-info"> Amenities Add </a>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Amenities Table</h6>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Amenity Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($amenities as $key => $type)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $type->amenity_name }}</td>
                                            <td>
                                                @if (Auth::user()->can('amenities.edit'))
                                                <a href="{{ route('edit.amenity', $type->id) }}" class="btn btn-warning">
                                                    Edit
                                                </a>
                                                @endif
                                                @if (Auth::user()->can('amenities.delete'))
                                                <a href="{{ route('delete.amenity', $type->id) }}" class="btn btn-danger"
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
