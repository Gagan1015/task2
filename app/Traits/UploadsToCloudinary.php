<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

trait UploadsToCloudinary
{
    /**
     * Upload a file to Cloudinary
     *
     * @param UploadedFile $file
     * @param string $folder
     * @return string The secure URL of the uploaded file
     */
    protected function uploadToCloudinary(UploadedFile $file, string $folder = 'uploads'): string
    {
        $result = Cloudinary::upload($file->getRealPath(), [
            'folder' => $folder,
            'resource_type' => 'image',
            'transformation' => [
                'quality' => 'auto',
                'fetch_format' => 'auto',
            ],
        ]);

        return $result->getSecurePath();
    }

    /**
     * Delete a file from Cloudinary by URL
     *
     * @param string|null $url
     * @return bool
     */
    protected function deleteFromCloudinary(?string $url): bool
    {
        if (!$url || !str_contains($url, 'cloudinary')) {
            return false;
        }

        try {
            // Extract public ID from URL
            $publicId = $this->extractPublicIdFromUrl($url);
            if ($publicId) {
                Cloudinary::destroy($publicId);
                return true;
            }
        } catch (\Exception $e) {
            // Log error but don't fail
            \Log::error('Failed to delete from Cloudinary: ' . $e->getMessage());
        }

        return false;
    }

    /**
     * Extract public ID from Cloudinary URL
     */
    private function extractPublicIdFromUrl(string $url): ?string
    {
        // URL format: https://res.cloudinary.com/{cloud_name}/image/upload/{version}/{public_id}.{format}
        if (preg_match('/\/upload\/(?:v\d+\/)?(.+)\.[a-z]+$/i', $url, $matches)) {
            return $matches[1];
        }
        return null;
    }
}
