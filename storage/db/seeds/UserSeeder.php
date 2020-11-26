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

        $data =             [
            'firstname' => $faker->firstName,
            'lastname' => $faker->lastName,
            'email' => "test_user@test.com",
            'apps_id' => 1,
            'leads_owner_id' => 1,
            'companies_id' => 1,
            'companies_branch_id' => 1,
            'users_id' => 1,
            'is_active' => 1,
            'system_modules_id' => 1,
            'created_at' => date('Y-m-d H:m:s'),
            'is_deleted' => 0,
        ];

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}
