<?php

class Uuid
{
    public static function GenerateUuid()
    {
        // Generate 16 bytes (128 bits) of random data
        $randomByte = random_bytes(16);
        assert(strlen($randomByte) == 16);

        // Set version to 0100
        $randomByte[6] = chr(ord($randomByte[6]) & 0x0f | 0x40);
        // Set bits 6-7 to 10
        $randomByte[8] = chr(ord($randomByte[8]) & 0x3f | 0x80);

        // Output the 36 character UUID.
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($randomByte), 4));
    }
}
