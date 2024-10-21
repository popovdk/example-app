<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use SergiX44\Nutgram\Nutgram;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $bot = new Nutgram(env('TG_VERIFY_BOT_TOKEN'));

        $bot->onText('.*', function (Nutgram $bot) {
            $bot->sendMessage($bot->message()->chat->id);
        });

        $bot->run();
    }
}
