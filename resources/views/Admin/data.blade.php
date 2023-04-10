<!DOCTYPE html>
<html>
<head>
	<title>Dashboard Admin</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/send_response.css') }}">
</head>
<body>
    <h2 class="title-table">Admin Page</h2>
    <div style="display: flex; justify-content: center; margin-bottom: 30px">
        <a href="/logout" style="text-align: center">Logout</a> 
        <div style="margin: 0 10px"> | </div>
        <a href="/" style="text-align: center">Home</a>
        <button class="print-btn" style="margin-right: 10px; margin-top: -5px;"><a href="{{route('export-pdf')}}">Cetak PDF</a></button>
        <button class="print-btn" style="margin-right: 10px; margin-top: -5px;"><a href="{{route('export.excel')}}">Cetak Excel</a></button>
    </div>

    <div style="display: flex; justify-content: flex-end; align-items: center">
        <form action="" method="GET">
            @csrf
            <input type="text" name="search" placeholder="Search By Name...." style="margin-right: 10px; padding: 0 30px;">
            <button type="submit" class="btn-login" style="margin-top: -1px; margin-right: 10px;">Refresh</button>
            <button type="submit" class="btn-login" style="margin-top: -1px; margin-right: 10px;">Cari</button>
        </form>
    </div>


    @if ($errors->any())
    <ul style="width:100%; background: red; padding: 10px;">
        @foreach ($errors->all() as $error)
            <li> {{$error}} </li>
        @endforeach
    </ul>
    @endif
    
    @if (Session::get('responseSuccess'))
    <ul style="width:100%; background: green; padding: 10px;">
        {{ Session::get('responseSuccess') }}
    </ul>
    @endif
    
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
            </tr>
            </thead>
            <tbody>
                @php
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
                    {{-- @php
                        $pesanWA = "Hallo " . $gadai->name . ", terima kasih telah menghubungi kami. Data pengaduan Anda sedang diproses. Mohon tunggu konfirmasi dari kami. Terima kasih.";
                    @endphp --}}
                    

                    @if($gadai->response['type'] == 'diterima')
                        @php
                            $pesanWA = "Hallo " . $gadai->name . ", pengajuan gadai Anda telah diterima. Terima kasih.";
                        @endphp
                    @else
                        @php
                            $pesanWA = "Maaf " . $gadai->name . ", pengajuan gadai Anda telah ditolak. Silakan hubungi kami untuk informasi lebih lanjut. Terima kasih.";
                        @endphp
                    @endif
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
                            {{$gadai->response['location'] }}
                        @else
                        {{-- kalau gada tampilan tanda ini --}}
                            -
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
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
