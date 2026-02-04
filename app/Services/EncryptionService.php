<?php

namespace App\Services;

class EncryptionService
{
    private const CIPHER = 'AES-256-CBC';

    public function encrypt(string $value): string
    {
        $key = $this->getKey();
        $iv = random_bytes(openssl_cipher_iv_length(self::CIPHER));
        $cipherText = openssl_encrypt($value, self::CIPHER, $key, OPENSSL_RAW_DATA, $iv);

        return base64_encode($iv . $cipherText);
    }

    public function decrypt(string $payload): string
    {
        $key = $this->getKey();
        $decoded = base64_decode($payload);
        $ivLength = openssl_cipher_iv_length(self::CIPHER);
        $iv = substr($decoded, 0, $ivLength);
        $cipherText = substr($decoded, $ivLength);

        return openssl_decrypt($cipherText, self::CIPHER, $key, OPENSSL_RAW_DATA, $iv) ?: '';
    }

    private function getKey(): string
    {
        $key = config('app.encryption_key') ?? env('ENCRYPTION_KEY');

        if (!$key) {
            $appKey = config('app.key');
            $key = str_starts_with($appKey, 'base64:') ? base64_decode(substr($appKey, 7)) : $appKey;
        }

        return hash('sha256', (string) $key, true);
    }
}
