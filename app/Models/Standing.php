<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Standing extends Model
{
    use HasFactory;

    protected $fillable = [
        'pos', 'club', 'logo', 'main', 'menang', 'seri', 'kalah', 'goal', 'selisih', 'poin', 'urutan', 'highlight'
    ];
}
