<?php


use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Enum\PackageStatusEnum;
use App\Models\Package;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

class CSVImportTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_can_import_packages_from_csv_file()
    {
        $this->actingAs(User::factory()->create()); // Simuleer een geauthenticeerde gebruiker

        Storage::fake('csv');

        // Fake CSV met meerdere regels
        $content = <<<CSV
john.doe@example.com,John,Doe,123 Street,123,12345,City,1
jane.doe@example.com,Jane,Doe,456 Street,456,67890,City,1
CSV;

        $file = UploadedFile::fake()->createWithContent('packages.csv', $content);

        Livewire::test(\App\Http\Livewire\Package\ShowPackages::class)
            ->set('file', $file)
            ->call('import');

        // Assert the packages were imported successfully
        $this->assertEquals(2, Package::count());
        $package1 = Package::where('email', 'john.doe@example.com')->first();
        $this->assertEquals('John', $package1->firstname);
        $this->assertEquals('Doe', $package1->lastname);
        $this->assertEquals('123 Street', $package1->streetname);
        $this->assertEquals('123', $package1->housenumber);
        $this->assertEquals('12345', $package1->zipcode);
        $this->assertEquals('City', $package1->city);
        $this->assertEquals(1, $package1->shop_id);

        $package2 = Package::where('email', 'jane.doe@example.com')->first();
        $this->assertEquals('Jane', $package2->firstname);
        $this->assertEquals('Doe', $package2->lastname);
        $this->assertEquals('456 Street', $package2->streetname);
        $this->assertEquals('456', $package2->housenumber);
        $this->assertEquals('67890', $package2->zipcode);
        $this->assertEquals('City', $package2->city);
        $this->assertEquals(1, $package2->shop_id);

        // Assert that the package statuses are updated after import
        $this->assertEquals(PackageStatusEnum::PRINTED, $package1->status);
        $this->assertEquals(PackageStatusEnum::PRINTED, $package2->status);
    }
}
