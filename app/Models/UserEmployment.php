<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEmployment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'job_title',
        'start_date',
        'end_date'
    ];
}
