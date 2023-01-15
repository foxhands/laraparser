<?php

namespace Modules\Parser\Http\Controllers;

use Exception;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\Parser\Entities\Processor;
use voku\helper\HtmlDomParser;

class ParserController extends Controller
{
    public function parseProcessors()
    {
        $count = 20;

        for ($i = 0; $i < $count; $i++) {
            $techElem = 'https://technical.city/en/cpu/history?pg=' . $i . '&sort_field=default&sort_order=up&ajax=0';
            $page = (new \Modules\Parser\Services\ParserService)->curlGetPage($techElem);
            $baseUrl = 'https://technical.city';

            if (trim($page) == '') return false; else $html = HtmlDomParser::str_get_html($page);  // сайт недоступен, его мы не грузим

            foreach ($html->find('table.search-results tr[id] td[style]') as $item) {

                ///
                $rawText = explode('<a href="', $item->innertext);
                $cleanText = explode('">', $rawText[2]);
                $link = $cleanText[0];

                ///
                $name = str_replace('</a>', '', $cleanText[1]);
                ///
                echo $name . PHP_EOL;

                DB::table('processors')->updateOrInsert([
                    'name' => $name,
                    'url' => $baseUrl . $link,
                ]);

            }
        }
    }

    public function parseElement()
    {
       $processorElement = Processor::all()->chunk(10);

        foreach ($processorElement as $chunkItem) {

            foreach ($chunkItem as $elem) {

                $page = (new \Modules\Parser\Services\ParserService)->curlGetPage($elem->url);

                if (trim($page) == '') return false; else $html = HtmlDomParser::str_get_html($page);  // сайт недоступен, его мы не грузим

                foreach ($html->find('table.compare-table tbody tr') as $elemTable) {

                    foreach ($elemTable->find('td', 0) as $label) {
                        $labels = Str::slug($label->text);
                    }
                    foreach ($elemTable->find('td', 1) as $value) {
                        $values = Str::replace(['®', ' ‡', '‡', '*','™'],['', '', '', '', ''], $value->text);

                        if ($labels == 'physical-cores') $values = (int)$value->text;
                        if ($labels == 'threads') $values = (int)$value->text;
                        if ($labels == 'base-clock-speed') $values = (float)$value->text;
                        if ($labels == 'boost-clock-speed') $values = (float)$value->text;
                        if ($labels == 'l1-cache') $values = (int)$value->text;
                        if ($labels == 'l2-cache') $values = (int)$value->text;
                        if ($labels == 'l3-cache') $values = (int)$value->text;
                        if ($labels == 'chip-lithography') $values = (int)$value->text;
                        if ($labels == 'maximum-core-temperature') $values = (int)$value->text;
                        if ($labels == 'number-of-transistors') $values = (int)$value->text;
                        if ($labels == '64-bit-support') $values = (int)$value->text;
                        if ($labels == 'number-of-cpus-in-a-configuration') $values = (int)$value->text;
                        if ($labels == 'thermal-design-power-tdp') $values = (int)$value->text;
                        if ($labels == 'aes-ni') $values = (int)$value->text;
                        if ($labels == 'avx') $values = (int)$value->text;
                        if ($labels == 'amd-v') $values = (int)$value->text;
                        if ($labels == 'integrated-graphics-card') $values = (int)$value->text;
                        if ($labels == 'pcie-version') $values = (float)$value->text;
                        if ($labels == 'value-for-money') $values = (float)$value->text;
                        if ($labels == 'current-price') $values = (int)$value->text;
                        if ($labels == 'maximum-case-temperature-tcase') $values = (int)$value->text;
                        if ($labels == 'unlocked-multiplie') $values = (int)$value->text;
                        if ($labels == 'speed-shift') $values = (int)$value->text;
                        if ($labels == 'hyper-threading-technology') $values = (int)$value->text;
                        if ($labels == 'thermal-monitoring') $values = (int)$value->text;
                        if ($labels == 'flex-memory-access') $values = (int)$value->text;
                        if ($labels == 'edb') $values = (int)$value->text;
                        if ($labels == 'secure-key') $values = (int)$value->text;
                        if ($labels == 'os-guard') $values = (int)$value->text;
                        if ($labels == 'vt-d') $values = (int)$value->text;
                        if ($labels == 'vt-x') $values = (int)$value->text;
                        if ($labels == 'ept') $values = (int)$value->text;
                        if ($labels == 'maximum-memory-size') $values = (int)$value->text;
                        if ($labels == 'max-memory-channels') $values = (int)$value->text;
                        if ($labels == 'ecc-memory-support') $values = (int)$value->text;
                        if ($labels == 'quick-sync-video') $values = (int)$value->text;
                        if ($labels == 'graphics-max-frequency') $values = (int)$value->text;
                        if ($labels == 'execution-units') $values = (int)$value->text;
                        if ($labels == 'number-of-displays-supported') $values = (int)$value->text;
                        if ($labels == 'directx') $values = (int)$value->text;
                        if ($labels == 'opengl') $values = (float)$value->text;
                        if ($labels == 'pci-express-lanes') $values = (int)$value->text;
                        if ($labels == 'enhanced-speedstep-eist') $values = (int)$value->text;
                        if ($labels == 'tsx') $values = (int)$value->text;
                        if ($labels == 'txt') $values = (int)$value->text;
                        if ($labels == 'maximum-memory-bandwidth') $values = (float)$value->text;
                        if ($labels == 'sipp') $values = (int)$value->text;
                        if ($labels == 'turbo-boost-max-30') $values = (int)$value->text;
                        if ($labels == 'vpro') $values = (int)$value->text;
                        if ($labels == 'windows-11-compatibility') $values = (int)$value->text;
                        if ($labels == 'gpio') $values = (int)$value->text;
                        if ($labels == '4k-resolution-support') $values = (int)$value->text;
                        if ($labels == 'usb-revision') $values = (float)$value->text;
                        if ($labels == 'turbo-boost-technology') $values = (int)$value->text;
                        if ($labels == 'idle-states') $values = (int)$value->text;
                        if ($labels == 'clear-video-hd') $values = (int)$value->text;
                        if ($labels == 'launch-price-msrp') $values = (int)$value->text;
                        if ($labels == 'place-by-popularity') $values = (int)$value->text;
                        if ($labels == 'bus-support') $values = (int)$value->text;
                        if ($labels == 'quickassist') $values = (int)$value->text;
                        if ($labels == 'max-number-of-sata-6-gbs-ports') $values = (int)$value->text;
                        if ($labels == 'number-of-usb-ports') $values = (int)$value->text;
                        if ($labels == 'integrated-lan') $values = (int)$value->text;
                        if ($labels == 'identity-protection') $values = (int)$value->text;
                        if ($labels == 'max-video-memory') $values = (int)$value->text;
                        if ($labels == 'clear-video') $values = (int)$value->text;
                        if ($labels == 'intru-3d') $values = (int)$value->text;
                        if ($labels == 'mpx') $values = (int)$value->text;
                        if ($labels == 'smart-response') $values = (int)$value->text;
                        if ($labels == 'edp') $values = (int)$value->text;
                        if ($labels == 'displayport') $values = (int)$value->text;
                        if ($labels == 'hdmi') $values = (int)$value->text;
                        if ($labels == 'mipi-dsi') $values = (int)$value->text;
                        if ($labels == 'dvi') $values = (int)$value->text;
                        if ($labels == 'uart') $values = (int)$value->text;
                        if ($labels == 'anti-theft') $values = (int)$value->text;
                        if ($labels == 'total-number-of-sata-ports') $values = (int)$value->text;
                        if ($labels == 'secure-boot') $values = (int)$value->text;
                        if ($labels == 'my-wifi') $values = (int)$value->text;
                        if ($labels == 'fma') $values = (int)$value->text;
                        if ($labels == 'demand-based-switching') $values = (int)$value->text;
                        if ($labels == 'pae') $values = (int)$value->text;
                        if ($labels == 'edram') $values = (int)$value->text;
                        if ($labels == 'vt-i') $values = (int)$value->text;
                        if ($labels == 'smart-idle') $values = (int)$value->text;
                        if ($labels == 'smart-connect') $values = (int)$value->text;
                        if ($labels == 'hd-audio') $values = (int)$value->text;
                        if ($labels == 'rst') $values = (int)$value->text;
                        if ($labels == 'amt') $values = (int)$value->text;
                        if ($labels == 'quiet-system') $values = (int)$value->text;
                        if ($labels == 'powernow') $values = (int)$value->text;
                        if ($labels == 'frtc') $values = (int)$value->text;
                        if ($labels == 'freesync') $values = (int)$value->text;
                        if ($labels == 'igpu-core-count') $values = (int)$value->text;
                        if ($labels == 'switchable-graphics') $values = (int)$value->text;
                        if ($labels == 'vulkan') $values = (int)$value->text;
                        if ($labels == 'vid-voltage-range') $values = (int)$value->text;
                        if ($labels == 'powertune') $values = (int)$value->text;
                        if ($labels == 'trueaudio') $values = (int)$value->text;
                        if ($labels == 'powergating') $values = (int)$value->text;
                        if ($labels == 'virusprotect') $values = (int)$value->text;
                        if ($labels == 'enduro') $values = (int)$value->text;
                        if ($labels == 'uvd') $values = (int)$value->text;
                        if ($labels == 'vce') $values = (int)$value->text;
                        if ($labels == 'out-of-band-client-management') $values = (int)$value->text;
                        if ($labels == 'raid') $values = (int)$value->text;
                        if ($labels == 'iommu-20') $values = (int)$value->text;
                        if ($labels == 'xfr') $values = (int)$value->text;
                        if ($labels == 'sensemi') $values = (int)$value->text;
                        if ($labels == 'monero-xmr-cryptonight') $values = (int)$value->text;
                        if ($labels == 'bitcoin-btc-sha256') $values = (int)$value->text;
                        if ($labels == 'instruction-replay') $values = (int)$value->text;
                        if ($labels == 'dualgraphics') $values = (int)$value->text;
                        if ($labels == 'fdi') $values = (int)$value->text;
                        if ($labels == 'operating-temperature-range') $values = (int)$value->text;
                        if ($labels == 'number-of-pipelines') $values = (int)$value->text;
                        if ($labels == 'hsa') $values = (int)$value->text;
                        if ($labels == 'fast-memory-access') $values = (int)$value->text;
                        if ($labels == 'vga') $values = (int)$value->text;
                        if ($labels == 'matrix-storage') $values = (int)$value->text;
                        if ($labels == 'pci-support') $values = (int)$value->text;
                        if ($labels == 'integrated-ide') $values = (int)$value->text;
                        if ($labels == 'sdvo') $values = (int)$value->text;
                        if ($labels == 'crt') $values = (int)$value->text;
                        if ($labels == 'lvds') $values = (int)$value->text;
                        if ($labels == 'quick-resume') $values = (int)$value->text;
                        if ($labels == 'mipi') $values = (int)$value->text;
                        if ($labels == 'io-acceleration') $values = (int)$value->text;
                        if ($labels == 'fsb-parity') $values = (int)$value->text;

                    }
                    if ($values == 'Yes') $values = 1;
                    if ($values == '+') $values = 1;
                    if ($values == 'Yes with Intel SPS') $values = 1;
                    if ($values == 'Yes with Intel ME') $values = 1;
                    if ($values == 'Yes with both Intel SPS and Intel ME') $values = 1;
                    if ($values == '-') $values = 0;
                    if ($values == 'No') $values = 0;
                    if ($values == 'NO') $values = 0;
                    $collection[$labels] = $values;
                }
                try
                {
                    (new \Modules\Parser\Entities\Element)->addElement($elem->id, $elem->name, $collection);
                    echo $elem->id.' '.$elem->name.PHP_EOL;

                }
                catch(Exception $e)
                {
                    if ($e->getCode() == '42S22') echo 'Column not found';
                    echo $elem->name.$e->getMessage().PHP_EOL;
                    continue;
                }
            }
       }
    }
}
