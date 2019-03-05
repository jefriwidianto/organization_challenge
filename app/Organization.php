<?php

namespace Printerous;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $table = "organization";

    protected $fillable = ['name', 'phone', 'email', 'website', 'logo', 'company', 'id_accountmgr'];
}
