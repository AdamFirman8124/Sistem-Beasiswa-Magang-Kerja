<div class="container">
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a href="/">
                <img class="img" style="width: 80%" src="{{ asset('assets/logo-siuns.webp') }}"
                    alt="image">
            </a>
            {{-- btn humbuerger --}}
            <button class="navbar-toggler border border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="bi bi-list fs-3"></i>
            </button>

            {{-- Content navbar --}}
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link fs-6" aria-current="page" href="/">Terbaru</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-6" href="{{ route('guest.beasiswa') }}">Beasiswa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-6" href="{{ route('guest.lomba') }}">Lomba</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-6" href="{{ route('guest.loker') }}">Lowongan Kerja</a>
                    </li>

                </ul>
                <a class="icon-link icon-link-hover link-offset-2 link-underline link-underline-opacity-0 text-dark fw-bold fs-6"
                    href="/login" style="margin-right: 10px">
                    Sign In
                    <i class="bi bi-box-arrow-in-right fs-5 d-flex"></i>
                </a>
                <a class="icon-link icon-link-hover link-offset-2 link-underline link-underline-opacity-0 text-dark fw-bold fs-6"
                    href="/register">
                    Daftar
                    <i class="bi bi-pencil-square fs-5 d-flex"></i>
                </a>
            </div>
        </div>
    </nav>
</div>
