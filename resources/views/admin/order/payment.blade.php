@extends('admin.layouts.main')

@push('css')
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-flex align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Detail Pemesanan</h6>
        </div>
    </div>
    <div class="card-body">
        <form class="form-order-payment" action="{{ route('api.admin.receipt.payment', ['id' => $id])}}" method="POST" data-id="{{$id}}">
            @csrf
            <ul class="nav nav-tabs" id="order-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="main-tab" data-toggle="tab" data-target="#main" type="button" role="tab" aria-controls="main" aria-selected="true">Info Pemesanan</button>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="main" role="tabpanel" aria-labelledby="main-tab">
                    <div class="accordion" id="accordion-update">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-toggle="collapse" data-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                    <b>Informasi Utama</b>
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 mb-3">
                                            <div class="form-group mb-3">
                                                <label for="kode_pemesanan">Kode Pemesanan</label>
                                                <input type="text" name="kode_pemesanan" id="kode_pemesanan" class="form-control" disabled>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="tipe">Tipe</label>
                                                <select id="tipe" name="tipe" class="form-control" disabled>
                                                    <option value="bdrs">BDRS</option>
                                                    <option value="non_bdrs">NON BDRS</option>
                                                </select>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="tgl_pemesanan">Tanggal Pemesanan</label>
                                                <input type="text" name="tgl_pemesanan" id="tgl_pemesanan" class="form-control" 
                                                    value="{{ date('d / m / Y') }}" disabled
                                                >
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="total_harga">Total Harga</label>
                                                <input type="text" name="total_harga" id="total_harga" class="form-control"  readonly>
                                            </div>
                                    
                                        </div>
                                        <div class="col-lg-6 col-md-6 mb-3">
                                            <div class="form-group mb-3">
                                                <label for="dokter">Dokter yang meminta</label>
                                                <input type="text" name="dokter" id="dokter" class="form-control"  disabled>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="tgl_diperlukan">Tanggal Diperlukan</label>
                                                <input type="date" name="tgl_diperlukan" id="tgl_diperlukan" class="form-control"  disabled>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="status">Status</label>
                                                <input type="text" name="status" id="status" class="form-control"  disabled>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="jumlah_pembayaran">Jumlah Pembayaran</label>
                                                <input type="text" name="jumlah_pembayaran" id="jumlah_pembayaran" class="form-control">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-toggle="collapse" data-target="#panelsStayOpen-collapseFour" aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
                                    <b>Informasi Pemesanan</b>
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-item" id="dataTable" width="100%" cellspacing="0"
                                            data-url="{{ route('api.order.index') }}"
                                        >
                                            <thead>
                                                <tr>
                                                    <th>Item</th>
                                                    <th>Golongan</th>
                                                    <th>Unit Volume</th>
                                                    <th>Harga</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-center">
                <a href="{{ route('admin.order.index') }}" class="btn btn-danger btn-icon-split m-2">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-left"></i>
                    </span>
                    <span class="text">Cancel</span>
                </a>
                <button type="submit"class="btn btn-primary btn-icon-split m-2 btn-submit">
                    <span class="icon text-white-50">
                        <i class="fas fa-check"></i>
                    </span>
                    <span class="text">Bayar</span>
                </button>
            </div>
            <hr>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/pages/order/payment.js') }}"></script>
@endpush
