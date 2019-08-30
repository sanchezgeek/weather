<?php

namespace weather\infrastructure\api\exceptions;

/**
 * #401
 */
class UnauthorizedException extends ApiException
{
    protected $message = 'Unauthorized';
}
