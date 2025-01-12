<?php

namespace App\Controllers;

use Core\Controller;
use Core\Storage;

class FileController extends Controller
{
    public function upload()
    {
        if (!isset($_FILES['file'])) {
            echo "No file uploaded.";
            return;
        }

        $file = $_FILES['file'];
        $path = 'uploads/' . $file['name'];

        try {
            $storedPath = Storage::put($path, $file);
            echo "File uploaded to: $storedPath";
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function delete($filename)
    {
        try {
            Storage::delete("uploads/$filename");
            echo "File $filename deleted successfully.";
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function listFiles()
    {
        $files = Storage::files();
        echo "<ul>";
        foreach ($files as $file) {
            echo "<li>$file</li>";
        }
        echo "</ul>";
    }
}
