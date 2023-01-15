<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amd_elements', function (Blueprint $table) {
            $table->id();
            $table->integer('processor_id');
            $table->string('platform')->nullable()->default(NULL);
            $table->string('product-family')->nullable()->default(NULL);
            $table->string('product-line')->nullable()->default(NULL);
            $table->integer('amd-pro-technologies')->nullable()->default(NULL);
            $table->integer('consumer-use')->nullable()->default(NULL);
            $table->string('regional-availability')->nullable()->default(NULL);
            $table->string('former-codename')->nullable()->default(NULL);
            $table->string('architecture')->nullable()->default(NULL);
            $table->smallInteger('of-cpu-cores')->nullable()->default(NULL);
            $table->smallInteger('multithreading-smt')->nullable()->default(NULL);
            $table->smallInteger('of-threads')->nullable()->default(NULL);
            $table->smallInteger('max-boost-clock')->nullable()->default(NULL);
            $table->smallInteger('base-clock')->nullable()->default(NULL);
            $table->smallInteger('l1-cache')->nullable()->default(NULL);
            $table->smallInteger('l2-cache')->nullable()->default(NULL);
            $table->smallInteger('l3-cache')->nullable()->default(NULL);
            $table->smallInteger('default-tdp')->nullable()->default(NULL);
            $table->string('amd-configurable-tdp-ctdp')->nullable()->default(NULL);
            $table->smallInteger('processor-technology-for-cpu-cores')->nullable()->default(NULL);
            $table->smallInteger('processor-technology-for-io-die')->nullable()->default(NULL);
            $table->smallInteger('cpu-compute-die-ccd-size')->nullable()->default(NULL);
            $table->smallInteger('io-die-iod-size')->nullable()->default(NULL);
            $table->smallInteger('package-die-count')->nullable()->default(NULL);
            $table->smallInteger('unlocked-for-overclocking')->nullable()->default(NULL);
            $table->smallInteger('amd-expo-memory-overclocking-technology')->nullable()->default(NULL);
            $table->smallInteger('precision-boost-overdrive')->nullable()->default(NULL);
            $table->string('cpu-socket')->nullable()->default(NULL);
            $table->string('cpu-boost-technology')->nullable()->default(NULL);
            $table->string('instruction-set')->nullable()->default(NULL);
            $table->string('supported-extensions')->nullable()->default(NULL);
            $table->smallInteger('max-operating-temperature-tjmax')->nullable()->default(NULL);
            $table->string('os-support')->nullable()->default(NULL);
            $table->smallInteger('usb-type-c-support')->nullable()->default(NULL);
            $table->smallInteger('native-usb-32-gen-2-10gbps-ports')->nullable()->default(NULL);
            $table->smallInteger('native-usb-20-480mbps-ports')->nullable()->default(NULL);
            $table->string('pci-express-version')->nullable()->default(NULL);
            $table->string('native-pcie-lanes-totalusable')->nullable()->default(NULL);
            $table->string('nvme-support')->nullable()->default(NULL);
            $table->string('system-memory-type')->nullable()->default(NULL);
            $table->string('memory-channels')->nullable()->default(NULL);
            $table->smallInteger('max-memory')->nullable()->default(NULL);
            $table->string('system-memory-subtype')->nullable()->default(NULL);
            $table->string('max-memory-speed')->nullable()->default(NULL);
            $table->string('ecc-support')->nullable()->default(NULL);
            $table->smallInteger('integrated-graphics')->nullable()->default(NULL);
            $table->string('graphics-model')->nullable()->default(NULL);
            $table->smallInteger('graphics-core-count')->nullable()->default(NULL);
            $table->smallInteger('graphics-frequency')->nullable()->default(NULL);
            $table->smallInteger('gpu-base')->nullable()->default(NULL);
            $table->smallInteger('directx-version')->nullable()->default(NULL);
            $table->smallInteger('displayport-version')->nullable()->default(NULL);
            $table->smallInteger('hdmi-version')->nullable()->default(NULL);
            $table->smallInteger('hdcp-version-supported')->nullable()->default(NULL);
            $table->smallInteger('usb-type-c-displayport-alternate-mode')->nullable()->default(NULL);
            $table->smallInteger('multi-monitor-support')->nullable()->default(NULL);
            $table->smallInteger('max-displays')->nullable()->default(NULL);
            $table->smallInteger('amd-freesync')->nullable()->default(NULL);
            $table->string('wireless-display')->nullable()->default(NULL);
            $table->smallInteger('amd-smartshift-max')->nullable()->default(NULL);
            $table->smallInteger('amd-smartaccess-memory')->nullable()->default(NULL);
            $table->string('product-id-tray')->nullable()->default(NULL);
            $table->smallInteger('amd-enhanced-virus-protection-nx-bit')->nullable()->default(NULL);
            $table->smallInteger('curve-optimizer-voltage-offsets')->nullable()->default(NULL);
            $table->smallInteger('native-usb-4-40gbps-ports')->nullable()->default(NULL);
            $table->string('displayport-extensions')->nullable()->default(NULL);
            $table->string('displayport-max-refresh-rates-sdr')->nullable()->default(NULL);
            $table->string('displayport-max-refresh-rates-hdr')->nullable()->default(NULL);
            $table->string('max-video-encode-bandwidth-sdr')->nullable()->default(NULL);
            $table->string('max-video-decode-bandwidth')->nullable()->default(NULL);
            $table->string('launch-date')->nullable()->default(NULL);
            $table->smallInteger('total-graphics-shaders')->nullable()->default(NULL);
            $table->smallInteger('gpu-max-memory')->nullable()->default(NULL);
            $table->smallInteger('wddm-version')->nullable()->default(NULL);
            $table->smallInteger('opengl')->nullable()->default(NULL);
            $table->smallInteger('opencl')->nullable()->default(NULL);
            $table->smallInteger('amd-eyefinity-single-large-surface-sls')->nullable()->default(NULL);
            $table->smallInteger('system-memory-specification')->nullable()->default(NULL);
            $table->smallInteger('dash-support')->nullable()->default(NULL);
            $table->smallInteger('amd-memory-guard')->nullable()->default(NULL);
            $table->smallInteger('amd-secure-processor-support')->nullable()->default(NULL);
            $table->smallInteger('windows-secure-boot-support')->nullable()->default(NULL);
            $table->smallInteger('uefi-secure-boot-support')->nullable()->default(NULL);
            $table->smallInteger('windows-device-guard-support')->nullable()->default(NULL);
            $table->smallInteger('guest-mode-execution-gmet-trap-support')->nullable()->default(NULL);
            $table->smallInteger('virtualization-based-security-vbs-support')->nullable()->default(NULL);
            $table->smallInteger('windows-secured-core-pc-support')->nullable()->default(NULL);
            $table->smallInteger('firmware-tpm')->nullable()->default(NULL);
            $table->smallInteger('amd-v-svm-support')->nullable()->default(NULL);
            $table->smallInteger('amd-v-nested-paging-rvi-support')->nullable()->default(NULL);
            $table->smallInteger('amd-avic-interrupt-virtualization-support')->nullable()->default(NULL);
            $table->smallInteger('amd-vi-io-mmu-virtualization-support')->nullable()->default(NULL);
            $table->smallInteger('second-level-address-translation-slat-supported')->nullable()->default(NULL);
            $table->smallInteger('advanced-encryption-standard-new-instructions-aes-ni')->nullable()->default(NULL);
            $table->smallInteger('native-usb-32-gen-1-5gbps-ports')->nullable()->default(NULL);
            $table->string('socket-count')->nullable()->default(NULL);
            $table->string('product-id-boxed')->nullable()->default(NULL);
            $table->string('supported-technologies')->nullable()->default(NULL);
            $table->string('market-segment')->nullable()->default(NULL);
            $table->smallInteger('amd-ryzen-master-support')->nullable()->default(NULL);
            $table->string('supporting-chipsets')->nullable()->default(NULL);
            $table->smallInteger('native-sata-ports')->nullable()->default(NULL);
            $table->string('additional-usable-pcie-lanes-from-motherboard')->nullable()->default(NULL);
            $table->string('thermal-solution-pib')->nullable()->default(NULL);
            $table->string('product-id-mpk')->nullable()->default(NULL);
            $table->smallInteger('total-transistor-count')->nullable()->default(NULL);
            $table->smallInteger('pcie-dma-security')->nullable()->default(NULL);
            $table->smallInteger('usb-dma-security')->nullable()->default(NULL);
            $table->smallInteger('amd-ryzen-master-eco-mode')->nullable()->default(NULL);
            $table->string('thermal-solution-mpk')->nullable()->default(NULL);
            $table->smallInteger('all-core-boost-speed')->nullable()->default(NULL);
            $table->smallInteger('1ku-pricing')->nullable()->default(NULL);
            $table->smallInteger('per-socket-mem-bw')->nullable()->default(NULL);
            $table->string('workload-affinity')->nullable()->default(NULL);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('amd_elements');
    }
};
