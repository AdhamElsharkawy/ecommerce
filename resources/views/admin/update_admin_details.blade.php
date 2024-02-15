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
                        <h1>Settings</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Update Password</li>
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
                                <h3 class="card-title">Update Admin Details</h3>
                            </div>

                            @if (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif

                            @if (session('message_success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('message_success') }}
                                </div>
                            @endif

                            <!-- form start -->
                            <form action="{{ url('admin/update-admin-details') }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="email" name="email" class="form-control" id="email"
                                            value="{{ Auth::guard('admin')->user()->email }}" placeholder="Enter email"
                                            >

                                    </div>
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="name" name="name" class="form-control" id="name"
                                            value="{{ Auth::guard('admin')->user()->name }}" placeholder="Enter name"
                                            >
                                    </div>
                                    <div class="form-group">
                                        <label for="image">image</label>
                                        <img src="{{ asset('uploads/admin/'.Auth::guard('admin')->user()->image) }}" alt="image" style="width: 100px; height: 100px;">
                                        <input type="file" name="image" class="form-control" id="image" placeholder="Enter image">
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