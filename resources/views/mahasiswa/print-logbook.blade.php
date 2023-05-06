<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Logbook Magang</title>

    <style>
        table,
        th,
        td {
            border: 1px solid;
            border-collapse: collapse;
            padding: 16px;
        }
    </style>

    {{-- <link href="{{ public_path('css/bootstrap.min.css') }}" rel="stylesheet"> --}}

</head>

<body>
    <main>
        <div class="container" style="margin: 0 16px 0 0;">
            <h3 style="text-align: center">Logbook Magang</h3>
            <hr>
            <h3>NIM : {{ $mhs->registration_number }}</h3>
            <h3>Nama : {{ $mhs->name }}</h3>
        </div>
        <div class="table-responsive">
            <table class="table table-primary">
                <thead>
                    <tr>
                        <th scope="col" style="width: 2%;">No.</th>
                        <th scope="col">Nama Kegiatan</th>
                        <th scope="col">Tanggal Kegiatan</th>
                        <th scope="col">Bukti Kegiatan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $item)
                        <tr class="">
                            <td style="width: 2%"> {{ $key + 1 }} </td>
                            <td scope="row"> {{ $item->activity_name }} </td>
                            <td> {{ $item->activity_date }} </td>
                            <td>
                                <img src="{{ public_path('storage/') . $item->img }}" alt=""
                                    style="height: 100px">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </main>
</body>

</html>
