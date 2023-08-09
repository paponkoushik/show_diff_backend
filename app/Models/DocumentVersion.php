<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DocumentVersion extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_id',
        'version',
        'body_content',
        'tags_content'
    ];

    protected $casts = [
        'body_content' => 'array'
    ];

    public function document(): BelongsTo {
        return $this->belongsTo(Document::class);
    }
}
