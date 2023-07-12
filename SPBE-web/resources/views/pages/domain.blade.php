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
                                {{-- <h6 class="text-white text-capitalize ps-3">Authors table</h6> --}}
                                <div class="d-flex flex-row">
                                    <div class="p-2" style="margin-top: 8px;">
                                        <h6 class="text-white text-capitalize ps-3">Tabel Input Domain</h6>
                                    </div>
                                    <div class="p-2" style="margin-left: 825px;">
                                        <button type="button" class="btn bg-gradient-dark px-3 mb-2 me-3 active"
                                            data-bs-toggle="modal" data-bs-target="#inputDataDomainModal">
                                            Tambah Domain
                                        </button>
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
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Domain</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Aspek</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Indikator</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Data Dukung</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Action</th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($attributes as $attribute)
                                            <tr>
                                                {{-- Domain --}}
                                                <td>
                                                    {{-- <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <img src="{{ asset('assets') }}/img/team-2.jpg"
                                                                class="avatar avatar-sm me-3 border-radius-lg"
                                                                alt="user1">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">John Michael</h6>
                                                            <p class="text-xs text-secondary mb-0">john@creative-tim.com
                                                            </p>
                                                        </div>
                                                    </div> --}}
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $attribute->domain_name }}</span>
                                                </td>
                                                {{-- Aspect --}}
                                                <td>
                                                    {{-- <p class="text-xs font-weight-bold mb-0">Manager</p>
                                                    <p class="text-xs text-secondary mb-0">Organization</p> --}}
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $attribute->aspect_name }}</span>
                                                </td>
                                                {{-- Indicator --}}
                                                <td class="align-middle text-center text-sm">
                                                    {{-- <span class="badge badge-sm bg-gradient-success">Online</span> --}}
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $attribute->indicator_name }}</span>
                                                </td>
                                                {{-- Document --}}
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $attribute->doc_name }}</span>
                                                </td>
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
                    {{-- <button type="button" class="btn bg-gradient-dark px-3 mb-2 me-3 active" data-toggle="modal" data-target="#exampleModal"
                        onclick="">Tambah Data</button> --}}
                    <!-- Tombol untuk membuka pop-up -->
                    {{-- <div class="container"> --}}
                    {{-- </div> --}}

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
                    <div class="modal fade" id="inputDataDomainModal" tabindex="-1"
                        aria-labelledby="inputModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="inputModalLabel">Form Input Domain</h5>
                                    <button type="button" class="btn-close btn-close-white  "
                                        data-bs-dismiss="modal" aria-label="Close"></button>
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

                    <!-- Modal Tambah Data Aspek -->
                    <div class="modal fade" id="inputDataAspekModal" tabindex="-1"
                        aria-labelledby="inputModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="inputModalLabel">Form Input Aspek</h5>
                                    <button type="button" class="btn-close btn-close-white  "
                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="form.php" method="post">
                                        <div class="container">
                                            <div class="form-group mt-2">
                                                <div>
                                                    <label for="domain">Domain</label>
                                                </div>
                                                <div>
                                                    <select id="domain" name="domain"
                                                        class="form-control border border-2 p-2" ">
                                                        <option value="Kebijakan SPBE">Kebijakan SPBE</option>
                                                        <option value="Kebijakan SPBE">Kebijakan SPBE</option>
                                                        <option value="Kebijakan SPBE">Kebijakan SPBE</option>
                                                        <option value="Kebijakan SPBE">Kebijakan SPBE</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="aspek">Aspek</label>
                                                <input type="text" class="form-control border border-2 p-2"
                                                    id="aspek" name="aspek">
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
                                <div class="modal-body">
                                    <form action="form.php" method="post">
                                        <div class="container">
                                            <div class="form-group mt-2">
                                                <div>
                                                    <label for="aspek">Aspek</label>
                                                    </div>
                                                <div>
                                                    <select id="aspek" name="aspek"
                                                    class="form-control border border-2 p-2"
                                                    ">
                                                        <option value="Kebijakan SPBE">Kebijakan SPBE</option>
                                                        <option value="Kebijakan SPBE">Kebijakan SPBE</option>
                                                        <option value="Kebijakan SPBE">Kebijakan SPBE</option>
                                                        <option value="Kebijakan SPBE">Kebijakan SPBE</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="indikator">Indikator</label>
                                                <input type="text" class="form-control border border-2 p-2"
                                                    id="indikator" name="indikator">
                                            </div>
                                            <div>
                                                <label for="deskripsi">Deskripsi</label>
                                            </div>
                                            <div>
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
                                                    name="deskripsi" class="form-control border border-2 p-2">Masukkan Deskripsi</textarea>
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
                                    <form action="form.php" method="post">
                                        <div class="container">
                                            <div class="form-group mt-2">
                                                <div>
                                                    <label for="aspek">Aspek</label>
                                                </div>
                                                <div>
                                                    <select id="aspek" name="aspek"
                                                        class="form-control border border-2 p-2" ">
                                                        <option value="Kebijakan SPBE">Kebijakan SPBE</option>
                                                        <option value="Kebijakan SPBE">Kebijakan SPBE</option>
                                                        <option value="Kebijakan SPBE">Kebijakan SPBE</option>
                                                        <option value="Kebijakan SPBE">Kebijakan SPBE</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group mt-2">
                                                <div>
                                                    <label for="indikator">Indikator</label>
                                                    </div>
                                                <div>
                                                    <select id="indikator" name="indikator"
                                                    class="form-control border border-2 p-2"
                                                    ">
                                                        <option value="Kebijakan SPBE">Kebijakan SPBE</option>
                                                        <option value="Kebijakan SPBE">Kebijakan SPBE</option>
                                                        <option value="Kebijakan SPBE">Kebijakan SPBE</option>
                                                        <option value="Kebijakan SPBE">Kebijakan SPBE</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group mt-2">
                                                <div>
                                                    <label for="upd">Nama UPD</label>
                                                </div>
                                                <div>
                                                    <select id="upd" name="upd"
                                                        class="form-control border border-2 p-2" ">
                                                        <option value="Kebijakan SPBE">Kebijakan SPBE</option>
                                                        <option value="Kebijakan SPBE">Kebijakan SPBE</option>
                                                        <option value="Kebijakan SPBE">Kebijakan SPBE</option>
                                                        <option value="Kebijakan SPBE">Kebijakan SPBE</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="data-dukung">Nama Dokumen</label>
                                                <input type="text" class="form-control border border-2 p-2"
                                                    id="data-dukung" name="data-dukung">
                                            </div>
                                            {{-- <div class="form-group mt-2">
                                                <label for="data-dukung">Upload Data Dukung</label></br>
                                                <input type="file" class="form-control border border-2"
                                                    id="data-dukung" name="data-dukung" aria-describedby="fileHelp"
                                                    placeholder="Upload Data Dukung(PDF)">
                                            </div> --}}
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary">Tambah Data</button>
                                </div>
                            </div>
                        </div>
                    </div>

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
