<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Casts\Attribute;

class UserModel extends Authenticatable implements JWTSubject
{
    public function getJWTIdentifier(){
        return $this->getkey();
    }
        public function getJWTCustomClaims(){
        return [];
    }

    protected $table = 'm_user'; //Mendefinisikan nama tabel yang digunakan oleh model ini
    protected $primaryKey = 'user_id'; //Mendefiniskan primary key dari tabel yang digunakan
    protected $fillable = [
        'username',
        'nama',
        'password',
        'level_id',
        'image'//tambahan
    ];

    public function level(): BelongsTo{
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }
    
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn($image) => url('/storage/posts/' . $image),
        );
    }

    /**protected $table = 'm_user'; //Mendefinisikan nama tabel yang digunakan oleh model ini
    protected $primaryKey = 'user_id'; //Mendefiniskan primary key dari tabel yang digunakan
    protected $fillable = ['username','password','nama','level_id', 'created_at', 'updated_at'];
    protected $hidden = ['password'];
    protected $casts=  ['password'=> 'hashed'];**/


    /**public function getRoleName(): string{
        return $this->level->level_nama;
    }
    public function hasRole($role): bool{
        return $this->level->level_kode == $role;
    }
    public function getRole(){
        return $this->level->level_kode;
    }**/
}