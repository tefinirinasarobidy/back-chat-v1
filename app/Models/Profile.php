<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory, Uuids;
    protected $guarded = [];
    public $incrementing = false;
    protected $primaryKey = "id";

    protected $keyType = "string";

    public function media()
    {
        return $this->morphOne(Media::class,'mediable');
    }

    public function profilable()
    {
        return $this->morphTo();
    }
}
