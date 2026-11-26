# Product Requirements Document (PRD): Pembaruan Tampilan dan Portal Web PPSDMAP BPSDMP Kemenhub

**Nama Proyek:** Pembaruan Portal Web Pusat Pengembangan Sumber Daya Manusia Aparatur Perhubungan (PPSDMAP)  
**Domain Target:** `https://ppsdmap.bpsdm.kemenhub.go.id/`  
**Stack Teknis:** Laravel 12 (`^12.0`), PHP (`^8.2`), Tailwind CSS v4 (`@tailwindcss/vite`), Vite (`^6.0.11`), SQLite (lokal) / MySQL atau PostgreSQL (produksi)  
**Standar Kualitas UI/UX:** Anti-Slop (`anti-slop/antislop.md`), Mode **1 (DURING)**  
**Status Dokumen:** Draft PRD v1.0 (Siap ditinjau sebelum penyusunan `DESIGN.md` dan implementasi)

---

## 1. Ringkasan Eksekutif

Proyek ini bertujuan memperbarui tampilan, struktur informasi, dan pengalaman pengguna website resmi **Pusat Pengembangan Sumber Daya Manusia Aparatur Perhubungan (PPSDMAP)** di bawah Badan Pengembangan Sumber Daya Manusia Perhubungan (BPSDMP), Kementerian Perhubungan Republik Indonesia, menggunakan **Laravel 12** di workspace `c:\laragon\www\web-ppsdmap`.

Pembaruan difokuskan pada peralihan dari antarmuka portal lama yang terasa padat dan usang menuju portal layanan informasi kediklatan dan tata kelola aparatur yang modern, terbaca jelas di perangkat seluler maupun desktop, aksesibel (WCAG AA), dan bebas dari pola desain generik buatan AI (*AI slop*) dengan menerapkan filter aturan dari repositori `anti-slop` sejak tahap perencanaan hingga verifikasi akhir.

### Catatan Cakupan Audit Situs Eksisting
Saat PRD ini disusun, audit visual langsung via browser ke `https://ppsdmap.bpsdm.kemenhub.go.id/` belum dapat dijalankan karena koneksi Chrome DevTools MCP (`DevToolsActivePort`) belum aktif di lingkungan lokal. Informasi domain pada dokumen ini dirangkum dari sumber publik resmi BPSDMP Kemenhub serta struktur proyek Laravel di workspace. Pemetaan halaman lama yang lebih rinci perlu diverifikasi ulang melalui audit browser sebelum tahap finalisasi konten.

---

## 2. Latar Belakang dan Masalah yang Diselesaikan

### 2.1 Konteks Instansi (Terverifikasi dari Sumber Publik Resmi)
PPSDMAP merupakan unit kerja eselon II di bawah BPSDMP Kementerian Perhubungan yang berkedudukan di **Jl. Raya Parung - Bogor KM. 26,4, Kabupaten Bogor, Jawa Barat**. Tugas pokoknya adalah melaksanakan penyusunan kebijakan teknis, pelaksanaan, pemantauan, evaluasi, dan pelaporan di bidang pendidikan dan pelatihan (diklat) manajerial, struktural, fungsional, teknis kedinasan, dan pembinaan pembangunan karakter bagi SDM aparatur perhubungan.

Program dan layanan utama PPSDMAP mencakup:
1. Pelatihan Struktural, Kepemimpinan, dan Manajerial (antara lain PKP, PKA, serta pembinaan manajerial ASN).
2. Pelatihan Teknis Transportasi (PTT Tingkat III dan IV, keselamatan transportasi, kesyahbandaran, angkutan multimoda, pengadaan barang/jasa pemerintah).
3. Pelatihan Pembentukan Karakter dan Integritas (seperti **PRESTASI** bekerja sama dengan KPK serta pelatihan mandiri Zona Integritas menuju WBK/WBBM).
4. Orientasi PPPK, Latsar CPNS Pola Pembibitan, Webinar Series PPSDMAP, serta Program Rintisan Gelar Pascasarjana.
5. Layanan keterbukaan informasi publik (PPID), dukungan teknis LMS / E-Learning (terhubung ke ekosistem BPSDMP / EduHub), dan layanan helpdesk peserta.

### 2.2 Masalah yang Ingin Diselesaikan dengan Pembaruan
1. **Hierarki Informasi dan Tampilan Kurang Modern:** Portal pemerintah/diklat lama umumnya menumpuk banyak tautan, banner, dan teks dalam tata letak sempit sehingga menyulitkan ASN atau peserta diklat menemukan jadwal, katalog program, dan akses masuk LMS dengan cepat.
2. **Pengalaman Mobile dan Aksesibilitas:** Peserta diklat dan aparatur sering mengakses informasi pelatihan, pengumuman, dan PPID melalui ponsel di lapangan. Tata letak harus melakukan *reflow* yang rapi di semua lebar layar, bukan sekadar mengecilkan tampilan desktop (`R-03`).
3. **Risiko Desain Generik AI (*AI Slop*):** Penggunaan generator kode modern berisiko menghasilkan tampilan kloning template SaaS (gradasi biru-ungu, kartu fitur seragam, statistik karangan, badge dekoratif, atau navigasi mati). Proyek ini mengikat seluruh proses desain dan pengembangan ke aturan `anti-slop` dalam mode **DURING**.

---

## 3. Tujuan Produk dan Kriteria Keberhasilan

### 3.1 Tujuan Utama
- Menyajikan identitas digital PPSDMAP yang berwibawa, informatif, dan mudah dipindai oleh ASN Kemenhub, calon peserta diklat, instansi mitra, dan masyarakat umum.
- Menyediakan jalur cepat yang jelas menuju program diklat, pengumuman terbaru, layanan PPID, serta gerbang akses E-Learning / LMS.
- Memastikan seluruh halaman berjalan di atas arsitektur Laravel 12 yang bersih, cepat, mudah dikelola melalui panel admin internal, serta siap diganti dari aset dummy ke aset resmi instansi.

### 3.2 Kriteria Keberhasilan yang Dapat Diuji (Tanpa Angka Klaim Fiktif)
Sesuai `R-17`, `R-36`, dan `R-40`, proyek ini tidak menargetkan angka metrik fiktif yang tidak diukur. Keberhasilan diukur melalui kondisi nyata saat pengujian rilis:
- Seluruh tautan navigasi (header, isi halaman, footer) mengarah ke halaman atau destinasi yang benar-benar berfungsi (`R-24`, `R-26`).
- Seluruh teks dan kontrol interaktif lolos pengecekan rasio kontras WCAG AA (minimal 4.5:1 teks normal, 3:1 teks besar dan batas komponen) menggunakan `anti-slop/skills/antislop-human/contrast-check.py` (`R-25`).
- Tidak ada *horizontal overflow*, teks terpotong, atau tombol di bawah ukuran sentuh 44 x 44 px pada viewport ponsel (360px), tablet (768px), laptop kecil (1024px), hingga desktop (1440px) (`R-03`).
- Semua tampilan data memiliki tiga status lengkap: *empty state*, *loading state*, dan *error state* (`R-27`).
- Lulus seluruh 4 blok **Delivery Gate** pada `anti-slop/antislop.md` dengan bukti klik per elemen (`R-35`).

---

## 4. Target Pengguna (Persona)

1. **ASN dan Calon Peserta Diklat Kemenhub / Instansi Terkait:** Mencari katalog pelatihan, jadwal/status angkatan, persyaratan, pengumuman pemanggilan, serta pintu masuk cepat menuju LMS E-Learning dan FAQ kendala teknis.
2. **Pimpinan Unit Kerja dan Pengelola Kepegawaian (Biro/Bagian SDM):** Meninjau profil kelembagaan, tugas dan fungsi PPSDMAP, daftar program pengembangan kompetensi tahun berjalan, serta kanal koordinasi kerja sama.
3. **Masyarakat Umum dan Pemohon Informasi Publik:** Mengakses informasi keterbukaan publik (PPID), komitmen Zona Integritas (WBK/WBBM), dokumen regulasi, dan layanan kontak/pengaduan resmi.
4. **Administrator / Tim Humas & Kediklatan PPSDMAP:** Mengelola berita, pengumuman, katalog diklat, dokumen PPID, FAQ, serta pesan masuk melalui panel admin Laravel.

---

## 5. Ruang Lingkup Produk

### 5.1 Dalam Ruang Lingkup (Fase 1: Portal Publik, Katalog Diklat, dan CMS Laravel)
- **Portal Publik PPSDMAP** berbasis Laravel 12 Blade + Tailwind CSS v4.
- **Katalog Program dan Diklat** dengan pencarian, filter rumpun pelatihan, dan halaman detail program.
- **Portal Berita, Pengumuman, dan Agenda** dengan kategori dan detail artikel.
- **Halaman Profil Kelembagaan** (Tugas & Fungsi, Struktur Organisasi, Pimpinan, Fasilitas Kampus Parung menggunakan aset dummy terlabel).
- **Halaman Layanan PPID, Regulasi, dan Zona Integritas** (dokumen terstruktur, form permohonan informasi/pengaduan).
- **Halaman Gerbang E-Learning & FAQ Khusus PPSDMAP** (panduan akses LMS, tautan ke platform LMS aktif, serta pertanyaan yang spesifik mengenai diklat PPSDMAP).
- **Halaman Kontak & Helpdesk** beserta formulir pesan yang tersimpan ke database dan memberi umpan balik jelas.
- **Panel Admin CMS Ringan** di Laravel (`/admin`) untuk mengelola konten katalog diklat, berita/pengumuman, dokumen PPID, FAQ, dan kotak masuk formulir, lengkap dengan autentikasi pengguna.
- **Seeder Data dan Aset Dummy Terstruktur** sesuai instruksi pengguna, namun ditandai secara jujur sesuai aturan `R-23` dan `R-38`.

### 5.2 Di Luar Ruang Lingkup Awal (Opsi Fase 2, Perlu Konfirmasi Terpisah)
- Pembangunan ulang mesin LMS inti (modul kuis, SCORM player, penilaian tugas, sertifikat otomatis, dan manajemen kelas sinkronus) di dalam Laravel. Pada Fase 1, LMS diasumsikan tetap berjalan pada sistem existing (atau terhubung lewat tautan/SSO eksternal) sementara portal Laravel berfungsi sebagai etalase resmi, katalog program, informasi publik, dan gerbang masuknya.
- Integrasi API real-time ke database SIASN BKN atau aplikasi kepegawaian internal Kemenhub (dapat disiapkan antarmuka adapter jika endpoint tersedia pada fase lanjutan).

---

## 6. Strategi Aset Dummy dan Kejujuran Konten (Kepatuhan `R-17`, `R-18`, `R-23`, `R-38`)

Pengguna telah menyetujui penggunaan aset dummy untuk logo, foto, dan elemen visual lain pada tahap pembangunan awal. Agar tetap mematuhi aturan `anti-slop` tanpa menyamarkan data tiruan sebagai fakta resmi:

1. **Logo Instansi:** Menggunakan komponen SVG geometris sederhana atau wordmark tipografi resmi dengan label kode/alt `[LOGO DUMMY PPSDMAP]` yang terisolasi dalam satu partial Blade (`components/brand-logo.blade.php`) agar mudah ditukar satu kali dengan logo resmi Kementerian Perhubungan dan BPSDMP.
2. **Foto Pimpinan, Kegiatan, dan Kampus:** Menggunakan aset gambar dummy lokal berdimensi eksplisit (`width`, `height`, dan `aspect-ratio`) dengan keterangan `[FOTO DUMMY]` pada seeder/metadata admin. Tidak menggunakan avatar AI yang diberi nama atau jabatan orang fiktif seolah-olah pejabat nyata (`R-18`, `R-38`). Untuk informasi pejabat yang terverifikasi di sumber publik (misal jabatan Kepala Pusat), teks tetap merujuk pada struktur organisasi resmi atau menggunakan placeholder posisi yang jelas.
3. **Statistik dan Angka Capaian:** Tidak menampilkan kartu angka karangan seperti "10.000+ Alumni" atau "99,9% Kepuasan" tanpa sumber resmi (`R-17`). Jika slot statistik dibutuhkan di tata letak, tampilkan label eksplisit `[DATA RESMI MENYUSUL]` di UI atau tampilkan hanya hitungan nyata dari database Laravel (misal jumlah program yang terdaftar di katalog aktif).
4. **Testimoni:** Bagian testimoni peserta **tidak dibuat** selama belum ada kutipan dan identitas narasumber alumni yang nyata dan terverifikasi (`R-18`, `C-3`).

---

## 7. Arsitektur Informasi dan Spesifikasi Halaman

Seluruh rute navigasi harus mengarah ke halaman nyata (`R-24`). Navigasi utama di header desktop terdiri dari **4 menu dropdown aksesibel** (tanpa tautan teks `Beranda`, di mana logo portal mengarah ke `/`) ditambah **1 tombol aksi primer `Kontak`** di sebelah kanan.

### 7.1 Peta Situs (Sitemap)

| Rute URL | Menu / Nama Halaman | Tujuan Utama | Komponen / Fitur Kunci |
|---|---|---|---|
| `/` | Beranda (via Logo) | Mengenalkan peran PPSDMAP dan mengarahkan pengunjung ke layanan utama | Hero fokus tunggal, Jalur Cepat Layanan, Katalog Diklat Unggulan, Berita & Pengumuman terbaru, Komitmen Zona Integritas & PPID |
| `/profil/sejarah` | Profil: Sejarah | Menyajikan riwayat perkembangan kelembagaan PPSDMAP | Lini masa periode pengembangan lembaga dengan penanda jujur data arsip |
| `/profil/tugas-fungsi` | Profil: Tugas dan Fungsi | Menyajikan mandat resmi BPSDMP Kemenhub pada PPSDMAP | Tugas pokok dan 5 fungsi penyelenggaraan kediklatan serta kedudukan kampus |
| `/profil/struktur-organisasi` | Profil: Struktur Organisasi | Memaparkan susunan organisasi unit kerja | Kepala Pusat (Eselon II.b), Bagian Tata Usaha, Bidang Teknis & Fungsional |
| `/profil/fasilitas` | Profil: Fasilitas | Menginformasikan sarana belajar di Kampus Parung | Gedung kelas, auditorium, asrama peserta, dan ruang asesmen (aset dummy) |
| `/program/corporate-university` | Program: Corporate University | Menjelaskan ekosistem Kemenhub Corporate University | Pilar pembelajaran 10-20-70, pemenuhan 20 JP, dan keterkaitan LMS Corpu |
| `/program/assessment-center` | Program: Assessment Center | Memaparkan layanan penilaian dan pemetaan kompetensi ASN | Ruang lingkup asesmen manajerial/sosial kultural dan alur pengajuan unit kerja |
| `/program/pelatihan` | Program: Pelatihan | Membantu ASN mencari dan memilih program pelatihan | Pencarian judul, filter rumpun, daftar program dengan status, state kosong/loading/error |
| `/program/pelatihan/{slug}` | Detail Program Pelatihan | Memberi informasi lengkap sebelum peserta mendaftar/masuk LMS | Ringkasan program, sasaran peserta, metode, kurikulum, jadwal, tombol ke LMS |
| `/program/rintisan-gelar` | Program: Rintisan Gelar/Beasiswa | Menjelaskan fasilitasi tugas belajar dan beasiswa pascasarjana | Jalur pembekalan akademik dan daftar program fungsional terkait |
| `/publikasi/berita` | Publikasi: Berita | Pusat kabar kegiatan, rilis, pengumuman, dan agenda | Filter kategori (Berita, Pengumuman, Agenda Kegiatan), artikel utama, paginasi |
| `/publikasi/berita/{slug}` | Detail Berita/Pengumuman | Halaman baca yang nyaman dan aksesibel | Tipografi artikel nyaman baca, metadata tanggal & kategori, lampiran PDF, berita terkait |
| `/publikasi/e-buletin` | Publikasi: E-Buletin | Arsip terbitan buletin berkala digital PPSDMAP | Pencarian edisi, filter tahun terbit, unduhan PDF e-buletin |
| `/layanan/ppid` | Layanan: PPID | Keterbukaan informasi dan tata kelola WBK/WBBM | Daftar informasi publik & regulasi (dapat difilter) serta formulir permohonan PPID |
| `/layanan/pengaduan-survei` | Layanan: Pengaduan & Survei | Kanal umpan balik layanan publik dan evaluasi mutu peserta | Formulir pengaduan layanan dan formulir survei kepuasan layanan (SKM) |
| `/layanan/penyewaan-aset` | Layanan: Penyewaan Aset | Informasi pemanfaatan fasilitas kampus sesuai PNBP | Daftar sarana/aset kampus (data dummy) dan formulir permintaan ketersediaan aset |
| `/layanan/lms-corpu` | Layanan: E-Learning / LMS Corpu | Menjembatani portal informasi dengan platform LMS Corpu | Alur masuk peserta, modal checklist persiapan, program daring, dan FAQ PPSDMAP |
| `/kontak` | Kontak & Helpdesk | Kanal komunikasi resmi ke PPSDMAP (tombol kanan header) | Alamat Parung KM 26,4, email & helpdesk resmi, formulir tiket bantuan |
| `/admin/*` | Panel Admin CMS | Pengelolaan konten internal oleh operator | Login/Auth, Dashboard operasional, CRUD Diklat, Artikel, PPID/E-Buletin, FAQ, Kotak Masuk & Survei |

### 7.2 Rancangan Komposisi Beranda (Menghindari Pola Template Seragam `R-05` & `R-14`)

Halaman beranda wajib memiliki variasi komposisi antar bagian sesuai ritme konten (*RHYTHM*), bukan mengulang pola "judul rata tengah + 3 atau 6 kartu identik":

1. **Header & Navigasi Global:**
   - Logo + nama instansi (`PPSDMAP Kemenhub`) yang menjadi tautan ke `/`, 4 menu dropdown klik/keyboard (`Profil`, `Program`, `Publikasi`, `Layanan`, dengan `E-Learning / LMS Corpu` berada di bawah `Layanan`), dan satu tombol aksi kanan (`Kontak`).
   - Pada mobile, menu beralih menjadi drawer navigasi yang dapat dibuka dengan tombol berlabel jelas `Menu` (bukan ikon hamburger tanpa keterangan), memuat akordeon sub-menu per kelompok, dapat ditutup dengan tombol tutup maupun tombol `Escape`, dan mengembalikan fokus ke tombol pemicu (`R-03`, `R-26`, `R-32`).
   - Tersedia *skip link* `Langsung ke konten utama` di paling atas untuk pengguna keyboard (`R-32`).
2. **Bagian 1: Hero Fokus Tunggal (Split Editorial):**
   - Kolom kiri: Judul `<h1>` yang spesifik tentang peran PPSDMAP mengembangkan kompetensi aparatur perhubungan (tanpa pil kategori/eyebrow badge di atas `<h1>` sesuai `R-09`), paragraf ringkas tanpa jargon AI, satu CTA primer (`Lihat Katalog Diklat`), dan satu CTA sekunder (`Masuk ke E-Learning`).
   - Kolom kanan: Foto utama gedung/aktivitas kediklatan dummy dengan tag HTML `<img>` langsung (bukan CSS background), memiliki `width`/`height` eksplisit, tidak memakai `loading="lazy"`, dan memakai `fetchpriority="high"` (`R-40`). Jika teks bersentuhan dengan gambar, wajib dilapisi scrim agar kontras teks selalu >= 4.5:1 (`R-25`).
3. **Bagian 2: Jalur Layanan Utama (Tata Letak Asimetris Berhierarki):**
   - Membedakan layanan prioritas (misal Akses LMS & Katalog Pelatihan Teknis/Manajerial) dengan porsi ruang lebih dominan, sementara layanan pendukung (Layanan PPID, Helpdesk Peserta, Pengaduan WBK/WBBM) tampil dalam daftar terstruktur yang ringkas, bukan 4 kartu dengan ukuran dan padding kembar (`R-14`).
4. **Bagian 3: Program Pengembangan Kompetensi (Tab/Filter Rumpun Interaktif):**
   - Menampilkan tab filter kategori pelatihan dengan atribut ARIA tabs yang lengkap (`role="tablist"`, `role="tab"`, `aria-selected`, navigasi panah keyboard) serta status loading/kosong/gagal yang informatif (`R-27`, `R-32`, `R-39`).
   - Menampilkan kartu program dengan variasi sorotan untuk program unggulan (seperti PRESTASI, PTT, dan Orientasi PPPK) dan tautan nyata ke `/diklat/{slug}`.
5. **Bagian 4: Kabar Terbaru & Pengumuman (Layout Editorial 2 Kolom Tidak Simetris):**
   - Kolom kiri lebih lebar untuk 1 berita utama lengkap dengan foto berasio tetap, tanggal, dan ringkasan.
   - Kolom kanan berupa daftar padat berisi 3 sampai 4 pengumuman/agenda terbaru tanpa foto berulang, sehingga mudah dipindai layaknya buletin instansi resmi.
6. **Bagian 5: Tata Kelola, Zona Integritas (WBK/WBBM), dan Akses Informasi Publik (PPID):**
   - Blok kontras terpisah yang menjelaskan komitmen birokrasi bersih serta tautan langsung ke dokumen PPID, regulasi, dan form permohonan informasi.
7. **Footer Khusus Konteks Instansi (`R-05`):**
   - Menghindari template 4 kolom generik Produk/Perusahaan/Sumber Daya/Legal. Footer disusun sesuai struktur informasi nyata PPSDMAP:
     - Kolom Identitas & Alamat Kantor (PPSDMAP, BPSDMP Kementerian Perhubungan, Jl. Raya Parung - Bogor KM. 26,4, Kab. Bogor, Jawa Barat 16310, beserta jam layanan placeholder/resmi).
     - Kolom Tautan Portal & Layanan (Profil, Katalog Diklat, Berita & Pengumuman, Layanan PPID, E-Learning).
     - Kolom Kontak & Kanal Resmi (Email `ppsdmap@kemenhub.go.id`, Helpdesk `0811 1175 430` atau `[KONFIRMASI KONTAK AKTIF]`, tautan ke BPSDMP / Kemenhub).

### 7.3 Spesifikasi Panel Admin CMS (`/admin`)
Mengikuti standar **App & Dashboard** pada `anti-slop/skills/antislop-ui/SKILL.md`:
- Tidak menggunakan shell admin generik berisi 4 kartu angka fiktif dan grafik tanpa pertanyaan (`Charts Without a Question`, `Stat Cards With Invented Numbers`).
- Halaman utama `/admin` berfokus pada tugas kerja operator: daftar pengumuman/diklat terbaru yang statusnya draf atau aktif, serta antrean pesan helpdesk/permohonan PPID yang belum dibalas.
- Sidebar navigasi admin dikelompokkan berdasarkan pekerjaan (Konten Publik: Berita, Program Diklat; Tata Kelola: Dokumen PPID, FAQ; Interaksi: Kotak Masuk; Sistem: Pengguna Admin), memiliki penanda aktif yang jelas (bukan sekadar warna latar tipis), tombol collapse ber-`aria-expanded`, serta sheet menu yang berfungsi di layar ponsel (`R-03`, `R-24`, `R-39`).
- Tabel menampilkan kolom yang menentukan keputusan operator (misal pada tabel Diklat: Judul, Rumpun, Metode, Status Pendaftaran, Terakhir Diperbarui, Aksi Nyata Edit/Lihat/Arsipkan), tanpa menu titik tiga yang berisi aksi mati (`R-26`).

---

## 8. Arah Desain Visual dan Kepatuhan Anti-Slop

### 8.1 Prasyarat Wajib: Penyusunan `DESIGN.md` (`R-37`)
Sesuai aturan `R-37`, `anti-slop` adalah filter, bukan penentu gaya. Sebelum fase penulisan kode UI dimulai, tim wajib menyepakati dan membuat file `DESIGN.md` di root proyek. Berikut usulan arah desain default untuk dikonfirmasi pengguna sebelum masuk ke `DESIGN.md`:

- **Design Read Usulan:**  
  `Reading this as: Portal informasi dan layanan kediklatan aparatur perhubungan untuk ASN Kemenhub dan publik, in a Editorial Layanan Publik Instansi yang bersih dan berwibawa style, dial ENERGY 2 / RHYTHM 2 / MOTION 1.`
- **Pilihan Mode Tema (`R-21`, `R-34`):**  
  Menggunakan **Light Mode** sebagai mode utama (latar kertas bersih/off-white untuk kenyamanan baca dokumen regulasi, berita, dan katalog pelatihan). Apabila tombol toggle Light/Dark disertakan, kedua mode wajib dirancang tuntas dan diverifikasi kontrasnya di setiap komponen (`R-34`). Rekomendasi awal adalah Light Mode penuh terlebih dahulu agar kualitas kontras dan detail tipografi maksimal, atau menyertakan toggle penuh jika dibutuhkan.
- **Batas Palet Warna (`R-29`, `R-01`, `R-25`):**  
  Maksimal 2 sampai 3 warna inti + 1 aksen (di luar netral putih/hitam/abu):
  - Warna Inti 1: Biru Maritim / Navy Perhubungan gelap (untuk header/elemen otoritas dan teks aksen gelap).
  - Warna Inti 2: Slate Hangat / Batu Sabak (untuk permukaan sekunder/panel informasi).
  - Warna Aksen Tunggal: Kuning/Emas Perhubungan atau Amber terukur yang hanya dipakai pada titik fokus penting (tombol aksi primer, penanda aktif tab, atau indikator status).
  - Seluruh pasangan teks dan latar belakang wajib diuji menggunakan `anti-slop/skills/antislop-human/contrast-check.py` sebelum dipakai di CSS.
- **Tipografi dengan Alasan (`R-06`):**  
  Pemilihan font akan ditetapkan di `DESIGN.md` (menghindari pemakaian monospace besar untuk gaya terminal maupun label uppercase berjarak huruf ekstrem pada setiap judul bagian). Menggunakan pasangan huruf yang mendukung keterbacaan panjang dalam Bahasa Indonesia untuk berita/regulasi dan kejelasan angka/jadwal pada tabel diklat.
- **Aturan Ketat Elemen Dekoratif dan Gerak (`R-04` sampai `R-19`):**
  - Dilarang memakai tanda pisah panjang em dash (`U+2014`) di seluruh copy UI maupun artikel bawaan (`R-02`).
  - Dilarang memakai emoji dekoratif pada judul, tombol, maupun daftar fitur (`R-04`).
  - Dilarang memakai garis warna dekoratif di sisi kiri kartu (*colored left stripe*) kecuali membawa arti status nyata (`R-01`, `R-31`).
  - Dilarang memberi panah (`→` atau `↗`) pada setiap tombol secara otomatis; gunakan hanya jika memang menandakan navigasi eksternal menuju LMS (`R-08`).
  - Dilarang memakai badge kapsul berbunyi "Modern", "Smart", "Terintegrasi AI", atau titik status berkedip tanpa data live nyata (`R-09`, `R-19`).
  - Gerakan (*MOTION 1*) terbatas pada transisi hover, focus, buka/tutup drawer/modal, dan penghormatan penuh terhadap `prefers-reduced-motion: reduce` (`R-19`, `R-39`).

---

## 9. Kebutuhan Non-Fungsional (Aksesibilitas, Responsivitas, Performa, Keamanan)

### 9.1 Aksesibilitas dan Interaksi Manusia (`R-32`, `R-39`, `antislop-human`)
- Struktur dokumen HTML utuh: `<html lang="id">`, `<title>` unik per halaman, landmark `<header>`, `<nav>`, `<main id="main-content">`, `<footer>`, tepat satu `<h1>` per halaman, dan urutan heading tanpa melompati level.
- Viewport meta tidak boleh mengunci zoom (`user-scalable=no` dan `maximum-scale=1` dilarang). Teks harus aman saat diperbesar 200%.
- Aturan CSS dasar menetapkan `cursor: pointer` pada seluruh kontrol interaktif aktif (`a[href]`, `button`, `summary`, `select`, `label[for]`, checkbox/radio) dan `cursor: not-allowed` pada elemen `:disabled` / `[aria-disabled="true"]`.
- Seluruh aksi non-navigasi memakai `<button type="button|submit">`, bukan `<div>` atau `<span>` yang diklik.
- Tombol ikon saja (seperti tombol tutup modal atau tombol cari) wajib memiliki `aria-label` yang jelas dan ikon bertanda `aria-hidden="true"`.
- Semua kolom formulir memakai `<label for="...">` yang terlihat jelas (bukan hanya placeholder) serta pesan error yang terhubung lewat `aria-describedby` dan `role="alert"` / `aria-live="polite"`.
- Seluruh elemen interaktif dapat diakses lewat keyboard (`Tab`, `Shift+Tab`, `Enter`, `Space`, `Escape`) dengan indikator `:focus-visible` berasio kontras minimal 3:1.

### 9.2 Responsivitas Mobile (`R-03`, `antislop-layoutmobile`)
- Mendukung minimal 3 kondisi tata letak (*reflow*): layar sempit/ponsel (kolom tunggal), layar menengah/tablet (grid 2 kolom adaptif), dan desktop (layout penuh), bukan hanya 2 kondisi yang membuat tampilan tablet terasa janggal.
- Ukuran font menggunakan skala fluid (`clamp()`) atau token responsif per breakpoint sehingga judul desktop tidak membesar berlebihan di ponsel.
- Bagian hero tidak boleh dipaksa `100vh` bila menyebabkan isi terpotong atau mendorong seluruh konten terlalu jauh di ponsel; tinggi mengikuti konten atau memakai `min-height` yang proporsional.
- Seluruh target klik/sentuh minimal 44 x 44 px dengan jarak antar tombol yang cukup agar tidak salah sentuh.
- Tabel data (seperti daftar dokumen PPID atau tabel admin) pada ponsel harus dibungkus kontainer gulir terkendali atau direstrukturisasi menjadi daftar vertikal tanpa menyebabkan *horizontal scroll* pada `<body>`.

### 9.3 Mekanisme Performa dan Baseline Keamanan (`R-40`, `WEB-BASELINE.md`)
- Seluruh `<img>`, `<video>`, dan `<iframe>` memiliki atribut `width` dan `height` (atau CSS `aspect-ratio`) untuk mencegah pergeseran tata letak (CLS).
- Tidak ada skrip pihak ketiga yang memblokir render di `<head>`.
- Aset CSS/JS dikompilasi melalui Vite (`npm run build`) dan tidak pernah dimodifikasi dengan skrip patching string eksternal (`R-33`).
- Semua formulir dilindungi token CSRF Laravel, validasi server-side `FormRequest`, sanitasi output Blade `{{ }}`, serta atribut `rel="noopener noreferrer"` pada seluruh tautan eksternal (`target="_blank"`).

---

## 10. Arsitektur Teknis dan Model Data Laravel 12

### 10.1 Struktur Direktori dan Komponen Laravel yang Direncanakan
- **Controllers:**
  - `HomeController` (mengorkestrasi data beranda)
  - `ProfileController` (sejarah, tugas dan fungsi, struktur organisasi, fasilitas)
  - `ProgramController` (corporate university, assessment center, katalog & detail pelatihan, endpoint filter, rintisan gelar)
  - `ArticleController` (berita, pengumuman, agenda, detail)
  - `PublicationController` (arsip E-Buletin PPSDMAP)
  - `PpidController` (informasi publik PPID, regulasi, pengajuan permohonan)
  - `ServiceController` (pengaduan layanan, survei kepuasan, dan penyewaan aset)
  - `ElearningController` (gerbang LMS Corpu & FAQ PPSDMAP)
  - `ContactController` (halaman kontak & simpan pesan helpdesk)
  - `Admin\*Controller` (autentikasi dan manajemen CRUD konten)
- **Database Schema (Migrations Awal):**
  - `training_programs`: `id`, `code`, `title`, `slug`, `category` (manajerial/teknis/fungsional/integritas/orientasi/webinar), `delivery_mode` (klasikal/blended/daring), `registration_status` (dibuka/terjadwal/mandiri/selesai), `summary`, `curriculum` (json), `target_audience`, `schedule_label`, `lms_url`, `thumbnail_path`, `is_featured`, `is_dummy`, `published_at`, `timestamps`.
  - `articles`: `id`, `title`, `slug`, `type` (berita/pengumuman/agenda), `excerpt`, `body`, `cover_image_path`, `attachment_path`, `event_date`, `is_featured`, `is_dummy`, `published_at`, `timestamps`.
  - `public_documents`: `id`, `title`, `category` (berkala/serta-merta/setiap-saat/regulasi/zona-integritas/ebuletin), `document_number`, `year`, `description`, `file_path`, `external_url`, `is_dummy`, `published_at`, `timestamps`.
  - `faqs`: `id`, `category`, `question`, `answer`, `sort_order`, `is_active`, `is_dummy`, `timestamps`.
  - `inquiries`: `id`, `reference_code`, `type` (kontak_helpdesk/permohonan_ppid/pengaduan_layanan/penyewaan_aset), `sender_name`, `sender_email`, `sender_phone`, `sender_unit`, `subject`, `message`, `status` (baru/diproses/selesai), `admin_notes`, `responded_at`, `timestamps`.
  - `service_surveys`: `id`, `service_type`, `respondent_name`, `respondent_unit`, `rating_clarity`, `rating_speed`, `rating_officer`, `rating_facility`, `feedback`, `timestamps`.
  - `users`: menggunakan tabel bawaan Laravel dengan kolom `role` (admin/editor) dan `unit_name` untuk akses `/admin`.
- **Views & Components:**
  - `resources/views/layouts/app.blade.php` (shell publik semantik)
  - `resources/views/layouts/admin.blade.php` (shell admin dengan sidebar responsif)
  - `resources/views/components/` (komponen UI terstandar: `brand-logo`, `button`, `program-card`, `state-empty`, `state-error`, `breadcrumb`, `modal-dialog`)
  - `resources/css/app.css` (token Tailwind CSS v4 `@theme`, layer base `cursor: pointer`, focus ring `:focus-visible`, aturan `prefers-reduced-motion`)

---

## 11. Rencana Tahapan Pelaksanaan (Roadmap Implementasi)

1. **Tahap 0: Klarifikasi & Audit Visual (Opsional Sebelum `DESIGN.md`)**
   - Mengulang audit browser terhadap `https://ppsdmap.bpsdm.kemenhub.go.id/` jika Chrome remote debugging diaktifkan, untuk mencocokkan tautan eksternal/LMS aktual dan kebutuhan halaman tambahan.
   - Menyelesaikan integrasi skill `anti-slop` ke `.agents/skills/` dan `GEMINI.md` apabila disetujui oleh pemilik proyek.
2. **Tahap 1: Penetapan `DESIGN.md`**
   - Menetapkan pilihan arah visual, palet warna terverifikasi kontras (`contrast-check.py`), skala tipografi, token radius/spasi, serta nilai dial (`ENERGY / RHYTHM / MOTION`).
3. **Tahap 2: Fondasi Backend, Skema Database, dan Seeder Dummy**
   - Membuat migrasi database, model Eloquent, `DatabaseSeeder` dengan data contoh dan penanda dummy yang jelas, serta aset gambar/logo dummy terukur dimensinya.
4. **Tahap 3: Implementasi Antarmuka Publik (Blade + Tailwind v4)**
   - Membangun layout utama, navigasi desktop/mobile, beranda, profil, katalog & detail diklat, berita & pengumuman, PPID, gerbang E-Learning & FAQ, serta kontak.
   - Melengkapi seluruh tampilan data dengan empty, loading, dan error states.
5. **Tahap 4: Implementasi Panel Admin CMS**
   - Membangun autentikasi admin dan modul manajemen konten (Diklat, Berita/Pengumuman, Dokumen PPID, FAQ, Kotak Masuk).
6. **Tahap 5: Verifikasi Delivery Gate Anti-Slop dan Pengujian**
   - Menjalankan `npm run build`, Laravel Feature Tests (`php artisan test`), pemeriksaan kontras dengan `contrast-check.py`, uji klik langsung setiap kontrol (`R-35`) di breakpoint mobile/tablet/desktop, uji navigasi keyboard, serta menyusun laporan PASS/FAIL **Delivery Gate** lengkap sebelum serah terima.

---

## 12. Keputusan Terbuka yang Perlu Dikonfirmasi Sebelum Tahap Berikutnya (`DESIGN.md`)

Agar tahap penyusunan `DESIGN.md` dan penulisan kode berjalan tepat sasaran sesuai jawaban awal Anda, mohon konfirmasi beberapa poin berikut:
1. **Ruang Lingkup LMS:** Apakah Fase 1 cukup membangun **Portal Publik + Katalog Diklat + CMS Admin + Tautan ke LMS yang sudah ada**, sesuai usulan pada Bagian 5?
2. **Arah Gaya Desain (`DESIGN.md`):** Apakah Anda menyetujui arah **Editorial Layanan Publik Instansi yang tenang dan berwibawa** (`ENERGY 2 / RHYTHM 2 / MOTION 1`), atau ingin nuansa yang lebih kontras/tegas (`ENERGY 2-3 / RHYTHM 3`)? Apakah juga diperlukan fitur toggle **Mode Gelap (Dark Mode)**?
3. **Integrasi Anti-Slop di Antigravity:** Apakah Anda mengizinkan saya menyalin folder `anti-slop/skills/*` ke `.agents/skills/` dan menulis blok pointer di `GEMINI.md` agar aturan otomatis dimuat di setiap sesi?
4. **Audit Situs Eksisting:** Apakah Anda ingin mengaktifkan remote debugging Chrome (`chrome://inspect/#remote-debugging`) agar saya membedah struktur aktual `https://ppsdmap.bpsdm.kemenhub.go.id/` sebelum menyusun `DESIGN.md`, atau langsung lanjut menyusun `DESIGN.md` dari spesifikasi PRD ini?
