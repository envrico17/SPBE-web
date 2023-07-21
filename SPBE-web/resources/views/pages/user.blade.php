<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="user"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="user"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <div class="d-flex flex-row justify-content-between align-items-center">
                                    <h6 class="text-white text-capitalize ps-3">Tabel Input Data User</h6>
                                    <div class="ms-md-auto px-3 mb-2 me-2 d-flex">
                                        <form action="{{ route('user.search') }}" method="GET">
                                            @csrf
                                            <div class="input-group input-group-outline">
                                                <label class="form-label text-white">Search</label>
                                                <input type="text" class="text-white form-control" name="keyword">
                                            </div>
                                        </form>
                                    </div>
                                    <button type="button" class="btn bg-gradient-dark px-3 mb-2 me-3"
                                        data-bs-toggle="modal" data-bs-target="#inputDataDomainModal">
                                        Tambah Data User
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
                                                Nama User</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"">
                                                NIP</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Pangkat/Gol</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                No.Hp</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                OPD</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" colspan="2">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($attributes as $attribute)
                                            <tr>
                                                {{-- User --}}
                                                <td class="align-middle text-center text-sm">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $attribute->name }}</span>
                                                </td>
                                                {{-- NIP --}}
                                                <td class="align-middle text-center text-sm">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $attribute->nip }}</span>
                                                </td>
                                                {{-- Pangkat --}}
                                                <td class="align-middle text-center text-sm">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $attribute->pangkat }}</span>
                                                </td>
                                                {{-- No Hp --}}
                                                <td class="align-middle text-center text-sm">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $attribute->phone }}</span>
                                                </td>
                                                {{-- Nama OPD --}}
                                                <td class="align-middle text-center text-sm">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $attribute->opd_name }}</span>
                                                </td>
                                                {{-- Edit Button --}}
                                                <td class="align-middle text-center">
                                                    <a href="javascript:;" class="link-info font-weight-bold text-xs"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $attribute->id }}"
                                                        data-original-title="Edit user">
                                                        Edit
                                                    </a>
                                                    <!-- Modal Edit Data -->
                                                    <div class="modal fade" id="editModal{{ $attribute->id }}"
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
                                                                        action="{{ route('user.update', ['user' => $attribute->id]) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="container">
                                                                            <div class="form-group mt-2">
                                                                                <label class="fs-6 pt-4"
                                                                                    for="nameUpdate">Masukan Nama
                                                                                    User Baru</label>
                                                                                <input type="text"
                                                                                    class="form-control border border-2 p-2"
                                                                                    id="nameUpdate" name="name"
                                                                                    value="{{ $attribute->name }}">
                                                                            </div>
                                                                            <div class="form-group mt-2">
                                                                                <label class="fs-6 pt-4"
                                                                                    for="nipUpdate">Masukan NIP
                                                                                    Baru</label>
                                                                                <input type="text"
                                                                                    class="form-control border border-2 p-2"
                                                                                    id="nipUpdate" name="nip"
                                                                                    value="{{ $attribute->nip }}">
                                                                            </div>
                                                                            <div class="form-group mt-2">
                                                                                <label class="fs-6 pt-4"
                                                                                    for="pangkatUpdate">Masukan Pangkat
                                                                                    Baru</label>
                                                                                <input type="text"
                                                                                    class="form-control border border-2 p-2"
                                                                                    id="pangkatUpdate" name="pangkat"
                                                                                    value="{{ $attribute->pangkat }}">
                                                                            </div>
                                                                            <div class="form-group mt-2">
                                                                                <label class="fs-6 pt-4"
                                                                                    for="phoneUpdate">Masukan No HP
                                                                                    Baru</label>
                                                                                <input type="text"
                                                                                    class="form-control border border-2 p-2"
                                                                                    id="phoneUpdate" name="phone"
                                                                                    value="{{ $attribute->phone }}">
                                                                            </div>
                                                                            <div class="form-group mt-2">
                                                                                <label class="fs-6 pt-4"
                                                                                    for="opdUpdate">Masukan OPD
                                                                                    Baru</label>
                                                                                <input type="text"
                                                                                    class="form-control border border-2 p-2"
                                                                                    id="opdUpdate" name="opd"
                                                                                    value="{{ $attribute->opd_name }}">
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
                                                    </div>
                                                </td>
                                                {{-- Delete Button --}}
                                                <td class="align-middle text-center">
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
                                                                    <h5 class="modal-title" id="deleteModalLabel">Hapus
                                                                        Data User Ini?</h5>
                                                                    <button type="button"
                                                                        class="btn-close btn-close-white"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="container">
                                                                        <div class="form-group mt-2">
                                                                            <div class="text-info">Nama User
                                                                            </div>
                                                                            <div class="text-warning">
                                                                                {{ $attribute->name }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <div class="order-0">
                                                                        <form
                                                                            action="{{ route('user.destroy', ['user' => $attribute->id]) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit"
                                                                                class="btn btn-danger">Hapus
                                                                                Data User</button>
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
                            </div>
                            <div class="container mt-3">
                                {{ $attributes->onEachSide(2)->links() }}
                            </div>
                        </div>
                    </div>

                    <!-- Modal Tambah Data Domain -->
                    <div class="modal fade" id="inputDataDomainModal" tabindex="-1"
                        aria-labelledby="inputModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="inputModalLabel">Form Input Data User</h5>
                                    <button type="button" class="btn-close btn-close-white  "
                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="{{ route('user.store') }}"
                                        method="POST">
                                        @csrf
                                        <div class="container">
                                            <div class="form-group mt-2">
                                                <label for="user-name">Nama User</label>
                                                <input type="text" class="form-control border border-2 p-2"
                                                    id="user-name" name="name" required>
                                                <div class="invalid-feedback">
                                                    Nama User Tidak Boleh Kosong
                                                </div>
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="nip">NIP</label>
                                                <input type="text" class="form-control border border-2 p-2"
                                                    id="nip" name="nip" required>
                                                <div class="invalid-feedback">
                                                    NIP Tidak Boleh Kosong
                                                </div>
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="pangkat">Pangkat/Gol</label>
                                                <input type="text" class="form-control border border-2 p-2"
                                                    id="pangkat" name="pangkat">
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="phone">No.HP</label>
                                                <input type="text" class="form-control border border-2 p-2"
                                                    id="phone" name="phone">
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="opd">OPD</label>
                                                <input type="text" class="form-control border border-2 p-2"
                                                    id="opd" name="opd">
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