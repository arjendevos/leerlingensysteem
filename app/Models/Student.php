<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';
    public $timestamps = true;
    protected $fillable = [
        'name', 'street', 'postcode', 'city', 'country', 'education_id', 'class_id'
    ];

    public function education()
    {
        return $this->belongsTo(Education::class);
    }

    public function classes()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function results()
    {
        return $this->hasMany(Results::class);
    }

    public function user()
    {
        return $this->hasOne(User::class, 'student_id');
    }
}
