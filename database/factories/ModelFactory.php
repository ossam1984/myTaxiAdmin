<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'phone' => $faker->phoneNumber,
        //'owner_id' => $faker->unique()->randomNumber(3),
        //'owner_type' => $faker->randomElement(["App\\Customer","App\\Driver"]),
        'gender' => $faker->randomElement([1,2]),
        'email' => $faker->unique()->email,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'dev_id' => $faker->randomNumber(8),
        'dev_token' => $faker->realText(20),


    ];
});

// Temp User
$factory->define(App\TmpUser::class,function (Faker\Generator $faker){
	return [
		'phone' => $faker->phoneNumber,
		'dev_id' => $faker->randomNumber(8),
		'code' => $faker->randomNumber(4),
		'last_name' => $faker->lastName,
		'first_name' => $faker->firstName,
		'email' => $faker->email,
		'dev_token' => $faker->windowsPlatformToken,
		'end_time' => \Carbon\Carbon::now()->addDays(7),
        'gender' => $faker->randomElements([1,2]),

    ];

});


//factory(\Staff::class,1)
//    ->create()
//    ->each(function($staff)
//    {
//        $staff
//            ->userable()
//            ->save(
//                factory(\User::class)
//                    ->create()
//            );
//    });

// Real User
$factory->define(App\AppUser::class,function (Faker\Generator $faker){
	return [
		'first_name' => $faker->name,
		'last_name' => $faker->name,
		'email' => $faker->safeEmail,
		'phone' => $faker->randomNumber(9),
		'dev_id' => $faker->randomNumber(8),
		'dev_token' => $faker->randomNumber(8),

	];

});


// Customer User
$factory->define(App\Customer::class,function (Faker\Generator $faker){
	return [
		'name' => $faker->name,
        'image' => $faker->address. $faker->fileExtension,
	];

});

// Driver User
$factory->define(App\Driver::class,function (Faker\Generator $faker){
	return [
	    'name' => $faker->name,
		'driver_licence_no' => $faker->phoneNumber,
        'dev_id' => $faker->randomNumber(8),
        //'driver_licence_expire_date' => $faker->name,
        'image' => $faker->address. $faker->fileExtension,
    ];

});

// Order Factory

$factory->define(App\Order::class,function (Faker\Generator $faker){
	return [
		'place_from_name' => $faker->streetAddress,
		'place_to_name' => $faker->streetAddress,
		'place_from_lat' => $faker->latitude,
		'place_from_lng' => $faker->longitude,
		'place_to_lat' => $faker->latitude,
		'place_to_lng' => $faker->longitude,
		// 'place_to_lng' => $faker->name,
		'distance_m' => $faker->randomNumber(4),
		'distance_k' => (string)$faker->randomNumber(1),
		'price_total' => $faker->randomNumber(3),
		'price_distance_k_first' => $faker->randomNumber(2),
		'price_first' => $faker->randomNumber(2),
		'price_galon' => $faker->randomNumber(5),
		'steps' => $faker->paragraph(10),
		'st'=> $faker->randomElement(['Created','Canceled', 'Unverified']),
        'dev_id' => $faker->randomNumber(8),

        'app_user_id'=> $faker->randomElement(\App\User::all()->pluck('id')->toArray()) ,
        'order_type_id'=> $faker->randomElement(\App\OrderType::all()->pluck('id')->toArray()) ,
		'transportation_id'=> $faker->randomElement(\App\Transportation::all()->pluck('id')->toArray()),

	];

});


// Order Type
$factory->define(App\OrderType::class,function (Faker\Generator $faker){
	return [
		'name'=>$faker->name
	];

});


// Transportation

$factory->define(App\Transportation::class,function (Faker\Generator $faker){
	return [
		'name'=>'taxi'
	];

});

// Setting Panel

$factory->define(App\Setting::class,function (Faker\Generator $faker){
	return [
		'name'=> $faker->name,
		'name_id'=> $faker->randomNumber(2),
		'value'=> $faker->randomNumber(2),
		'type'=> $faker->name,
	];

});