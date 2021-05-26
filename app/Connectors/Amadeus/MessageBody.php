<?php

namespace App\Connectors\Amadeus;

interface MessageBody
{
    public static function generateBody(array $data): array;
}
