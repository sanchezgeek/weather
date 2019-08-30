<?php

namespace weather\infrastructure\api\exceptions;

/**
 * #500
 */
class InternalErrorException extends ApiException
{
    protected $message = 'Internal Server Error';
}
