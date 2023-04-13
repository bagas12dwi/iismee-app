@extends('layout.admin')

@section('konten')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="/manage-mahasiswa" method="POST">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="registration_number" class="form-label">NIM</label>
                    <input type="number" class="form-control" name="registration_number" id="registration_number">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" name="name" id="name">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email">
                </div>
                <div class="mb-3">
                    <label for="class" class="form-label">Kelas</label>
                    <input type="text" class="form-control" name="class" id="class">
                </div>
                <div class="mb-3">
                    <label for="date_start" class="form-label">Tanggal Mulai</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-calendar2-date-fill"></i></span>
                        <input type="date" class="form-control ps-3" name="date_start" id="date_start"
                            aria-label="date_start" aria-describedby="basic-addon1">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="date_end" class="form-label">Tanggal Selesai</label>
                    <div class="input-group date" id="datepicker">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-calendar2-date-fill"></i></span>
                        <input type="date" class="form-control ps-3" name="date_end" id="date_end" aria-label="date_end"
                            aria-describedby="basic-addon1">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="company_name" class="form-label">Nama Perusahaan</label>
                    <input type="text" class="form-control" name="company_name" id="company_name">
                </div>
                <div class="mb-3">
                    <label for="company_number" class="form-label">No. Telepon Perusahaan</label>
                    <input type="number" class="form-control" name="company_number" id="company_number">
                </div>
                <div class="mb-3">
                    <label for="company_address" class="form-label">Alamat Perusahaan</label>
                    <textarea class="form-control" name="company_address" id="company_address" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="division" class="form-label">Divisi</label>
                    <input type="text" class="form-control" name="division" id="division">
                </div>
                <div class="mb-3">
                    <label for="internship_type" class="form-label">Kategori Magang</label>
                    <select class="form-select" name="internship_type" id="internship_type"
                        aria-label="Default select example">
                        <option selected>Pilih Kategori Magang</option>
                        <option value="MSIB">MSIB</option>
                        <option value="Reguler">Reguler</option>
                    </select>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
