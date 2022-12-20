<?php

namespace Modules\Intel\Http\Controllers;


use Illuminate\Routing\Controller;
use Modules\Intel\Entities\IntelElem;
use Modules\Intel\Entities\IntelProcessorCategory;
use Modules\Intel\Entities\IntelProcessors;
use Modules\Intel\Entities\TechElem;
use voku\helper\HtmlDomParser;



class IntelController extends Controller
{
    public function processorsCreateOrUpdate($action)
    {
        $baseUrl = 'https://www.intel.com';
        $baseUrlForNull = 'https://technical.city/en/cpu/';
        $countUrl = IntelProcessorCategory::all()->count();
        for ($i = 1; $i <= $countUrl; $i++)
        {
            $url = IntelProcessorCategory::all()->where('id', $i)->value('url');

            $page = (new \Modules\Intel\Services\ParserService)->curlGetPage($url);
            if(trim($page)=='')return false;  // сайт недоступен, его мы не грузим
            $html = HtmlDomParser::str_get_html($page);

            foreach ($html->find('.add-compare-wrap a') as $item)
            {
                $processor = str_replace(['Intel® ', '®', ' Processor','™', 'Intel ', 'Core2'],['', '', '', '', '', 'Core-2'],$item->text);
                $urlTech =  $baseUrlForNull.str_replace(' ', '-',$processor);
                $urlIntel =  $baseUrl.$item->href;

                $base = new IntelProcessors;

                $base->name = $processor;
                $base->url_intel = $urlIntel;
                $base->url_tech =  $urlTech;


                $base->$action();
            }
        }
    }

    public function categoriesCreateOrUpdate($action)
    {
        $url = 'https://ark.intel.com/content/www/us/en/ark.html';
        $baseUrl = 'https://www.intel.com';

        $page = (new \Modules\Intel\Services\ParserService)->curlGetPage($url);
        if (trim($page) == '') return false;  // сайт недоступен, его мы не грузим
        $html = HtmlDomParser::str_get_html($page);
        $panelLabel = [
            'PanelLabel595',
            'PanelLabel29035',
            'PanelLabel29862',
            'PanelLabel75557',
            'PanelLabel29862',
            'PanelLabel79047',
            'PanelLabel43521',
            'PanelLabel451',
            'PanelLabel122139'
        ];

        foreach ($panelLabel as $item)
        {
            foreach ($html->find('div[data-parent-panel-key=' . $item . '] a') as $element)
            {
                $processor = str_replace(['Intel® ', '®', ' Processors','™', 'Intel '],['', '', '', '', ''],$element->text);

                $base = new IntelProcessorCategory;

                $base->name = $processor;
                $base->url = $baseUrl.$element->href;

                $base->$action();
            }
        }
    }

    public function elementTechCreateOrUpdate($action)
    {
        $intelElem = IntelProcessors::all()->chunk(10);

        foreach ($intelElem as $item) {
            foreach ($item as $elem){
                $page = (new \Modules\Parser\Services\ParserService)->curlGetPage($elem->url_tech);
                $html = HtmlDomParser::str_get_html($page);
                foreach ($html->find('.specs-list') as $item)
                {
                    foreach ($item->find('span.label') as $element)
                    {
                        $name = $element->text;
                    }
                    foreach ($item->find('span.value') as $element)
                    {
                        $value = $element->text;
                    }

                    $base = new TechElem;

                    $base->intel_processors_id = $elem->id;
                    $base->name = $name;
                    $base->value = $value;

                    $base->$action();
                }
            }
        }
    }

    public function elementIntelCreateOrUpdate($action)
    {
        $intelElem = IntelProcessors::all()->chunk(10);

        foreach ($intelElem as $item) {
            foreach ($item as $elem){
                $page = (new \Modules\Parser\Services\ParserService)->curlGetPage($elem->url_tech);
                $html = HtmlDomParser::str_get_html($page);
                foreach ($html->find('.specs-list') as $item)
                {
                    foreach ($item->find('li', 0) as $element)
                    {
                        $name = $element->text;
                    }
                    foreach ($item->find('li', 1) as $element)
                    {
                        $value = $element->text;
                    }


                    $base = new IntelElem;

                    $base->intel_processors_id = $elem->id;
                    $base->name = $name;
                    $base->value = $value;

                    $base->$action();
                }
            }
        }
    }
}