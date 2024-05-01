<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Candidate extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'lastName',
        'firstName',
        'email',
        'mobile',
        'degree_id',
        'resume',
        'jobAppliedFor',
        'applicationDate',
    ];

    protected $casts = [
        'applicationDate' => 'datetime',
    ];
    public function degree()
    {

        return $this->belongsTo(Degree::class);
        //        return $this->belongsTo('App\Models\Degree', 'id_degree');
    }
}
