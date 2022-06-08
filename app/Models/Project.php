<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function backlog()
    {
        return $this->hasOne(Backlog::class);
    }

    public function sprints()
    {
        return $this->hasMany(Sprint::class);
    }

    public function memberships()
    {
        return $this->hasMany(ProjectMember::class);
    }
}
