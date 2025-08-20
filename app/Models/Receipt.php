<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Receipt extends Model
{
    //
    protected $table = "penerimaan";
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        "pemesanan_id",
        "kode_penerimaan",
        "tgl_penerimaan",
        "tgl_ambil_sampel",
        "jam_ambil_sampel",
        "ambil_sampel_oleh",
        "tgl_terima_sampel",
        "jam_terima_sampel",
        "tgl_periksa_sampel",
        "jam_periksa_sampel",
        "periksa_sampel_oleh",
        "hasil_pemeriksaan",
        "hasil_golongan_sampel",
        "hasil_rhesus_sampel",
        "nama_pasangan",
        "status",
        "total_harga",
        "created_by",
        "updated_by"
    ];

    public static $_status = [
        'Proses',
        'Ambil Sampel',
        'Terima Sampel',
        'Check Sampel',
        'Selesai',
    ];

    public function receiptDetail(): HasMany {
        return $this->hasMany(ReceiptDetail::class, 'penerimaan_id', 'id');
    }
}
