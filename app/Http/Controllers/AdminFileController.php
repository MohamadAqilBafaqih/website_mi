<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class AdminFileController extends Controller
{
    // app/Http/Controllers/DataSiswaController.php
    public function getFile($type, $filename)
    {
        // batasi hanya folder tertentu
        if (!in_array($type, ['akta', 'kk'])) {
            abort(404, 'Folder tidak valid.');
        }

        $path = storage_path("app/private/uploads/{$type}/{$filename}");

        if (!file_exists($path)) {
            return response("File tidak ditemukan di: {$path}", 404);
        }

        return response()->file($path);
    }

    public function downloadFile($type, $filename)
    {
        if (!in_array($type, ['akta', 'kk'])) {
            abort(404, 'Folder tidak valid.');
        }

        $path = storage_path("app/private/uploads/{$type}/{$filename}");

        if (!file_exists($path)) {
            return response("File tidak ditemukan di: {$path}", 404);
        }

        return response()->download($path);
    }
}
