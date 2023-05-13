<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'notes';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $orderable = [
        'id',
        'subject',
        'note',
        'task.subject',
    ];

    protected $filterable = [
        'id',
        'subject',
        'note',
        'task.subject',
    ];

    protected $fillable = [
        'subject',
        'note',
        'task_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $hidden = [
        'deleted_at',
    ];

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }
}
