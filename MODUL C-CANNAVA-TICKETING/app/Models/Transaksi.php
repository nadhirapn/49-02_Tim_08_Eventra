<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'tiket_id', 'jumlah_beli', 'total_harga'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function tiket() {
        return $this->belongsTo(Tiket::class, 'tiket_id', 'id_tiket');
    }
}