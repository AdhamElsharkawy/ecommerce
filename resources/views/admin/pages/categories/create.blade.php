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
                            <h1>Create</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Create Category</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Create Category</h3>
                                </div>
                                @if ($errors->any())
                                    <div class="alert alert-danger" role="alert">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if (session('message_success'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('message_success') }}
                                    </div>
                                @endif

                                <!-- form start -->
                                <form action="{{ url('admin/categories') }}" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="name" name="name" class="form-control" id="name"
                                                value="{{ old('name', '') }}" placeholder="Enter name">
                                        </div>
                                        <div class="form-group">
                                            <div class="d-flex justify-content-between my-3">
                                                <label for="image">image</label>
                                            </div>
                                            <input type="file" name="image" class="form-control" id="image"
                                                accept="image/*" placeholder="Enter image">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Status</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" value="active"
                                                    checked>
                                                <label class="form-check-label">
                                                    Active
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status"
                                                    value="archived">
                                                <label class="form-check-label">
                                                    Archived
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">select parent</label>
                                            <select name="parent_id" class="form-control" id="parent_id">
                                                <option value="">Select parent</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card -->

                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>


    </div>

@endsection
