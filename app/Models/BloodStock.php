<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BloodStock extends Model
{
    //
    protected $table = 'blood_stock';
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'blood_id',
        'stock_no',
        'expiry_date',
        'blood_group',
        'blood_rhesus',
        'unit_volume',
        'status',
    ];
}
