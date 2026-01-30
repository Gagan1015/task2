<?php

if (!function_exists('imageUrl')) {
    /**
     * Get the URL for an image, handling both Cloudinary URLs and local storage paths
     *
     * @param string|null $path
     * @return string
     */
    function imageUrl(?string $path): string
    {
        if (empty($path)) {
            return '';
        }

        // If it's already a full URL (Cloudinary or external), return as-is
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        // Otherwise, treat it as a local storage path
        return asset('storage/' . $path);
    }
}
