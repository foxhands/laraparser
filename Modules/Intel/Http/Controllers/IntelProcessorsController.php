<?php

namespace Modules\Intel\Http\Controllers;

class IntelProcessorsController extends IntelController
{
    /**
     * Create the specified resource in storage.
     */
    public function create()
    {
        return parent::processorsCreateOrUpdate();
    }


    /**
     * Update the specified resource in storage.
     */
    public function update()
    {
        return parent::processorsCreateOrUpdate();
    }

}
