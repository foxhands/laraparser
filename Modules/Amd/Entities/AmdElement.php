<?php

namespace Modules\Amd\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class AmdElement extends Model
{
    protected $table = 'amd_elements';

    public function addElement($id, $items)
    {
        $base = new AmdElement;

        $base->processor_id = $id;

        foreach ($items as $label => $value) {
            $base->$label = $value;
        }

        $base->save();
    }
}
