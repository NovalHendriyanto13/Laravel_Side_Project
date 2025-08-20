@extends('admin.layouts.main')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-flex align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Users Create</h6>
            
        </div>
    </div>
    <div class="card-body">
        <form class="user form-user" action="{{ route('api.user.create') }}" method="POST">
            @csrf
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label class="form-label">NIK</label>
                    <input type="text" class="form-control" id="nik"
                        placeholder="NIK" name="nik" required>
                </div>
                <div class="col-sm-6">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name"
                        placeholder="Name" name="name" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" id="email"
                        placeholder="Email Address" name="email" required>
                </div>
                <div class="col-sm-6">
                    <label class="form-label">Role</label>
                    <select class="form-control" id="role"
                        placeholder="Role" name="role">
                        <option value="">Select Role</option>
                        <option value="admin">Service Desk</option>
                        <option value="upd_officer">Admin UPD</option>
                        <option value="checker">Cross Match</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control"
                        id="password" placeholder="Password" name="password" required>
                </div>
                <div class="col-sm-6">
                    <label class="form-label">Validasi Password</label>
                    <input type="password" class="form-control"
                        id="repeat_password" placeholder="Repeat Password" name="password_confirmation" required>
                </div>
            </div>
            <div class="d-flex align-items-center">
                <a href="{{ route('admin.user.index') }}" class="btn btn-danger btn-icon-split m-2">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-left"></i>
                    </span>
                    <span class="text">Cancel</span>
                </a>
                <button type="submit"class="btn btn-primary btn-icon-split m-2 btn-submit">
                    <span class="icon text-white-50">
                        <i class="fas fa-check"></i>
                    </span>
                    <span class="text">Submit</span>
                </button>
            </div>
            <hr>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/pages/user/create.js') }}"></script>
@endpush
