<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();

        $room = new \App\Models\Room();
        $room->name = '7400';
        $room->detail = 'Room of computer technology.';
        $room->published = 1;
        $room->save();

        $room_type = new \App\Models\RoomType();
        $room_type->name = 'เรียน';
        $room_type->save();

        $room_type = new \App\Models\RoomType();
        $room_type->name = 'อินเตอร์เน็ต/พิมพ์งาน';
        $room_type->save();

    }
}
