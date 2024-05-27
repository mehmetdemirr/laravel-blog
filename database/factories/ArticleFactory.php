<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->name;
        return [
            "title"=> $title,
            "slug"=> Str::slug($title),
            "body"=> fake()->text,
            "image"=> fake()->imageUrl,
            "tags" => Str::slug(fake()->address,", "),
            "status" => fake()->boolean,
            "view_count"=> random_int(1,100),
            "like_count"=> random_int(1,100),
            "read_time"=> random_int(1,100),
            "seo_keywords"=> Str::slug(fake()->address,", "),
            "seo_desciption"=> fake()->text,
            "user_id" => random_int(1,10),
            "category_id" => random_int(1,20),
        ]; 
    }
}
