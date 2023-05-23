<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    // slug e immagine così non saranno mai aggiornate
    protected $guarded = ['slug', 'image'];
}
