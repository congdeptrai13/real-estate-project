@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">
        @if (Auth::User()->can('property.add'))
            <nav class="page-breadcrumb">
                <ol class="breadcrumb">
                    <a href="{{ route('add.property') }}"class="btn btn-info"> Add Property </a>
                </ol>
            </nav>
        @endif
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Property Table</h6>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>P Type</th>
                                        <th>Status Type</th>
                                        <th>City</th>
                                        <th>Code</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($property as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td><img src="{{ asset($item->property_thumnail) }}" alt=""
                                                    style="width: 70px; height: 40px;"></td>
                                            <td>{{ $item->property_name }}</td>
                                            <td>{{ $item['type']['type_name'] }}</td>
                                            <td>{{ $item->property_status }}</td>
                                            <td>{{ $item->city }}</td>
                                            <td>{{ $item->property_code }}</td>
                                            <td>
                                                @if ($item->status == 1)
                                                    <span class="badge rounded-pill bg-success"> Active </span>
                                                @else
                                                    <span class="badge rounded-pill bg-danger"> InActive </span>
                                                @endif
                                            </td>
                                            <td>
                                                @if (Auth::User()->can('property.edit'))
                                                    <a href="{{ route('details.property', $item->id) }}"
                                                        class="btn btn-info">
                                                        <i data-feather="eye"></i>
                                                    </a>
                                                @endif
                                                @if (Auth::User()->can('property.edit'))
                                                    <a href="{{ route('edit.property', $item->id) }}"
                                                        class="btn btn-warning">
                                                        <i data-feather="edit"></i>
                                                    </a>
                                                @endif
                                                @if (Auth::User()->can('property.delete'))
                                                    <a href="{{ route('delete.property', $item->id) }}"
                                                        class="btn btn-danger" id="delete">
                                                        <i data-feather="trash-2"></i> </a>
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
