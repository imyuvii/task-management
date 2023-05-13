<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attachment extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'note_id',
        'name'
    ];

    protected $appends = [
        'path',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $hidden = [
        'deleted_at',
    ];

    public function getPathAttribute()
    {
        return asset(env('ATTACHMENT_DIR_NAME', 'attachments'). '/' . $this->name);
    }
}
