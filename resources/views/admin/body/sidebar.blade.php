<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            Easy<span>Admin</span>
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
            <li class="nav-item nav-category">web apps</li>
            @if (Auth::User()->can('type.menu'))
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false"
                        aria-controls="emails">
                        <i class="link-icon" data-feather="mail"></i>
                        <span class="link-title">Property Type</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="emails">
                        <ul class="nav sub-menu">
                            @if (Auth::User()->can('all.type'))
                                <li class="nav-item">
                                    <a href="{{ route('all.type') }}" class="nav-link">All Type</a>
                                </li>
                            @endif
                            @if (Auth::User()->can('add.type'))
                                <li class="nav-item">
                                    <a href="{{ route('add.type') }}" class="nav-link">Add Type</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif

            @if (Auth::User()->can('amenities.menu'))
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#amenities" role="button" aria-expanded="false"
                        aria-controls="amenities">
                        <i class="link-icon" data-feather="mail"></i>
                        <span class="link-title">Amenities</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="amenities">
                        <ul class="nav sub-menu">
                            @if (Auth::User()->can('amenities.all'))
                                <li class="nav-item">
                                    <a href="{{ route('all.amenity') }}" class="nav-link">All Amenity</a>
                                </li>
                            @endif
                            @if (Auth::User()->can('amenities.add'))
                                <li class="nav-item">
                                    <a href="{{ route('add.amenity') }}" class="nav-link">Add Amenity</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif

            @if (Auth::User()->can('state.menu'))
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#state" role="button" aria-expanded="false"
                        aria-controls="state">
                        <i class="link-icon" data-feather="mail"></i>
                        <span class="link-title">Property State</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="state">
                        <ul class="nav sub-menu">
                            @if (Auth::User()->can('state.all'))
                                <li class="nav-item">
                                    <a href="{{ route('all.state') }}" class="nav-link">All State</a>
                                </li>
                            @endif
                            @if (Auth::User()->can('state.add'))
                                <li class="nav-item">
                                    <a href="{{ route('add.state') }}" class="nav-link">Add State</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif

            @if (Auth::User()->can('tesimonials.menu'))
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#Testimonial" role="button"
                        aria-expanded="false" aria-controls="Testimonial">
                        <i class="link-icon" data-feather="mail"></i>
                        <span class="link-title">Property Testimonial</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="Testimonial">
                        <ul class="nav sub-menu">
                            @if (Auth::User()->can('tesimonials.all'))
                                <li class="nav-item">
                                    <a href="{{ route('all.testimonial') }}" class="nav-link">All Testimonial</a>
                                </li>
                            @endif
                            @if (Auth::User()->can('tesimonials.add'))
                                <li class="nav-item">
                                    <a href="{{ route('add.testimonial') }}" class="nav-link">Add Testimonial</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif

            @if (Auth::User()->can('tesimonials.menu'))
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#property" role="button"
                        aria-expanded="false" aria-controls="property">
                        <i class="link-icon" data-feather="mail"></i>
                        <span class="link-title">Property</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="property">
                        <ul class="nav sub-menu">
                            @if (Auth::User()->can('tesimonials.menu'))
                                <li class="nav-item">
                                    <a href="{{ route('all.property') }}" class="nav-link">All property</a>
                                </li>
                            @endif
                            @if (Auth::User()->can('tesimonials.menu'))
                                <li class="nav-item">
                                    <a href="{{ route('add.property') }}" class="nav-link">Add property</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif

            @if (Auth::User()->can('history.menu'))
                <li class="nav-item">
                    <a href="{{ route('admin.package.history') }}" class="nav-link">
                        <i class="link-icon" data-feather="calendar"></i>
                        <span class="link-title">Package History</span>
                    </a>
                </li>
            @endif

            @if (Auth::User()->can('message.menu'))
                <li class="nav-item">
                    <a href="{{ route('admin.property.message') }}" class="nav-link">
                        <i class="link-icon" data-feather="calendar"></i>
                        <span class="link-title">Property Message</span>
                    </a>
                </li>
            @endif


            <li class="nav-item nav-category">USER ALL FUNCTION </li>
            @if (Auth::User()->can('agent.menu'))
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#uiComponents" role="button"
                        aria-expanded="false" aria-controls="uiComponents">
                        <i class="link-icon" data-feather="feather"></i>
                        <span class="link-title">
                            Manage Agent
                        </span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="uiComponents">
                        <ul class="nav sub-menu">
                            @if (Auth::User()->can('agent.all'))
                                <li class="nav-item">
                                    <a href="{{ route('all.agent') }}" class="nav-link">All Agent</a>
                                </li>
                            @endif
                            @if (Auth::User()->can('agent.add'))
                                <li class="nav-item">
                                    <a href="{{ route('add.agent') }}" class="nav-link">Add Agent</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif


            @if (Auth::User()->can('category.menu'))
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#blogcategory" role="button"
                        aria-expanded="false" aria-controls="blogcategory">
                        <i class="link-icon" data-feather="mail"></i>
                        <span class="link-title">Blog Category</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="blogcategory">
                        <ul class="nav sub-menu">
                            @if (Auth::User()->can('category.all'))
                                <li class="nav-item">
                                    <a href="{{ route('all.blog.category') }}" class="nav-link">All Blog Category</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif

            @if (Auth::User()->can('category.menu'))
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#blogpost" role="button"
                        aria-expanded="false" aria-controls="blogpost">
                        <i class="link-icon" data-feather="mail"></i>
                        <span class="link-title">Blog Post</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="blogpost">
                        <ul class="nav sub-menu">
                            @if (Auth::User()->can('category.all'))
                                <li class="nav-item">
                                    <a href="{{ route('all.blog.post') }}" class="nav-link">All Blog Post</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif

            @if (Auth::User()->can('comment.menu'))
                <li class="nav-item">
                    <a href="{{ route('admin.blog.comment') }}" class="nav-link">
                        <i class="link-icon" data-feather="calendar"></i>
                        <span class="link-title">Blog Comment</span>
                    </a>
                </li>
            @endif
            @if (Auth::User()->can('smtp.menu'))
                <li class="nav-item">
                    <a href="{{ route('setting.smtp') }}" class="nav-link">
                        <i class="link-icon" data-feather="calendar"></i>
                        <span class="link-title">Setting SMTP</span>
                    </a>
                </li>
            @endif
            @if (Auth::User()->can('site.menu'))
                <li class="nav-item">
                    <a href="{{ route('site.setting') }}" class="nav-link">
                        <i class="link-icon" data-feather="calendar"></i>
                        <span class="link-title">Site Setting</span>
                    </a>
                </li>
            @endif


            <li class="nav-item nav-category">Role & Permission</li>
            @if (Auth::User()->can('role.menu'))
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#advancedUI" role="button"
                        aria-expanded="false" aria-controls="advancedUI">
                        <i class="link-icon" data-feather="anchor"></i>
                        <span class="link-title">Role & Permission</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="advancedUI">
                        <ul class="nav sub-menu">
                            @if (Auth::User()->can('role.all'))
                                <li class="nav-item">
                                    <a href="{{ route('all.permission') }}" class="nav-link">All Permission</a>
                                </li>
                            @endif
                            @if (Auth::User()->can('role.all'))
                                <li class="nav-item">
                                    <a href="{{ route('all.roles') }}" class="nav-link">All Role</a>
                                </li>
                            @endif
                            @if (Auth::User()->can('role.add'))
                                <li class="nav-item">
                                    <a href="{{ route('add.roles.permission') }}" class="nav-link">Add Roles In
                                        Permission</a>
                                </li>
                            @endif
                            @if (Auth::User()->can('role.all'))
                                <li class="nav-item">
                                    <a href="{{ route('all.roles.permission') }}" class="nav-link">All Roles In
                                        Permission</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif


            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#adminuser" role="button"
                    aria-expanded="false" aria-controls="advancedUI">
                    <i class="link-icon" data-feather="anchor"></i>
                    <span class="link-title">Manage Admin User</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="adminuser">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('all.admin') }}" class="nav-link">All Admin</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('add.admin') }}" class="nav-link">Add Admin</a>
                        </li>
                    </ul>
                </div>
            </li>
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
