<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ActivityLog;

class ActivityLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ActivityLog::create([
            'model_type' => 'Dokumen',
            'loa_request_id' => 8,
            'action' => 'created',
            'description' => 'Dokumen LOA baru ditambahkan',
            'created_at' => now(),
        ]);

        ActivityLog::create([
            'model_type' => 'Dokumen',
            'loa_request_id' => 9,
            'action' => 'updated',
            'description' => 'Status dokumen LOA #9 diperbarui menjadi: Approved',
            'created_at' => now()->subMinutes(10),
        ]);
    }
}
