<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Cloudinary\Cloudinary;
use Cloudinary\Api\Upload\UploadApi;

trait UploadsToCloudinary
{
    /**
     * Get the Cloudinary instance
     */
    protected function getCloudinary(): Cloudinary
    {
        $cloudinaryUrl = env('CLOUDINARY_URL');
        
        if ($cloudinaryUrl) {
            return new Cloudinary($cloudinaryUrl);
        }

        // Fallback to individual config values
        return new Cloudinary([
            'cloud' => [
                'cloud_name' => config('cloudinary.cloud_name'),
                'api_key' => config('cloudinary.api_key'),
                'api_secret' => config('cloudinary.api_secret'),
            ],
        ]);
    }

    /**
     * Upload a file to Cloudinary
     *
     * @param UploadedFile $file
     * @param string $folder
     * @return string The secure URL of the uploaded file
     */
    protected function uploadToCloudinary(UploadedFile $file, string $folder = 'uploads'): string
    {
        $cloudinary = $this->getCloudinary();
        
        $result = $cloudinary->uploadApi()->upload($file->getRealPath(), [
            'folder' => $folder,
            'resource_type' => 'image',
            'transformation' => [
                'quality' => 'auto',
                'fetch_format' => 'auto',
            ],
        ]);

        return $result['secure_url'];
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
            $publicId = $this->extractPublicIdFromUrl($url);
            if ($publicId) {
                $cloudinary = $this->getCloudinary();
                $cloudinary->uploadApi()->destroy($publicId);
                return true;
            }
        } catch (\Exception $e) {
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

