<?php

namespace Modules\Intel\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Intel\Entities\IntelProcessors;
use voku\helper\HtmlDomParser;

class IntelElementController extends IntelController
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return parent::elementIntelCreateOrUpdate('save');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update()
    {
        return parent::elementIntelCreateOrUpdate('update');

    }

}
