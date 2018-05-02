<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FakeInvoicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customers_count = 5;
        $vendors_count = 3;
        $categories_count = 3;
        $invoices_count = 20;

        factory(\App\Models\Customer::class, $customers_count)->create();
        factory(\App\Models\Vendor::class, $vendors_count)->create();
        factory(\App\Models\InvoiceCategory::class, $categories_count)->create();

        DB::table('invoice_statuses')->insert([
            ['name' => 'opened'],
            ['name' => 'closed']
        ]);

        foreach (range(1, $invoices_count) as $index) {
            \App\Models\Invoice::create([
                'vendor_id' => rand(1, $vendors_count),
                'customer_id' => rand(1, $customers_count),
                'category_id' => rand(1, $categories_count),
                'status_id' => rand(1, 2),
                'price' => number_format(rand(1, 100000) / 100, 2)
            ]);
        }
    }
}