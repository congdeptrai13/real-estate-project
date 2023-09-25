@extends('agent.agent_dashboard')
@section('agent')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{ route('agent.add.property') }}"class="btn btn-info"> Add Property </a>
            </ol>
        </nav>

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
                                        <th>user</th>
                                        <th>property</th>
                                        <th>date</th>
                                        <th>time</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($schedules as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>

                                            <td>{{ $item['user']['name'] }}</td>
                                            <td>{{ $item['property']['property_name'] }}</td>
                                            <td>{{ $item->tour_date }}</td>
                                            <td>{{ $item->tour_time }}</td>                                      
                                            <td>
                                                @if ($item->status == 1)
                                                    <span class="badge rounded-pill bg-success"> Confirm </span>
                                                @else
                                                    <span class="badge rounded-pill bg-danger"> Pending </span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('agent.details.schedule', $item->id) }}"
                                                    class="btn btn-info">
                                                    <i data-feather="eye"></i>
                                                </a>
                                                <a href="{{ route('agent.delete.property', $item->id) }}"
                                                    class="btn btn-danger" id="delete">
                                                    <i data-feather="trash-2"></i> </a>

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
