<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHistory extends Model
{
    protected $fillable = [
        'user_name',
        'history_change_type',
        'history_change',
        'created_at',
        'updated_at'
    ];
}
