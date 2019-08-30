<?php

namespace weather\infrastructure\api\exceptions;

/**
 * #403
 */
class ForbiddenException extends ApiException
{
    protected $message = 'Forbidden';
}
