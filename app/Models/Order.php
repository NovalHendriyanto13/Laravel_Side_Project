<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $table = "pemesanan";
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        "rs_id",
        "kode_pemesanan",
        "tipe",
        "dokter",
        "tgl_pemesanan",
        "tgl_diperlukan",
        "diagnosis",
        "alasan_transfusi",
        "hb",
        "trombosit",
        "berat_badan",
        "nama_pasien",
        "jenis_kelamin",
        "nama_pasangan",
        "tempat_lahir",
        "tanggal_lahir",
        "alamat",
        "no_telp",
        "transfusi_sebelumnya",
        "tgl_transfusi_sebelumnya",
        "gejala_reaksi",
        "tempat_serologi",
        "tgl_serologi",
        "hasil_serologi",
        "hamil",
        "jumlah_kehamilan",
        "pernah_aborsi",
        "status",
        "created_by",
        "updated_by"
    ];
}
