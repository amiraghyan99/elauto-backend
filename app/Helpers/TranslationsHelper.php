<?php

namespace App\Helpers;

use Spatie\Valuestore\Valuestore;

class TranslationsHelper
{

    public static function translate(string $name): string|null
    {
        $valueStore = Valuestore::make(base_path('/translations/fr.json'));

        return $valueStore->get($name);
    }
}
