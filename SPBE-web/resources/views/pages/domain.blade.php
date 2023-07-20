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
                                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                                        <form action="{{route("domain.search")}}" method="GET">
                                         @csrf
                                        <div class="input-group input-group-outline">
                                            <label class="form-label text-white">Type here...</label>
                                            <input type="text" class="text-white form-control" name="keyword">
                                        </div>
                                        </form>
                                    </div>
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
                                                {{-- Edit Button --}}
                                                <td class="align-middle text-center">
                                                    <a href="javascript:;"
                                                        class="link-info font-weight-bold text-xs"
                                                        data-bs-toggle="modal" data-bs-target="#editModal{{ $attribute->id }}"
                                                        data-original-title="Edit user">
                                                        Edit
                                                    </a>
                                                    <!-- Modal Edit Data -->
                                                    <div class="modal fade" id="editModal{{ $attribute->id }}" tabindex="-1" aria-labelledby="editModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-xl">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editModalLabel">Form Edit</h5>
                                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('domain.update', ['domain' => $attribute->id]) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="container">
                                                                <div class="form-group mt-2">
                                                                    <div class="text-info">Nama Domain Lama</div>
                                                                    <div class="text-warning">{{ $attribute->domain_name }}</div>
                                                                    <label class="fs-6 pt-4" for="domainUpdate">Masukan Nama Domain Baru</label>
                                                                    <input type="text" class="form-control border border-2 p-2"
                                                                    id="domainUpdate" name="domain_name" value="{{ $attribute->domain_name }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="order-1">
                                                                <button type="submit" class="btn btn-success">Ubah Data</button>
                                                            </form>
                                                            </div>
                                                            <div class="order-0">
                                                            <form action="{{ route('domain.destroy', ['domain' => $attribute->id]) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Hapus Domain</button>
                                                            </form>
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
                                    <form class="needs-validation" novalidate action="{{ route('domain.store') }}" method="POST">
                                        @csrf
                                        <div class="container">
                                            <div class="form-group mt-2">
                                                <label for="domainCreate">Nama Domain</label>
                                                <input type="text" class="form-control border border-2 p-2"
                                                    id="domainCreate" name="domain_name" required>
                                                <div class="invalid-feedback">
                                                    Nama Domain Tidak Boleh Kosong
                                                </div>
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
