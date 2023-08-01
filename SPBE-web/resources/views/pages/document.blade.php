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
                                        <form action="{{route("document.search")}}" method="GET">
                                        @csrf
                                        <div class="input-group input-group-outline">
                                            <label class="form-label text-white">Cari dokumen atau indikator</label>
                                            <input type="text" class="text-white form-control" name="keyword">
                                        </div>
                                        </form>
                                    </div>
                                    @if (Auth::user()->hasRole('admin'))
                                    <button type="button" class="btn bg-gradient-dark px-3 mb-2 me-3 active"
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
                                                class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7 w-1">
                                                No</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-5">
                                                Indikator</th>
                                            {{-- <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-5">
                                                Data Dukung</th> --}}
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-2">
                                                Tahun</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-2">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $uniqueIndicators = [];
                                        @endphp
                                        @forelse ($attributes as $index =>$attribute)
                                            @php
                                            $year = date('Y', strtotime($attribute->updated_at));
                                            $indicatorName = $attribute->indicator_name;
                                            @endphp
                                            @if (!in_array($indicatorName, $uniqueIndicators))
                                                @php
                                                    $uniqueIndicators[] = $indicatorName; // Tambahkan nama indikator ke array jika belum ada
                                                @endphp
                                            <tr>
                                                <td class="align-middle text-sm text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $index +1 }}</span>
                                                </td>
                                                {{-- Indicator --}}
                                                <td class="align-middle text-sm">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $indicatorName }}</span>
                                                </td>
                                                {{-- Year --}}
                                                <td class="align-middle text-sm">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ date('Y', strtotime($attribute->updated_at)) }}</span>
                                                </td>
                                                {{-- Lihat Dokumen --}}
                                                {{-- <td class="align-middle text-center text-break">
                                                    @if ($attribute->upload_path)
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">
                                                        <a class="link-info" href="{{ $attribute->file_path_url }}" target="_blank">
                                                            <i class="bi bi-folder-symlink" style="font-size: 1.1rem"></i>
                                                        </a>
                                                    </span>
                                                    @else
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">N/A</span>
                                                    @endif
                                                </td> --}}
                                                {{-- Edit Button --}}
                                                <td class="align-middle text-center">
                                                    <a href="{{ route('document.upload', $attribute->id) }}" class="btn btn-info font-weight-bold text-xs align-middle my-1">
                                                        Lihat Dokumen
                                                        {{-- <i class="bi bi-pencil-square" style="font-size: 1.1rem"></i> --}}
                                                    </a>
                                                </td>
                                                {{-- Delete Button --}}
                                                {{-- <td class="w-10 align-middle text-center">
                                                    <a href="javascript:;" class="link-info font-weight-bold text-xs"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{ $attribute->id }}"
                                                        data-original-title="Delete user">
                                                        <i class="bi bi-trash" style="font-size: 1.1rem"></i>
                                                    </a>
                                                    <!-- Modal Delete Data -->
                                                    <div class="modal fade" id="deleteModal{{ $attribute->id }}"
                                                        tabindex="-1" aria-labelledby="deleteModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-xl">
                                                            <div class="modal-content">
                                                                <div class="modal-header justify-between">
                                                                    <h5 class="modal-title" id="deleteModalLabel">Hapus
                                                                        Dokumen?</h5>
                                                                    <button type="button"
                                                                        class="btn-close btn-close-white"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="container">
                                                                        <div class="form-group mt-2">
                                                                            <div class="text-info">Nama Dokumen
                                                                            </div>
                                                                            <div class="text-warning">
                                                                                {{ $attribute->doc_name }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <div class="order-0">
                                                                        <form
                                                                            action="{{ route('document.destroy', ['document' => $attribute->id]) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit"
                                                                                class="btn btn-danger">Hapus
                                                                                Dokumen</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td> --}}
                                                {{-- @elseif (Auth::user()->hasRole('user'))
                                                <td class="align-middle text-center">
                                                    <a href="javascript:;" class="link-info font-weight-bold text-xs"
                                                        data-bs-toggle="modal" data-bs-target="#uploadDataModal{{ $attribute->id }}"
                                                        data-original-title="Edit user">
                                                        <i class="bi bi-upload" style="font-size: 1.1rem"></i>
                                                    </a>
                                                </td> --}}
                                                @endif
                                                @empty
                                                    </tbody>
                                                    </table>
                                                    <div colspan="auto" class='alert alert-danger fw-bold text-center text-white mt-4'>
                                                        Tidak ada data
                                                    </div>
                                                @endforelse
                                            </tr>
                                        </tbody>
                                    </table>
                            </div>
                            <div class="container mt-3">
                                {{ $attributes->onEachSide(2)->links() }}
                            </div>
                        </div>
                    </div>

                    <!-- Modal Tambah Data Dukung -->
                    <div class="modal fade" id="inputDataDukungModal" tabindex="-1"
                        aria-labelledby="inputModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="inputModalLabel">Form Input Data Dukung</h5>
                                    <button type="button" class="btn-close btn-close-white  "
                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('document.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                        <div class="container">
                                            <div class="form-group mt-2">
                                                <div>
                                                    <label for="indikator">Nama Indikator</label>
                                                </div>
                                                <div>
                                                    <select id="indikator" name="indicator_id"
                                                        class="form-control border border-2 p-2">
                                                        @foreach ($indicators as $indicator)
                                                        <option value="{{$indicator->id}}">{{$indicator->indicator_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group mt-2">
                                                <div>
                                                    <label for="upd">Nama OPD</label>
                                                    </div>
                                                <div>
                                                    <select id="opd" name="opd_id"
                                                    class="form-control border border-2 p-2">
                                                        @foreach ($opds as $opd)
                                                        <option value="{{$opd->id}}">{{$opd->opd_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="data-dukung">Nama Dokumen</label>
                                                <input type="text" class="form-control border border-2 p-2"
                                                    id="data-dukung" name="doc_name">
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="fileUpload">Upload Data Dukung</label>
                                                <input type="file" class="form-control border border-2"
                                                    id="fileUpload" name="file">
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

                    {{-- <!-- Modal Edit Data -->
                    <div class="modal fade" id="uploadDataModal{{ $attribute->id }}" tabindex="-1"
                        aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Form Upload</h5>
                                    <button type="button"
                                        class="btn-close btn-close-white  "
                                        data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('document.update', ['document' => $attribute->id]) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="container">
                                            <div class="form-group mt-2">
                                                <div class="text-info">Nama Dokumen</div>
                                                <div class="text-warning">{{ $attribute->doc_name }}</div>
                                            </div>
                                            <div class="form-group mt-2">
                                                <label class="fs-6 pt-1" for="fileEdit" >Upload Data Dukung</label>
                                                <input type="file" class="form-control border border-2"
                                                    id="fileEdit" name="file">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="order-1">
                                            <button type="submit" class="btn btn-success">Upload Data</button>
                                        </form>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> --}}

                    {{-- <div class="row">
                    <div class="col-12">
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                    <h6 class="text-white text-capitalize ps-3">Projects table</h6>
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center justify-content-center mb-0">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Project</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Budget</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Status</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                                    Completion</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2">
                                                        <div>
                                                            <img src="{{ asset('assets') }}/img/small-logos/logo-asana.svg"
                                                                class="avatar avatar-sm rounded-circle me-2"
                                                                alt="spotify">
                                                        </div>
                                                        <div class="my-auto">
                                                            <h6 class="mb-0 text-sm">Asana</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0">$2,500</p>
                                                </td>
                                                <td>
                                                    <span class="text-xs font-weight-bold">working</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <span class="me-2 text-xs font-weight-bold">60%</span>
                                                        <div>
                                                            <div class="progress">
                                                                <div class="progress-bar bg-gradient-info"
                                                                    role="progressbar" aria-valuenow="60"
                                                                    aria-valuemin="0" aria-valuemax="100"
                                                                    style="width: 60%;"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <button class="btn btn-link text-secondary mb-0">
                                                        <i class="fa fa-ellipsis-v text-xs"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2">
                                                        <div>
                                                            <img src="{{ asset('assets') }}/img/small-logos/github.svg"
                                                                class="avatar avatar-sm rounded-circle me-2"
                                                                alt="invision">
                                                        </div>
                                                        <div class="my-auto">
                                                            <h6 class="mb-0 text-sm">Github</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0">$5,000</p>
                                                </td>
                                                <td>
                                                    <span class="text-xs font-weight-bold">done</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <span class="me-2 text-xs font-weight-bold">100%</span>
                                                        <div>
                                                            <div class="progress">
                                                                <div class="progress-bar bg-gradient-success"
                                                                    role="progressbar" aria-valuenow="100"
                                                                    aria-valuemin="0" aria-valuemax="100"
                                                                    style="width: 100%;"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <button class="btn btn-link text-secondary mb-0"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v text-xs"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2">
                                                        <div>
                                                            <img src="{{ asset('assets') }}/img/small-logos/logo-atlassian.svg"
                                                                class="avatar avatar-sm rounded-circle me-2" alt="jira">
                                                        </div>
                                                        <div class="my-auto">
                                                            <h6 class="mb-0 text-sm">Atlassian</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0">$3,400</p>
                                                </td>
                                                <td>
                                                    <span class="text-xs font-weight-bold">canceled</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <span class="me-2 text-xs font-weight-bold">30%</span>
                                                        <div>
                                                            <div class="progress">
                                                                <div class="progress-bar bg-gradient-danger"
                                                                    role="progressbar" aria-valuenow="30"
                                                                    aria-valuemin="0" aria-valuemax="30"
                                                                    style="width: 30%;"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <button class="btn btn-link text-secondary mb-0"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v text-xs"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2">
                                                        <div>
                                                            <img src="{{ asset('assets') }}/img/small-logos/bootstrap.svg"
                                                                class="avatar avatar-sm rounded-circle me-2"
                                                                alt="webdev">
                                                        </div>
                                                        <div class="my-auto">
                                                            <h6 class="mb-0 text-sm">Bootstrap</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0">$14,000</p>
                                                </td>
                                                <td>
                                                    <span class="text-xs font-weight-bold">working</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <span class="me-2 text-xs font-weight-bold">80%</span>
                                                        <div>
                                                            <div class="progress">
                                                                <div class="progress-bar bg-gradient-info"
                                                                    role="progressbar" aria-valuenow="80"
                                                                    aria-valuemin="0" aria-valuemax="80"
                                                                    style="width: 80%;"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <button class="btn btn-link text-secondary mb-0"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v text-xs"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2">
                                                        <div>
                                                            <img src="{{ asset('assets') }}/img/small-logos/logo-slack.svg"
                                                                class="avatar avatar-sm rounded-circle me-2"
                                                                alt="slack">
                                                        </div>
                                                        <div class="my-auto">
                                                            <h6 class="mb-0 text-sm">Slack</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0">$1,000</p>
                                                </td>
                                                <td>
                                                    <span class="text-xs font-weight-bold">canceled</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <span class="me-2 text-xs font-weight-bold">0%</span>
                                                        <div>
                                                            <div class="progress">
                                                                <div class="progress-bar bg-gradient-success"
                                                                    role="progressbar" aria-valuenow="0"
                                                                    aria-valuemin="0" aria-valuemax="0"
                                                                    style="width: 0%;"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <button class="btn btn-link text-secondary mb-0"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v text-xs"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2">
                                                        <div>
                                                            <img src="{{ asset('assets') }}/img/small-logos/devto.svg"
                                                                class="avatar avatar-sm rounded-circle me-2" alt="xd">
                                                        </div>
                                                        <div class="my-auto">
                                                            <h6 class="mb-0 text-sm">Devto</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0">$2,300</p>
                                                </td>
                                                <td>
                                                    <span class="text-xs font-weight-bold">done</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <span class="me-2 text-xs font-weight-bold">100%</span>
                                                        <div>
                                                            <div class="progress">
                                                                <div class="progress-bar bg-gradient-success"
                                                                    role="progressbar" aria-valuenow="100"
                                                                    aria-valuemin="0" aria-valuemax="100"
                                                                    style="width: 100%;"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <button class="btn btn-link text-secondary mb-0"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v text-xs"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <x-footers.auth></x-footers.auth> --}}
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
