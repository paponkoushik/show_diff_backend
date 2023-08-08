<?php

namespace App\Models;

use App\Enums\DocumentStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'current_version',
        'status'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
//        'status' => DocumentStatusEnum::class,
    ];

    public function users( ): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'document_users', 'document_id','user_id')
            ->using(DocumentUser::class)
            ->withPivot( 'id', 'last_viewed_version');
    }
}
