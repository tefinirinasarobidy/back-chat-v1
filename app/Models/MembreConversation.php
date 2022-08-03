<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembreConversation extends Model
{
    use HasFactory,Uuids;
    protected $guarded = [];
    public $incrementing = false;
    protected $primaryKey = "id";

    protected $keyType = "string";

    public function conversation()
    {
        return $this->belongsTo(Conversation::class,'conversation_id');
    }
    public function customer()
    {
       return $this->belongsTo(Customers::class,'customer_id');
    }
}
