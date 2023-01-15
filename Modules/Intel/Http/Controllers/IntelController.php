<?php

namespace Modules\Intel\Http\Controllers;


use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\Intel\Entities\IntelProcessorCategory;
use Modules\Intel\Entities\IntelProcessors;
use voku\helper\HtmlDomParser;
Use Exception;


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
                $urlIntel =  $baseUrl.$item->href;

                $base = new IntelProcessors;

                $base->name = $processor;
                $base->url = $urlIntel;

                $countUrl > 0 ? $base->save() : $base->update();

                echo 'Name:'.$processor.PHP_EOL;
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
                $processor = str_replace(['Intel® ', '®', ' Processors','™', 'Intel '],'',$element->text);

                $base = new IntelProcessorCategory;

                $base->name = $processor;
                $base->url = $baseUrl.$element->href;

                $countUrl > 0 ? $base->update() : $base->save();
            }
        }
    }

    public function elementTechCreateOrUpdate()
    {
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
////                    $base = new TechElemBench;
////
////                    $base->intel_processors_id = $elem->id;
////                    $base->name = $name;
////                    $base->value = $value;
////
////                    $countUrl > 0 ? $base->update() : $base->save();
//
//                }
//
//                foreach ($html->find('.knob_2') as $item)
//                {
////                    $base = new TechElemRating();
////
////                    $base->intel_processors_id = $elem->id;
////                    $base->value = $item->text;
////
////                    $countUrl > 0 ? $base->update() : $base->save();
//                }
    }


    public function elementIntelCreateOrUpdate()
    {
        $intelElems = IntelProcessors::all()->chunk(10);
        foreach ($intelElems as $intelElem) {
            foreach ($intelElem as $elem){
                $page = (new \Modules\Intel\Services\ParserService)->curlGetPage($elem->url);

                if (trim($page) == '') return false; else $html = HtmlDomParser::str_get_html($page);  // сайт недоступен, его мы не грузим

                foreach ($html->find('ul.specs-list li') as $item)
                {
                    foreach ($item->find('span.label') as $label)
                    {
                        $labels = Str::slug($label->text);
                    }
                    foreach ($item->find('span.value') as $value)
                    {
                        $values = Str::replace(['®', ' ‡', '‡', '*','™'],['', '', '', '', ''], $value->text);
                        //float
                        if ($labels == 'opengl-support') $values = (float)$value->text;
                        if ($labels == 'pci-express-revision') $values = (float)$value->text;
                        if ($labels == 'intel-gaussian-neural-accelerator') $values = (float)$value->text;
                        if ($labels == 'intel-turbo-boost-technology') $values = (float)$value->text;
                        //int
                        if ($labels == 'directx-support') $values = (int)$value->text;
                        if ($labels == 'of-displays-supported') $values = (int)$value->text;
                        if ($labels == 'max-cpu-configuration') $values = (int)$value->text;
                        if ($labels == 'maximum-memory-speed') $values = (int)$value->text;
                        if ($labels == 'max-of-pci-express-lanes') $values = (int)$value->text;
                        if ($labels == 'total-cores') $values = (int)$value->text;
                        if ($labels == 'total-threads') $values = (int)$value->text;
                        if ($labels == 'max-of-upi-links') $values = (int)$value->text;
                        if ($labels == 'max-of-memory-channels') $values = (int)$value->text;
                        if ($labels == 'general-purpose-io') $values = (int)$value->text;
                        //W
                        if ($labels == 'configurable-tdp-up') $values = (int)$value->text;
                        if ($labels == 'configurable-tdp-down') $values = (int)$value->text;
                        if ($labels == 'tdp') $values = (int)$value->text;
                        if ($labels == 'scenario-design-power-sdp') $values = (int)$value->text;
                        if ($labels == 'processor-base-power') $values = (int)$value->text;
                        if ($labels == 'minimum-assured-power') $values = (int)$value->text;
                        if ($labels == 'maximum-assured-power') $values = (int)$value->text;
                        //TB
                        if ($labels == 'max-memory-size-dependent-on-memory-type') $values = (int)$value->text;
                        //GB/s
                        if ($labels == 'max-memory-bandwidth') $values = (float)$value->text;
                        if ($labels == 'graphics-memory-bandwidth') $values = (float)$value->text;
                        //GT/s
                        if ($labels == 'intel-upi-speed') $values = (float)$value->text;
                        if ($labels == 'bus-speed') $values = (float)$value->text;
                        //GB
                        if ($labels == 'maximum-enclave-page-cache-epc-size-for-intel-sgx') $values = (int)$value->text;
                        if ($labels == 'graphics-video-max-memory') $values = (int)$value->text;
                        //MB
                        if ($labels == 'cache') $values = (int)$value->text;
                        if ($labels == 'edram') $values = (int)$value->text;
                        if ($labels == 'total-l2-cache') $values = (int)$value->text;
                        //MHz
                        if ($labels == 'graphics-base-frequency') $values = (int)$value->text;
                        if ($labels == 'graphics-burst-frequency') $values = (int)$value->text;
                        if ($labels == 'burst-frequency') $values = (int)$value->text;
                        if ($labels == 'configurable-tdp-down-base-frequency') $values = (int)$value->text;
                        if ($labels == 'maximum-memory-speed') $values = (int)$value->text;
                        //Ghz
                        if ($labels == 'graphics-max-dynamic-frequency') $values = (float)$value->text;
                        if ($labels == 'high-priority-core-frequency') $values = (float)$value->text;
                        if ($labels == 'low-priority-core-frequency') $values = (float)$value->text;
                        if ($labels == 'performance-core-base-frequency') $values = (float)$value->text;
                        if ($labels == 'efficient-core-base-frequency') $values = (float)$value->text;
                        if ($labels == 'intel-turbo-boost-technology-20-frequency') $values = (float)$value->text;
                        if ($labels == 'intel-turbo-boost-max-technology-30-frequency') $values = (float)$value->text;
                        if ($labels == 'configurable-tdp-up-base-frequency') $values = (float)$value->text;
                        if ($labels == 'max-turbo-frequency') $values = (int)$value->text;
                        if ($labels == 'intel-speedstep-max-frequency') $values = (int)$value->text;
                        if ($labels == 'processor-base-frequency') $values = (int)$value->text;
                        if ($labels == 'intel-thermal-velocity-boost-frequency') $values = (int)$value->text;
                        if ($labels == 'performance-core-max-turbo-frequency') $values = (int)$value->text;
                        if ($labels == 'efficient-core-max-turbo-frequency') $values = (int)$value->text;
                        if ($labels == 'minimum-assured-frequency') $values = (int)$value->text;
                        if ($labels == 'maximum-assured-frequency') $values = (int)$value->text;
                        if ($labels == 'maximum-turbo-power') $values = (int)$value->text;
                        if ($labels == 'graphics-base-clock') $values = (int)$value->text;
                        if ($labels == 'graphics-max-dynamic-clock') $values = (int)$value->text;
                        //nm
                        if ($labels == 'lithography') $values = (int)$value->text;
                        //°
                        if ($labels == 'tjunction') $values = (int)$value->text;
                        if ($labels == 'operating-temperature-maximum') $values = (int)$value->text;
                        if ($labels == 'operating-temperature-minimum') $values = (int)$value->text;
                        if ($labels == 'intel-thermal-velocity-boost-temperature') $values = (int)$value->text;
                        if ($labels == 'dts-max') $values = (int)$value->text;
                        //,
                        if ($labels == '4k-support') $values = (int)$value->text;
                        //mm2
                        if ($labels == 'processing-die-size') $values = (int)$value->text;
                        //million
                        if ($labels == 'of-processing-die-transistors') $values = (int)$value->text;
                        //interfaces
                        if ($labels == 'uart') $values = (int)$value->text;
                        if ($labels == 'integrated-lan') $values = 0;
                    }
                    if ($labels == "mm") break;
                    if ($values == 'Yes') $values = 1;
                    if ($values == 'Yes with Intel SPS') $values = 1;
                    if ($values == 'Yes with Intel ME') $values = 1;
                    if ($values == 'Yes with both Intel SPS and Intel ME') $values = 1;
                    if ($values == 'No') $values = 0;
                    if ($values == 'NO') $values = 0;

                    $collection[$labels] = $values;

                }
                try
                {
                    (new \Modules\Intel\Entities\IntelElem)->addElement($elem->id, $elem->name, $collection);
                    echo $elem->id.' '.$elem->name.PHP_EOL;

                }
                catch(Exception $e)
                {
                    echo $elem->name.' Has error '.$e->getMessage().PHP_EOL;

                    if ($e->getCode() == '42S22') echo 'Column not found';
                    if ($e->getCode() == '22003') echo 'Integer error';
                    if ($e->getCode() == 'HY000') echo 'Column does not have default value';

                    continue;
                }
            }
        }
    }
}
