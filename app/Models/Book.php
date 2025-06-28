<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /**
     * fillable
     * 
     * @var array
     */
    use HasFactory;
    protected $table = 'book';

    protected $fillable = [
        'title',
        'pengarang',
        'tanggal_terbit'
    ];
}
