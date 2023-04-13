@extends('layout.admin')

@section('konten')
    <div class="row justify-content-between">
        <div class="col">
            <h4 class="mb-4">Manage {{ $title }}</h4>
        </div>
        <div class="col">
            <a href="/manage-magang/create" class="btn btn-primary float-end">
                Tambahkan {{ $title }}
            </a>
        </div>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success fw-bold alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close text-light" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Data {{ $title }}</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0" id="datatable">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NIP</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Lengkap
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No. Telepon
                                </th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $data)
                                <tr>
                                    <td>
                                        <div class="my-auto">
                                            <h6 class="mb-0 text-sm">
                                                {{ $data->lecturer['lecturer_id_number'] }}
                                            </h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="my-auto">
                                            <h6 class="mb-0 text-sm">
                                                {{ $data->lecturer['name'] }}
                                            </h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="my-auto">
                                            <h6 class="mb-0 text-sm">
                                                {{ $data->lecturer['email'] }}
                                            </h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="my-auto">
                                            <h6 class="mb-0 text-sm">
                                                {{ $data->lecturer['phone_number'] }}
                                            </h6>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <a href="manage-magang/{{ $data->id }}"
                                            class="edit btn font-weight-bold text-xs" data-original-title="Edit user"
                                            id="edit">
                                            Lihat Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
