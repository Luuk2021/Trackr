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

    public function test_it_can_generate_pdf_for_selected_packages()
    {
        $this->artisan('db:wipe');
        $this->artisan('migrate');
        $this->artisan('db:seed');

        $user = \App\Models\User::find(2);

        $this->actingAs($user); // Simuleer een geauthenticeerde gebruiker

        Storage::fake('csv');

        // Fake CSV met meerdere regels
        $content = <<<CSV
csvjohn.doe@example.com,John,Doe,123 Street,123,1234ab,City,1
jane.doe@example.com,Jane,Doe,456 Street,456,5678cd,City,1
CSV;

        $file = UploadedFile::fake()->createWithContent('packages.csv', $content);

        Livewire::test(\App\Http\Livewire\Package\ShowPackages::class)
            ->set('file', $file)
            ->call('import');

        Livewire::test(\App\Http\Livewire\Package\ShowPackages::class)
            ->set('selectedPackages', Package::all()->pluck('id')->toArray())
            ->call('generateSelectedPDFs')
            ->assertSuccessful();
    }
}
