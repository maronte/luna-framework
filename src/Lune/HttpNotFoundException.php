<?php

namespace Lune;

class HttpNotFoundException extends \Exception
{
    public function __construct()
    {
        parent::__construct('404 Not Found', 404);
    }
}
