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
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-1">
                                                No</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-2">
                                                Tahun</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-7">
                                                Nama Form</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-5">
                                                Tanggal Penilaian</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-3"
                                                colspan="">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($attributes as $attribute)
                                            <tr class="data-row">
                                                <td class="align-middle text-center text-sm">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $loop->iteration }}</span>
                                                </td>
                                                {{-- Year --}}
                                                <td class="align-middle text-center text-sm">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $attribute->score_date }}</span>
                                                </td>
                                                <td>
                                                    <span class="text-secondary text-xs font-weight-bold">
                                                        {{ $attribute->score_name }}</span>
                                                </td>
                                                <td>
                                                    <span class="text-secondary text-xs font-weight-bold">
                                                        {{ $attribute->score_date_range }}</span>
                                                </td>
                                                {{-- Beri Penilaian --}}
                                                <td>
                                                    <div class="align-middle text-center">
                                                        <a href="{{ route('score.show', ['score' => $attribute->id]) }}"
                                                            class="link-info font-weight-bold text-xs"
                                                            style="cursor: pointer">
                                                            <i class="bi bi-eye mx-2" style="font-size: 1.1rem"></i>
                                                        </a>
                                                        <a href="{{ route('score.clone', [$attribute->id]) }}"
                                                            class="mx-3 link-info font-weight-bold text-xs"
                                                            style="cursor: pointer">
                                                            <i class="bi bi-plus-square mx-2" style="font-size: 1.1rem"></i>
                                                        </a>
                                                        {{-- Delete Button --}}
                                                        <a href="javascript:;"
                                                            class="link-info font-weight-bold text-xs"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal{{ $attribute->id }}"
                                                            data-original-title="Delete Indicator">
                                                            <i class="bi bi-trash mx-2" style="font-size: 1.1rem"></i>
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
                                                                            Form ini?</h5>
                                                                        <button type="button"
                                                                            class="btn-close btn-close-white"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="container">
                                                                            <div class="form-group mt-2">
                                                                                <div class="text-info">Nama
                                                                                    Form
                                                                                </div>
                                                                                <div class="text-warning">
                                                                                    {{ $attribute->score_name }}
                                                                                </div>
                                                                                <div class="text-info">Tanggal Penilaian
                                                                                </div>
                                                                                <div class="text-warning">
                                                                                    {{ $attribute->score_date_range }}</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <div class="order-0">
                                                                            <form
                                                                                action="{{ route('score.destroy', ['score' => $attribute->id]) }}"
                                                                                method="POST">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit"
                                                                                    class="btn btn-danger">Hapus
                                                                                    Form</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
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
                            {{-- <div class="container mt-3">
                            {{ $attributes->onEachSide(2)->links() }}
                        </div> --}}
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
