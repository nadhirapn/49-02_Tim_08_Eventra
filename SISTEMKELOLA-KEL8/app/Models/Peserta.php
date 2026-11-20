<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    protected $table = "peserta";
    protected $fillable = ["nama", "nim", "instansi", "no_kontak", "email", "user_id"];

public function user()
{
    return $this->belongsTo(User::class);
}
}