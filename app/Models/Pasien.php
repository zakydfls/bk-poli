<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'alamat', 'no_ktp', 'no_hp', 'no_rm'];

    public function daftarPolis()
    {
        return $this->hasMany(DaftarPoli::class, 'id_pasien');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id_pasien', 'id');
    }




    public static function generateNoRM()
    {
        $lastPasien = Pasien::count();
        $currentYear = date('Y');
        $currentMonth = date('m');
        $noRM = $currentYear . $currentMonth . '-' . sprintf('%04d', $lastPasien + 1);

        return $noRM;
    }
}
