<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            [
                'name' => 'Alice Johnson',
                'email' => 'alice@example.com',
                'phone' => '01711000001',
                'address' => '123 Main St, Cityville',
            ],
            [
                'name' => 'Robert Smith',
                'email' => 'robert@example.com',
                'phone' => '01711000002',
                'address' => '456 Elm St, Townsville',
            ],
            [
                'name' => 'Sophia Davis',
                'email' => 'sophia@example.com',
                'phone' => '01711000003',
                'address' => '789 Oak St, Villageville',
            ],
            [
                'name' => 'William Brown',
                'email' => 'william@example.com',
                'phone' => '01711000004',
                'address' => '321 Pine St, Hamletville',
            ],
            [
                'name' => 'Emma Wilson',
                'email' => 'emma@example.com',
                'phone' => '01711000005',
                'address' => '654 Cedar St, Boroughville',
            ],
            [
                'name' => 'James Taylor',
                'email' => 'james@example.com',
                'phone' => '01711000006',
                'address' => '987 Birch St, Metropolis',
            ],
            [
                'name' => 'Olivia Martin',
                'email' => 'olivia@example.com',
                'phone' => '01711000007',
                'address' => '246 Maple St, Capital City',
            ],
            [
                'name' => 'Benjamin Thomas',
                'email' => 'benjamin@example.com',
                'phone' => '01711000008',
                'address' => '135 Spruce St, Suburbia',
            ],
            [
                'name' => 'Charlotte White',
                'email' => 'charlotte@example.com',
                'phone' => '01711000009',
                'address' => '864 Willow St, Countryside',
            ],
            [
                'name' => 'Daniel Harris',
                'email' => 'daniel@example.com',
                'phone' => '01711000010',
                'address' => '579 Poplar St, Riverside',
            ],
            [
                'name' => 'Mia Clark',
                'email' => 'mia@example.com',
                'phone' => '01711000011',
                'address' => '753 Chestnut St, Lakeside',
            ],
            [
                'name' => 'Henry Lewis',
                'email' => 'henry@example.com',
                'phone' => '01711000012',
                'address' => '468 Walnut St, Hilltop',
            ],
            [
                'name' => 'Amelia Walker',
                'email' => 'amelia@example.com',
                'phone' => '01711000013',
                'address' => '357 Fir St, Valleyview',
            ],
            [
                'name' => 'Lucas Hall',
                'email' => 'lucas@example.com',
                'phone' => '01711000014',
                'address' => '246 Redwood St, Mountainview',
            ],
            [
                'name' => 'Grace Allen',
                'email' => 'grace@example.com',
                'phone' => '01711000015',
                'address' => '135 Cypress St, Seaside',
            ],
        ];

        foreach ($customers as $customer) {
            Customer::create($customer);
        }
    }
}
