<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        /* table */
h2.title-table{
    margin: 30px 0 10px 0;
    text-align: center;
}

table {
    border: 1px solid #ccc;
    border-collapse: collapse;
    margin: 0;
    padding: 0;
    width: 100%;
}

table tr {
    background-color: #f8f8f8;
    border: 1px solid #ddd;
    padding: .35em;
}

table th,
table td {
    padding: .625em;
    text-align: center;
}

table th {
    font-size: .85em;
    letter-spacing: .1em;
    text-transform: uppercase;
}


    </style>
    <title>Cekat PDF</title>
</head>
<body>
    <h2 style="text-align: center; margin-bottom: 20px;">Data Keseluruhan Pegadaian</h2>
    <table style="width: 100%">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Age</th>
            <th>Telp</th>
            <th>NIK</th>
            <th>Item</th>
            <th>Image</th>
            <th>Status</th>
            <th>Location</th>
            <th>Updated At</th>
        </tr>

        @php
            $pegadaian = App\Models\Pegadaian::all();
            $no = 1;
        @endphp

        @foreach ($pegadaian as $gadai)
            <tr>
                <td>{{$no++}}</td>
                <td>{{$gadai['name']}}</td>
                <td>{{$gadai['email']}}</td>
                <td>{{$gadai['age']}}</td>
                <td>{{$gadai['phone']}}</td>
                <td>{{$gadai['nik']}}</td>
                <td>{{$gadai['item']}}</td>
                <td><img src="assets/image/{{$gadai['foto']}}" width="80"></td>
                <td>
                    {{-- cek apakah data report ini sudah memiliki relasi dengan data dr with ('response') --}}
                    @if ($gadai->response)
                    {{-- kalau ada hasil relasinya, tampilkan bagian status --}}
                        {{$gadai->response['type'] }}
                    @else
                    {{-- kalau gada tampilan tanda ini --}}
                        -
                    @endif
                </td>
                <td>
                    {{-- cek apakah data report ini sudah memiliki relasi dengan data dr with ('response') --}}
                    @if ($gadai->response)
                    {{-- kalau ada hasil relasinya, tampilkan bagian status --}}
                        {{$gadai->response['location'] }}
                    @else
                    {{-- kalau gada tampilan tanda ini --}}
                        -
                    @endif
                </td>
                <td>{{\Carbon\Carbon::parse($gadai['created_at'])->format('j F, Y')}}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>