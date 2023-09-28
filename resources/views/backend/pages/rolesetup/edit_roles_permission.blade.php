@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <div class="page-content">

        <div class="row profile-body">

            <!-- middle wrapper start -->
            <div class="col-md-12 col-xl-12 middle-wrapper">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">ADD ROLES IN PERMISSION</h6>

                        <form class="forms-sample" method="POST" action="{{ route('update.permission.roles', $roles->id) }}"
                            id="myForm">
                            @csrf
                            <div class="form-group mb-3">

                                <label for="amenity_name" class="form-label">Roles Name</label>
                                <h3>{{ $roles->name }}</h3>

                            </div>
                            <div class="form-check mb-3 col-9">
                                <input type="checkbox" class="form-check-input" id="checkDefaultMain">
                                <label class="form-check-label" for="checkDefaultMain">
                                    Permission all
                                </label>
                            </div>
                            <hr>
                            @foreach ($group_permission as $group)
                                <div class="row">
                                    @php
                                        $permissions = App\Models\User::getPermissionByGroupname($group->group_name);
                                    @endphp
                                    <div class="col-3">
                                        <div class="form-check mb-3">
                                            <input type="checkbox" class="form-check-input"
                                                id="checkDefault{{ $group->group_name }}"
                                                {{ App\Models\User::hasRolesPermission($roles, $permissions) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="checkDefault{{ $group->group_name }}">
                                                {{ $group->group_name }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-9">

                                        @foreach ($permissions as $permission)
                                            <div class="form-check mb-3">
                                                <input type="checkbox" class="form-check-input" name="permissions[]"
                                                    id="checkDefault{{ $permission->id }}" value="{{ $permission->id }}"
                                                    {{ $roles->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="checkDefault{{ $permission->id }}">
                                                    {{ $permission->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                        <br>

                                    </div>

                                </div>
                            @endforeach

                            <button type="submit" class="btn btn-primary me-2">Add New</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#checkDefaultMain').click(function() {
            if ($(this).is(':checked')) {
                $('input[type=checkbox]').prop("checked", true);
            } else {
                $('input[type=checkbox]').prop("checked", false);
            }
        })
    </script>
@endsection
