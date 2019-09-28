<?php

namespace App\Factory;


use App\Entity\Doctor;

class DoctorFactory implements Factory
{

    public function make($values)
    {
        $keys = array_keys($values);
        $doctor = new Doctor();
        foreach ($keys as $key) {
            $doctor->{"set" . ucfirst($key)}($values[$key]);
        }

        return $doctor;
    }
}