# DESIGN.md: Arah Desain Visual Portal Web PPSDMAP BPSDMP Kemenhub

Dokumen ini menjadi sumber arah desain (*style direction*) untuk seluruh antarmuka publik dan panel admin pada proyek Laravel `web-ppsdmap` sebagaimana dipersyaratkan oleh `R-37` pada `anti-slop`.

---

## 1. Identitas, Kepribadian, dan Dials

- **Nama Produk:** Portal Informasi dan Layanan Kediklatan PPSDMAP (Pusat Pengembangan SDM Aparatur Perhubungan, BPSDMP Kementerian Perhubungan).
- **Kepribadian Desain:** Editorial Tata Kelola Publik yang Berwibawa, Jernih, dan Terstruktur ("Lembaran Kediklatan & Regulasi Perhubungan Modern"). Tampilan tidak meniru produk SaaS gelap atau startup teknologi, melainkan memadukan keterbacaan editorial dokumen negara dengan navigasi katalog pelatihan yang praktis di layar ponsel maupun desktop.
- **Mode Tema (`R-21`):** **Light Mode Tunggal** pada Fase 1. Alasan: ASN dan calon peserta diklat mengakses silabus, surat pemanggilan, dan dokumen PPID di lingkungan kantor maupun lapangan dengan pencahayaan terang; mempertahankan satu tema terang terkalibrasi menjamin keterbacaan optimal tanpa beban pemeliharaan mode ganda yang setengah jadi (`R-34`).
- **Dial:** `ENERGY 2 / RHYTHM 2 / MOTION 1`
  - **ENERGY 2 (Balanced Authority):** Kontras tipografi yang tegas dan blok warna biru maritim yang berwibawa tanpa ornamen berlebihan.
  - **RHYTHM 2 (Structured Variety):** Grid dasar yang disiplin dengan variasi komposisi antarbagian (hero split editorial, jalur layanan berhierarki, direktori diklat interaktif, buletin berita asimetris, serta blok tata kelola berlatar kontras).
  - **MOTION 1 (Functional Restraint):** Terbatas pada respons hover/focus, buka-tutup drawer navigasi, tab kategori, dan modal native `<dialog>`. Nol animasi melayang terus-menerus, nol pulse dekoratif, nol *scroll-reveal* berantai, dan tunduk penuh pada `prefers-reduced-motion: reduce`.
- **Design Read:**
  `Reading this as: Portal informasi publik dan katalog kediklatan aparatur perhubungan untuk ASN Kemenhub dan masyarakat, in an Institutional Civic Editorial style, dial ENERGY 2 / RHYTHM 2 / MOTION 1.`

---

## 2. Motif Identitas (Pembeda dari Template Generik)

Agar desain tetap terasa khas PPSDMAP walaupun logo disembunyikan (`antislop` Core Principle):
1. **Kanvas Kertas Editorial Hangat (`#F8F7F4`):** Menghindari latar putih polos yang terasa steril maupun latar gelap ala situs developer.
2. **Garis Horizon Penanda Hierarki:** Garis aksen tegas selebar `3px` berwarna Emas Perhubungan (`#E5A91A` di atas permukaan gelap, `#8A5A00` di atas permukaan terang) yang hanya dipakai pada titik penanda struktural (penanda halaman aktif, tab terpilih, dan tajuk bagian otoritas), bukan garis tempelan di setiap kartu (`R-01`, `R-31`).
3. **Kode Referensi Kediklatan Tabular:** Setiap program diklat, nomor dokumen PPID, dan tanggal agenda memakai angka tabular (`font-variant-numeric: tabular-nums`) berjarak rapi dengan gaya arsip resmi instansi.

---

## 3. Palet Warna dan Hasil Uji Kontras Terukur (`R-25`, `R-29`)

Sesuai batas `R-29`, palet dibatasi menjadi **2 warna inti** + **1 warna aksen terukur**, di luar warna netral (putih, hitam, abu/kertas) dan warna status semantik fungsional.

### 3.1 Token Warna

| Peran Token | Nama CSS (`@theme`) | Nilai Hex | Penggunaan Spesifik |
|---|---|---|---|
| **Core 1 (Utama)** | `--color-maritime-900` | `#0B2545` | Judul utama, blok Zona Integritas & Footer resmi, tombol primer gelap |
| **Core 1 (Interaktif)** | `--color-maritime-800` | `#133C6D` | State hover tombol primer gelap, tautan teks standar pada latar terang |
| **Core 2 (Pendukung)** | `--color-marine-700` | `#1E4E79` | Header sekunder, label kategori utama, panel ringkasan lembaga |
| **Core 2 (Tint Lembut)** | `--color-marine-100` | `#EAF0F6` | Latar panel sorotan aktif atau kotak informasi panduan |
| **Aksen (Utama)** | `--color-hub-gold` | `#E5A91A` | Hanya untuk tombol CTA utama di atas area gelap, penanda fokus di area gelap, dan garis horizon aksen (maks. 1-2 fokus per layar) |
| **Aksen (Hover)** | `--color-hub-gold-hover` | `#D4990E` | State hover tombol Emas Perhubungan |
| **Aksen (Teks Terang)** | `--color-hub-ochre` | `#8A5A00` | Teks/ikon aksen terukur di atas latar putih atau kertas hangat |
| **Netral Kanvas** | `--color-paper` | `#F8F7F4` | Latar halaman utama |
| **Netral Permukaan** | `--color-surface` | `#FFFFFF` | Permukaan kartu katalog, formulir input, panel tabel admin |
| **Netral Redup** | `--color-stone` | `#F1EFEA` | Pemisah antarband halaman yang tenang (dipakai selektif) |
| **Netral Teks Utama** | `--color-ink` | `#1B2430` | Paragraf isi dan label kontrol |
| **Netral Teks Sekunder** | `--color-ink-muted` | `#4B5563` | Tanggal terbit, metadata kategori, teks bantu formulir |
| **Netral Garis Tipis** | `--color-rule` | `#D6D3CB` | Garis pemisah struktural non-interaktif (divider tabel dan footer) |
| **Netral Border Kontrol** | `--color-control-border` | `#6A6F78` | Batas input formulir, checkbox, radio, select di atas `#F8F7F4` (`#6E737D` di atas `#FFFFFF`) |
| **Status: Sukses** | `--color-status-ok` / `bg` | `#166534` / `#DCFCE7` | Status "Dibuka" dan notifikasi pengiriman formulir berhasil (selalu berpasangan dengan teks/ikon) |
| **Status: Peringatan / Dummy** | `--color-status-warn` / `bg` | `#854D0E` / `#FEF9C3` | Penanda `[ASSET DUMMY]` atau status jadwal "Segera Dibuka" |
| **Status: Error** | `--color-status-err` / `bg` | `#991B1B` / `#FEE2E2` | Pesan galat validasi formulir dan state gagal muat |

### 3.2 Bukti Pengukuran Kontras WCAG 2.x (`contrast-check.py`)
Seluruh pasangan utama telah diuji langsung menggunakan `.agents/skills/antislop-human/contrast-check.py`:

| Pasangan Warna | Rasio Terukur | Teks Normal (4.5:1) | Teks Besar / Komponen (3.0:1) |
|---|---|---|---|
| `#0B2545` di atas `#F8F7F4` | `14.36:1` | PASS | PASS |
| `#0B2545` di atas `#FFFFFF` | `15.39:1` | PASS | PASS |
| `#0B2545` di atas `#F1EFEA` | `13.39:1` | PASS | PASS |
| `#0B2545` di atas `#EAF0F6` | `13.40:1` | PASS | PASS |
| `#1B2430` di atas `#F8F7F4` | `14.61:1` | PASS | PASS |
| `#1B2430` di atas `#FFFFFF` | `15.65:1` | PASS | PASS |
| `#4B5563` di atas `#F8F7F4` | `7.05:1` | PASS | PASS |
| `#4B5563` di atas `#F1EFEA` | `6.58:1` | PASS | PASS |
| `#133C6D` di atas `#FFFFFF` | `11.08:1` | PASS | PASS |
| `#133C6D` di atas `#F8F7F4` | `10.34:1` | PASS | PASS |
| `#1E4E79` di atas `#F8F7F4` | `8.10:1` | PASS | PASS |
| `#FFFFFF` di atas `#0B2545` | `15.39:1` | PASS | PASS |
| `#F8F7F4` di atas `#0B2545` | `14.36:1` | PASS | PASS |
| `#FFFFFF` di atas `#1E4E79` | `8.67:1` | PASS | PASS |
| `#0B2545` di atas `#E5A91A` | `7.34:1` | PASS | PASS |
| `#0B2545` di atas `#D4990E` | `6.13:1` | PASS | PASS |
| `#E5A91A` di atas `#0B2545` | `7.34:1` | PASS | PASS |
| `#8A5A00` di atas `#F8F7F4` | `5.53:1` | PASS | PASS |
| `#8A5A00` di atas `#FFFFFF` | `5.93:1` | PASS | PASS |
| `#6A6F78` di atas `#F8F7F4` | `4.71:1` | PASS | PASS |
| `#6E737D` di atas `#FFFFFF` | `4.76:1` | PASS | PASS |
| `#166534` di atas `#DCFCE7` | `6.49:1` | PASS | PASS |
| `#854D0E` di atas `#FEF9C3` | `6.38:1` | PASS | PASS |
| `#991B1B` di atas `#FEE2E2` | `6.80:1` | PASS | PASS |

**Larangan Keras Warna (`R-01`):** Dilarang menggunakan gradasi biru-ke-ungu, biru-ke-cyan, radial orb glow di belakang hero, maupun teks putih langsung di atas foto tanpa lapisan scrim gelap solid/terkalibrasi (`#0B2545` minimal 80% opasitas atau blok warna solid di belakang teks).

---

## 4. Tipografi dan Skala Spasi (`R-03`, `R-06`)

### 4.1 Pasangan Huruf dan Alasannya (`R-06`, `R-31`)
- **Display / Judul Utama (`--font-display`):** `Plus Jakarta Sans` (bobot `700` dan `800` dengan `letter-spacing` rapat `-0.025em` pada `H1`), fallback `'Segoe UI', system-ui, -apple-system, sans-serif`.  
  *Alasan:* Mengikuti arahan revisi pemilik proyek menuju karakter tipografi portal instansi digital modern yang menggunakan sans-serif bersih dan tegas (seperti gaya portal layanan pemerintahan modern di Indonesia), sekaligus memilih huruf karya desainer Indonesia dengan keterbacaan tinggi dan terhindar dari pilihan default generik (`Inter`/`Space Grotesk`).
- **UI & Paragraf (`--font-sans`):** `Plus Jakarta Sans` (bobot `400`, `500`, `600`), fallback `'Segoe UI', system-ui, -apple-system, sans-serif`.  
  *Alasan:* Menjaga kesatuan sistem tipografi antara judul, navigasi, formulir, dan teks panjang berbahasa Indonesia (berita, persyaratan diklat, dokumen PPID) agar cepat dipindai di desktop maupun ponsel.
- **Kode & Angka Tabular (`--font-mono`):** `IBM Plex Mono`, fallback `ui-monospace, SFMono-Regular, monospace`.  
  *Alasan:* Dipakai terbatas hanya pada kode program diklat, nomor dokumen regulasi/PPID, dan penanggalan agenda agar kolom tabel rata vertikal (`tabular-nums`). Dilarang dipakai sebagai judul besar hero (`R-06`).
- **Strategi Pemuatan (`R-40`):** Paket `@fontsource/plus-jakarta-sans` dan `@fontsource/ibm-plex-mono` dibundel lokal melalui Vite sehingga tidak bergantung pada skrip pihak ketiga yang memblokir render.

### 4.2 Skala Tipografi Fluid (Menghindari Ukuran Fixed Pixel `antislop-layoutmobile`)
- `H1` (Hero / Judul Halaman): `clamp(1.875rem, 1.4rem + 2.2vw, 3.125rem)` (30px di ponsel hingga 50px di desktop), `line-height: 1.12`, `font-weight: 800`.
- `H2` (Tajuk Bagian): `clamp(1.5rem, 1.25rem + 1.1vw, 2.25rem)` (24px hingga 36px), `line-height: 1.2`, `font-weight: 700`.
- `H3` (Sub-bagian / Judul Kartu Utama): `clamp(1.125rem, 1.05rem + 0.35vw, 1.375rem)` (18px hingga 22px), `line-height: 1.32`, `font-weight: 700`.
- `Body`: `1rem` (16px minimum), `line-height: 1.65`, lebar baris artikel dibatasi `max-width: 68ch` untuk kenyamanan baca.
- `Caption / Metadata`: `0.875rem` (14px minimum untuk teks informatif; hindari teks terlalu kecil di bawah 12px).

### 4.3 Breakpoints dan Skala Spasi Berbasis Konten (`R-03`, `R-05`)
Menggunakan minimal **3 kondisi tata letak** agar tablet dan laptop kecil tidak terjebak di tampilan ponsel yang melar atau grid desktop yang berdesakan:
- **Sempit (`< 640px`):** Kolom tunggal, padding vertikal antarbagian `48px` (`py-12`), padding horizontal `16px` (`px-4`), jarak elemen `16px`. Navigasi berubah menjadi bar ringkas dengan tombol berlabel **`Menu`** (minimal 44 x 44 px) yang membuka drawer aksesibel.
- **Menengah (`640px` sampai `1023px`):** Grid 2 kolom untuk katalog diklat dan layanan, padding vertikal antarbagian `64px` (`py-16`), padding horizontal `24px`.
- **Lebar (`>= 1024px`, kontainer max `1240px`):** Layout split hero asimetris (7:5), tata letak buletin berita 2 kolom tidak simetris (7:5), grid 3 kolom hanya pada katalog saat isi memadai, padding vertikal bervariasi (`64px` hingga `96px`) sesuai kedalaman pemisahan bagian (`R-05`).

---

## 5. Komponen, Bentuk, Kedalaman, dan Ikonografi

### 5.1 Border Radius (`R-11`)
Tidak menggunakan bentuk pil (`rounded-full`) secara massal pada kartu, input, dan seluruh tombol.
- Kartu, panel, kotak input formulir: `6px` (`rounded-md`).
- Kontainer gambar atau dialog modal: `8px` (`rounded-lg`).
- Tombol aksi standar: `6px` (`rounded-md`), memberi kesan kokoh dan formal.
- Badge status fungsional (misal status pendaftaran `Dibuka`): `4px` (`rounded-sm`) dengan border tipis dan ikon/teks jelas, bukan kapsul neon (`R-09`).

### 5.2 Shadow, Glass, dan Glow (`R-10`, `R-12`, `R-13`)
- **Flat-First Discipline:** Sebagian besar kartu dan baris daftar duduk rata di atas kanvas menggunakan garis tipis `1px solid #D6D3CB` dan perbedaan warna permukaan (`#FFFFFF` di atas `#F8F7F4`).
- **Elevation Terbatas (`R-12`):** Bayangan ringan (`0 10px 28px -12px rgba(11, 37, 69, 0.14)`) hanya diberikan pada elemen yang memang melayang secara fungsional: drawer navigasi mobile, dropdown menu header, dan modal `<dialog>`.
- **Glassmorphism & Glow (`R-10`, `R-13`):** Tidak dipakai pada desain dasar Portal PPSDMAP (0 elemen glassmorphism dan 0 glow dekoratif), agar seluruh teks mencapai keterbacaan maksimum.

### 5.3 Ikonografi dan Media (`R-04`, `R-22`, `R-23`, `R-40`)
- **Ikon:** Menggunakan ikon SVG garis bersih berukuran proporsional (`18px-20px`) yang relevan secara langsung dengan bidang kediklatan/administrasi (ikon dokumen, kalender jadwal, tautan eksternal, pencarian, telepon, lokasi), **bukan** ikon klise AI (kilau/sparkle, roket, robot, petir). Semua ikon di dalam tombol berteks atau tombol ikon ber-`aria-label` wajib diberi `aria-hidden="true"`.
- **Aset Dummy Terstruktur (`R-23`, `R-38`):**
  - Logo dummy: partial SVG geometris sederhana + teks `PPSDMAP Kemenhub` disertai penanda di dokumentasi/komponen bahwa logo menunggu aset vektor resmi instansi.
  - Foto kegiatan/kampus dummy: gambar SVG/ilustrasi arsitektural atau foto placeholder lokal terukur rasio (`16:9` untuk hero/artikel, `4:3` untuk kartu program/fasilitas) dengan atribut `width`, `height`, dan badge/label `[ASSET DUMMY]` pada seeder admin. Hero `<img>` wajib tanpa `loading="lazy"` dan memakai `fetchpriority="high"` (`R-40`).
  - Tidak ada ilustrasi karakter kartun generik (seperti Undraw atau blob 3D) (`R-22`).

---

## 6. Aturan Copywriting, Interaksi, dan Keadaan UI (`R-02`, `R-15`, `R-16`, `R-26`, `R-27`, `R-32`, `R-39`)

1. **Nada Bahasa Indonesia Formal yang Humanis:** Kalimat aktif, langsung pada subjek (*"PPSDMAP menyelenggarakan..."*, bukan kalimat pasif tanpa pelaku terus-menerus).
2. **Larangan Keras Copywriting:**
   - Nol tanda em dash (`U+2014`) di seluruh teks UI, kode contoh, maupun artikel seeder (`R-02`).
   - Nol kata klise AI (*"revolusioner"*, *"seamless"*, *"generasi berikutnya"*, *"terdepan dan tak tertandingi"*), serta nol CTA generik (*"Pelajari Lebih Lanjut"*, *"Mulai Sekarang"*). Gunakan CTA spesifik: **`Lihat Katalog Diklat`**, **`Masuk ke LMS E-Learning`**, **`Unduh Dokumen PPID`**, **`Kirim Permohonan`**.
3. **Kontrol dan Interaksi (`R-26`, `R-32`, `R-39`):**
   - Base layer CSS menetapkan `cursor: pointer` pada seluruh kontrol interaktif aktif dan `cursor: not-allowed` pada kontrol nonaktif.
   - Setiap kontrol memiliki `:hover`, `:active`, dan `:focus-visible` (`outline: 3px solid #0B2545` dengan `outline-offset: 2px` di latar terang; `#E5A91A` di latar gelap).
   - Semua area sentuh (tautan navigasi, tombol filter, input, tombol aksi) memenuhi ukuran minimal `44 x 44 px` atau diperluas hit-area-nya lewat padding dengan jarak aman antar tombol (`>= 8px`).
   - Tersedia *skip link* di baris pertama `<body>` yang mengarah ke `<main id="main-content" tabindex="-1">`.
4. **Tiga Status Data Wajib (`R-27`):**
   - **Loading state:** Indikator memuat yang menyebutkan konteks (*"Memuat daftar program diklat..."*) menggunakan `aria-live="polite"`.
   - **Empty state:** Menjelaskan penyebab dan langkah lanjut (*"Belum ada program pada rumpun ini. Tampilkan semua program atau ubah kata kunci pencarian."* disertai tombol reset filter).
   - **Error state:** Menjelaskan kendala dan tombol muat ulang (*"Data gagal dimuat dari server. Silakan muat ulang halaman."*).

---

## 7. Ringkasan Alasan Keputusan Desain (`R-31` Decision Log)

| Keputusan | Alasan Satu Baris (`R-31`) |
|---|---|
| **Palet Biru Maritim (`#0B2545`) + Emas Terukur (`#E5A91A`/`#8A5A00`)** | Mengacu langsung pada identitas warna otoritas Kementerian Perhubungan dengan komposisi rasio kontras teruji WCAG AA (`>= 5.5:1` hingga `15.39:1`). |
| **Kanvas Kertas Hangat (`#F8F7F4`) & Light Mode** | Mengoptimalkan kenyamanan baca dokumen regulasi, silabus diklat, dan pengumuman bagi ASN di kantor maupun perangkat seluler di lapangan. |
| **Plus Jakarta Sans (Display & UI) + IBM Plex Mono** | Memberikan karakter portal instansi pemerintah modern yang tegas dan mudah dipindai sesuai revisi sans-serif sambil menjaga angka kode/jadwal tabular tetap rapi. |
| **Tata Letak Bervariasi (`RHYTHM 2`)** | Memecah kebosanan kartu seragam dengan menggabungkan hero split editorial, daftar layanan berhierarki, direktori diklat interaktif, dan buletin pengumuman. |
| **Radius `6px`, Nol Glass/Glow, `MOTION 1`** | Menjaga fokus pembaca pada informasi layanan publik tanpa efek visual yang mengalihkan perhatian atau menghambat performa ponsel. |
| **Aset Dummy Berdimensi Eksplisit & Terisolasi** | Memenuhi kebutuhan prototipe cepat sesuai arahan pemilik proyek sambil tetap jujur tanpa memalsukan angka statistik, foto pejabat, maupun testimoni (`R-17`, `R-18`, `R-23`, `R-38`). |
