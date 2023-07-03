<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="form"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Form Input Data"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <form action="form.php" method="post">
                <div class="container">
                    <div class="row">
                        <label for="domain">Domain:</label>
                        <input type="text" id="domain" name="domain" />
                    </div>
                    <div class="row">
                        <label for="aspek">Aspek:</label>
                        <input type="text" id="aspek" name="aspek" />
                    </div>
                    <div class="row">
                        <label for="indikator">Indikator</label>
                        <input type="text" id="indikator" name="indikator" />
                    </div>
                    <div class="row" style="margin-top: 25px;">
                        <label for="data-dukung">Upload Data Dukung</label>
                    </div>
                    <div>
                        <input type="file" class="form-control-file" id="data-dukung" name="data-dukung" placeholder="Upload Data Dukung(PDF)">
                    </div>
                </div>
                <button style="margin-top: 50px;" type="submit" class="btn bg-gradient-dark px-3 mb-2 me-3 active">Tambah Data</button>
            </form>
        </div>
    </main>
    <x-plugins></x-plugins>

</x-layout>
