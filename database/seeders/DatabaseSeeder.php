<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Category;
use App\Models\Commune;
use App\Models\PaymentMethod;
use App\Models\Playlist;
use App\Models\Region;
use App\Models\Video;
use App\Models\Feedback;
use App\Models\PlaylistVideo;
use App\Models\UserPlaylist;
use App\Models\UserType;
use App\Models\User;
use App\Models\Donation;
use App\Models\VideoCategory;
use App\Models\UserVideo;
use App\Models\UserSubscription;
use App\Models\Commentary;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Country::factory(10)->create();
        Category::factory(15)->create();
        PaymentMethod::factory(10)->create();
        Playlist::factory(15)->create();
        Region::factory(10)->create();
        Commune::factory(10)->create();
        UserType::factory(2)->create();
        User::factory(20)->create();
        Video::factory(10)->create();
        Feedback::factory(10)->create();
        PlaylistVideo::factory(10)->create();
        VideoCategory::factory(20)->create();
        Donation::factory(10)->create();
        UserPlaylist::factory(10)->create();
        Commentary::factory(10)->create();
        UserVideo::factory(10)->create();
        UserSubscription::factory(10)->create();
        DB::table('user_types')->insert([
            'nombre_tipo_usuario' => 'admin',
            'descripcion_tipo_usuario' => 'Administrador del sitio',
        ]);
        DB::table('users')->insert([
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'fecha_nacimiento' => '1900-01-01',
            'monedero' => '5000',
            'email' => 'soyadmin@cheems.com',
            'id_comuna' => 1,
            'id_tipo_usuario' => 3,
        ]);
    }

    
}
