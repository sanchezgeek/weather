<?php

namespace weather\infrastructure\api\exceptions;

/**
 * Class ApiException
 */
class ApiException extends \Exception
{
    protected $message = 'Unexpected Api Exception';
}
