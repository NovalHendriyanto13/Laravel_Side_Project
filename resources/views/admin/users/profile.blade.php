@extends('layouts.main')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
    </div>

    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Profile Overview</h6>                    
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form class="user" action="{{ route('user.profile-action') }}" method="POST">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                    placeholder="NIK" name="nik" value="{{ $data['user']['nik'] }}" readonly>
                            </div>
                            <div class="col-sm-6">
                                <select class="form-control form-control-user" id="exampleLastName"
                                    placeholder="Role" name="role">
                                    <option value="">Select Role</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                    placeholder="Email Address" name="email" value="{{ $data['user']['email'] }}" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <input type="text" class="form-control form-control-user" id="exampleLastName"
                                    placeholder="Name" name="name" value="{{ $data['user']['name'] }}" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">
                            Edit Profile
                        </button>
                        <hr>
                    </form>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Change Password</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form class="user" action="{{ route('user.change-password') }}" method="POST">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3">
                                <input type="password" class="form-control form-control-user"
                                    id="exampleInputPassword" placeholder="Old Password" name="old_password">
                            </div>
                            <div class="col-sm-12 mb-3">
                                <input type="password" class="form-control form-control-user"
                                    id="exampleInputPassword" placeholder="Password" name="password">
                            </div>
                            <div class="col-sm-12">
                                <input type="password" class="form-control form-control-user"
                                    id="exampleRepeatPassword" placeholder="Repeat Password" name="password_confirmation">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">
                            Change Password
                        </button>
                        <hr>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@endsection