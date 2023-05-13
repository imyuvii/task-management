<?php

namespace Database\Seeders;

use App\Models\Attachment;
use App\Models\Note;
use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        $attachment_dir = env('ATTACHMENT_DIR_NAME', 'attachments');
        if (!file_exists(storage_path("app/public/$attachment_dir"))) {
            mkdir(storage_path("app/public/$attachment_dir"));
        }
        Task::factory()->count(10)->create()
            ->each(function ($task) use ($faker, $attachment_dir) {
                $notes_count = rand(0, 4);
                for ($i = 0; $i < $notes_count; $i++) {
                    $note_id = Note::create([
                        'subject' => $faker->sentence(4),
                        'note' => $faker->paragraph(4),
                        'task_id' => $task->id,
                    ])->id;
                    $attachment_count = rand(0, 2);
                    for($j = 0; $j < $attachment_count; $j++) {
                        $filename = $faker->file(resource_path('/pdf'), "storage/app/public/$attachment_dir", false);
                        Attachment::create([
                            'note_id' => $note_id,
                            'name' => $filename,
                        ]);
                    }
                }
            });
    }
}
