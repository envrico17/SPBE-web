<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="document"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Data Dukung"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid pt-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <div class="d-flex flex-row justify-content-between align-items-center">
                                    <h6 class="text-white text-capitalize ps-3">Penilaian
                                        {{ $indicator->indicator_name }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="container">
                                <div class="row mb-3">
                                    <div class="col-sm-3 text-start fw-bold fs-3">Detail Indikator</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3 text-start fw-bold">Domain</div>
                                    <div class="col-sm-auto fw-bold">:</div>
                                    <div class="col-sm-8">{{ $domain->domain_name }}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3 text-start fw-bold">Aspek</div>
                                    <div class="col-sm-auto fw-bold">:</div>
                                    <div class="col-sm-8">{{ $aspect->aspect_name }}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3 text-start fw-bold">Indikator</div>
                                    <div class="col-sm-auto fw-bold">:</div>
                                    <div class="col-sm-8">{{ $indicator->indicator_name }}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3 text-start fw-bold">Penjelasan Indikator</div>
                                    <div class="col-sm-auto fw-bold">:</div>
                                    <div class="col-sm-8">{{ $indicator->description }}</div>
                                </div>
                                {{-- <hr>
                                <div class="row mb-3"> --}}

                                    {{-- <div class="col-sm-auto text-start fw-bold align-items-center fs-3">
                                        Data Dukung
                                        @if (Auth::user()->hasRole('admin'))
                                            <span data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Tambah Data Dukung">
                                                <a href="javascript:;" class="link-info mx-3 fs-2"
                                                    data-bs-toggle="modal" data-bs-target="#inputDataDukungModal">
                                                    <i class="bi bi-plus-square"></i>
                                                </a>
                                            </span>
                                        @endif
                                    </div> --}}
                                    {{-- <div class="col-sm-auto fw-bold">:</div> --}}

                                {{-- </div>
                                <div class="row mb-3"> --}}
                                    {{-- <div class="col-sm-3 text-start fw-bold">Data Dukung</div> --}}
                                    {{-- <div class="col-sm-auto fw-bold">:</div> --}}
                                    {{-- <ul>
                                        <div class="container-fluid">
                                            @foreach ($documents as $document)
                                                @if (!is_null($document->upload_path))
                                                    <li>
                                                        <div class="container-sm">
                                                            <div class="row align-items-center">
                                                                <div class="col-md-auto">
                                                                    <span data-bs-toggle="tooltip"
                                                                        data-bs-placement="top"
                                                                        title="Edit Data Dukung">
                                                                        <a href="javascript:;"
                                                                            class="link-info font-weight-bold text-xs mx-2"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#uploadDataModal{{ $document->id }}">
                                                                            <i class="bi bi-pencil-square fs-3"></i>
                                                                        </a>
                                                                    </span>
                                                                    <a class="link-info"
                                                                        href="{{ $document->file_path_url }} "
                                                                        data-bs-toggle="tooltip" data-bs-placement="right"
                                                                        title="Lihat Data Dukung" target="_blank">
                                                                        @php
                                                                            dump($document);
                                                                            dd($document->opd);
                                                                        @endphp
                                                                        {{ $document->opd->opd_name }} -
                                                                        {{ $document->doc_name }}
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @else
                                                    <li>
                                                        <div class="container-sm">
                                                            <div class="row align-items-center">
                                                                <div class="col-md-auto">
                                                                    <span data-bs-toggle="tooltip"
                                                                        data-bs-placement="top"
                                                                        title="Tambah Data Dukung">
                                                                        <a href="javascript:;"
                                                                            class="link-info font-weight-bold text-xs mx-2"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#uploadDataModal{{ $document->id }}">
                                                                            <i
                                                                                class="bi bi-file-earmark-arrow-up fs-3"></i>
                                                                        </a>
                                                                    </span>
                                                                    <span class='text-secondary'>
                                                                        {{ $document->opd->opd_name }} -
                                                                        {{ $document->doc_name }} <span class="fw-bold"
                                                                            style="color:red;">(Belum Upload)</span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endif
                                                <!-- Modal Edit Data -->
                                                <div class="modal fade" id="uploadDataModal{{ $document->id }}"
                                                    tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-xl">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editModalLabel">
                                                                    Form Edit / Upload</h5>
                                                                <button type="button"
                                                                    class="btn-close btn-close-white  "
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form
                                                                    action="{{ route('document.update', ['document' => $document->id]) }}"
                                                                    method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="container">
                                                                        @if (Auth::user()->hasRole('admin'))
                                                                            <div class="form-group mt-2">
                                                                                <label class="fs-6 pt-1"
                                                                                    for="dokumenEdit">Nama
                                                                                    Dokumen</label>
                                                                                <input type="text"
                                                                                    class="form-control border border-2 p-2"
                                                                                    id="dokumenEdit" name="doc_name"
                                                                                    value="{{ $document->doc_name }}">
                                                                            </div>
                                                                        @else
                                                                            <div class="form-group mt-2">
                                                                                <label class="fs-6 pt-1"
                                                                                    for="dokumenEdit">Nama
                                                                                    Dokumen</label>
                                                                                <input type="text"
                                                                                    class="form-control border border-2 p-2"
                                                                                    id="dokumenEdit" name="doc_name"
                                                                                    value="{{ $document->doc_name }}"
                                                                                    readonly>
                                                                            </div>
                                                                        @endif
                                                                        <div class="form-group mt-2">
                                                                            <label class="fs-6 pt-1"
                                                                                for="fileEdit">Upload Data
                                                                                Dukung</label>
                                                                            <input type="file"
                                                                                class="form-control border border-2"
                                                                                id="fileEdit" name="file">
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div class="order-1">
                                                                    <button type="submit"
                                                                        class="btn btn-success">Upload
                                                                        Data</button>
                                                                    </form>
                                                                </div>
                                                                @if (Auth::user()->hasRole('admin'))
                                                                    <div class="order-0">
                                                                        <form
                                                                            action="{{ route('document.destroy', ['document' => $document->id]) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit"
                                                                                class="btn btn-danger">Hapus
                                                                                Dokumen</button>
                                                                        </form>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </ul> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid pb-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <div class="d-flex flex-row justify-content-between align-items-center">
                                    <h6 class="text-white text-capitalize ps-3">Data Dukung</h6>
                                    @if (Auth::user()->hasRole('admin'))
                                    <button type="button" class="btn bg-gradient-dark px-3 mb-2 me-3"
                                        data-bs-toggle="modal" data-bs-target="#inputDataDukungModal">
                                        Tambah Data Dukung
                                    </button>
                                    @endif
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
                                                class="w-5 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Nama OPD</th>
                                            <th
                                                class="w-7 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Nama Dokumen</th>
                                            <th
                                                class="w-2 text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" colspan="2">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($documents as $index => $document)
                                        <tr>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $index + 1 }}</span>
                                            </td>
                                            {{-- Domain --}}
                                            <td class="align-middle">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $document->opd->opd_name }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $document->doc_name }}</span>
                                            </td>
                                                {{-- Edit Button --}}
                                            <td class="align-middle text-center">
                                            @if (!is_null($document->upload_path))
                                                <span data-bs-toggle="tooltip"
                                                    data-bs-placement="top">
                                                    <a class="link-info"
                                                        href="{{ $document->file_path_url }} "
                                                        data-bs-toggle="tooltip" data-bs-placement="right"
                                                        title="Lihat Data Dukung" target="_blank">
                                                        <i class="bi bi-folder-symlink-fill fs-5"></i>
                                                    </a>
                                                </span>
                                            @else
                                                <span data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="Tambah Data Dukung">
                                                    N/A
                                                </span>
                                            @endif
                                            </td>
                                            <td class="align-middle text-center">
                                                @if (!is_null($document->upload_path))
                                                <span data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="Edit Data Dukung">
                                                    <a href="javascript:;"
                                                        class="link-info font-weight-bold text-xs mx-2"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#uploadDataModal{{ $document->id }}">
                                                        <i class="bi bi-pencil-square fs-5"></i>
                                                    </a>
                                                </span>
                                                @else
                                                <span data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="Tambah Data Dukung">
                                                    <a href="javascript:;"
                                                        class="link-info font-weight-bold text-xs mx-2"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#uploadDataModal{{ $document->id }}">
                                                        <i class="bi bi-file-earmark-arrow-up fs-5"></i>
                                                    </a>
                                                </span>
                                                @endif
                                                <!-- Modal Edit Data -->
                                                <div class="modal fade" id="uploadDataModal{{ $document->id }}"
                                                    tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-xl">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editModalLabel">
                                                                    Form Edit / Upload</h5>
                                                                <button type="button"
                                                                    class="btn-close btn-close-white  "
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form
                                                                    action="{{ route('document.update', ['document' => $document->id]) }}"
                                                                    method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="container">
                                                                        @if (Auth::user()->hasRole('admin'))
                                                                            <div class="form-group mt-2">
                                                                                <label class="fs-6 pt-1"
                                                                                    for="dokumenEdit">Nama
                                                                                    Dokumen</label>
                                                                                <input type="text"
                                                                                    class="form-control border border-2 p-2"
                                                                                    id="dokumenEdit" name="doc_name"
                                                                                    value="{{ $document->doc_name }}">
                                                                            </div>
                                                                        @else
                                                                            <div class="form-group mt-2">
                                                                                <label class="fs-6 pt-1"
                                                                                    for="dokumenEdit">Nama
                                                                                    Dokumen</label>
                                                                                <input type="text"
                                                                                    class="form-control border border-2 p-2"
                                                                                    id="dokumenEdit" name="doc_name"
                                                                                    value="{{ $document->doc_name }}"
                                                                                    readonly>
                                                                            </div>
                                                                        @endif
                                                                        <div class="form-group mt-2">
                                                                            <label class="fs-6 pt-1"
                                                                                for="fileEdit">Upload Data
                                                                                Dukung</label>
                                                                            <input type="file"
                                                                                class="form-control border border-2"
                                                                                id="fileEdit" name="file">
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div class="order-1">
                                                                    <button type="submit"
                                                                        class="btn btn-success">Upload
                                                                        Data</button>
                                                                    </form>
                                                                </div>
                                                                @if (Auth::user()->hasRole('admin'))
                                                                    <div class="order-0">
                                                                        <form
                                                                            action="{{ route('document.destroy', ['document' => $document->id]) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit"
                                                                                class="btn btn-danger">Hapus
                                                                                Dokumen</button>
                                                                        </form>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

        <!-- Modal Tambah Data Dokumen -->
        <div class="modal fade" id="inputDataDukungModal" tabindex="-1" aria-labelledby="inputDataDukungModal"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="inputModalLabel">Form Input Data Dukung</h5>
                        <button type="button" class="btn-close btn-close-white  " data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('document.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="container">
                                <div class="form-group mt-2">
                                    <input type="hidden" name="indicator_id" value="{{ $indicator->id }}">
                                </div>
                                <div class="form-group mt-2">
                                    <div>
                                        <label for="upd">Nama OPD</label>
                                    </div>
                                    <div>
                                        <select id="opd" name="opd_id"
                                            class="form-control border border-2 p-2">
                                            @foreach ($opds as $opd)
                                                <option value="{{ $opd->id }}">{{ $opd->opd_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group mt-2">
                                    <label for="data-dukung">Nama Dokumen</label>
                                    <input type="text" class="form-control border border-2 p-2" id="data-dukung"
                                        name="doc_name">
                                </div>
                                <div class="form-group mt-2">
                                    <label for="fileUpload">Upload Data Dukung</label>
                                    <input type="file" class="form-control border border-2" id="fileUpload"
                                        name="file">
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
            const filterYearSelect = document.getElementById('filterYear');
            const yearDataRows = document.querySelectorAll('.data-row');

            filterYearSelect.addEventListener('change', function() {
                const selectedYear = this.value;

                if (selectedYear === '') {
                    yearDataRows.forEach(row => {
                        row.style.display = 'table-row';
                    });
                } else {
                    yearDataRows.forEach(row => {
                        const rowYear = row.getAttribute('data-year');
                        if (rowYear === selectedYear) {
                            row.style.display = 'table-row';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                }
            });
        </script>
    @endpush
</x-layout>
