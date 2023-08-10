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
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-1">
                                <div class="d-flex flex-row justify-content-between align-items-center">
                                    <h6 class="text-white text-capitalize ps-3">Edit Score Form</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('score.updateForm', $score->id) }}" class="">
                                @csrf
                                @method('PUT')
                                <div class="form-group mt-2">
                                    <label for="indicator_name">Nama Form</label>
                                    <input type="text" class="form-control border border-2 p-2" id="score_name"
                                        name="score_name">
                                </div>
                                <div class="form-group mt-2">
                                    <label for="yearSelect">Tahun</label>
                                    <select class="form-control border border-2 p-2" id="yearSelect" name="score_date">
                                        <option>2024</option>
                                        <option>2025</option>
                                        <option>2026</option>
                                        <option>2027</option>
                                        <option>2028</option>
                                    </select>
                                </div>
                                <div class="form-group mt-2">
                                    <label for="dateRange">Tanggal Penilaian</label>
                                    <x-flatpickr range clearable onClose="rangeFormat" class="form-control"
                                        date-format="d F Y" name="score_date_range" id="score_date_range" />
                                </div>
                                <div class="d-flex flex-row justify-content-end mt-5">
                                    <button type="submit" class="btn btn-primary mx-2">Submit</button>
                                </form>
                                <form action="{{ route('score.destroy', $score->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger mx-2">Cancel  </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tambahkan stylesheet TinyMCE (jika menggunakan CDN) -->
        <script src="https://cdn.tiny.cloud/1/m5qijcc36wgnreuxu9sqpw3jsaelf3euqu4gsb85pn56ti5w/tinymce/5/tinymce.min.js">
        </script>
        {{-- <script>
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
        </script> --}}
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
        <script>
            function rangeFormat(selectedDates, dateStr, instance) {
                instance.element.value = dateStr.replace('to', ':#;');
            }
        </script>
    @endpush

</x-layout>
