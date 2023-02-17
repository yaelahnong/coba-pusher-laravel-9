<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Kontributor') }}
    </h2>

    @if(session('success'))
    <div class="alert alert-success">
      <script>alert("{{session('success')}}")</script>
    </div>
    @endif
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
        <h1 class="text-center">Form Pengisian Suara</h1>
        <form method="POST" action="{{ route('contributor.store') }}" class="mt-4">
          @csrf
          <div class="wrap_contributor_form_table">
            @foreach($data['kandidat_pemilihan'] as $kandidat)
            <table class="border-collapse border-gray-500">
              <thead>
                <tr>
                  <td colspan="2">
                    <div class="wrap_candidate flex flex-col items-center">
                      <div class="flex">
                        <div class="wrap_avatar">
                          <img src="{{ uploader($kandidat['foto_capres']) }}">
                        </div>
                        <div class="wrap_avatar ml-2">
                          <img src="{{ uploader($kandidat['foto_cawapres']) }}">
                        </div>
                      </div>
                      <div class="wrap_candidate_info pt-2 flex flex-col items-center text-center">
                        <p class="font-bold candidate_name">{{ $kandidat['nama'] }}</p>
                        <p class="party_name">{{ $kandidat['partai'] }}</p>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr class="text-left">
                  <th class="px-4 py-2">Provinsi</th>
                  <th class="px-4 py-2">Perolehan Suara</th>
                </tr>
              </thead>
              <tbody>
                @foreach(cariResumeProvinsi($kandidat['id'], $data['resume_terkini_provinsi']) as $resume)
                <tr>
                  <td class="px-4 py-2">{{ $resume['provinsi'] }}</td>
                  <td class="px-4 py-2">
                    <input name="{{ $kandidat['kode_kandidat'] }}-{{ $resume['kode_provinsi'] }}" class="bg-gray-200 appearance-none border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text">
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            @endforeach
          </div>
          <div class="wrap_submit_button">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ml-3">
              Simpan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>