<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Incident;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@dhl.com',
            'password' => Hash::make('password'),
            'role' => 'Admin',
        ]);

        // Create Support Staff
        User::factory()->create([
            'name' => 'Support Staff',
            'email' => 'support@dhl.com',
            'password' => Hash::make('password'),
            'role' => 'Support Staff',
        ]);

        // Create Manager
        User::factory()->create([
            'name' => 'Manager User',
            'email' => 'manager@dhl.com',
            'password' => Hash::make('password'),
            'role' => 'Manager',
        ]);

        // Create sample incidents for Phase 1
        Incident::create([
            'title' => 'Damaged package in transit',
            'description' => 'The package with tracking number DHL123456 was received with a large hole in the box and the contents are broken.',
            'category' => 'Damaged Parcel',
            'priority' => 'Critical',
            'status' => 'New',
            'tracking_number' => 'DHL123456',
        ]);

        Incident::create([
            'title' => 'Delay in Frankfurt Hub',
            'description' => 'My shipment has been stuck in Frankfurt for 4 days without any update. It was supposed to be delivered yesterday.',
            'category' => 'Late Delivery',
            'priority' => 'High',
            'status' => 'In Progress',
            'tracking_number' => 'DHL987654',
        ]);

        Incident::create([
            'title' => 'Missing Parcel - APAC Region',
            'description' => 'A high-value parcel sent from Singapore to Sydney has disappeared from the tracking system after reaching the hub.',
            'category' => 'Missing Parcel',
            'priority' => 'Medium',
            'status' => 'Assigned',
            'tracking_number' => 'DHL112233',
        ]);
    }
}
