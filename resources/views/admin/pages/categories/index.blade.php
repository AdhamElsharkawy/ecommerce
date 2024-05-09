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
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active">Categories</li>
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
                                    <x-alert type="success_message"/>
                                    <x-alert type="info"/>
                                    <h3 class="card-title">categories</h3>
                                    <a href="{{ url('admin/categories/create') }}" class="btn btn-primary btn-sm"
                                        style="float: right;">Add category</a>

                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>parentID</th>
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
                                                    <td>{{ $category->parent_id }}</td>
                                                    <td>
                                                        @if (!empty($category->image))
                                                            <img src="{{ asset($category->image) }}" style="width: 100px;">
                                                        @endif
                                                    <td>{{ $category->name }}</td>
                                                    <td>{{ ucfirst($category->status) }}</td>
                                                    <td>{{ date('F j, Y, g:i a', strtotime($category->created_at)) }}</td>
                                                    <td>
                                                        <a title="Edit category"
                                                            href="{{ url('admin/categories/' . $category->id . '/edit') }}"><i
                                                                class="fas fa-edit mx-4"></i></a>
                                                        <form action="{{ url('admin/categories/' . $category->id) }}" class="d-inline"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" title="Delete category"
                                                                style="border: none; background-color:transparent;">
                                                                <i class="fas fa-trash text-danger"></i>
                                                        </form>



                                                    </td>
                                            @endforeach
                                            </tr>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>

    </div>
@endsection

@push('push_scripts')
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>

    @include('admin.pages.categories.ajax_script')
@endpush
