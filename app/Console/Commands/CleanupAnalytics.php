<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\UserAnalytics;
use Carbon\Carbon;

class CleanupAnalytics extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'analytics:cleanup {--days=365 : Number of days to keep data}';

    /**
     * The console command description.
     */
    protected $description = 'Clean up old analytics data older than specified days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $days = $this->option('days');
        $cutoffDate = Carbon::now()->subDays($days);

        $this->info("Suppression des données analytics antérieures au : {$cutoffDate->format('Y-m-d H:i:s')}");

        $deletedCount = UserAnalytics::where('created_at', '<', $cutoffDate)->delete();

        $this->info("✅ {$deletedCount} enregistrements supprimés avec succès.");

        // Optionnel: Statistiques après nettoyage
        $remainingCount = UserAnalytics::count();
        $this->info("📊 {$remainingCount} enregistrements conservés.");

        return 0;
    }
}
