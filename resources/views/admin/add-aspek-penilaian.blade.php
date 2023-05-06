@extends('layout.admin')

@section('konten')
    <form action="{{ url('aspek-penilaian') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="subject_id" class="form-label">Mata Kuliah</label>
                    <select class="form-select" name="subject_id" id="subject_id" aria-label="Default select example">
                        <option selected>Pilih Mata Kuliah</option>
                        @foreach ($matakuliah as $item)
                            <option value="{{ $item->id }}">{{ $item->subject_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Aspek Penilaian</label>
                    <input type="text" class="form-control" name="name" id="name">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Deskripsi Penilaian</label>
                    <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
