<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Response</title>
        <link rel="stylesheet" href="{{asset("assets/css/response.css")}}">
    </head>
    <body>
        <h1>Create/Update Response</h1>
        @if ($errors->any())
        <ul style="width:100%; background: red; padding: 10px;">
            @foreach ($errors->all() as $error)
                <li> {{$error}} </li>
            @endforeach
        </ul>
        @endif
        
        @if (Session::get('success'))
        <ul style="width:100%; background: green; padding: 10px;">
            {{ Session::get('success') }}
        </ul>
        @endif
        
        <form action="{{route('response.update', $pegadaianId)}}" method="POST" enctype="multipart/form-data">
            @csrf 
            @method('PATCH')
            <label for="type">Type:</label>
            @if ($pegadaian)
                <select name="type" id="type">
                    <option value="ditolak" {{ $pegadaian['type'] == 'ditolak' ? 'selected' : '' }}>ditolak</option>
                    <option value="proses" {{ $pegadaian['type'] == 'proses' ? 'selected' : '' }}>proses</option>
                    <option value="diterima" {{ $pegadaian['type'] == 'diterima' ? 'selected' : '' }}>diterima</option>
                </select>
            @else
                <select id="type" name="type" placeholder="Type...">
                    <option selected hidden disabled>Pilih Type</option>
                    <option value="ditolak" type="ditolak">ditolak</option>
                    <option value="proses" type="proses">proses</option>
                    <option value="diterima" type="diterima">diterima</option>
                </select>
            @endif
            
            <label for="shop-location">Shop Location:</label>
            <input type="text" id="location" name="location" placeholder="Enter location..." value="{{ $pegadaian ? $pegadaian['location'] : '' }} ">
                
            <button type="submit" class="">Send Response</button>
            <a href="{{route('dashboard')}}" class="button-cancel">Cancel</a>
        </form>
    </body>
</html>
