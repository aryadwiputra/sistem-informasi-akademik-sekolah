<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelas extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kelas';

    protected $fillable = ['paket_id', 'nama_kelas', 'guru_id'];

    public function guru()
    {
        return $this->belongsTo(Guru::class)->withDefault();
    }

    public function paket()
    {
        return $this->belongsTo(Paket::class)->withDefault();
    }
}
