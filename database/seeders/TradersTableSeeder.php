<?php

namespace Database\Seeders;

use App\Models\Trader;
use Cloudinary\Cloudinary;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class TradersTableSeeder extends Seeder
{
    protected $cloudinary;

    public function __construct()
    {
        $this->cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ],
            'url' => [
                'secure' => true
            ]
        ]);
    }

    public function run()
    {


        $traders = [
            [
                'id' => 1,
                'picture' => 'uploads/photos/1750547967.jpg',
                'is_verified' => 1,
                'verified_badge' => null,
                'name' => 'Kyle Chassé / DD',
                'return_rate' => 96.28,
                'min_amount' => 1.00,
                'max_amount' => 1.00,
                'followers' => 5826,
                'profit_share' => 20.00,
                'created_at' => '2025-03-18 08:12:41',
                'updated_at' => '2025-06-22 03:19:27',
            ],
            [
                'id' => 2,
                'picture' => 'uploads/photos/1750549123.jpg',
                'is_verified' => 1,
                'verified_badge' => null,
                'name' => 'VirtualBacon',
                'return_rate' => 98.27,
                'min_amount' => 1.00,
                'max_amount' => 1.00,
                'followers' => 5246,
                'profit_share' => 20.00,
                'created_at' => '2025-04-07 07:04:31',
                'updated_at' => '2025-06-22 03:38:43',
            ],
      
          [
                'id' => 45,
                'picture' => 'uploads/photos/1751896762.jpg',
                'is_verified' => 1,
                'verified_badge' => null,
                'name' => 'KilliaXBT',
                'return_rate' => 95.37,
                'min_amount' => 3000.00,
                'max_amount' => 5000.00,
                'followers' => 4031,
                'profit_share' => 20.00,
                'created_at' => '2025-07-07 17:59:22',
                'updated_at' => '2025-07-07 17:59:22',
            ],
        ];

        foreach ($traders as $traderData) {
            $pictureData = null;

            // If picture path is provided, upload to Cloudinary
            if (!empty($traderData['picture'])) {
                $picturePath = public_path($traderData['picture']);

                if (File::exists($picturePath)) {
                    $pictureData = $this->uploadToCloudinary($picturePath, 'traders');
                } else {
                    $this->command->warn("Image not found: {$traderData['picture']}");
                }
            }

            // Create the trader record with explicit ID
            Trader::create([
                'id' => $traderData['id'],
                'picture_url' => $pictureData['secure_url'] ?? null,
                'picture_public_id' => $pictureData['public_id'] ?? null,
                'is_verified' => $traderData['is_verified'],
                'verified_badge' => $traderData['verified_badge'],
                'name' => $traderData['name'],
                'return_rate' => $traderData['return_rate'],
                'min_amount' => $traderData['min_amount'],
                'max_amount' => $traderData['max_amount'],
                'followers' => $traderData['followers'],
                'profit_share' => $traderData['profit_share'],
                'created_at' => $traderData['created_at'],
                'updated_at' => $traderData['updated_at'],
            ]);
        }
    }

    protected function uploadToCloudinary($imagePath, $folder)
    {
        try {
            $uploadResult = $this->cloudinary->uploadApi()->upload($imagePath, [
                'folder' => $folder,
                'transformation' => [
                    'width' => 500,
                    'height' => 500,
                    'crop' => 'fill',
                    'quality' => 'auto',
                    'gravity' => 'face',
                ]
            ]);

            return [
                'public_id' => $uploadResult['public_id'],
                'secure_url' => $uploadResult['secure_url'],
            ];
        } catch (\Exception $e) {
            $this->command->error("Failed to upload image: {$e->getMessage()}");
            return null;
        }
    }
}
