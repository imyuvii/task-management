<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Note extends Model
{
    use SoftDeletes, InteractsWithMedia, HasFactory;

    public $table = 'notes';

    protected $appends = [
        'attachment',
    ];

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

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getAttachmentAttribute()
    {
        return $this->getMedia('note_attachment')->map(function ($item) {
            $media        = $item->toArray();
            $media['url'] = $item->getUrl();

            return $media;
        });
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
