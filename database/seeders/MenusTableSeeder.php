<?php

<<<<<<< HEAD
=======
namespace Database\Seeders;

>>>>>>> 9255f34eb3a8438052ab1e1977cc90d747756179
use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Menu;

class MenusTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        Menu::firstOrCreate([
            'name' => 'admin',
        ]);
    }
}
