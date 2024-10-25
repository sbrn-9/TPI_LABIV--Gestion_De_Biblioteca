<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ImgBBService
{
    private string $apiKey = "4c43afb6c30568002ac4bdbf49530875";
    private string $apiUrl = "https://api.imgbb.com/1/upload";

    public function uploadImage($imageFile): ?string
    {
        try {
            $imageData = base64_encode(file_get_contents($imageFile->path()));
            
            $response = Http::asMultipart()->post($this->apiUrl, [
                'key' => $this->apiKey,
                'image' => $imageData
            ]);

            if ($response->successful()) {
                $result = $response->json();
                return $result['data']['url'] ?? null;
            }
            
            return null;
        } catch (\Exception $e) {
            // Log error if needed
            return null;
        }
    }
}
