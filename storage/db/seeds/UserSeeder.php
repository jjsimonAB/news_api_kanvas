<?php

use Phalcon\Security\Random;
use Faker\Factory;
use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run()
    {

        $faker = Factory::create();
        $random = new Random();

        $data = [
            [
                'user_activation_email' => $random->uuid(),
                'email' => "test_user@test.com",
                'password' => password_hash('bakatest123567', PASSWORD_DEFAULT),
                'firstname' => 'test1',
                'lastname' => 'user',
                'default_company' => 1,
                'displayname' => 'anonymouss' . rand(1, 100000),
                'system_modules_id' => 2,
                'user_last_login_try' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'registered' => date('Y-m-d H:i:s'),
                'lastvisit' => date('Y-m-d H:i:s'),
                'user_active' => 1,
                'user_level' => 1,
                'dob' => date('Y-m-d'),
                'sex' => 'M',
                'user_login_tries' => 0,
                'is_deleted' => 0
            ]
        ];

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}
