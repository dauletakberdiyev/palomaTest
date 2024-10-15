<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class Place extends Model
{
    protected $table = 'places';
    protected $primaryKey = 'id';
    public $timestamps = 'false';
    protected $fillable = [
        'title'
    ];
}
