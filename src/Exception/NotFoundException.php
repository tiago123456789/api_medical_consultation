<?php

namespace App\Exception;


use Throwable;

class NotFoundException extends MedicalConsultationException
{

    public function __construct($message = "", $code = 404, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}