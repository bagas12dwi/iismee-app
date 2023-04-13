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
    <form action="/manage-matakuliah/{{ $matakuliah->subject_name }}" method="POST">
        @method('put')
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="subject_name" class="form-label">Nama Mata Kuliah</label>
                    <input type="text" class="form-control" name="subject_name" id="subject_name"
                        value="{{ old('subject_name', $matakuliah->subject_name) }}">
                </div>
                <div class="mb-3">
                    <label for="lecturer_id" class="form-label">Dosen Pengajar</label>
                    <select class="form-select" name="lecturer_id" id="lecturer_id" aria-label="Default select example">
                        <option selected>Pilih Dosen Pengajar</option>
                        @foreach ($dosen as $item)
                            <option value="{{ $item->id }}"
                                {{ old('lecturer_id', $item->id) == $matakuliah->lecturer_id ? 'selected' : '' }}>
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
