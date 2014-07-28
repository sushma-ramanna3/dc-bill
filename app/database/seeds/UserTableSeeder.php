<?php

class UserTableSeeder extends Seeder
{

	public function run()
	{
		DB::table('users')->delete();
		User::create(array(
			'first_name'     => 'franchise',
			'last_name'     => 'blore',
			//'usertype' => 'franchise',
			'email'    => 'sushma.ramanna@finitiatives.com',
			'password' => Hash::make('1234'),
			'location' => Hash::make('Bangalore'),
			'phone' => Hash::make('1234567890'),
			'created_at' => new DateTime,
			'updated_at' => new DateTime
		));
	}

}