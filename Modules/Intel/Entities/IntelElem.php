<?php

namespace Modules\Intel\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IntelElem extends Model
{
    /**
     * Название БД
     *
     * @var string
     */

    protected $table = 'intel_elements';
}
