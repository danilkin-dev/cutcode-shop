<?php

namespace App\Faker;

use Faker\Provider\Base;
use Illuminate\Support\Facades\Storage;
use Throwable;

final class FakerImageProvider extends Base
{
    public function fixturesImage(string $fixturesDir, string $storageDir): string
    {
        if (!Storage::exists($storageDir)) {
            Storage::makeDirectory($storageDir);
        }

        $file = $this->generator->file(
            base_path("tests/Fixtures/images/$fixturesDir"),
            Storage::path($storageDir),
            false
        );

        return '/storage/' . trim($storageDir, '/') . '/' . $file;
    }

    public function aiImage(string $storageDir, int $width = 500, int $height = 500, string $prompt): string
    {
        try {
            $prompt = str_replace(' ', '%20', trim($prompt));

            $name = $storageDir . '/' . str()->random(6) . '.jpg';

            Storage::put(
                $name,
                file_get_contents("https://placeholders.io/$width/$height/$prompt")
            );

            return $name;
        } catch (Throwable $e) {
            report(new \Exception($e->getMessage()));

            return '';
        }
    }
}
