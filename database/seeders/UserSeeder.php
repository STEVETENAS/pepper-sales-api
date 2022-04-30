<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        User::query()->create([
            'name' => 'tenas',
            'email' => 'tenas@gmail.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        $products = Product::all();
        $images = glob('public/images/' . '/*.jpg');
        foreach ($products as $product)
        { $product->addMediaFromUrl($images[array_rand($images)])->toMediaCollection('Product-images'); }

    }
}
