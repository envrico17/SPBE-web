<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="document"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Data Dukung"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <div class="d-flex flex-row justify-content-between align-items-center">
                                    <h6 class="text-white text-capitalize ps-3">Tabel Input Data Dukung</h6>
                                    <div class="ms-md-auto px-3 mb-2 me-2 d-flex">
                                        <form action="{{ route('document') }}" method="GET" class="d-flex">
                                            <div class="input-group input-group-outline flex-nowrap">
                                                <label class="form-label text-white" style="font-size:12.5px;">Cari
                                                    indikator</label>
                                                <input type="text" class="text-white form-control" name="keyword">
                                            </div>
                                        </form>
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
                                                class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7 w-1">
                                                No</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-5">
                                                Indikator</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-2">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    @forelse ($attributes as $index =>$attribute)
                                        <tbody>
                                            <tr class="data-row">
                                                <td class="align-middle text-sm text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ ($attributes->currentPage() - 1) * $attributes->perPage() + $loop->iteration }}</span>
                                                </td>
                                                {{-- Indicator --}}
                                                <td class="align-middle text-sm">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $attribute->indicator_name }}</span>
                                                </td>
                                                {{-- Show Button --}}
                                                <td class="align-middle text-center">
                                                    <a href="{{ route('document.show', $attribute->id) }}"
                                                        class="btn btn-info font-weight-bold text-xs align-middle my-1">
                                                        Lihat Dokumen
                                                        {{-- <i class="bi bi-pencil-square" style="font-size: 1.1rem"></i> --}}
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    @empty
                                        <tbody>
                                            <tr class="data-row">
                                                <td colspan="3">
                                                    <div class='alert alert-danger fw-bold text-center text-white mt-4'>
                                                        Tidak ada data
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    @endforelse
                                </table>
                            </div>
                            <div class="container mt-3">
                                {{ $attributes->onEachSide(2)->links() }}
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
            var filterDropdown = document.getElementById('filterDropdown');
            var filterForm = document.getElementById('filterForm');

            filterDropdown.addEventListener('change', function() {
                filterForm.submit();
            });
        </script>
    @endpush
</x-layout>
