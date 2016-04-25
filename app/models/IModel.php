<?php

namespace App\Models;

interface IModel
{
    public function save();
    public function validate();
}
