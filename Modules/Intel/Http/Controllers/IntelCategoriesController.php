<?php

namespace Modules\Intel\Http\Controllers;

class IntelCategoriesController extends IntelController
{

    /**
     * Create the specified resource in storage.
     */

    public function create()
    {
        return parent::categoriesCreateOrUpdate('save');

    }

    /**
     * Update the specified resource in storage.
     */

    public function update()
    {
       return parent::categoriesCreateOrUpdate('update');
    }

}
