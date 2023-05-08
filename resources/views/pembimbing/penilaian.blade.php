@extends('layout.admin')

@section('konten')
    <div class="row justify-content-between">
        <div class="col">
            <h4 class="mb-4">Daftar Mahasiswa </h4>
        </div>
    </div>
    <div class="row">
        @foreach ($mahasiswa as $item)
            <div class="col-md-3">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor"
                                    class="bi bi-person-square" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                    <path
                                        d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12z" />
                                </svg>
                            </div>
                            <div class="col-md-8">
                                <h5 class="card-title ellipsis">{{ $item->student->name }}</h5>
                                <h6 class="card-subtitle mb-2 text-body-secondary">
                                    {{ $item->student->registration_number }} </h6>
                            </div>
                        </div>
                        <p style="margin-bottom: 0 !important">{{ $item->company_name }}</p>
                        <p class="ellipsis">{{ $item->company_address }}</p>
                        <div class="d-flex align-items-center">
                            @if ($penilaian->is_enable == true)
                                @if ($item->is_assessment == true)
                                    <a href="penilaian/{{ $item->student->registration_number }}/edit"
                                        class="btn btn-warning btn-sm card-link fw-bold text-dark"
                                        style="margin-bottom: 0!important">Ubah
                                        Nilai</a>
                                @else
                                    <a href="penilaian/{{ $item->student->registration_number }}"
                                        class="btn btn-primary btn-sm card-link fw-bold"
                                        style="margin-bottom: 0!important">Nilai</a>
                                @endif
                            @endif
                            <a href="penilaian/{{ $item->student->registration_number }}/show"
                                class="btn btn-light btn-sm card-link fw-bold" style="margin-bottom: 0!important">Lihat</a>
                            <div class="dropdown ms-auto">
                                <a href="#" class="dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-bs-toggle="dropdown" aria-expanded="true">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item"
                                            href="{{ url('logbook-show/' . $item->student->registration_number) }}">Lihat
                                            Logbook</a></li>
                                    <li><a class="dropdown-item"
                                            href="{{ url('laporan-show/' . $item->student->registration_number) }}">Lihat
                                            Laporan</a></li>
                                    @if ($item->document_path)
                                        <li><a class="dropdown-item" href="{{ url('storage/' . $item->document_path) }}"
                                                target="_blank">Lihat Surat Balasan</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
