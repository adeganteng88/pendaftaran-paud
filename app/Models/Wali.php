<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wali extends Model
{
    protected $primaryKey = 'id_wali';
    protected $fillable = ['nama_wali', 'no_hp', 'alamat'];

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'id_wali', 'id_wali');
    }
}