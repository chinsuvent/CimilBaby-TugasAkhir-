<footer id="footer" class="footer">

    <div class="container footer-top d-flex justify-content-center">
        <div class="row gy-4 justify-content-center w-100">

            <!-- Kolom 1: Ci'mil Baby -->
                <div class="col-lg-4 col-md-6 footer-links d-flex flex-column align-items-start">
                <h2 class="text-white mb-4">Ci'mil Baby</h2>
                <p class="text-white">
                        Ci'mil Baby adalah jasa penitipan anak yang aman, nyaman, dan terpercaya. Kami memberikan perhatian, kasih sayang, serta lingkungan yang mendukung tumbuh kembang anak Anda.
                </p>
                </div>

                <!-- Kolom 2: Jam Pelayanan + Hubungi Kami -->
                <div class="col-lg-4 col-md-6 footer-links d-flex flex-column align-items-center">
                        <h4 class="text-center text-white">Jam Pelayanan</h4>
                        <ul class="d-flex flex-column align-items-center p-0 text-white" style="list-style: none;">
                        <li><i class="bi bi-calendar-event me-2" style="font-size: 1em;"></i>Senin-Jum'at</li>
                        <li><i class="bi bi-clock me-2" style="font-size: 1em;"></i>07:00 - 17.00</li>
                        </ul>

                        <h4 class="text-center text-white mt-4">Hubungi Kami</h4>
                        <ul class="d-flex flex-column align-items-center p-0" style="list-style: none;">
                        <li>
                            @if ($waSetting && $waSetting->value)
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $waSetting->value) }}" target="_blank" class="text-white">
                                    <i class="bi bi-whatsapp me-2" style="font-size: 1em;"></i>{{ $waSetting->value }}
                                </a>
                            @else
                                <span class="text-white">Nomor tidak tersedia</span>
                            @endif
                        </li>

                        <li>
                            <span class="text-white text-center" style="max-width: 220px; word-break: break-word; display: inline-block;">
                                    <i class="bi bi-geo-alt me-2" style="font-size: 1em;"></i>
                                    Jl. Komodor Yos Sudarso<br>Gg. Kenari 2, No. 23B
                            </span>
                        </li>
                        </ul>
                </div>

                <!-- Kolom 3: Lokasi Maps -->
                <div class="col-lg-4 col-md-12 footer-links d-flex flex-column align-items-center">
                        <h4 class="text-center text-white">Lokasi Kami</h4>
                        <div class="ratio ratio-4x3 w-100">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d53280.697799167014!2d109.24947042167969!3d-0.011213500000001285!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e1d59e4ce1f2b09%3A0xaf034f6ba1716bbc!2sJasa%20Penitipan%20Anak%20Ci&#39;mil%20Baby!5e1!3m2!1sen!2sid!4v1753670802569!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                </div>

                </div>
    </div>
    <hr class="border-white my-2">
    <div class="container py-3">
        <div class="row">
            <div class="col text-center text-white">
                &copy; {{ date('Y') }} Sinta(3202216050), Teknik Informatika, Politeknik Negeri Pontianak.
            </div>
        </div>
    </div>
</footer>
