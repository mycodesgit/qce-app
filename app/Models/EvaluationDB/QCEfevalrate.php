<?php

namespace App\Models\EvaluationDB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QCEfevalrate extends Model
{
    use HasFactory;

    protected $table = 'qceformevalrate';

    protected $fillable = [
        'qceschlyearsemID', 
        'schlyear',
        'semester',
        'ratingfromto',
        'qcefacID',
        'qcefacname',
        'qceevaluator',
        'question',
        'question_rate',
        'qcecomments',
        'evaluatorname',
        'evaluatorID'
    ];
}
