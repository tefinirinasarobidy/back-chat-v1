<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class Customers extends Authenticatable
{
    use HasFactory,Uuids,Notifiable,HasApiTokens;

    protected $guarded = [];
    public $incrementing = false;
    protected $primaryKey = "id";

    protected $keyType = "string";

    protected $appends = [
        'convExist'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function profile()
    {
        return $this->morphMany(Profile::class,'profilable');
    }
    public function active_profile()
    {
        return $this->morphOne(Profile::class,'profilable')->where('status',1);
    }

    public function message()
    {
        return $this->hasMany(Message::class,'customer_id');
    }

    public function membres()
    {
        return $this->hasMany(MembreConversation::class,'customer_id');
    }

    public function getConvExistAttribute()
    {
        $conversation = Conversation::wherehas('membres', function ($query){
            $query->where('customer_id',$this->id);
        })->whereHas('membres', function ($query) {
            $query->where('customer_id',Auth::id());
        })->first();

        return $conversation? $conversation : null;
    }
}
