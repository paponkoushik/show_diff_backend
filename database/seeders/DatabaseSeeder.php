<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Document;
use App\Models\DocumentUser;
use App\Models\DocumentVersion;
use App\Models\User;
use App\Models\Version;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         User::factory(300)->create();

         Version::factory(2)->create()->each(function ($version) {
             Document::factory(250)->create(['current_version' => $version->id])
                 ->each(function($document) use ($version) {
                     DocumentVersion::factory(5)->create(['version' => $version->id]);
                 });

         });

//         DocumentVersion::factory(2500)->create();
         DocumentUser::factory(8400)->create();



//        User::factory(1)->create();
//        Version::factory(3)->create();
//        Document::factory(3)->create();
//        DocumentVersion::factory(5)->create();
//        DocumentUser::factory(5)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
