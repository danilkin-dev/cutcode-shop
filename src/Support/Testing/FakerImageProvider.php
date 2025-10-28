<?php

namespace Support\Testing;

use Faker\Provider\Base;
use Illuminate\Support\Facades\Storage;
use Throwable;

final class FakerImageProvider extends Base
{
    public function fixturesImage(string $fixturesDir, string $storageDir): string
    {
        $storage = Storage::disk('images');

        if (!$storage->exists($storageDir)) {
            $storage->makeDirectory($storageDir);
        }

        $file = $this->generator->file(
            base_path("tests/Fixtures/images/$fixturesDir"),
            $storage->path($storageDir),
            false
        );

        return '/storage/images/' . trim($storageDir, '/') . '/' . $file;
    }

    public function aiImage(string $storageDir, int $width = 500, int $height = 500, string $prompt): string
    {
        $storage = Storage::disk('images');

        try {
            $prompt = str_replace(' ', '%20', trim($prompt));

            $name = $storageDir . '/' . str()->random(6) . '.jpg';

            $storage->put(
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
