<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Option;
use Eloquent;
use DB;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        DB::table('options')->truncate();

        Option::create([
            'company_id' => 0,
            'category' => 'job',
            'title' => 'Job 1',
            'value' => 'job_1'
        ]);

        Option::create([
            'company_id' => 0,
            'category' => 'job',
            'title' => 'Job 2',
            'value' => 'job_2'
        ]);

        Option::create([
            'company_id' => 0,
            'category' => 'job',
            'title' => 'Job 3',
            'value' => 'job_3'
        ]);
         
        Option::create([
            'company_id' => 0,
            'category' => 'duty',
            'title' => 'Duty 1',
            'value' => 'duty_1'
        ]);

        Option::create([
            'company_id' => 0,
            'category' => 'duty',
            'title' => 'Duty 2',
            'value' => 'duty_2'
        ]);

        Option::create([
            'company_id' => 0,
            'category' => 'duty',
            'title' => 'Duty 3',
            'value' => 'duty_3'
        ]);

        Eloquent::reguard();
    }
}