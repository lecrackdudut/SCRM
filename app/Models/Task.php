<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'status', 'score'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'status' => Status::class,
    ];

    public function backlog()
    {
        return $this->belongsTo(Backlog::class);
    }

    public function sprint()
    {
        return $this->belongsTo(Sprint::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, "user_id");
    }
}
