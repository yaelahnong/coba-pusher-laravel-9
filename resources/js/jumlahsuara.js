import axios from 'axios';

import Echo from 'laravel-echo';

import Pusher from 'pusher-js';

// window.Pusher = Pusher;

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
    wsHost: import.meta.env.VITE_PUSHER_HOST ? import.meta.env.VITE_PUSHER_HOST : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
    wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
    wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});

window.Echo.channel('jumlah-suara')
.listen('JumlahSuaraBertambah', (e) => {
    e.resumeTerkiniSeluruhIndonesia.forEach((item) => {
      window.resumeTerkiniSeluruhIndonesia.find((i) => i.id === item.id).jumlah_suara = item.jumlah_suara;
    });

    e.resumeTerkiniProvinsi.forEach((item) => {
      window.resumeTerkiniProvinsi.find((i) => i.id === item.id).jumlah_suara = item.jumlah_suara;
    });

    renderResumeTerkiniSeluruhIndonesia();
    
    renderResumeTerkiniProvinsi();
});

renderResumeTerkiniSeluruhIndonesia();

renderResumeTerkiniProvinsi();

function renderResumeTerkiniSeluruhIndonesia() {
    let renderContent = '';

    window.resumeTerkiniSeluruhIndonesia.forEach((item) => {
        renderContent += `
          <div class="col-lg-3 mt-3">
            <div class="wrap_candidate">
              <div class="card">
                <div class="card-body d-flex flex-column align-items-center">
                  <div class="d-flex">
                    <div class="wrap_avatar">
                      <img src="${uploader(item.foto_capres)}" alt="${item.nama}">
                    </div>
                    <div class="wrap_avatar ms-2">
                      <img src="${uploader(item.foto_cawapres)}" alt="${item.nama}">
                    </div>
                  </div>
                  <div class="wrap_candidate_info py-3 text-center d-flex flex-column align-items-center">
                    <p class="fw-bold candidate_name">${item.nama}</p>
                    <p class="party_name">${item.partai}</p>
                    <p class="ballot">${window.kontenJumlahSuara} ${item.jumlah_suara}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        `;
    });

    const el = document.getElementById('resumeTerkiniSeluruhIndonesia');
    el.innerHTML = renderContent;
}

function renderResumeTerkiniProvinsi() {
    let renderContent = '';

    let subContent = '';

    let num = 1;

    window.kandidatPemilihan.forEach((item) => {
        subContent = '';

        window.resumeTerkiniProvinsi.filter((i) => i.id_kandidat == item.id)
          .forEach((row) => {
            subContent += `
              <tr>
                <td>${row.provinsi}</td>
                <td>${row.jumlah_suara}</td>
              </tr>
            `;
          });

        renderContent += `
          <div class="col-lg-6 mt-3">
            <div class="wrap_province_ballot">
              <div class="row">
                <div class="col-md-12">
                  <div class="wrap_candidate_name">
                    <h3>${num}. ${item.nama}</h3>
                  </div>
                </div>
                <div class="col-md-12 mt-3">
                  <div class="wrap_province_table table-responsive">
                    <table class="table table-hover table-bordered">
                      <thead class="bg-light">
                        <tr>
                          <th>WILAYAH</th>
                          <th>PEROLEHAN SUARA</th>
                        </tr>
                      </thead>

                      <tbody class="bg-white">
                        ${subContent}
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        `;

        num++;
    });

    const el = document.getElementById('resumeTerkiniProvinsi');
    el.innerHTML = renderContent;
}

function uploader(filename = '') {
  return import.meta.env.VITE_UPLOADER_URL + filename;
}