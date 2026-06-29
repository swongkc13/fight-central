<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Fighter;
use App\Services\OctagonApi;

class SyncOctagonFighters extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-fighters';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync fighters from the Octagon API into the local database';

    /**
     * Execute the console command.
     */
    public function handle(OctagonApi $octagonApi): int
    {
        $fighters = $octagonApi->fighters();

        foreach ($fighters as $externalId => $fighter) {
            Fighter::updateOrCreate(
                ['external_id' => $externalId],
                [
                    'name' => $fighter['name'] ?? 'Unknown',
                    'nickname' => $fighter['nickname'] ?? null,
                    'division' => $fighter['category'] ?? null,
                    'category' => $fighter['category'] ?? null,
                    'record' => sprintf(
                        '%s-%s-%s',
                        $fighter['wins'] ?? 0,
                        $fighter['losses'] ?? 0,
                        $fighter['draws'] ?? 0,
                    ),
                    'wins' => $fighter['wins'] ?? null,
                    'losses' => $fighter['losses'] ?? null,
                    'draws' => $fighter['draws'] ?? null,
                    'status' => $fighter['status'] ?? null,
                    'img_url' => $fighter['imgUrl'] ?? null,
                    'api_synced_at' => now(),
                ]
            );
        }

        $this->info('Synced ' . count($fighters) . ' fighters from the Octagon API.');

        return self::SUCCESS;
    }
}
