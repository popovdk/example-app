<?php

namespace App\Console\Commands;

use App\Models\News;
use App\Package\NewsVendor\NewsVendor;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ImportNewsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-news';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command import news';

    const BATCH_SIZE = 10;

    /**
     * Execute the console command.
     */
    public function handle(NewsVendor $newsVendor)
    {
        $q = $newsVendor->paginateList('tesla');

        $batch = [];

        foreach ($q as $news) {
            $batch[] = [
                'title' => $news->getTitle(),
                'description' => $news->getDescription(),
                'content' => $news->getContent(),
                'source' => $news->getSource(),
                'preview_url' => $news->getPreviewUrl(),
                'published_at' => Carbon::parse($news->getPublishedAt()),
                'url' => $news->getUrl(),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if (count($batch) == self::BATCH_SIZE) {
                News::insert($batch);
                $this->info('Inserted ' . count($batch) . ' records');
                $batch = [];
            }
        }
    }
}
