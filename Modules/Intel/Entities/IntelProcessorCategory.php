<?php

namespace Modules\Intel\Entities;

use Illuminate\Database\Eloquent\Model;

class IntelProcessorCategory extends Model
{
    /**
     * Атрибуты, для которых разрешено массовое присвоение значений.
     *
     * @var array
     */

    protected $fillable = [
        'name',
        'url_tech',
        'url_intel'
    ];

    /**
     * Название БД
     *
     * @var string
     */

    protected $table = 'intel_processor_categories';



}
