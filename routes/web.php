<?php

    use App\Models\Difference;
    use App\Models\Document;
    use App\Models\DocumentVersion;
    use App\Models\User;
    use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $data = DB::table('users')
        ->join('document_users', 'user_id', '=', 'users.id')
        ->where('users.status', '=', 'active')
        ->join('documents', 'documents.id', '=', 'document_users.document_id')
        ->where('documents.status', '=', 'active')
        ->select(
            'users.id',
            'users.username',
            'document_users.document_id',
            'document_users.last_viewed_version',
            'documents.title',
            'documents.current_version',

        )->get()->filter(function ($item) {
            return $item->last_viewed_version != $item->current_version;
        })->values();

    foreach($data->chunk(100) as $items) {
        foreach ($items as $item) {
            $documentVersion = DB::table('document_versions')
                ->where('document_id', '=', $item->document_id)
                ->whereIn('version', [$item->current_version, $item->last_viewed_version])
                ->select('document_versions.*')
                ->get()->unique('version')->flatten();

            if ($documentVersion[0]->version == $item->last_viewed_version) {
                Difference::query()->create([
                    'document_id' => $item?->document_id,
                    'user_id' => $item?->id,
                    'before_body_content' => $documentVersion[0]?->body_content,
                    'before_tags_content' => $documentVersion[0]?->tags_content,
                    'after_body_content' => $documentVersion[1]?->body_content,
                    'after_tags_content' => $documentVersion[1]?->tags_content,
                ]);
            } else {
                Difference::query()->create([
                    'document_id' => $item?->document_id,
                    'user_id' => $item?->id,
                    'before_body_content' => $documentVersion[1]?->body_content,
                    'before_tags_content' => $documentVersion[1]?->tags_content,
                    'after_body_content' => $documentVersion[0]?->body_content,
                    'after_tags_content' => $documentVersion[0]?->tags_content,
                ]);
            }

        }
    }

    return true;
});
