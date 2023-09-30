@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">
        @if (Auth::user()->can('category.add'))
            <nav class="page-breadcrumb">
                <ol class="breadcrumb">
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Category Add
                    </button>
                </ol>
            </nav>
        @endif

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Blog Category Table</h6>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Blog Category Name</th>
                                        <th>Blog Category Slug</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $key => $type)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $type->category_name }}</td>
                                            <td>{{ $type->category_slug }}</td>
                                            <td>
                                                @if (Auth::user()->can('category.edit'))
                                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                        data-bs-target="#editCategory" id="{{ $type->id }}"
                                                        onclick="EditCategory(this.id)">
                                                        Edit
                                                    </button>
                                                @endif
                                                @if (Auth::user()->can('category.delete'))
                                                    <a href="{{ route('delete.category', $type->id) }}"
                                                        class="btn btn-danger" id="delete">
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


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="forms-sample" method="POST" action="{{ route('store.blog.category') }}" id="myForm">
                @csrf
                <div class="modal-content">``
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Category Add</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group mb-3">
                            <label for="category_name" class="form-label">Category Name</label>
                            <input type="text" name="category_name" id="category_name" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="forms-sample" method="POST" action="{{ route('update.blog.category') }}" id="myForm">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Category Edit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="cat_id" name="cat_id">

                        <div class="form-group mb-3">
                            <label for="cat" class="form-label">Category Name</label>
                            <input type="text" name="category_name" id="cat" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <script type="text/javascript">
        function EditCategory(id) {
            $.ajax({
                method: "GET",
                dataType: "json",
                url: "/edit/category/" + id,
                success: function(data) {
                    $("#cat").val(data.category_name)
                    $("#cat_id").val(data.id)
                }
            })
        }
    </script>
@endsection
