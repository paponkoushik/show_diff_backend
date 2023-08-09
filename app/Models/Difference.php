<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Difference extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_id',
        'user_id',
        'before_body_content',
        'before_tags_content',
        'after_body_content',
        'after_tags_content',
    ];
}
