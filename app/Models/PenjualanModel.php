<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

class PenjualanModel extends Model
{
    use HasFactory;
    // Mendefinisikan nama tabel dan primary key
    protected $table = 't_penjualan'; // Nama tabel
    protected $primaryKey = 'penjualan_id'; // Nama primary key

    protected $fillable = [
        'user_id',  
        'pembeli',  
        'penjualan_kode',
        'penjualan_tanggal',
        'image'
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'user_id');
    }

    // Relasi ke PenjualanDetailModel
    public function details()
    {
        return $this->hasMany(PenjualanDetailModel::class, 'penjualan_id', 'penjualan_id');
    }

    public function image(): Attribute
    {
        return Attribute::make(
            get: fn($image) => url('/storage/posts/' . $image),
        );
    }
}
