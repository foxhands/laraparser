<?php

namespace Modules\Parser\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use voku\helper\HtmlDomParser;

class ParserController extends Controller
{

    /**
     * Display a listing of the resource.
     * @param $nameOfAction
     */
    public function parseElementIntel($nameOfAction)
    {
        DB::table('intel_processors')->orderBy('id')->chunk(100, function ($intel_processors) use ($nameOfAction) {
            foreach ($intel_processors as $elem)
            {
                $page = (new \Modules\Parser\Services\ParserService)->curlGetPage($elem->url_tech);
                $html = HtmlDomParser::str_get_html($page);
                foreach ($html->find('tr') as $item)
                {
                    foreach ($item->find('td', 0) as $element)
                    {
                        $name = $element->text;
                    }
                    foreach ($item->find('td', 1) as $element)
                    {
                        $value = $element->text;
                    }
                    if ($nameOfAction == 'create')
                    {
                        DB::table('intel_elements')->where('intel_processors_id', $elem->id)->insert([
                            'intel_processors_id' => $elem->id,
                            'name' => $name,
                            'value' => $value,
                            'created_at' =>  Carbon::now(), # new \Datetime()
                        ]);
                    }else
                    {
                        DB::table('intel_elements')->where('intel_processors_id', $elem->id)->update([
                            'intel_processors_id' => $elem->id,
                            'name' => $name,
                            'value' => $value,
                            'updated_at' =>  Carbon::now(), # new \Datetime()
                        ]);
                    }

                }
                sleep(5);
                dd($elem->id);
            }
        });
    }
}
