<?php

namespace Modules\Amd\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class AmdElement extends Model
{
    protected $table = 'amd_elements';

    public function addElement($id, $name, $items)
    {
        $base = new AmdElement;

        $base->amd_processor_id = $id;
        $base->amd_processors_name = $name;

        foreach ($items as $label => $value) {
            $base->$label = $value;
        }

        $base->save();
    }
}
