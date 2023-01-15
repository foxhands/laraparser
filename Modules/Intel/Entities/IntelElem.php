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

    public function addElement($id, $name, $items)
    {
        $base = new IntelElem;

        $base->intel_processor_id = $id;
        $base->intel_processor_name = $name;

        foreach ($items as $key => $value) {
            $text = Str::slug($key);
            $base->$text = $value;
        }
        $base->save();
    }
}
