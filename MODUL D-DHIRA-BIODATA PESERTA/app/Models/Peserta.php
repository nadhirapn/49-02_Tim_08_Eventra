<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    protected $table = "peserta";
    public $timestamps = false;
    protected $fillable = ["nama", "nim", "instansi", "no_kontak", "email", "user_id"];
}
