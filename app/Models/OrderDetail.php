<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    //
    protected $table = "pemesanan_detail";
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        "pemesanan_id",
        "blood_id",
        "jumlah_ml",
        "jumlah",
        "status",
        "created_by",
        "updated_by"
    ];

    public static $_status = [
        'Belum Terisi',
        'Terisi',
    ];
}
