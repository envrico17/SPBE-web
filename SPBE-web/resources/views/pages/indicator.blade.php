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
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Nama Indikator</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Aspek</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Tahun</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Deskripsi</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($attributes as $attribute)
                                            <tr>
                                                {{-- Indicator --}}
                                                <td class="align-middle text-center text-sm">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $attribute->indicator_name }}</span>
                                                </td>
                                                {{-- Aspect of the Indicator --}}
                                                <td class="align-middle text-center text-sm">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $attribute->aspect_name }}</span>
                                                </td>
                                                {{-- Year of the Indicator --}}
                                                <td class="align-middle text-center text-sm">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ date('Y', strtotime($attribute->updated_at)) }}</span>
                                                </td>
                                                {{-- Details of the Indicator --}}
                                                <td class="align-middle text-center">
                                                    <a class="link-info font-weight-bold text-xs"
                                                        style="cursor: pointer" data-bs-toggle="modal"
                                                        data-bs-target="#detail-{{ $attribute->id }}" data-original-title="Edit user">
                                                        Detail
                                                    </a>
                                                    <!-- Modal Detail Indicator -->
                                                    <div class="modal fade" id="detail-{{ $attribute->id }}" tabindex="-1"
                                                        aria-labelledby="detailModalLabel" aria-hidden="true">
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
                                                                    {{ $attribute->description }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                                {{-- Document of the Indicator --}}
                                                <td class="align-middle text-center">
                                                    <a class="link-info font-weight-bold text-xs"
                                                        style="cursor: pointer" data-bs-toggle="modal"
                                                        data-bs-target="#editDataModal" data-original-title="Edit user">
                                                        Edit
                                                    </a>
                                                </td>
                                            </tr>
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

                    <!-- Modal Edit Data -->
                    <div class="modal fade" id="editDataModal" tabindex="-1" aria-labelledby="editModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Form Edit</h5>
                                    <button type="button" class="btn-close btn-close-white  " data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="form.php" method="post">
                                        <div class="container">
                                            <div class="form-group mt-2">
                                                <label for="domain">Domain</label>
                                                <input type="text" class="form-control border border-2 p-2"
                                                    id="domain" name="domain">
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="aspek">Aspek</label>
                                                <input type="text" class="form-control border border-2 p-2"
                                                    id="aspek" name="aspek">
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="indikator">Indikator</label>
                                                <input type="text" class="form-control border border-2 p-2"
                                                    id="indikator" name="indikator">
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="data-dukung">Upload Data Dukung</label></br>
                                                <input type="file" class="form-control border border-2"
                                                    id="data-dukung" name="data-dukung" aria-describedby="fileHelp"
                                                    placeholder="Upload Data Dukung(PDF)">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger">Hapus</button>
                                    <button type="button" class="btn btn-success">Ubah Data</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Tambah Data Indikator -->
                    <div class="modal fade" id="inputDataIndikatorModal" tabindex="-1"
                        aria-labelledby="inputModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="inputModalLabel">Form Input Indikator</h5>
                                    <button type="button" class="btn-close btn-close-white  "
                                        data-bs-dismiss="modal" aria-label="Close"></button>
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
                                                        class="form-control border border-2 p-2" ">
                                                         @forelse ($aspects as $aspect)
                                                        <option value="{{ $aspect->id }}">{{ $aspect->aspect_name }}
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
                                                <label for="description">Deskripsi</label>
                                                <textarea
                                                    style="
                                                    width: 50%;
                                                    height: 150px;
                                                    padding: 12px 20px;
                                                    box-sizing: border-box;
                                                    border: 2px solid #ccc;
                                                    border-radius: 4px;
                                                    background-color: #f8f8f8;
                                                    font-size: 16px;
                                                    resize: none;
                                                "
                                                    name="description" id="description" class="form-control border border-2 p-2"></textarea>
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
    @endpush

</x-layout>
