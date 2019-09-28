<?php

namespace App\Exception;


use Throwable;

class MedicalConsultationException extends \Exception
{

    public function __construct($message = "", $code = 500, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}