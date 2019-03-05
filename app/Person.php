<?php

namespace Printerous;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = "person";

    protected $fillable = ['name', 'phone', 'email', 'avatar', 'id_organization'];
}
