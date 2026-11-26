<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Faq;
use App\Models\Inquiry;
use App\Models\PublicDocument;
use App\Models\TrainingProgram;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PortalFoundationTest extends TestCase
{
    use RefreshDatabase;

    public function test_database_seeder_populates_expected_records_idempotently(): void
    {
        $this->seed(DatabaseSeeder::class);
        $this->seed(DatabaseSeeder::class);

        $this->assertSame(2, User::count());
        $this->assertSame(9, TrainingProgram::published()->count());
        $this->assertSame(6, Article::published()->count());
        $this->assertSame(7, PublicDocument::published()->count());
        $this->assertSame(6, Faq::active()->count());
        $this->assertSame(2, Inquiry::count());
    }

    public function test_training_program_filter_narrows_by_category_and_keyword(): void
    {
        $this->seed(DatabaseSeeder::class);

        $integritas = TrainingProgram::published()->filter('integritas', null)->get();
        $this->assertCount(2, $integritas);

        $prestasi = TrainingProgram::published()->filter('integritas', 'KPK')->get();
        $this->assertCount(1, $prestasi);
        $this->assertSame('DIKLAT-INT-01', $prestasi->first()->code);

        $byCode = TrainingProgram::published()->filter(null, 'DIKLAT-PTT-03')->get();
        $this->assertCount(1, $byCode);
        $this->assertSame('teknis', $byCode->first()->category);
    }

    public function test_inquiry_reference_code_increments_sequentially(): void
    {
        $this->seed(DatabaseSeeder::class);

        $nextPpid = Inquiry::generateReferenceCode('permohonan_ppid');
        $nextHelpdesk = Inquiry::generateReferenceCode('kontak_helpdesk');

        $year = now()->format('Y');
        $this->assertSame("PPID-{$year}-0002", $nextPpid);
        $this->assertSame("HD-{$year}-0002", $nextHelpdesk);
    }

    public function test_seeded_dummy_assets_exist_on_disk(): void
    {
        $this->seed(DatabaseSeeder::class);

        $paths = collect([
            '/images/dummy/hero-kampus-dummy.svg',
            '/images/dummy/kampus-fasilitas-dummy.svg',
            '/favicon.svg',
        ])
            ->merge(TrainingProgram::pluck('thumbnail_path')->filter())
            ->merge(Article::pluck('cover_image_path')->filter())
            ->merge(Article::pluck('attachment_path')->filter())
            ->merge(PublicDocument::pluck('file_path')->filter())
            ->unique();

        foreach ($paths as $relativePath) {
            $this->assertFileExists(public_path(ltrim($relativePath, '/')));
        }
    }
}
