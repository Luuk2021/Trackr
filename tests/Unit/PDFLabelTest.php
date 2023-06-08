<?php


use Tests\TestCase;
use App\Enum\PackageStatusEnum;
use App\Models\Package;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

class PDFLabelTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_it_can_generate_pdf_for_selected_packages()
    {
        // Create and save some packages
        $packages = Package::factory()->count(3)->create();

        Livewire::test(\App\Http\Livewire\Package\ShowPackages::class)
            ->set('selectedPackages', $packages->pluck('id')->toArray())
            ->call('generateSelectedPDFs')
            ->assertSuccessful()
            ->assertHeader('content-disposition', 'attachment; filename=trackr_labels.pdf');
    }
}
