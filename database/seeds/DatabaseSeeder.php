<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    private $roles = [
        ["Admin","All Access"],
        ["Editor","Add Match, add / edit bet options & site setting."],
        ["Moderator","NOT DEFINED YET"],
        ["Club Owner","Club Owner Page Access"]
    ];
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        foreach ($this->roles as $role) {
            # code...
            DB::table('roles')->insert([
                'name' => $role[0],
                'description' => $role[1]
            ]);
        }

        DB::table('users')->insert([
            'name' => 'Super Admin',
            'email' => 'super@worldbet365.org',
            'password' => Hash::make("55332211Ou"),
            'email_verified_at' => Carbon::now()
        ]);

        foreach ($this->roles as $key => $role) {
            # code...
            DB::table('role_user')->insert([
                'user_id' => 1,
                'role_id' => $key += 1
            ]);
        }

        DB::table('users')->insert([
            'name' => 'Site Editor',
            'email' => 'editor@worldbet365.org',
            'password' => Hash::make("Bet365@editor"),
            'email_verified_at' => Carbon::now()
        ]);

        DB::table('role_user')->insert([
            'user_id' => 2,
            'role_id' => 2
        ]);

        DB::table('users')->insert([
            'name' => 'Site Moderator',
            'email' => 'moderator@worldbet365.org',
            'password' => Hash::make("mrModerator365"),
            'email_verified_at' => Carbon::now()
        ]);

        DB::table('role_user')->insert([
            'user_id' => 3,
            'role_id' => 3
        ]);

        DB::table('site_settings')->insert([
            'betting' => false,
            'backend_number' => '01306606612'
        ]);
    }
}
