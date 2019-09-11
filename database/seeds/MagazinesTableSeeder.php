<?php

use App\Magazine;
use Illuminate\Database\Seeder;

class MagazinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Magazine::class, 30)->create();
    }
}
