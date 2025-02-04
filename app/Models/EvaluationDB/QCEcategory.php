<?php

namespace App\Models\EvaluationDB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QCEcategory extends Model
{
    use HasFactory;

    protected $table = 'qcecategory';

    protected $fillable = [
        'catName', 
        'postedBy',
    ];
}
