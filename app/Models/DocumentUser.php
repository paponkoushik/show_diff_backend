<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class DocumentUser extends Pivot
{
    use HasFactory;

    protected $table = 'document_users';

    protected $fillable = [
        'document_id',
        'user_id',
        'last_viewed_version',
    ];
}
