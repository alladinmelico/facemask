<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Like extends Pivot
{
    use HasFactory;
    public $incrementing = true;
}