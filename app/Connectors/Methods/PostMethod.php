<?php

namespace App\Connectors\Methods;

interface PostMethod
{
    function post(string $endpoint, array $body);
}
