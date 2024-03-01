<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Jadwal extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'jadwal';

    protected $fillable = ['hari_id', 'kelas_id', 'mapel_id', 'guru_id', 'jam_mulai', 'jam_selesai', 'ruang_id'];

    public function hari()
    {
        return $this->belongsTo(Hari::class)->withDefault();
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class)->withDefault();
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class)->withDefault();
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class)->withDefault();
    }

    public function ruang()
    {
        return $this->belongsTo(Ruang::class)->withDefault();
    }

    public function rapot($id)
    {
        $kelas = Kelas::where('id', $id)->first();
        return $kelas;
    }

    public function pengajar($id)
    {
        $guru = Guru::where('id', $id)->first();
        return $guru;
    }

    public function ulangan($id)
    {
        $siswa = Siswa::where('no_induk', Auth::user()->no_induk)->first();
        $nilai = Ulangan::where('siswa_id', $siswa->id)->where('mapel_id', $id)->first();
        return $nilai;
    }

    public function nilai($id)
    {
        $siswa = Siswa::where('no_induk', Auth::user()->no_induk)->first();
        $nilai = Rapot::where('siswa_id', $siswa->id)->where('mapel_id', $id)->first();
        return $nilai;
    }

    public function kkm($id)
    {
        $kkm = Nilai::where('guru_id', $id)->first();
        return $kkm['kkm'];
    }

    public function absen($id)
    {
        $absen = Absen::where('tanggal', date('Y-m-d'))->where('guru_id', $id)->first();
        if ($absen && $absen['kehadiran_id']) {
            $ket = Kehadiran::where('id', $absen['kehadiran_id'])->first();
            return $ket['color'];
        } else {
            return false;
        }
    }

    public function cekUlangan($id)
    {
        $data = json_decode($id, true);
        $ulangan = Ulangan::where('siswa_id', $data['siswa'])->where('mapel_id', $data['mapel'])->first();
        return $ulangan;
    }

    public function cekRapot($id)
    {
        $data = json_decode($id, true);
        $rapot = Rapot::where('siswa_id', $data['siswa'])->where('mapel_id', $data['mapel'])->first();
        return $rapot;
    }
}
