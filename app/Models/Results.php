<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Results extends Model
{
    use HasFactory;

    protected $table = 'results';
    public $timestamps = true;
    protected $fillable = [
        'result', 'student_id', 'subject_id'
    ];

    public function subject()
    {
        return $this->belongsTo(Subjects::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
