@extends('admin.layout.layout')

@section('content')
    <div class="wrapper">



        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>CMS Pages</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active">Pages</li>
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
                                    @if (Session::has('success_message'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert"
                                            style="margin-top: 10px;">
                                            {{ Session::get('success_message') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                    <h3 class="card-title">Pages</h3>
                                    <a href="{{ url('admin/cms-pages/add-edit-cms-page') }}" class="btn btn-primary btn-sm"
                                        style="float: right;">Add Page</a>

                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Title</th>
                                                <th>URL</th>
                                                <th>CreatedOn</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cmsPages as $page)
                                                <tr>
                                                    <td>{{ $page->id }}</td>
                                                    <td>{{ $page->title }}</td>
                                                    <td>{{ $page->url }}</td>
                                                    <td>{{ date('F j, Y, g:i a', strtotime($page->created_at)) }}</td>
                                                    <td>
                                                        @if ($page['status'] == 1)
                                                            <a class="updateCmsPageStatus" id="page-{{ $page['id'] }}"
                                                                page_id="{{ $page['id'] }}" href="javascript:void(0)">
                                                                <i class="fas fa-toggle-on" aria-hidden="true"
                                                                    status="Active"></i>
                                                            </a>
                                                        @else
                                                            <a class="updateCmsPageStatus" id="page-{{ $page['id'] }}"
                                                                page_id="{{ $page['id'] }}" href="javascript:void(0)">
                                                                <i class="fas fa-toggle-off" style="color: grey"
                                                                    aria-hidden="true" status="Inactive"></i>
                                                            </a>
                                                        @endif
                                                        <a title="Edit Page"
                                                            href="{{ url('admin/cms-pages/add-edit-cms-page/' . $page->id) }}"><i
                                                                class="fas fa-edit mx-4"></i></a>
                                                        <a title="Delete Page" href="javascript:void(0)"
                                                            class="confirmDelete" record="page"
                                                            recordid="{{ $page->id }}"><i class="fas fa-trash"></i></a>


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
    <script src="{{ url('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ url('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ url('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ url('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ url('admin/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ url('admin/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ url('admin/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ url('admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ url('admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ url('admin//plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
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

    @include('admin.pages.pages_ajax')
@endpush
