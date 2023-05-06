@extends('layout.admin')

@section('konten')
    <form action="{{ url('aspek-penilaian/') . $aspek->id }}" method="POST">
        @method('put')
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="subject_id" class="form-label">Mata Kuliah</label>
                    <select class="form-select" name="subject_id" id="subject_id" aria-label="Default select example">
                        <option selected>Pilih Mata Kuliah</option>
                        @foreach ($matakuliah as $item)
                            <option value="{{ $item->id }}"
                                {{ old('subject_id', $item->id) == $aspek->subject_id ? 'selected' : '' }}>
                                {{ $item->subject_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Aspek Penilaian</label>
                    <input type="text" class="form-control" name="name" id="name"
                        value="{{ old('name', $aspek->name) }}">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Aspek Penilaian</label>
                    <textarea class="form-control" name="description" id="description" rows="3">{{ old('description', $aspek->description) }}</textarea>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
