<?php

namespace Modules\Intel\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class IntelElem extends Model
{
    /**
     * Название БД
     *
     * @var string
     */

    protected $table = 'intel_elements';


    /**
     * @throws \Throwable
     */

    public function addProcessor($id, $items)
    {
        $base = new IntelElem;

        $base->intel_processors_id = $id;

        foreach ($items as $key => $value) {
            $text = Str::slug($key);
            $base->$text = $value;
        }
        $base->save();
    }
}
