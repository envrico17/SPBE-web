<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="domain"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Domain"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <div class="d-flex flex-row justify-content-between align-items-center">
                                    <h6 class="text-white text-capitalize ps-3">Tabel Input Domain</h6>
                                    <button type="button" class="btn bg-gradient-dark px-3 mb-2 me-3 active"
                                        data-bs-toggle="modal" data-bs-target="#inputDataDomainModal">
                                        Tambah Domain
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
                                                Nama Domain</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Tahun</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($attributes as $attribute)
                                            <tr>
                                                {{-- Domain --}}
                                                <td class="align-middle text-center text-sm">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $attribute->domain_name }}</span>
                                                </td>
                                                {{-- Year of the Domain --}}
                                                <td class="align-middle text-center text-sm">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $attribute->aspect_name }}</span>
                                                </td>
                                                {{-- Edit Button --}}
                                                <td class="align-middle text-center">
                                                    <a href="javascript:;"
                                                        class="text-secondary font-weight-bold text-xs"
                                                        data-bs-toggle="modal" data-bs-target="#editDataModal"
                                                        data-original-title="Edit user">
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

                    <!-- Modal Tambah Data Domain -->
                    <div class="modal fade" id="inputDataDomainModal" tabindex="-1" aria-labelledby="inputModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="inputModalLabel">Form Input Domain</h5>
                                    <button type="button" class="btn-close btn-close-white  " data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="form.php" method="post">
                                        <div class="container">
                                            <div class="form-group mt-2">
                                                <label for="domain">Nama Domain</label>
                                                <input type="text" class="form-control border border-2 p-2"
                                                    id="domain" name="domain">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary">Tambah Data</button>
                                </div>
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
