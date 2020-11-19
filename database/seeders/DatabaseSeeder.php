<?php

namespace Database\Seeders;

use Hash;
use App\Models\User;
use Marketplaceful\Models\Tag;
use Illuminate\Database\Seeder;
use Marketplaceful\Models\Listing;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Sequence;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        [$furniture, $chairs] = Tag::factory()->count(2)->state(new Sequence(
            ['name' => 'Furniture'],
            ['name' => 'Chairs'],
        ))->create();

        $user = User::factory()->super()->has(Listing::factory()
            ->count(100)
            ->state(new Sequence(
                ['title' => 'Modern Wooden Chair', 'price' => '6900', 'feature_image_path' => 'feature-images/modern-wooden-chair.jpg'],
                ['title' => 'White Chair', 'price' => '5600', 'feature_image_path' => 'feature-images/white-chair.jpg'],
                ['title' => 'Beach chair, foldable red', 'price' => '2499', 'feature_image_path' => 'feature-images/beach-chair-foldable-red.jpg'],
                ['title' => 'Chair, outdoor, black-brown', 'price' => '15090', 'feature_image_path' => 'feature-images/chair-outdoor-black-brown.jpg'],
                ['title' => 'Brown Stained', 'price' => '6000', 'feature_image_path' => 'feature-images/brown-stained.jpg'],
                ['title' => 'Bar stool, black-brown', 'price' => '3499', 'feature_image_path' => 'feature-images/bar-stool-black-brown.jpg'],
                ['title' => 'Charcoal grill, stainless steel', 'price' => '22800', 'feature_image_path' => 'feature-images/charcoal-grill-stainless-steel.jpg'],
                ['title' => 'Umbrella with base, gray', 'price' => '11999', 'feature_image_path' => 'feature-images/umbrella-with-base-gray.jpg'],
                ['title' => 'Side table, white', 'price' => '2499', 'feature_image_path' => 'feature-images/side-table-white.jpg'],
                ['title' => 'Stepladder, 3 steps, beech', 'price' => '2999', 'feature_image_path' => 'feature-images/stepladder-3-steps-beech.jpg'],
            )))->create([
            'name' => 'John Doe',
            'email' => 'dev@marketplaceful.com',
        ]);

        $user->listings->each(function ($listing) use ($furniture) {
            $listing->tags()->attach($furniture->id);
        });

        $user->listings()->take(6)->get()->each(function ($listing) use ($chairs) {
            $listing->tags()->attach($chairs->id);
        });

        $files = (new Filesystem)->allFiles(__DIR__.'/../_fixtures/images');

        collect($files)->each(function ($file) {
            Storage::disk($this->featureImageDisk())->put(
                'feature-images/' . $file->getFilename(),
                (new Filesystem)->get(
                    $file->getPathname()
                ),
                ['visibility' => 'public']
            );
        });
    }

    protected function featureImageDisk()
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : 'public';
    }
}
