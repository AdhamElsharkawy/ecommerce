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
                            <h1>General Form</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ url('admin/cms-pages') }}">Page</a></li>
                                <li class="breadcrumb-item active">Add Page</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            {{-- @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif                       --}}
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        @if (empty($cmsPage['id']))
                                            Add Page
                                        @else
                                            Edit Page
                                        @endif
                                    </h3>
                                    @if (Session::has('success_message'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert"
                                            style="margin-top: 10px;">
                                            {{ Session::get('success_message') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                    @if (Session::has('error_message'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert"
                                            style="margin-top: 10px;">
                                            {{ Session::get('error_message') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif

                                </div>
                                <form
                                    @if (empty($cmsPage['id'])) action="{{ url('admin/cms-pages/add-edit-cms-page') }}" @else
                                    action="{{ url('admin/cms-pages/add-edit-cms-page/' . $cmsPage['id']) }}" @ @endif
                                    method="POST">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="title">Title</label> <span class="text-danger">*</span>
                                            <input type="text" class="form-control" id="title" name="title"
                                                @if (!empty($cmsPage['title'])) value="{{ $cmsPage['title'] }}" @endif
                                            required placeholder="Enter title">
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="url">URL</label> <span class="text-danger">*</span>
                                            <input type="text" class="form-control" id="url" name="url" @if(!empty($cmsPage['url'])) value="{{ $cmsPage['url'] }}" @endif 
                                                required placeholder="Enter url">
                                            @error('url')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_title">Meta Title</label>
                                            <input type="text" class="form-control" name="meta_title" id="meta_title" @if (!empty($cmsPage['meta_title'])) value="{{ $cmsPage['meta_title'] }}" @endif
                                                placeholder="Enter meta title">
                                                
                                            @error('meta_title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_keywords">Meta KeyWords</label>
                                            <input type="text" class="form-control" name="meta_keywords" @if (!empty($cmsPage['meta_keywords'])) value="{{ $cmsPage['meta_keywords'] }}" @endif
                                                id="meta_keywords" placeholder="Enter meta keywords">
                                            @error('meta_keywords')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_description">Meta Description</label>
                                            <input type="text" class="form-control" name="meta_description"
                                                id="meta_description" placeholder="Enter meta description" @if (!empty($cmsPage['meta_description'])) value="{{ $cmsPage['meta_description'] }}" @endif>                                               
                                            @error('meta_description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
@endsection
