<?php

namespace App\Helpers;

use App\Models\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileHelper
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function upload($file, $directory, $length = 16)
    {
        try {
            if ($file instanceof UploadedFile) {
                $filename = Str::random($length);
                $extension = $file->getClientOriginalExtension();

                // Define the path by which we will store the new image
                $path = 'file/' . $filename . '.' . $extension;
                if (isset($directory)) {
                    $path = 'file/' . $directory . '/' . $filename . '.' . $extension;
                }

                // Store image
                Storage::put($path, (string) $file->get(), 'public');

                // Save to file table
                $file = File::create([
                    'name' => $filename . '.' . $extension,
                    'location' => $directory
                ]);

                return $file;
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        return false;
    }
}
