@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">


        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Comment Table</h6>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Post Title</th>
                                        <th>Username</th>
                                        <th>Subject</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($comments as $key => $type)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $type->post->post_title }}</td>
                                            <td>{{ $type->user->name }}</td>
                                            <td>{{ $type->subject }}</td>
                                            <td>
                                                @if (Auth::user()->can('comment.edit'))
                                                    <a href="{{ route('admin.reply.comment', $type->id) }}"
                                                        class="btn btn-warning">
                                                        Replay
                                                    </a>
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
