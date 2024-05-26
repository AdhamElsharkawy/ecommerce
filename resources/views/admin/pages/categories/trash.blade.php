@extends('admin.layout.layout')

@section('content')
    <div class="wrapper">
        <!-- Content Wrapper. Contains category content -->
        <div class="content-wrapper">
            <!-- Content Header (category header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Categories</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active"><a href="{{ url('admin/dashboard') }}">Trash</a></li>
                                <li class="breadcrumb-item">Categories</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <x-alert type="success_message" />
                                    <x-alert type="info" />
                                </div>
                                <!-- /.card-header -->
                                {{-- form for filter and search inputs --}}
                                <form action="{{ route('categories.index') }}" method="GET">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div
                                                    class="form-group
                                                    {{ $errors->has('status') ? 'has-error' : '' }}">
                                                    <label for="status">Filter</label>
                                                    <select name="status" id="status" class="form-control">
                                                        <option value="">All</option>
                                                        <option value="active"
                                                            {{ request()->get('status') == 'active' ? 'selected' : '' }}>
                                                            Active</option>
                                                        <option value="Archived"
                                                            {{ request()->get('status') == 'Archived' ? 'selected' : '' }}>
                                                            Archived</option>
                                                    </select>
                                                    @if ($errors->has('status'))
                                                        <span class="text-danger">{{ $errors->first('status') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div
                                                    class="form-group
                                                {{ $errors->has('search') ? 'has-error' : '' }}">
                                                    <label for="search">Search</label>
                                                    <input type="text" name="search" id="search" class="form-control"
                                                        value="{{ request()->get('search') }}">
                                                    @if ($errors->has('search'))
                                                        <span class="text-danger">{{ $errors->first('search') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Reset</a>
                                </form>

                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                {{-- <th>parentID</th> --}}
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Status</th>
                                                <th>CreatedOn</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($categories as $category)
                                                <tr>
                                                    <td>{{ $category->id }}</td>
                                                    {{-- <td>{{ $category->parent_id }}</td> --}}
                                                    <td>
                                                        @if (!empty($category->image))
                                                            <img src="{{ asset($category->image) }}" style="width: 100px;">
                                                        @endif
                                                    </td>
                                                    <td>{{ $category->name }}</td>
                                                    <td>{{ ucfirst($category->status) }}</td>
                                                    <td>{{ date('F j, Y, g:i a', strtotime($category->created_at)) }}</td>
                                                    <td>
                                                        <form action="{{ url('admin/categories/' . $category->id . '/restore') }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" title="Restore category"
                                                                style="border: none; background-color:transparent;">
                                                                <i class="fas fa-undo text-success"></i>
                                                            </button>
                                                        </form>
                                                        <form action="{{ url('admin/categories/' . $category->id .'/force-delete') }}"
                                                            class="d-inline" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" title="Delete category"
                                                                style="border: none; background-color:transparent;">
                                                                <i class="fas fa-trash text-danger"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <!-- Pagination Links -->
                                    <div class="d-flex justify-content-center mt-3">
                                        {{ $categories->withQueryString()->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@push('push_scripts')
    <script></script>
    {{-- @include('admin.pages.categories.ajax_script') --}}
@endpush
