<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Aqui se define el orden de ejecucion de los seeders
         $this->call(WalletTableSeeder::class);
         $this->call(TransferTableSeeder::class);
    }
}
