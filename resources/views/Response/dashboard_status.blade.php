<!DOCTYPE html>
<html>
<head>
	<title>Dashboard Admin</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/send_response.css') }}">
</head>
<body>
    <h2 class="title-table">Laporan Keluhan Petugas</h2>
    <div style="display: flex; justify-content: center; margin-bottom: 30px">
        <a href="/logout" style="text-align: center">Logout</a> 
        <div style="margin: 0 10px"> | </div>
        <a href="/response" style="text-align: center">Send Response</a>
        <div style="margin: 0 10px"> | </div>
        <a href="/response-page" style="text-align: center">By Status</a>
        <div style="margin: 0 10px"> | </div>
        <a href="/" style="text-align: center">Home</a>
    </div>

    <div style="display: flex; justify-content: flex-end; align-items: center">
        <form action="{{ route('dashboard_status') }}" method="GET">
            @csrf
            <input type="text" name="search" placeholder="Search By Name...." style="margin-right: 10px; padding: 0 30px;">
            <button type="submit" class="btn-login" style="margin-top: -1px; margin-right: 10px;">Refresh</button>
            <button type="submit" class="btn-login" style="margin-top: -1px; margin-right: 10px;">Cari</button>
        </form>
    </div>
    <div style="padding: 0 30px">
        <table>
            <thead>
            <tr>
                <th width="5%">No</th>
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
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
                @php
                $pegadaian = App\Models\Pegadaian::all();
                $no = 1;
            @endphp
            
            @foreach ($pegadaian as $gadai)
                <tr>
                    <th>{{ $no++ }}</th>
                    <th>{{ $gadai->name }}</th>
                    <th>{{ $gadai->email }}</th>
                    <th>{{ $gadai->age }}</th>
                    @php
                        $phone = substr_replace($gadai->no_telp, "62", 0, 1)
                    @endphp
                    @php
                        $pesanWA = "Hallo " . $gadai->name . ", terima kasih telah menghubungi kami. Data pengaduan Anda sedang diproses. Mohon tunggu konfirmasi dari kami. Terima kasih.";
                    @endphp
                    <td><a href="https://wa.me/{{$gadai->phone}}?text={{$pesanWA}}" target="_blank">{{$gadai->phone}}</a></td>
                   
                    <th>{{ $gadai->nik }}</th>
                    <th>{{ $gadai->item }}</th>
                    <td>
                        <a href="{{asset('assets/image/' . $gadai->foto)}}" target="_blank">
                            <img src="{{asset('assets/image/' . $gadai->foto)}}" width="120">
                        </a>
                    </td>
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
                        {{$gadai->response['location'] ? $gadai->response['location'] : '-' }}
                    @endif
                </td>
                {{-- <td>
                    @if ($gadai->response)
                        {{$gadai->response['updated_at'] }}
                    @else
                        -
                    @endif
                </td> --}}
                <td>{{\Carbon\Carbon::parse($gadai['created_at'])->format('j F, Y')}}</td>
                <td>
                    <a href="{{route('response.edit', $gadai->id)}}" class="button-submit">Change Response</a>
                </td>
            @endforeach
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
