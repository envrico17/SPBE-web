<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="opd"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Daftar OPD"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <div class="d-flex flex-row justify-content-between align-items-center">
                                    <h6 class="text-white text-capitalize ps-3">Daftar OPD</h6>
                                    <div class="ms-md-auto px-3 mb-2 me-2 d-flex">
                                        <form action="{{ route('opd.search') }}" method="GET">
                                            @csrf
                                            <div class="input-group input-group-outline">
                                                <label class="form-label text-white">Search</label>
                                                <input type="text" class="text-white form-control" name="keyword">
                                            </div>
                                        </form>
                                    </div>
                                    <button type="button" class="btn bg-gradient-dark px-3 mb-2 me-3 active"
                                        data-bs-toggle="modal" data-bs-target="#inputOPDModal">
                                        Tambah OPD
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="w-40 text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">
                                                Nama OPD</th>
                                            <th
                                                class="w-40 text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">
                                                Alias OPD</th>
                                            <th class="w-20 text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7"
                                                colspan="2">
                                                Aksi</th>
                                            {{-- <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                EMAIL</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                ROLE</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($attributes as $attribute)
                                            <tr>
                                                <td class="w-40">
                                                    <div class="d-flex flex-column text-center justify-content-center">
                                                        <span
                                                            class="text-secondary text-xs font-weight-bold">{{ $attribute->opd_name }}</span>
                                                    </div>
                                                </td>
                                                <td class="w-40">
                                                    <div class="d-flex flex-column text-center justify-content-center">
                                                        <span
                                                            class="text-secondary text-xs font-weight-bold">{{ $attribute->opd_alias }}</span>
                                                    </div>
                                                </td>
                                                {{-- <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">Admin</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">22/03/18</span>
                                            </td> --}}
                                                {{-- <td class="align-middle">
                                                <a rel="tooltip" class="btn btn-success btn-link" href=""
                                                    data-original-title="" title="">
                                                    <i class="material-icons">edit</i>
                                                    <div class="ripple-container"></div>
                                                </a>

                                                <button type="button" class="btn btn-danger btn-link"
                                                    data-original-title="" title="">
                                                    <i class="material-icons">close</i>
                                                    <div class="ripple-container"></div>
                                                </button>
                                            </td> --}}
                                                {{-- Edit OPD --}}
                                                <td class="w-10">
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
                                                                        action="{{ route('opd.update', ['opd' => $attribute->id]) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="container">
                                                                            <div class="form-group mt-2">
                                                                                <div class="text-info text-center">Nama OPD Lama
                                                                                </div>
                                                                                <div class="text-warning text-center">
                                                                                    {{ $attribute->opd_name }}</div>
                                                                                <label class="fs-6"
                                                                                    for="opdUpdate">Masukan Nama
                                                                                    OPD Baru</label>
                                                                                <input type="text"
                                                                                    class="form-control border border-2 p-2"
                                                                                    id="opdUpdate" name="opd_name"
                                                                                    value="{{ $attribute->opd_name }}">
                                                                                <div class="text-info text-center pt-3">Alias OPD Lama
                                                                                </div>
                                                                                <div class="text-warning text-center">
                                                                                    {{ $attribute->opd_alias }}</div>
                                                                                <label class="fs-6"
                                                                                    for="opdUpdate">Masukan Alias
                                                                                    OPD Baru</label>
                                                                                <input type="text"
                                                                                    class="form-control border border-2 p-2"
                                                                                    id="opdUpdate" name="opd_alias"
                                                                                    value="{{ $attribute->opd_alias }}">
                                                                            </div>
                                                                        </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <div class="order-1">
                                                                        <button type="submit"
                                                                            class="btn btn-success">Ubah Data</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                {{-- Delete Button --}}
                                                <td class="w-10 align-middle text-center">
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
                                                                        OPD ini?</h5>
                                                                    <button type="button"
                                                                        class="btn-close btn-close-white"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="container">
                                                                        <div class="form-group mt-2">
                                                                            <div class="text-info">Nama OPD
                                                                            </div>
                                                                            <div class="text-warning">
                                                                                {{ $attribute->opd_name }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <div class="order-0">
                                                                        <form
                                                                            action="{{ route('opd.destroy', ['opd' => $attribute->id]) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit"
                                                                                class="btn btn-danger">Hapus
                                                                                OPD</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <div class='alert alert-danger'>
                                                Tidak ada data
                                            </div>
                                        @endforelse
                                    </tbody>
                                </table>
                                <!-- Modal Tambah Data OPD -->
                                <div class="modal fade" id="inputOPDModal" tabindex="-1"
                                    aria-labelledby="inputModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="inputModalLabel">Form Input OPD</h5>
                                                <button type="button" class="btn-close btn-close-white  "
                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('opd.store') }}" method="post">
                                                <div class="modal-body">
                                                    @csrf
                                                    <div class="container">
                                                        <div class="form-group mt-2">
                                                            <label for="opd_name">Nama OPD</label>
                                                            <input type="text"
                                                                class="form-control border border-2 p-2"
                                                                id="opd_name" name="opd_name">
                                                        </div>
                                                        <div class="form-group mt-2">
                                                            <label for="opd_alias">Alias OPD</label>
                                                            <input type="text"
                                                                class="form-control border border-2 p-2"
                                                                id="opd_alias" name="opd_alias">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Tambah
                                                        Data</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
        <script>
            (function() {
                'use strict';
                window.addEventListener('load', function() {
                    // Fetch all the forms we want to apply custom Bootstrap validation styles to
                    var forms = document.getElementsByClassName('needs-validation');
                    // Loop over them and prevent submission
                    var validation = Array.prototype.filter.call(forms, function(form) {
                        form.addEventListener('submit', function(event) {
                            if (form.checkValidity() === false) {
                                event.preventDefault();
                                event.stopPropagation();
                            }
                            form.classList.add('was-validated');
                        }, false);
                    });
                }, false);
            })();
        </script>
    @endpush
</x-layout>
