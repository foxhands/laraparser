<?php

namespace Modules\Intel\Entities;

use Illuminate\Database\Eloquent\Model;

class IntelProcessors extends Model
{

    /**
     * Атрибуты, для которых разрешено массовое присвоение значений.
     *
     * @var array
     */

    protected $fillable = [
        'id',
        'name',
        'url_intel',
        'url_tech',
        'active',
    ];

    /**
     * Первичный ключ таблицы БД.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Название БД
     *
     * @var string
     */
    protected $table = 'intel_processors';




}
