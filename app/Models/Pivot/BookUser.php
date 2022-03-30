<?php

namespace App\Models\Pivot;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property string $status
 */
class BookUser extends Pivot
{
    public static array $statuses = [
        'WANT_TO_READ' => 'Want to read',
        'READING' => 'Reading',
        'READ' => 'Read',
    ];
    public function getActionAttribute(): string
    {
        return match ($this->status) {
            'WANT_TO_READ' => 'wants to read',
            'READING' => 'is reading',
            'READ' => 'has read',
        };
    }
}
