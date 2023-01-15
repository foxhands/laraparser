<?php

namespace Modules\Amd\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\Amd\Entities\AmdProcessor;
use voku\helper\HtmlDomParser;
Use Exception;

class AmdController extends Controller
{

    /**
     * Show the form for creating a new resource.
     * @void
     */
    public function processorUpdateOrCreate()
    {
        $url = 'https://www.amd.com/en/products/specifications/processors';
        $baseUrl = 'https://www.amd.com/en/product/';

        $page = (new \Modules\Amd\Services\ParserService)->curlGetPage($url);
        if (trim($page) == '') return false; else $html = HtmlDomParser::str_get_html($page);  // сайт недоступен, его мы не грузим


        foreach ($html->find('table tr td[class^=term-]') as $item) {
            //
            $arr = explode(" ",$item);
            $res = $arr[2];
            $link = $baseUrl.str_replace('entity-', '', $res);

            //
            $rawProcessor = str_replace(['AMD','™','®', ' Processor'], '',$item->text);
            $rawNameProcessor = explode("(",$rawProcessor);
            $clearNameProcessor = explode(" with", $rawNameProcessor[0]);
            $nameProcessor = explode(" Microsoft",$clearNameProcessor[0]);
            $name = trim($nameProcessor[0]);

            //
            DB::table('amd_processors')->updateOrInsert([
                'name' => $name,
                'url' => $link,
            ]);
        }
    }

    public function elementUpdateOrCreate(){
        $processorElement = AmdProcessor::all()->chunk(10);
        foreach ($processorElement as $chunkItem) {
            foreach ($chunkItem as $elem) {
                $page = (new \Modules\Amd\Services\ParserService)->curlGetPage($elem->url);
                if (trim($page) == '') return false; else $html = HtmlDomParser::str_get_html($page);  // сайт недоступен, его мы не грузим
                foreach ($html->find('div.field') as $elemDiv) {
                    foreach ($elemDiv->find('div.field__label') as $label) {
                        $labels = Str::slug($label->text);
                    }
                    foreach ($elemDiv->find('div.field__item') as $value) {
                        $values = Str::replace(['®', ' ‡', '‡', '*', '™','"','&quot;'], '', $value->text);
                        //int

                        if ($labels == 'of-cpu-cores') $values = (int)$value->text;
                        if ($labels == 'of-threads') $values = (int)$value->text;
                        if ($labels == 'l1-cache') $values = (int)$value->text;
                        if ($labels == 'l2-cache') $values = (int)$value->text;
                        if ($labels == 'l3-cache') $values = (int)$value->text;
                        if ($labels == 'max-boost-clock') $values = (int)$value->text;
                        if ($labels == 'base-clock') $values = (int)$value->text;
                        if ($labels == 'default-tdp') $values = (int)$value->text;
                        if ($labels == 'processor-technology-for-cpu-cores') $values = (int)$value->text;
                        if ($labels == 'processor-technology-for-io-die') $values = (int)$value->text;
                        if ($labels == 'cpu-compute-die-ccd-size') $values = (int)$value->text;
                        if ($labels == 'io-die-iod-size') $values = (int)$value->text;
                        if ($labels == 'package-die-count') $values = (int)$value->text;
                        if ($labels == 'unlocked-for-overclocking') $values = (int)$value->text;
                        if ($labels == 'amd-expo-memory-overclocking-technology') $values = (int)$value->text;
                        if ($labels == 'precision-boost-overdrive') $values = (int)$value->text;
                        if ($labels == 'max-operating-temperature-tjmax') $values = (int)$value->text;
                        if ($labels == 'usb-type-c-support') $values = (int)$value->text;
                        if ($labels == 'native-usb-32-gen-2-10gbps-ports') $values = (int)$value->text;
                        if ($labels == 'native-usb-20-480mbps-ports') $values = (int)$value->text;
                        if ($labels == 'pci-express-version') $values = (int)$value->text;
                        if ($labels == 'max-memory') $values = (int)$value->text;
                        if ($labels == 'graphics-core-count') $values = (int)$value->text;
                        if ($labels == 'graphics-frequency') $values = (int)$value->text;
                        if ($labels == 'gpu-base') $values = (int)$value->text;
                        if ($labels == 'directx-version') $values = (int)$value->text;
                        if ($labels == 'displayport-version') $values = (int)$value->text;
                        if ($labels == 'hdmi-version') $values = (int)$value->text;
                        if ($labels == 'hdcp-version-supported') $values = (int)$value->text;
                        if ($labels == 'usb-type-c-displayport-alternate-mode') $values = (int)$value->text;
                        if ($labels == 'multi-monitor-support') $values = (int)$value->text;
                        if ($labels == 'max-displays') $values = (int)$value->text;
                        if ($labels == 'amd-freesync') $values = (int)$value->text;
                        if ($labels == 'amd-smartshift-max') $values = (int)$value->text;
                        if ($labels == 'amd-smartaccess-memory') $values = (int)$value->text;
                        if ($labels == 'amd-enhanced-virus-protection-nx-bit') $values = (int)$value->text;
                        if ($labels == 'curve-optimizer-voltage-offsets') $values = (int)$value->text;
                        if ($labels == 'native-usb-4-40gbps-ports') $values = (int)$value->text;
                        if ($labels == 'total-graphics-shaders') $values = (int)$value->text;
                        if ($labels == 'gpu-max-memory') $values = (int)$value->text;
                        if ($labels == 'wddm-version') $values = (int)$value->text;
                        if ($labels == 'opengl') $values = (int)$value->text;
                        if ($labels == 'opencl') $values = (int)$value->text;
                        if ($labels == 'amd-eyefinity-single-large-surface-sls') $values = (int)$value->text;
                        if ($labels == 'system-memory-specification') $values = (int)$value->text;
                        if ($labels == 'dash-support') $values = (int)$value->text;
                        if ($labels == 'amd-memory-guard') $values = (int)$value->text;
                        if ($labels == 'amd-secure-processor-support') $values = (int)$value->text;
                        if ($labels == 'windows-secure-boot-support') $values = (int)$value->text;
                        if ($labels == 'uefi-secure-boot-support') $values = (int)$value->text;
                        if ($labels == 'windows-device-guard-support') $values = (int)$value->text;
                        if ($labels == 'guest-mode-execution-gmet-trap-support') $values = (int)$value->text;
                        if ($labels == 'virtualization-based-security-vbs-support') $values = (int)$value->text;
                        if ($labels == 'windows-secured-core-pc-support') $values = (int)$value->text;
                        if ($labels == 'firmware-tpm') $values = (int)$value->text;
                        if ($labels == 'amd-v-svm-support') $values = (int)$value->text;
                        if ($labels == 'amd-v-nested-paging-rvi-support') $values = (int)$value->text;
                        if ($labels == 'amd-avic-interrupt-virtualization-support') $values = (int)$value->text;
                        if ($labels == 'amd-vi-io-mmu-virtualization-support') $values = (int)$value->text;
                        if ($labels == 'second-level-address-translation-slat-supported') $values = (int)$value->text;
                        if ($labels == 'advanced-encryption-standard-new-instructions-aes-ni') $values = (int)$value->text;
                        if ($labels == 'native-usb-32-gen-1-5gbps-ports') $values = (int)$value->text;
                        if ($labels == 'amd-ryzen-master-support') $values = (int)$value->text;
                        if ($labels == 'native-sata-ports') $values = (int)$value->text;
                        if ($labels == 'total-transistor-count') $values = (float)$value->text;
                        if ($labels == 'pcie-dma-security') $values = (int)$value->text;
                        if ($labels == 'usb-dma-security') $values = (int)$value->text;
                        if ($labels == 'amd-ryzen-master-eco-mode') $values = (int)$value->text;
                        if ($labels == 'all-core-boost-speed') $values = (float)$value->text;
                        if ($labels == '1ku-pricing') $values = (int)$value->text;
                        if ($labels == 'per-socket-mem-bw') $values = (float)$value->text;
                    }
                    if ($values == 'Yes') $values = 1;
                    if ($values == 'Yes (Requires platform support)') $values = 1;
                    if ($values == 'No') $values = 0;

                    $collection[$labels] = $values;
                }
//                dd($collection);
                    try
                    {
                        (new \Modules\Amd\Entities\AmdElement)->addElement($elem->id, $elem->name,$collection);
                        echo $elem->id.' '.$elem->name.PHP_EOL;
                    }
                    catch(Exception $e)
                    {
                        if ($e->getCode() == '42S22') echo $error = 'Column not found';
                        echo $elem->name.$e->getMessage().PHP_EOL;
                        continue;
                    }
            }
        }
    }
}
