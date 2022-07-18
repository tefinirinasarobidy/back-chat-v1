<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customers extends Authenticatable
{
    use HasFactory,Uuids,Notifiable,HasApiTokens;

    protected $guarded = [];
    public $incrementing = false;
    protected $primaryKey = "id";

    protected $keyType = "string";

    public function profile()
    {
        return $this->morphMany(Profile::class,'profilable');
    }
    public function active_profile()
    {
        return $this->morphOne(Profile::class,'profilable')->where('status',1);
    }
}