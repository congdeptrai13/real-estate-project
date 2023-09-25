@extends('agent.agent_dashboard')
@section('agent')
    <div class="page-content">

        <div class="row profile-body">

            <!-- middle wrapper start -->
            <div class="col-md-12 col-xl-12 middle-wrapper">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Schedule Request Details</h6>
                        <form action="{{ route('agent.update.schedule') }}" method="post">
                            @csrf
                            <input type="hidden" name="request_id" value="{{ $request->id }}">
                            <input type="hidden" name="email" value="{{ $request->user->email }}">
                            <div class="table-responsive pt-3">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>User Name</td>
                                            <td>{{ $request->user->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Property Name</td>
                                            <td>{{ $request->property->property_name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tour Date</td>
                                            <td>{{ $request->tour_date }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tour Time</td>
                                            <td>{{ $request->tour_time }}</td>
                                        </tr>
                                        <tr>
                                            <td>message</td>
                                            <td>{{ $request->message }}</td>
                                        </tr>
                                        <tr>
                                            <td>Request Send Time</td>
                                            <td>{{ $request->created_at->format('M d Y') }}</td>
                                        </tr>


                                    </tbody>

                                </table>
                                <button type="submit" class="btn btn-success mt-4">Request Confirm</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
