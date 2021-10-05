<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $table = 'education';
    public $timestamps = true;
    protected $fillable = [
        'name',
    ];

    public function student()
    {
        return $this->hasMany(Student::class);
    }
}
