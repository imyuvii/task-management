<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'tasks';

    protected $appends = [
        'status_label',
        'priority_label',
    ];

    protected $dates = [
        'start_date',
        'end_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $orderable = [
        'id',
        'subject',
        'description',
        'start_date',
        'end_date',
        'status',
        'priority',
    ];

    protected $filterable = [
        'id',
        'subject',
        'description',
        'start_date',
        'end_date',
        'status',
        'priority',
    ];

    protected $fillable = [
        'subject',
        'description',
        'start_date',
        'end_date',
        'status',
        'priority',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const PRIORITY_SELECT = [
        [
            'label' => 'High',
            'value' => 'High',
        ],
        [
            'label' => 'Medium',
            'value' => 'Medium',
        ],
        [
            'label' => 'Low',
            'value' => 'Low',
        ],
    ];

    public const STATUS_SELECT = [
        [
            'label' => 'New',
            'value' => 'New',
        ],
        [
            'label' => 'Incomplete',
            'value' => 'Incomplete',
        ],
        [
            'label' => 'Complete',
            'value' => 'Complete',
        ],
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getStartDateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.date_format')) : null;
    }

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = $value ? Carbon::createFromFormat(config('project.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getEndDateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.date_format')) : null;
    }

    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = $value ? Carbon::createFromFormat(config('project.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getStatusLabelAttribute()
    {
        return collect(static::STATUS_SELECT)->firstWhere('value', $this->status)['label'] ?? '';
    }

    public function getPriorityLabelAttribute()
    {
        return collect(static::PRIORITY_SELECT)->firstWhere('value', $this->priority)['label'] ?? '';
    }
}
