@extends('agent.agent_dashboard')
@section('agent')
    <div class="page-content">

        <div class="row profile-body">
            <!-- left wrapper start -->
            <!-- left wrapper end -->
            <!-- middle wrapper start -->
            <div class="col-md-12 col-xl-12 middle-wrapper">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">Agent Live Chat</h6>

                        <div id="app">
                            <chat-message></chat-message>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
