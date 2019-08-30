<?php

namespace weather\infrastructure\api\exceptions;

/**
 * #404
 */
class NotFoundException extends ApiException
{
    protected $message = 'Not Found';
}
