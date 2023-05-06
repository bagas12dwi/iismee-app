<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Logbook Magang</title>
</head>

<body>
    <main>
        <div class="table-responsive">
            <table class="table table-primary">
                <thead>
                    <tr>
                        <th scope="col">Nama Kegiatan</th>
                        <th scope="col">Tanggal Kegiatan</th>
                        <th scope="col">Bukti Kegiatan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr class="">
                            <td scope="row"> {{ $item->activity_name }} </td>
                            <td> {{ $item->activity_date }} </td>
                            <td>
                                <img src="{{ URL::asset('storage/' . $item->img) }}" alt=""
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
