<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Job extends Model
{
    use HasFactory;

    protected $table = 'job_listings';

    protected $fillable = ['employer_id', 'title', 'salary'];
    //protected $guarded = []; // Opción alternativa para proteger los campos que no se pueden asignar en masa

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, relatedPivotKey: 'job_listing_id');
    }
}
