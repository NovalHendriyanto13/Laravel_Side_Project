<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    //
    protected $table = "rumah_sakit";
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'kode_rs',
        'nama_rs',
        'email',
        'no_telp',
        'penanggung_jawab_rs',
        'kota',
        'kode_pos',
        'alamat',
        'status',
    ];
}
