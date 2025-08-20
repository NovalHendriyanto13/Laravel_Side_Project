<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReceiptDetail extends Model
{
    //
    protected $table = "penerimaan_detail";
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        "penerimaan_id",
        "pemesanan_detail_id",
        "blood_stock_id",
        "sisa",
        "status",
        "harga",
        "created_by",
        "updated_by"
    ];

}
