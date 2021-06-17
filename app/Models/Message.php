<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    use Compoships;

    public function user() {
        return $this->belongsTo("App\Models\User", "fromId", "id");
    }
}
