<?php

namespace Modules\Intel\Http\Controllers;


use Illuminate\Routing\Controller;
use Modules\Intel\Entities\IntelElem;
use Modules\Intel\Entities\IntelProcessorCategory;
use Modules\Intel\Entities\IntelProcessors;
use Modules\Intel\Entities\TechElem;
use Modules\Intel\Entities\TechElemBench;
use Modules\Intel\Entities\TechElemRating;
use voku\helper\HtmlDomParser;



class IntelController extends Controller
{
    public function processorsCreateOrUpdate()
    {
        $baseUrl = 'https://www.intel.com';
        $baseUrlForNull = 'https://technical.city/en/cpu/';
        $countUrl = IntelProcessorCategory::all()->count();

        for ($i = 1; $i <= $countUrl; $i++)
        {
            $url = IntelProcessorCategory::all()->where('id', $i)->value('url');

            $page = (new \Modules\Intel\Services\ParserService)->curlGetPage($url);

            if (trim($page) == '') return false; else $html = HtmlDomParser::str_get_html($page);  // сайт недоступен, его мы не грузим

            foreach ($html->find('.add-compare-wrap a') as $item)
            {
                $processor = str_replace(['Intel® ', '®', ' Processor','™', 'Intel ', 'Core2'],['', '', '', '', '', 'Core-2'],$item->text);
                $urlTech =  $baseUrlForNull.str_replace(' ', '-',$processor);
                $urlIntel =  $baseUrl.$item->href;

                $base = new IntelProcessors;

                $base->name = $processor;
                $base->url_intel = $urlIntel;

                if ((new \Modules\Intel\Services\ParserService)->getUrlStatus($urlTech) == '200') $base->url_tech =  $urlTech;

                $countUrl > 0 ? $base->save() : $base->update();
            }
        }
    }

    public function categoriesCreateOrUpdate()
    {
        $url = 'https://ark.intel.com/content/www/us/en/ark.html';
        $baseUrl = 'https://www.intel.com';

        $countUrl = IntelProcessorCategory::all()->count();

        $page = (new \Modules\Intel\Services\ParserService)->curlGetPage($url);

        if (trim($page) == '') return false; else $html = HtmlDomParser::str_get_html($page);  // сайт недоступен, его мы не грузим

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

                $countUrl > 0 ? $base->update() : $base->save();
            }
        }
    }

    public function elementTechCreateOrUpdate()
    {
        $countUrl = IntelProcessors::all()->count();
        $techElem = IntelProcessors::all()->chunk(10);


        foreach ($techElem as $item) {
            foreach ($item as $elem){
                $page = (new \Modules\Parser\Services\ParserService)->curlGetPage($elem->url_tech);

                if (trim($page) == '') return false; else $html = HtmlDomParser::str_get_html($page);  // сайт недоступен, его мы не грузим

                foreach ($html->find('tr') as $item)
                {
                    foreach ($item->find('td', 0) as $element)
                    {
                        $name = str_replace(['®', ' ‡', '‡', '*','™'],['', '', '', '', ''], $element->text);
                    }
                    foreach ($item->find('td', 1) as $element)
                    {
                        $value = str_replace(['®', '‡', '*','™'],['', '', '', ''], $element->text);
                    }

                    $base = new TechElem;

                    $base->intel_processors_id = $elem->id;
                    $base->name = $name;
                    $base->value = $value;

                    $countUrl > 0 ? $base->update() : $base->save();
                }

                foreach ($html->find('.tab') as $item)
                {

                    foreach ($item->find('h4') as $element)
                    {
                        $name = str_replace(['®', ' ‡', '‡', '*','™'],['', '', '', '', ''], $element->text);
                    }
                    foreach ($item->find('.avarage') as $element)
                    {
                        $value = str_replace(['®', '‡', '*','™'],['', '', '', ''], $element->text);
                    }

                    $base = new TechElemBench;

                    $base->intel_processors_id = $elem->id;
                    $base->name = $name;
                    $base->value = $value;

                    $countUrl > 0 ? $base->update() : $base->save();

                }

//                foreach ($html->find('.tab') as $item)
//                {
//
//                    foreach ($item->find('h4') as $element)
//                    {
//                        $name = str_replace(['®', ' ‡', '‡', '*','™'],['', '', '', '', ''], $element->text);
//                    }
//                    foreach ($item->find('.avarage') as $element)
//                    {
//                        $value = str_replace(['®', '‡', '*','™'],['', '', '', ''], $element->text);
//                    }
//
//                    $base = new TechElemRating();
//
//                    $base->intel_processors_id = $elem->id;
//                    $base->name = $name;
//                    $base->value = $value;
//
//                      $countUrl > 0 ? $base->update() : $base->save();
//
//                }
            }
        }
    }

    public function elementIntelCreateOrUpdate()
    {
        $countUrl = IntelProcessors::all()->count();
        $intelElem = IntelProcessors::all()->chunk(10);

        foreach ($intelElem as $item) {
            foreach ($item as $elem){
                $page = (new \Modules\Parser\Services\ParserService)->curlGetPage($elem->url_intel);

                if (trim($page) == '') return false; else $html = HtmlDomParser::str_get_html($page);  // сайт недоступен, его мы не грузим

                foreach ($html->find('ul.specs-list li') as $item)
                {

                    foreach ($item->find('span.label') as $element)
                    {
                        $label = str_replace(['®', ' ‡', '‡', '*','™'],['', '', '', '', ''], $element->text);
                    }
                    foreach ($item->find('span.value') as $element)
                    {
                        $value = str_replace(['®', ' ‡', '‡', '*','™'],['', '', '', '', ''], $element->text);
                    }

                    $base = new IntelElem;

                    $base->intel_processors_id = $elem->id;
                    $base->name = $label;
                    $base->value = $value;

                    $countUrl > 0 ? $base->update() : $base->save();
                }
            }
        }
    }
}
