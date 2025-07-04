@extends('admin.layouts.main')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-flex align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Users Create</h6>
            
        </div>
    </div>
    <div class="card-body">
        <form class="user" action="{{ route('create.action-action') }}" method="POST">
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
                    <label class="form-label">NIK</label>
                    <input type="text" class="form-control" id="nik"
                        placeholder="NIK" name="nik">
                </div>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="name"
                        placeholder="Name" name="name">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="email" class="form-control" id="email"
                        placeholder="Email Address" name="email">
                </div>
                <div class="col-sm-6">
                    <select class="form-control" id="role"
                        placeholder="Role" name="role">
                        <option value="">Select Role</option>
                        <option value="admin">Admin</option>
                        <option value="guest">Guest</option>
                        <option value="checker">Checker</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control"
                        id="exampleInputPassword" placeholder="Password" name="password">
                </div>
                <div class="col-sm-6">
                    <input type="password" class="form-control"
                        id="exampleRepeatPassword" placeholder="Repeat Password" name="password_confirmation">
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block">
                Register Account
            </button>
            <hr>
        </form>
    </div>
</div>
@endsection
