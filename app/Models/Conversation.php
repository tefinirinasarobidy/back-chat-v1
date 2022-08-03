<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Conversation extends Model
{
    use HasFactory,Uuids;
    protected $guarded = [];
    public $incrementing = false;
    protected $primaryKey = "id";

    protected $keyType = "string";

    public function message()
    {
        return $this->hasMany(Message::class,'conversation_id');
    }
    public function membres()
    {
        return $this->hasMany(MembreConversation::class,'conversation_id');
    }
    public function last_message()
    {
        return $this->hasOne(Message::class,'conversation_id')->orderBy('created_at','desc');
    }
    public function talked()
    {
        return $this->hasOne(MembreConversation::class,'conversation_id')->with('customer.active_profile.media')->where('customer_id','!=',Auth::id());
    }
}
