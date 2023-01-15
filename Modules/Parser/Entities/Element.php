<?php

namespace Modules\Parser\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Element extends Model
{
    protected $table = 'elements';

    public function addElement($id, $name,$items)
    {
        $base = new Element;

        $base->processor_id = $id;
        $base->processor_name = $name;


        foreach ($items as $key => $value) {
            $text = Str::slug($key);
            $base->$text = $value;
        }

        $base->save();
    }

}
