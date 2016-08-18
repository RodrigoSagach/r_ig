<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $owner = new \App\User();
        $owner->is_admin  = true;
        $owner->username  = 'system';
        $owner->name      = 'System';
        $owner->last_name = 'Owner';
        $owner->email     = 'system@example.com';
        $owner->password  = bcrypt('system');
        $owner->confirmed = true;
        $owner->save();
    }
}
