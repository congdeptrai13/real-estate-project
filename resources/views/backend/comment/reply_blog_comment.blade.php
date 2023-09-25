@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <div class="row profile-body">

            <!-- middle wrapper start -->
            <div class="col-md-12 col-xl-12 middle-wrapper">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">Reply Comment</h6>

                        <form class="forms-sample" method="POST" action="{{ route('admin.store.comment') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $comment->id }}">
                            <input type="hidden" name="user_id" value="{{ $comment->user_id }}">
                            <input type="hidden" name="post_id" value="{{ $comment->post_id }}">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label for="state_name" class="form-label">User Name:</label>
                                        <code>{{ $comment->user->name }}</code>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Post title</label>
                                        <code>{{ $comment->post->post_title }}</code>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Subject</label>
                                        <code>{{ $comment->subject }}</code>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Message</label>
                                        <code>{{ $comment->message }}</code>
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">Subject</label>
                                        <input type="text" class="form-control" name="subject">
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Message</label>
                                        <input type="text" name="message" class="form-control"/>
                                    </div>
                                </div><!-- Col -->
                                <button type="submit" class="btn btn-primary me-2">Reply</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
