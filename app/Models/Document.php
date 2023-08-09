<?php

namespace App\Models;

use App\Enums\DocumentStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'current_version',
        'status'
    ];

    protected $casts = [
//        'status' => DocumentStatusEnum::class,
    ];

    public function users( ): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'document_users', 'document_id','user_id')
            ->using(DocumentUser::class)
            ->withPivot( 'id', 'last_viewed_version');
    }

    public function documentVersions(): HasMany
    {
        return $this->hasMany( DocumentVersion::class );
    }
}
