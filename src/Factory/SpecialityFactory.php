<?php

namespace App\Factory;


use App\Entity\Doctor;
use App\Entity\Speciality;

class SpecialityFactory implements Factory
{

    public function make($values)
    {
        $keys = array_keys($values);
        $speciality = new Speciality();

        foreach ($keys as $key) {
            $speciality->{"set" . ucfirst($key)}($values[$key]);
        }

        return $speciality;
    }
}