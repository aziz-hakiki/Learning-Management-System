<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Inquiry;
use App\Models\ServiceSurvey;
use App\Models\TrainingProgram;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPortalTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function test_all_public_routes_render_successfully_with_semantic_landmarks(): void
    {
        $routes = [
            route('home'),
            route('profil.sejarah'),
            route('profil.tugas-fungsi'),
            route('profil.struktur'),
            route('profil.fasilitas'),
            route('program.corpu'),
            route('program.assessment'),
            route('diklat.index'),
            route('diklat.show', 'pelatihan-kepemimpinan-pengawas-pkp'),
            route('program.rintisan-gelar'),
            route('informasi.index'),
            route('informasi.show', 'pembukaan-program-pengembangan-kompetensi-tahun-berjalan'),
            route('publikasi.buletin'),
            route('ppid.index'),
            route('layanan.pengaduan'),
            route('layanan.aset'),
            route('elearning'),
            route('kontak.index'),
        ];

        foreach ($routes as $url) {
            $response = $this->get($url);
            $response->assertOk();
            $response->assertSee('<html lang="id">', false);
            $response->assertSee('id="main-content"', false);
            $response->assertSee('<h1', false);
        }
    }

    public function test_primary_navbar_omits_beranda_link_and_has_contact_button_and_elearning_submenu(): void
    {
        $response = $this->get(route('home'));
        $response->assertOk();
        $response->assertSee('id="desktop-menu-profil"', false);
        $response->assertSee('id="desktop-menu-program"', false);
        $response->assertSee('id="desktop-menu-publikasi"', false);
        $response->assertSee('id="desktop-menu-layanan"', false);
        $response->assertSee('E-Learning / LMS Corpu');
        $this->assertMatchesRegularExpression(
            '/<a[^>]+href="'.preg_quote(route('kontak.index'), '/').'"[^>]*>\s*Kontak\s*<\/a>/',
            $response->getContent()
        );
        $response->assertDontSee('>Beranda</a>', false);
        $this->assertDoesNotMatchRegularExpression('/<a[^>]*>\s*Akses E-Learning\s*<\/a>/', $response->getContent());
    }

    public function test_legacy_urls_redirect_cleanly_to_new_routes(): void
    {
        $this->get('/profil')->assertRedirect(route('profil.tugas-fungsi'));
        $this->get('/diklat')->assertRedirect(route('diklat.index'));
        $this->get('/informasi')->assertRedirect(route('informasi.index'));
        $this->get('/layanan-ppid')->assertRedirect(route('ppid.index'));
        $this->get('/e-learning')->assertRedirect(route('elearning'));
    }

    public function test_diklat_filter_endpoint_returns_matching_html_and_empty_state(): void
    {
        $filtered = $this->getJson(route('diklat.filter', ['category' => 'integritas']));
        $filtered->assertOk()
            ->assertJsonPath('count', 2);

        $empty = $this->getJson(route('diklat.filter', ['q' => 'kata-kunci-tidak-ada']));
        $empty->assertOk()
            ->assertJsonPath('count', 0);
        $this->assertStringContainsString('Program diklat tidak ditemukan', $empty->json('html'));
    }

    public function test_unpublished_program_or_article_returns_not_found(): void
    {
        TrainingProgram::create([
            'code' => 'DIKLAT-DRAFT-99',
            'title' => 'Program Draf Internal',
            'slug' => 'program-draf-internal',
            'category' => 'manajerial',
            'delivery_mode' => 'daring',
            'registration_status' => 'terjadwal',
            'summary' => 'Ringkasan draf.',
            'target_audience' => 'ASN',
            'schedule_label' => 'Draf',
            'published_at' => null,
        ]);

        Article::create([
            'title' => 'Berita Draf',
            'slug' => 'berita-draf',
            'type' => 'berita',
            'excerpt' => 'Ringkasan',
            'body' => 'Isi draf',
            'published_at' => null,
        ]);

        $this->get(route('diklat.show', 'program-draf-internal'))->assertNotFound();
        $this->get(route('informasi.show', 'berita-draf'))->assertNotFound();
    }

    public function test_public_forms_validate_and_persist_inquiries_and_survey(): void
    {
        $invalidContact = $this->from(route('kontak.index'))
            ->post(route('kontak.store'), [
                'sender_name' => 'A',
                'sender_email' => 'bukan-email',
                'subject' => 'Hi',
                'message' => 'Pendek',
            ]);

        $invalidContact->assertRedirect(route('kontak.index'));
        $invalidContact->assertSessionHasErrors(['sender_name', 'sender_email', 'subject', 'message']);

        $this->post(route('kontak.store'), [
            'sender_name' => 'Peserta Uji Portal',
            'sender_email' => 'peserta.uji@example.test',
            'sender_unit' => 'Unit Kerja Uji',
            'subject' => 'Permintaan informasi akun LMS uji',
            'message' => 'Mohon bantuan verifikasi status akun pelatihan peserta uji coba.',
        ])->assertRedirect(route('kontak.index'))->assertSessionHas('contact_success');

        $this->post(route('ppid.store'), [
            'sender_name' => 'Pemohon Uji PPID',
            'sender_email' => 'ppid.uji@example.test',
            'subject' => 'Permohonan salinan daftar diklat uji',
            'message' => 'Mengajukan permohonan daftar informasi publik untuk keperluan verifikasi uji.',
        ])->assertRedirect(route('ppid.index', ['#permohonan-ppid']))->assertSessionHas('ppid_success');

        $this->post(route('layanan.pengaduan.store'), [
            'sender_name' => 'Pelapor Uji Layanan',
            'sender_email' => 'aduan.uji@example.test',
            'subject' => 'Pengaduan kendala akses ruang kelas',
            'message' => 'Menyampaikan laporan kendala fasilitas pengeras suara ruang kelas uji.',
        ])->assertRedirect(route('layanan.pengaduan', ['#form-pengaduan']))->assertSessionHas('complaint_success');

        $this->post(route('layanan.aset.store'), [
            'sender_name' => 'Mitra Uji Aset',
            'sender_email' => 'aset.uji@example.test',
            'subject' => 'Permintaan jadwal pemanfaatan auditorium',
            'message' => 'Mengajukan permohonan pengecekan jadwal penggunaan auditorium bulan depan.',
        ])->assertRedirect(route('layanan.aset', ['#permohonan-aset']))->assertSessionHas('asset_success');

        $this->assertSame(6, Inquiry::count());
        $this->assertDatabaseHas('inquiries', ['type' => 'pengaduan_layanan', 'sender_email' => 'aduan.uji@example.test']);
        $this->assertDatabaseHas('inquiries', ['type' => 'penyewaan_aset', 'sender_email' => 'aset.uji@example.test']);

        $this->post(route('layanan.survei.store'), [
            'service_type' => 'lms_corpu',
            'respondent_name' => 'Responden Uji',
            'rating_clarity' => 4,
            'rating_speed' => 3,
            'rating_officer' => 4,
            'rating_facility' => 4,
            'feedback' => 'Akses materi pembelajaran daring berjalan lancar.',
        ])->assertRedirect(route('layanan.pengaduan', ['#form-survei']))->assertSessionHas('survey_success');

        $this->assertSame(1, ServiceSurvey::count());
    }
}
