<?php

namespace App\Connectors;

interface ApiConnector
{
    function __construct();

    function authenticate(): ApiConnector;
}
