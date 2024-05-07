<!-- Content Wrapper. Contains page content -->
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
                                    <h3 class="card-title">Update Admin Password</h3>
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
                                <form action="{{ url('admin/update-password') }}" method="POST">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="email">Email address</label>
                                            <input type="email" name="email" class="form-control" id="email"
                                                value="{{ Auth::guard('admin')->user()->email }}" placeholder="Enter email"
                                                readonly style="background-color: #ccc;">

                                        </div>
                                        <div class="form-group">
                                            <label for="current_password">Current Password</label>
                                            <input type="password" name="current_password" class="form-control"
                                                id="current_password" placeholder="Current Password"> <span
                                                id="verify_current_pwd"></span>
                                            @error('current_password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="new_password">New Password</label>
                                            <input type="password" name="new_password" class="form-control"
                                                id="new_password" placeholder="New Password">
                                            @error('new_password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="confirm_password">Confrim Password</label>
                                            <input type="password" name="confirm_password" class="form-control"
                                                id="confirm_password" placeholder="Confirm Password">
                                            @error('confirm_password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        {{-- <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                        </div> --}}
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

@push('push_scripts')
    <script src="{{ url('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        $(document).ready(function() {
    $('#current_password').on('keyup',function(){
        let current_password = $(this).val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: '/admin/check-current-password',
                data: {current_password:current_password},
                success: function(response){
                    if(response == false){
                        $('#verify_current_pwd').html("<font color='red'>Current Password is Incorrect</font>");
                    }else if(response == true){
                        $('#verify_current_pwd').html("<font color='green'>Current Password is Correct</font>");
                    }
                },
                error: function(){
                    alert('Error');
                }
            });
    })
});
    </script>
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
@endpush
