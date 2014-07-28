<?php

class UserTableSeeder extends Seeder
{

	public function run()
	{
		DB::table('users')->delete();
		User::create(array(
			'first_name'     => 'admin',
			'last_name'     => 'mysore',
			//'usertype' => 'franchise',
			'email'    => 'admin@admin.com',
			'password' => Hash::make('1234'),
			'location' => 'Bangalore',
			'phone' => '1234567890',
			'created_at' => new DateTime,
			'updated_at' => new DateTime
		));
	}

}