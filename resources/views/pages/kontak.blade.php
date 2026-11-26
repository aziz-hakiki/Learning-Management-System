<x-layouts.app
    title="Kontak dan Helpdesk - PPSDMAP Kemenhub"
    description="Alamat kantor PPSDMAP Parung Bogor, kanal email dan telepon resmi, serta formulir layanan bantuan kediklatan."
>
    <div class="mx-auto max-w-[1240px] px-4 py-10 sm:px-6 lg:py-14">
        <x-breadcrumb :items="[['label' => 'Kontak']]" />

        <div class="max-w-3xl">
            <span class="horizon-rule-ochre" aria-hidden="true"></span>
            <h1 class="type-h1 mt-4 text-[#0B2545]">Kontak dan Layanan Helpdesk</h1>
            <p class="mt-3 text-base leading-relaxed text-[#4B5563]">
                Hubungi tim administrasi kediklatan, humas, atau bantuan teknis LMS PPSDMAP melalui saluran resmi maupun formulir di bawah ini.
            </p>
        </div>

        <div class="mt-10 grid grid-cols-1 gap-8 lg:grid-cols-12 lg:items-start">
            <aside class="space-y-6 lg:col-span-5">
                <div class="rounded-md border border-[#D6D3CB] bg-[#FFFFFF] p-6">
                    <h2 class="type-h3 text-[#0B2545]">Informasi Kontak Resmi</h2>
                    <dl class="mt-4 space-y-4 text-sm">
                        <div class="border-b border-[#D6D3CB] pb-3">
                            <dt class="text-xs font-semibold text-[#4B5563]">Alamat Kantor dan Kampus</dt>
                            <dd class="mt-1 font-medium leading-relaxed text-[#0B2545]">
                                Jl. Raya Parung - Bogor KM. 26,4, Kabupaten Bogor, Jawa Barat 16310
                            </dd>
                        </div>
                        <div class="border-b border-[#D6D3CB] pb-3">
                            <dt class="text-xs font-semibold text-[#4B5563]">Email Resmi</dt>
                            <dd class="mt-1">
                                <a href="mailto:ppsdmap@kemenhub.go.id" class="font-semibold text-[#133C6D] hover:underline">
                                    ppsdmap@kemenhub.go.id
                                </a>
                            </dd>
                        </div>
                        <div class="border-b border-[#D6D3CB] pb-3">
                            <dt class="text-xs font-semibold text-[#4B5563]">Helpdesk Peserta / LMS</dt>
                            <dd class="tabular-code mt-1 font-semibold text-[#0B2545]">0811 1175 430</dd>
                        </div>
                        <div class="border-b border-[#D6D3CB] pb-3">
                            <dt class="text-xs font-semibold text-[#4B5563]">Telepon Kantor</dt>
                            <dd class="tabular-code mt-1 font-semibold text-[#0B2545]">(0251) 7540092 / 7540093 / 7540094</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-semibold text-[#4B5563]">Jam Layanan</dt>
                            <dd class="mt-1 text-xs font-medium text-[#8A5A00]">
                                Senin - Jumat (Jam operasional mengikuti ketentuan jam kerja ASN; konfirmasi jadwal resmi menyusul)
                            </dd>
                        </div>
                    </dl>
                </div>

                <figure class="overflow-hidden rounded-md border border-[#D6D3CB] bg-[#FFFFFF]">
                    <img
                        src="{{ asset('images/dummy/hero-kampus-dummy.svg') }}"
                        alt="Ilustrasi dummy lokasi kampus PPSDMAP di Jalan Raya Parung Bogor"
                        width="1280"
                        height="720"
                        loading="lazy"
                        class="h-auto w-full object-cover aspect-video"
                    >
                    <figcaption class="border-t border-[#D6D3CB] px-4 py-3 text-xs text-[#4B5563]">
                        Ilustrasi lokasi kampus [Asset Dummy]. Embed peta interaktif dapat ditambahkan saat koordinat resmi ditetapkan.
                    </figcaption>
                </figure>
            </aside>

            <section class="rounded-md border border-[#D6D3CB] bg-[#FFFFFF] p-6 sm:p-8 lg:col-span-7">
                <h2 class="type-h2 text-[#0B2545]">Kirim Pesan atau Laporan Kendala</h2>
                <p class="mt-2 mb-6 text-sm text-[#4B5563]">
                    Setiap pesan yang dikirim memperoleh kode tiket unik untuk memudahkan tindak lanjut oleh petugas helpdesk.
                </p>

                <x-inquiry-form
                    :action="route('kontak.store')"
                    formId="contact-form"
                    successKey="contact_success"
                    submitLabel="Kirim Pesan ke Helpdesk"
                />
            </section>
        </div>
    </div>
</x-layouts.app>
