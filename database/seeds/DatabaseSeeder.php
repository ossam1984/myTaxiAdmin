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
        // $this->call(UsersTableSeeder::class);
        Eloquent::unguard();
        App\User::create([
            'first_name' => "Aiman",
            'last_name' => "Noman",
            'phone' => "773393905",
            'owner_id' => 1,
            'owner_type' => "Driver",
            'gender' => 1,
            'email' => "Aiman@gmail.com",
            'password' => bcrypt('secret'),
        ]);

        $path = 'app/taxi.sql';
        DB::unprepared(file_get_contents($path));

        factory(App\Transportation::class)->create();
        factory(App\OrderType::class, 2)->create();
        factory(App\Order::class, 500)->create();

        factory(App\Customer::class, 500)
            ->create()
            ->each(function ($c) {
                $c
                    ->user()
                    ->save(
                        factory(App\User::class)
                            ->create([
                                "first_name" => explode(' ',trim($c->name))[0],
                                "last_name" => explode(' ',trim($c->name))[1],
                                "owner_id" => $c->id,
                                "owner_type" => "App\\Customer",
                            ])
                    );
            });
        factory(App\Driver::class, 50)
            ->create()
            ->each(function ($d) {
                $d
                    ->user()
                    ->save(
                        factory(App\User::class)
                            ->create([
                                "first_name" => explode(' ',trim($d->name))[0],
                                "last_name" => explode(' ',trim($d->name))[1],
                                "dev_id" => $d->dev_id,
                                "owner_id" => $d->id,
                                "owner_type" => "App\\Driver",
                            ])
                    );
            });

        factory(App\Driver::class, 50)
            ->create()
            ->each(function ($d) {
                $d
                    ->user()
                    ->save(
                        factory(App\User::class)
                            ->create([
                                "first_name" => explode(' ',trim($d->name))[0],
                                "last_name" => explode(' ',trim($d->name))[1],
                                "dev_id" => $d->dev_id,
                                "owner_id" => $d->id,
                                "owner_type" => "App\\Driver",
                            ])
                    );
            });


        //factory(App\User::class, 10)->create();


        //Eloquent::guard();


    }
}
