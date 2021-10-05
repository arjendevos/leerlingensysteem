<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $table = 'classes';
    public $timestamps = true;
    protected $fillable = [
        'class',
    ];

    public function student()
    {
        return $this->hasMany(Student::class, 'class_id');
    }
}
