<?php

namespace App\Models\EvaluationDB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QCEinstruction extends Model
{
    use HasFactory;

    protected $table = 'qceinstruction';

    protected $fillable = [
        'inst_scale', 
        'inst_descRating',
        'inst_qualDescription',
        'postedBy',
    ];
}
