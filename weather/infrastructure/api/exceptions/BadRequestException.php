<?php

namespace weather\infrastructure\api\exceptions;

/**
 * #400
 */
class BadRequestException extends ApiException
{
    protected $message = 'Bad Request';
}
