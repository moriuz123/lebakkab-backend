<?php

namespace App\Helpers;

class UploadHelper
{
    /**
     * Get the dynamic upload directory based on the user's OPD.
     *
     * @param string $baseDirectory
     * @return \Closure
     */
    public static function getDirectory($baseDirectory)
    {
        return function () use ($baseDirectory) {
            $user = auth()->user();
            if ($user && $user->opd_id) {
                return 'dinas-' . $user->opd_id . '/' . ltrim($baseDirectory, '/');
            }
            return $baseDirectory;
        };
    }
}
