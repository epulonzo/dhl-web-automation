<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Incident extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category',
        'priority',
        'status',
        'tracking_number',
        'assigned_to',
        'attachment',
        'ai_summary',
        'ai_suggested_category',
        'ai_suggested_priority',
        'ai_raw_response',
    ];

    protected $casts = [
        'ai_raw_response' => 'array',
    ];

    public function assignedStaff(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
