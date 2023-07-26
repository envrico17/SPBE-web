<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="score"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Score"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <div class="d-flex flex-row justify-content-between align-items-center">
                                    <h6 class="text-white text-capitalize ps-3">Penilaian</h6>
                                    <div class="ms-md-auto px-3 mb-2 me-2 d-flex">
                                        <label for="filterYear" class="my-auto me-2 text-white text-capitalize ps-3">Filter Tahun</label>
                                        <div class="form-group mt-2 px-3" style="background-color: white; border-radius: 8px;">
                                            <select id="filterYear" class="form-control">
                                                <option value="">Semua Tahun</option>
                                                @php
                                                    $uniqueYears =[];
                                                @endphp
                                                @foreach($attributes as $attribute)
                                                    @php
                                                        $year = date('Y', strtotime($attribute->updated_at));
                                                    @endphp
                                                    @if (!in_array($year, $uniqueYears))
                                                        <option value="{{ $year }}">{{ $year }}</option>
                                                        @php
                                                            $uniqueYears[] = $year; // Tambahkan tahun ke array jika belum ada
                                                        @endphp
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Tahun</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Nama Indikator</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                                colspan="2">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($attributes as $attribute)
                                            <tr class="data-row" data-year="{{ date('Y', strtotime($attribute->updated_at)) }}">
                                                {{-- Year --}}
                                                <td class="align-middle text-center text-sm">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ date('Y', strtotime($attribute->updated_at)) }}</span>
                                                </td>
                                                {{-- Indicator --}}
                                                <td class="align-middle text-center text-sm">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $attribute->indicator_name }}</span>
                                                </td>
                                                {{-- Details of the Indicator --}}
                                                <td class="align-middle text-center">
                                                    <a href="javascript:;" class="link-info font-weight-bold text-xs"
                                                        style="cursor: pointer" data-bs-toggle="modal"
                                                        data-bs-target="#detailModal{{ $attribute->id }}"
                                                        data-original-title="Edit user">
                                                        Detail
                                                    </a>
                                                    <!-- Modal Detail Indicator -->
                                                    <div class="modal fade" id="detailModal{{ $attribute->id }}"
                                                        tabindex="-1" aria-labelledby="detailModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-xl">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="detailModalLabel">Detail
                                                                        Indikator</h5>
                                                                    <button type="button"
                                                                        class="btn-close btn-close-white  "
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    {!! $attribute->description !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                                {{-- Edit Indicator --}}
                                                {{-- <td class="">
                                                    <div class="align-middle text-center">
                                                        <a href="javascript:;"
                                                            class="link-info font-weight-bold text-xs"
                                                            style="cursor: pointer" data-bs-toggle="modal"
                                                            data-bs-target="#editDataModal{{ $attribute->id }}"
                                                            data-original-title="Edit user">
                                                            Edit
                                                        </a>
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
                                                </td> --}}
                                                {{-- Delete Button --}}
                                                {{-- <td class="align-middle text-center">
                                                    <a href="javascript:;" class="link-info font-weight-bold text-xs"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{ $attribute->id }}"
                                                        data-original-title="Delete user">
                                                        Delete
                                                    </a>
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
                                                                            <div class="text-info">Nama Indikator
                                                                            </div>
                                                                            <div class="text-warning">
                                                                                {{ $attribute->indicator_name }}
                                                                            </div>
                                                                            <div class="text-info">Deskripsi Indikator
                                                                            </div>
                                                                            <div class="text-warning">{!! $attribute->description !!}</div>
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
                                                </td> --}}
                                            </tr>
                            </div>
                        </div>
                    @empty
                        <div class='alert alert-danger'>
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

                // if (selectedYear === '') {
                //     this.style.color = 'white';
                // } else {
                //     this.style.color = 'black';
                // }
            });
        </script>
    @endpush

</x-layout>
