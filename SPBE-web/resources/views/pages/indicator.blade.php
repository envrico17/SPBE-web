<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="indicator"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Indikator"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <div class="d-flex flex-row justify-content-between align-items-center">
                                    <h6 class="text-white text-capitalize ps-3">Tabel Input Indikator</h6>
                                    <div class="ms-4 d-flex align-items-center">
                                        <label for="filter-year" class="me-2" style="color: white; display: inline-block; vertical-align: middle;">Filter Tahun:</label>
                                        <select id="filter-year" class="form-control text-center" style="background: white;">
                                            <option value="">Semua Tahun</option>
                                            @foreach ($uniqueYears as $year)
                                                <option value="{{ $year }}">{{ $year }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="ms-md-auto px-3 mb-2 me-2 d-flex">
                                        <form action="{{ route('indicator.search') }}" method="GET">
                                            @csrf
                                            <div class="input-group input-group-outline">
                                                <label class="form-label text-white">Cari indikator</label>
                                                <input type="text" class="text-white form-control" name="keyword">
                                            </div>
                                        </form>
                                    </div>
                                    <button type="button" class="btn bg-gradient-dark px-3 mb-2 me-3 active"
                                        data-bs-toggle="modal" data-bs-target="#inputDataIndikatorModal">
                                        Tambah Indikator
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="w-1 text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                No</th>
                                            <th
                                                class="w-10 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Nama Indikator</th>
                                            <th
                                                class="w-3 text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($attributes as $index => $attribute)
                                            <tr class="data-row" data-year="{{ $attribute->scoreForm->score_date }}">
                                                <td class="align-middle text-center text-sm">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $index + 1 }}</span>
                                                </td>
                                                {{-- Indicator --}}
                                                <td class="align-middle text-sm">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $attribute->indicator_name }}</span>
                                                </td>
                                                {{-- Details of the Indicator --}}
                                                <td class="w-10">
                                                    <div class="d-flex justify-content-center">
                                                        {{-- Edit Button --}}
                                                        {{-- <span
                                                        class="text-secondary text-xs font-weight-bold">{!! $attribute->description !!}</span> --}}
                                                        <a href="javascript:;"
                                                            class="link-info font-weight-bold text-xs"
                                                            style="cursor: pointer" data-bs-toggle="modal"
                                                            data-bs-target="#detailModal{{ $attribute->id }}"
                                                            data-original-title="Detail Indicator">
                                                            <i class="bi bi-bookmarks mx-2"
                                                                style="font-size: 1.1rem"></i>
                                                        </a>
                                                        {{-- Edit Button --}}
                                                        <a href="javascript:;"
                                                            class="link-info font-weight-bold text-xs"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editDataModal{{ $attribute->id }}"
                                                            data-original-title="Edit Indicator">
                                                            <i class="bi bi-pencil-square mx-2"
                                                                style="font-size: 1.1rem"></i>
                                                        </a>
                                                        {{-- Delete Button --}}
                                                        <a href="javascript:;"
                                                            class="link-info font-weight-bold text-xs"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal{{ $attribute->id }}"
                                                            data-original-title="Delete Indicator">
                                                            <i class="bi bi-trash mx-2" style="font-size: 1.1rem"></i>
                                                        </a>
                                                    </div>
                                                    <!-- Modal Detail Indicator -->
                                                    <div class="modal fade" id="detailModal{{ $attribute->id }}"
                                                        tabindex="-1" aria-labelledby="detailModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-xl">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="detailModalLabel">
                                                                        Penjelasan Indikator</h5>
                                                                    <button type="button"
                                                                        class="btn-close btn-close-white  "
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="card-body px-0 pb-2">
                                                                        <div class="container">
                                                                            <div class="row mb-3">
                                                                                <div
                                                                                    class="col-sm-3 text-start fw-bold">
                                                                                    Domain</div>
                                                                                <div class="col-sm-auto fw-bold">:</div>
                                                                                <div class="col-sm-8">
                                                                                    {{ $attribute->aspect->domain->domain_name }}
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mb-3">
                                                                                <div
                                                                                    class="col-sm-3 text-start fw-bold">
                                                                                    Aspek</div>
                                                                                <div class="col-sm-auto fw-bold">:</div>
                                                                                <div class="col-sm-8">
                                                                                    {{ $attribute->aspect->aspect_name }}
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mb-3">
                                                                                <div
                                                                                    class="col-sm-3 text-start fw-bold">
                                                                                    Indikator</div>
                                                                                <div class="col-sm-auto fw-bold">:</div>
                                                                                <div class="col-sm-8">
                                                                                    {{ $attribute->indicator_name }}
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mb-3">
                                                                                <div
                                                                                    class="col-sm-3 text-start fw-bold">
                                                                                    Penjelasan Indikator</div>
                                                                                <div class="col-sm-auto fw-bold">:</div>
                                                                                <div class="col-sm-8">
                                                                                    {!! $attribute->description !!}</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Modal Delete Data -->
                                                    <div class="modal fade" id="deleteModal{{ $attribute->id }}"
                                                        tabindex="-1" aria-labelledby="deleteModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-xl">
                                                            <div class="modal-content">
                                                                <div class="modal-header justify-between">
                                                                    <h5 class="modal-title" id="deleteModalLabel">
                                                                        Hapus
                                                                        Indikator ini?</h5>
                                                                    <button type="button"
                                                                        class="btn-close btn-close-white"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="container">
                                                                        <div class="form-group mt-2">
                                                                            <div class="text-info">Nama
                                                                                Indikator
                                                                            </div>
                                                                            <div class="text-warning">
                                                                                {{ $attribute->indicator_name }}
                                                                            </div>
                                                                            <div class="text-info">Deskripsi
                                                                                Indikator
                                                                            </div>
                                                                            <div class="text-warning">
                                                                                {!! $attribute->description !!}</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <div class="order-0">
                                                                        <form
                                                                            action="{{ route('indicator.destroy', ['indicator' => $attribute->id]) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit"
                                                                                class="btn btn-danger">Hapus
                                                                                Indikator</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Modal Edit Data -->
                                                    <div class="modal fade" id="editDataModal{{ $attribute->id }}"
                                                        tabindex="-1" aria-labelledby="editModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-xl">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="editModalLabel">Form
                                                                        Edit</h5>
                                                                    <button type="button"
                                                                        class="btn-close btn-close-white"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form
                                                                        action="{{ route('indicator.update', ['indicator' => $attribute->id]) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="container pb-3">
                                                                            <div class="form-group mt-2">
                                                                                <label for="indicatorNameEdit">Masukan
                                                                                    Nama Indikator Baru</label>
                                                                                <input type="text"
                                                                                    value="{{ $attribute->indicator_name }}"
                                                                                    class="form-control border border-2 p-2"
                                                                                    id="indicatorNameEdit"
                                                                                    name="indicator_name">
                                                                            </div>
                                                                            <div class="form-group mt-2">
                                                                                <label
                                                                                    for="descriptionEdit2_{{ $attribute->id }}">Masukan
                                                                                    Deskripsi Baru</label>
                                                                                <textarea id="descriptionEdit2_{{ $attribute->id }}"
                                                                                    style="width: 50%;
                                                                                height: 150px;
                                                                                padding: 12px 20px;
                                                                                box-sizing: border-box;
                                                                                border: 2px solid #ccc;
                                                                                border-radius: 4px;
                                                                                background-color: #f8f8f8;
                                                                                resize: none;"
                                                                                    name="description" class="form-control border border-2 p-2">{!! $attribute->description !!}</textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <div class="order-1">
                                                                                <button type="submit"
                                                                                    class="btn btn-success">Ubah
                                                                                    Data</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                            </div>
                        </div>
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
                        {{ $attributes->onEachSide(2)->links() }}
                    </div>
                </div>
            </div>

            <!-- Modal Tambah Data Indikator -->
            <div class="modal fade" id="inputDataIndikatorModal" tabindex="-1" aria-labelledby="inputModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="inputModalLabel">Form Input Indikator</h5>
                            <button type="button" class="btn-close btn-close-white  " data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('indicator.store') }}" method="post">
                            <div class="modal-body">
                                @csrf
                                <div class="container">
                                    <div class="form-group mt-2">
                                        <div>
                                            <label for="aspect_id">Nama Aspek</label>
                                        </div>
                                        <div>
                                            <select id="aspect_id" name="aspect_id"
                                                class="form-control border border-2 p-2">
                                                @forelse ($aspects as $aspect)
                                                    <option value="{{ $aspect->id }}">
                                                        {{ $aspect->aspect_name }}
                                                    </option>
                                                @empty
                                                    <div class='alert alert-danger'>
                                                        Tidak ada data
                                                    </div>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="indicator_name">Nama Indikator</label>
                                        <input type="text" class="form-control border border-2 p-2"
                                            id="indicator_name" name="indicator_name">
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="descriptionEdit">Deskripsi</label>
                                        <textarea id="descriptionEdit"
                                            style="
                                                    width: 50%;
                                                    height: 150px;
                                                    padding: 12px 20px;
                                                    box-sizing: border-box;
                                                    border: 2px solid #ccc;
                                                    border-radius: 4px;
                                                    background-color: #f8f8f8;
                                                    resize: none;"
                                            name="description" class="form-control border border-2 p-2"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Tambah Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tambahkan stylesheet TinyMCE (jika menggunakan CDN) -->
        <script src="https://cdn.tiny.cloud/1/m5qijcc36wgnreuxu9sqpw3jsaelf3euqu4gsb85pn56ti5w/tinymce/5/tinymce.min.js">
        </script>
        <script>
            tinymce.init({
                selector: '#descriptionEdit',
                plugins: 'advlist autolink lists link image charmap print preview anchor textcolor',
                toolbar: 'undo redo | styleselect | bold italic | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image'
            });
            @foreach ($attributes as $attribute)
                tinymce.init({
                    selector: '#descriptionEdit2_{{ $attribute->id }}',
                    plugins: 'advlist autolink lists link image charmap print preview anchor textcolor',
                    toolbar: 'undo redo | styleselect | bold italic | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image'
                });
            @endforeach
        </script>
    </main>
    <x-plugins></x-plugins>
    @push('js')
        <script>
            //message with toastr
            @if (session()->has('success'))

                toastr.success('{{ session('success') }}', 'BERHASIL!');
            @elseif (session()->has('error'))

                toastr.error('{{ session('error') }}', 'GAGAL!');
            @endif
        </script>
        <script>
            const filterYearDropdown = document.getElementById('filter-year');
            const dataRows = document.querySelectorAll('.data-row');

            filterYearDropdown.addEventListener('change', function() {
                const selectedYear = this.value;

                dataRows.forEach(row => {
                    const rowYear = row.getAttribute('data-year');
                    if (!selectedYear || rowYear === selectedYear) {
                        row.style.display = 'table-row';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        </script>
    @endpush
</x-layout>
