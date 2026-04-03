<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
    ];

    /**
     * Available task statuses with human-readable labels.
     */
    public const STATUSES = [
        'new'         => 'New',
        'in_progress' => 'In Progress',
        'completed'   => 'Completed',
    ];

    /**
     * Returns the human-readable label for the current status.
     */
    public function statusLabel(): string
    {
        return self::STATUSES[$this->status] ?? ucfirst($this->status);
    }
}
