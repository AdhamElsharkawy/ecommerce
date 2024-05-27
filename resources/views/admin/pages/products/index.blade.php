@extends('admin.layout.layout')

@section('content')
    <div class="wrapper">
        <!-- Content Wrapper. Contains product content -->
        <div class="content-wrapper">
            <!-- Content Header (product header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Categories</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active">Products</li>
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
                                    <h3 class="card-title">Products</h3>
                                    <a href="{{ url('admin/products/create') }}" class="btn btn-primary btn-sm"
                                        style="float: right;">Add Product</a>
                                </div>
                                <!-- /.card-header -->
                                {{-- form for filter and search inputs --}}
                                <form action="{{ route('products.index') }}" method="GET">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                {{-- <div
                                                    class="form-group
                                                    {{ $errors->has('price') ? 'has-error' : '' }}">
                                                    <label for="price">Filter</label>
                                                    <select name="price" id="price" class="form-control">
                                                        <option value="">All</option>
                                                        <option value="active"
                                                            {{ request()->get('price') == 'active' ? 'selected' : '' }}>
                                                            Active</option>
                                                        <option value="Archived"
                                                            {{ request()->get('price') == 'Archived' ? 'selected' : '' }}>
                                                            Archived</option>
                                                    </select>
                                                    @if ($errors->has('price'))
                                                        <span class="text-danger">{{ $errors->first('price') }}</span>
                                                    @endif
                                                </div> --}}
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
                                        <a href="{{ route('products.index') }}" class="btn btn-secondary">Reset</a>
                                </form>

                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Category Name</th>
                                                <th>STORE Name</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Price</th>
                                                <th>Compare Price</th>
                                                {{-- <th>Options</th> --}}
                                                <th>rating</th>
                                                <th>is_featured</th>
                                                <th>CreatedOn</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $product)
                                                <tr>
                                                    <td>{{ $product->id }}</td>
                                                    <td>{{ $product->category->name }}</td>
                                                    <td>{{ $product->store->name }}</td>
                                                    <td>
                                                        @if (!empty($product->image))
                                                            <img src="{{ asset($product->image) }}" style="width: 100px;">
                                                        @endif
                                                    </td>
                                                    <td>{{ $product->name }}</td>
                                                    <td>{{ $product->description }}</td>
                                                    <td>{{ $product->price }}</td>
                                                    <td>{{ $product->compare_price }}</td>
                                                    {{-- <td>
                                                        @foreach ($product->options->size as $option)
                                                            <span class="badge badge-primary">{{ $option->name }}</span>
                                                        @endforeach
                                                    </td> --}}
                                                    <td>{{ $product->rating }}</td>
                                                    <td>{{ $product->is_featured }}</td>
                                                    <td>{{ date('F j, Y, g:i a', strtotime($product->created_at)) }}</td>
                                                    <td class="d-flex" style="height: 7rem">
                                                        <a title="Edit product"
                                                            href="{{ url('admin/products/' . $product->id . '/edit') }}"><i
                                                                class="fas fa-edit mx-4"></i></a>
                                                        <form action="{{ url('admin/products/' . $product->id) }}"
                                                            class="d-inline" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" title="Delete product"
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
                                        {{ $products->withQueryString()->links() }}
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
    {{-- @include('admin.pages.products.ajax_script') --}}
@endpush
