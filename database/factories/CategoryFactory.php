<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name= fake()->name;
        return [
            "name"=> $name,
            "slug"=> Str::slug($name),
            "status"=> fake()->boolean,
            "feature_status"=> fake()->boolean,
            "desciption"=> fake()->paragraph(1),
            // "parent_id" => random_int(1,10),
            "order"=> random_int(1,100) ,
            "seo_keywords"=> Str::slug(fake()->address,", "),
            "seo_desciption"=> fake()->text,
            "user_id"=> random_int(1,10),
        ];
    }
}
