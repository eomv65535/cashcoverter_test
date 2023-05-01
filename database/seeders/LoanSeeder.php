<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Loan;
use Illuminate\Database\Seeder;

class LoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $loan = new Loan();
            $loan->client_id =  rand(1, 65534);
            $loan->amount = rand(1000, 10000) / 100;
            $loan->instalments = rand(6, 36);
            $loan->int_rate = rand(5, 20) / 100;
            $loan->start_date = now()->subDays(rand(1, 365));
            $loan->save();
        }
    }
}
