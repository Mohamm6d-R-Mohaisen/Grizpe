<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Spatie\Permission\Models\Permission as SpatieRole;

class Permission extends SpatieRole
{
    use HasFactory;
}
