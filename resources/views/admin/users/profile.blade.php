@extends('admin.layouts.main')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Update Profile</h1>
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
                    <form class="user form-user-update" action="{{ route('api.user.update-profile') }}" method="POST" data-id="{{ $id }}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <label class="form-label">NIK</label>
                                <input type="text" class="form-control" id="nik"
                                    placeholder="NIK" name="nik" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" id="email"
                                    placeholder="Email Address" name="email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" id="name"
                                    placeholder="Name" name="name" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-submit">
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
                    <form class="user form-change-password" action="{{ route('api.user.change-password') }}" method="POST">
                        @csrf
                       
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3">
                                <label class="form-label">Password Lama</label>
                                <input type="password" class="form-control"
                                    id="old_password" placeholder="Old Password" name="old_password">
                            </div>
                            <div class="col-sm-12 mb-3">
                                <label class="form-label">Password baru</label>
                                <input type="password" class="form-control"
                                    id="password" placeholder="Password" name="password">
                            </div>
                            <div class="col-sm-12">
                                <label class="form-label">Validasi Password</label>
                                <input type="password" class="form-control"
                                    id="repeat_password" placeholder="Repeat Password" name="password_confirmation">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-change-password">
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

@push('scripts')
<script src="{{ asset('js/pages/user/update.js') }}"></script>
@endpush