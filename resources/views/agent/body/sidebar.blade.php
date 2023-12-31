@php
    $id = Auth::id();
    $status = \App\Models\User::find($id)->status;
    $property = \App\Models\User::where('role', 'agent')
        ->where('id', $id)
        ->first();
    $pcount = $property->credit;
@endphp
<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            Easy<span>Agent</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            @if ($status === 'active')
                <li class="nav-item nav-category">web apps</li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#property" role="button" aria-expanded="false"
                        aria-controls="property">
                        <i class="link-icon" data-feather="mail"></i>
                        <span class="link-title">Property</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="property">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="{{ route('agent.all.property') }}" class="nav-link">All property</a>
                            </li>
                            @if ($pcount == 1 || $pcount == 7)
                            @else
                                <li class="nav-item">
                                    <a href="{{ route('agent.add.property') }}" class="nav-link">Add property</a>
                                </li>
                            @endif


                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="{{ route('buy.package') }}" class="nav-link">
                        <i class="link-icon" data-feather="calendar"></i>
                        <span class="link-title">Package</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('package.history') }}" class="nav-link">
                        <i class="link-icon" data-feather="calendar"></i>
                        <span class="link-title">Package History</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('agent.property.message') }}" class="nav-link">
                        <i class="link-icon" data-feather="calendar"></i>
                        <span class="link-title">Property Message</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('agent.schedule.request') }}" class="nav-link">
                        <i class="link-icon" data-feather="calendar"></i>
                        <span class="link-title">Schedule Request</span>
                    </a>
                </li>
                <li class="nav-item nav-category">Components</li>
                <li class="nav-item">
                    <a href="{{ route('agent.live.chat') }}" class="nav-link">
                        <i class="link-icon" data-feather="calendar"></i>
                        <span class="link-title">Live Chat</span>
                    </a>
                </li>
            @endif
            <li class="nav-item nav-category">Docs</li>
            <li class="nav-item">
                <a href="#" target="_blank" class="nav-link">
                    <i class="link-icon" data-feather="hash"></i>
                    <span class="link-title">Documentation</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
