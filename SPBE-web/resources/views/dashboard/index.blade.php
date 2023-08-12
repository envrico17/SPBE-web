<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    {{-- @php
        dd($aspects)
    @endphp --}}
    <x-navbars.sidebar activePage='dashboard'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Dashboard"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">domain</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Jumlah Domain</p>
                                <h4 class="mb-0">{{ $uniqueDomains }}</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            {{-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than
                                lask week</p> --}}
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">table_view</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Jumlah Aspek</p>
                                <h4 class="mb-0">{{ $uniqueAspects }}</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            {{-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+3% </span>than
                                lask month</p> --}}
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">table_view</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Jumlah Indikator</p>
                                <h4 class="mb-0">{{ $uniqueIndicators }}</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            {{-- <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">-2%</span> than
                                yesterday</p> --}}
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">description</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Jumlah Data Dukung</p>
                                <h4 class="mb-0">{{ $uniqueDocuments }}</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            {{-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+5% </span>than
                                yesterday</p> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row align-items-center justify-content-center">
                <div class="col-sm-6 mb-xl-0 my-3 text-center">
                    <form id="filterForm" action="{{ route('dashboard') }}" method="GET">
                        <select id="filterDropdown" name="option" class="form-select px-3">
                                <option selected>Pilih Nama Score Form</option>
                            @foreach ($scores as $score)
                                <option value={{ $score->id }}>{{ $score->score_name }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>
            @if (! empty($data))
            <div class="row">
                <div class="col-lg-12 col-md-6">
                    <div class="card-body px-0">
                        <div class="container">
                            <div class="row mb-3">
                                <div class="col-sm-5 text-start fw-bold fs-3">Hasil Evaluasi {{ $score_form->score_name }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3 text-start fw-bold">Nama Form</div>
                                <div class="col-sm-auto fw-bold">:</div>
                                <div class="col-sm-8">{{ $score_form->score_name }}</div>
                            </div>
                            <hr size="3">
                            <div class="row mb-3">
                                <div class="col-sm-3 text-start fw-bold">Tahun</div>
                                <div class="col-sm-auto fw-bold">:</div>
                                <div class="col-sm-8">{{ $score_form->score_date }}</div>
                            </div>
                            <hr size="3">
                            <div class="row mb-3">
                                <div class="col-sm-3 text-start fw-bold">Deskripsi</div>
                                <div class="col-sm-auto fw-bold">:</div>
                                <div class="col-sm-8">{{ $score_form->score_description }}</div>
                            </div>
                            <hr size="3">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-6 mb-4">
                    <div class="card z-index-2 ">
                        <div class="table table-responsive p-0">
                            <table class="table align-items-center mb-0" style="color: black;">
                                <thead>
                                    <tr>
                                        <th class="w-10 text-uppercase text-xs font-weight-bolder opacity-7">
                                            Nama Instansi</th>
                                        <th class="w-1 text-uppercase text-xs font-weight-bolder opacity-7">
                                        </th>
                                        <th class="w-2 text-center text-uppercase text-xs font-weight-bolder opacity-7">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="data-row"
                                        style="border-bottom: 2px dashed #000000; padding-bottom: 10px; background-color: #c0bdbd;">
                                        <td class="align-middle text-sm">
                                            <span class="text-xs font-weight-bold">Pemerintah Kota
                                                Malang</span>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <span class=" text-xs font-weight-bold"></span>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <span class=" text-xs font-weight-bold"></span>
                                        </td>
                                    <tr>
                                    <tr class="data-row">
                                        <td class="align-middle text-sm">
                                            <span class=" text-xs font-weight-bold">K/L/D</span>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <span class=" text-xs font-weight-bold">:</span>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <span class=" text-xs font-weight-bold">Pemerintah Kota</span>
                                        </td>
                                    </tr>
                                    <tr class="data-row" style="background-color: #c0bdbd;">
                                        <td class="align-middle text-sm">
                                            <span class=" text-xs font-weight-bold">Indeks SPBE</span>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <span class=" text-xs font-weight-bold">:</span>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <span class=" text-xs font-weight-bold">{{ $data['indexScore'] }}</span>
                                        </td>
                                    </tr>
                                    <tr class="data-row"
                                        style="border-bottom: 2px dashed #000000; padding-bottom: 10px; background-color: #c0bdbd;">
                                        <td class="align-middle text-sm">
                                            <span class=" text-xs font-weight-bold">Predikat SPBE</span>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <span class=" text-xs font-weight-bold">:</span>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <span class=" text-xs font-weight-bold">{{ $data['spbeStatus'] }}</span>
                                        </td>
                                    </tr>
                                    <tr class="data-row" style="background-color: #c0bdbd;">
                                        <td class="align-middle text-sm">
                                            <span class="text-xs font-weight-bold">Domain Kebijakan
                                                SPBE</span>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <span class="text-xs font-weight-bold">:</span>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <span class="text-xs font-weight-bold">{{ $data['domainOne'] }}</span>
                                        </td>
                                    </tr>
                                    <tr class="data-row">
                                        <td class="align-middle text-sm">
                                            <span class="text-xs font-weight-bold">Kebijakan Internal
                                                Terkait Tata Kelola SPBE</span>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <span class="text-xs font-weight-bold">:</span>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <span class="text-xs font-weight-bold">{{ $data[1] }}</span>
                                        </td>
                                    </tr>
                                    <tr class="data-row" style="background-color: #c0bdbd;">
                                        <td class="align-middle text-sm">
                                            <span class="text-xs font-weight-bold">Domain Tata Kelola
                                                SPBE</span>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <span class="text-xs font-weight-bold">:</span>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <span class="text-xs font-weight-bold">{{ $data['domainTwo'] }}</span>
                                        </td>
                                    </tr>
                                    <tr class="data-row">
                                        <td class="align-middle text-sm">
                                            <span class="text-xs font-weight-bold">Perencanaan Strategis
                                                SPBE</span>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <span class="text-xs font-weight-bold">:</span>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <span class="text-xs font-weight-bold">{{ $data[2] }}</span>
                                        </td>
                                    </tr>
                                    <tr class="data-row">
                                        <td class="align-middle text-sm">
                                            <span class="text-xs font-weight-bold">Teknologi Informasi
                                                dan Komunikasi</span>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <span class="text-xs font-weight-bold">:</span>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <span class="text-xs font-weight-bold">{{ $data[3] }}</span>
                                        </td>
                                    </tr>
                                    <tr class="data-row">
                                        <td class="align-middle text-sm">
                                            <span class="text-xs font-weight-bold">Penyelanggara
                                                SPBE</span>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <span class="text-xs font-weight-bold">:</span>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <span class="text-xs font-weight-bold">{{ $data[4] }}</span>
                                        </td>
                                    </tr>
                                    <tr class="data-row" style="background-color: #c0bdbd;">
                                        <td class="align-middle text-sm">
                                            <span class="text-xs font-weight-bold">Domain Manajemen
                                                SPBE</span>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <span class=" text-xs font-weight-bold">:</span>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <span class="text-xs font-weight-bold">{{ $data['domainThree'] }}</span>
                                        </td>
                                    </tr>
                                    <tr class="data-row">
                                        <td class="align-middle text-sm">
                                            <span class=" text-xs font-weight-bold">Penerapan Manajemen
                                                SPBE</span>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <span class=" text-xs font-weight-bold">:</span>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <span class=" text-xs font-weight-bold">{{ $data[5] }}</span>
                                        </td>
                                    </tr>
                                    <tr class="data-row">
                                        <td class="align-middle text-sm">
                                            <span class="text-xs font-weight-bold">Audit TIK</span>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <span class=" text-xs font-weight-bold">:</span>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <span class=" text-xs font-weight-bold">{{ $data[6] }}</span>
                                        </td>
                                    </tr>
                                    <tr class="data-row" style="background-color: #c0bdbd;">
                                        <td class="align-middle text-sm">
                                            <span class=" text-xs font-weight-bold">Domain Layanan
                                                SPBE</span>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <span class=" text-xs font-weight-bold">:</span>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <span class=" text-xs font-weight-bold">{{ $data['domainFour'] }}</span>
                                        </td>
                                    </tr>
                                    <tr class="data-row">
                                        <td class="align-middle text-sm">
                                            <span class=" text-xs font-weight-bold">Layanan Administrasi
                                                Pemerintah Berbasis Elektronik</span>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <span class="text-xs font-weight-bold">:</span>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <span class=" text-xs font-weight-bold">{{ $data[7] }}</span>
                                        </td>
                                    </tr>
                                    <tr class="data-row">
                                        <td class="align-middle text-sm">
                                            <span class=" text-xs font-weight-bold">Layanan Publik
                                                Berbasi Elektronik</span>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <span class=" text-xs font-weight-bold">:</span>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <span class="text-xs font-weight-bold">{{ $data[8] }}</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-lg-12 col-md-6 mt-2 mb-4">
                        <div class="card z-index-2 ">
                            <div class="table table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-1">
                                                No
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-7">
                                                Nama Indikator</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-2">
                                                Score</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($score_indicators as $score_indicator)
                                            <tr>
                                                <td class="align-middle text-center text-sm">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $loop->iteration }}</span>
                                                </td>
                                                {{-- Indicator --}}
                                                <td class="align-middle text-sm">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $score_indicator->indicator->indicator_name }}</span>
                                                </td>
                                                {{-- Score --}}
                                                <td class="align-middle text-sm">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $score_indicator->score }}</span>
                                                </td>
                                            </tr>
                                        @empty
                                    </tbody>
                                </table>
                                <div colspan="auto" class='alert alert-danger fw-bold text-center text-white mt-4'>
                                    Tidak ada data
                                </div>
                                @endforelse
                                </tbody>
                                </table>
                            </div>
                            <div class="container mt-3">
                                {{ $score_indicators->onEachSide(2)->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div>
                No Data
            </div>
            @endif
        </div>
    </main>
    <x-plugins></x-plugins>
    </div>
    @push('js')
        <script src="{{ asset('assets') }}/js/plugins/chartjs.min.js"></script>
        <script>
            var filterDropdown = document.getElementById('filterDropdown');
            var filterForm = document.getElementById('filterForm');

            filterDropdown.addEventListener('change', function () {
                filterForm.submit();
            });
        </script>
    @endpush
</x-layout>
