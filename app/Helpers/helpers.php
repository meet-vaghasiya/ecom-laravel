<?php

// namespace App\Helpers;

use Illuminate\Support\Str;

function genrateRandomNameForFile($file, $digit = 20)
{
    $randomName = Str::random($digit);
    $fileExtension =  $file->getClientOriginalExtension();
    $name = $randomName . '.' . $fileExtension;

    return $name;
}
