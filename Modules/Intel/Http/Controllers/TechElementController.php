<?php

namespace Modules\Intel\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TechElementController extends IntelController
{

    public function create()
    {
        return parent::elementTechCreateOrUpdate();
    }


    public function update()
    {
        return parent::elementTechCreateOrUpdate();

    }

}
