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
    <div class="row justify-content-between">
        <div class="col">
            <div class="card mb-3">
                <div class="card-body">
                    <p>Data Mahasiswa :</p>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>NIM : {{ $data->registration_number }} </h5>
                            <h6>Nama : {{ $data->name }}</h6>
                            <h6>Tempat Magang : {{ $data->company_name }}</h6>
                            <h6>Alamat Tempat Magang : {{ $data->company_address }}</h6>
                        </div>
                        <div class="col-md-6">
                            <h6>Tanggal Mulai : {{ $data->date_start }} </h6>
                            <h6>Tanggal Selesai : {{ $data->date_end }}</h6>
                            <h6>Divisi : {{ $data->division }}</h6>
                            <h6>Tipe Magang : {{ $data->internship_type }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="mb-3">Edit Penilaian : </h5>

            <div class="accordion" id="accordionExample">
                <form action="/penilaian" method="post">
                    @method('PUT')
                    @csrf
                    @foreach ($mpks as $mpk)
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapse{{ $mpk->id }}" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapse{{ $mpk->id }}">
                                    {{ $mpk->subject_name }}
                                </button>
                            </h2>
                            <label class="visually-hidden" for="inputName">Hidden input label</label>
                            <input type="hidden" class="form-control" name="lecturer_id" id="lecturer_id" placeholder=""
                                value="{{ $mpk->lecturer_id }}" style="display: none !important">
                            <label class="visually-hidden" for="inputName">Hidden input label</label>
                            <input type="hidden" class="form-control" name="student_id" id="student_id" placeholder=""
                                value="{{ $data->id }}" style="display: none !important">

                            @foreach ($mpk->assesmentAspect as $item)
                                <div id="panelsStayOpen-collapse{{ $mpk->id }}"
                                    class="accordion-collapse collapse text-dark" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <ul>
                                                    <li>
                                                        <p> {{ $item->name }} </p>
                                                    </li>
                                                </ul>
                                            </div>
                                            <input type="hidden" class="form-control" name="subject_id[]" id="subject_id"
                                                placeholder="" value="{{ $mpk->id }}"
                                                style="display: none !important">
                                            <input type="hidden" class="form-control" name="assesment_aspect_id[]"
                                                id="assesment_aspect_id" placeholder="" value="{{ $item->id }}"
                                                style="display: none !important">
                                            @foreach ($item->assessment as $assessment)
                                                @if ($assessment->student_id == $data->id)
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <input type="hidden" class="form-control"
                                                                name="assessment_id[]" value="{{ $assessment->id }}">
                                                            <input type="number" class="form-control" name="score[]"
                                                                id="score" value="{{ $assessment->score }}">
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-0">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
