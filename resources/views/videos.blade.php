<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div style="margin: 0.5rem" class="row">
  <h1>List Video</h1>
  <!-- <form style="margin: auto 1rem" method="GET" action="{{ route('video.add') }}">
    <button type="submit" class="btn">Add</button>
  </form> -->
</div>
<div class="container">
    <h3>Upload Video</h3>
    <form method="post" action="{{ Route('insert.file') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
        <input type="text" class="input" name="title" id="title" placeholder="Masukkan Judul Video">
        <input type="file" class="input" name="video">
        <p>
         @if($errors->has('video'))
           {{ $errors->first('video') }}
         @endif
        </p>
        <div style="padding: 0" class="btnContainer"><button type="submit" style="margin: 0" class="btn" name="click">Upload</button></div>
    </form>
</div>
<div class="row">
  @foreach($data as $row)
    <div class="box">
        <span style="display: block; font-size: 1.3rem">{{ $row['title'] }}</span>
        <video id="myVideo" width="320" height="240" controls >
            <source src="{{asset('upload')}}/{{$row['video']}}" type="video/mp4">
        </video>

        <div class="btnContainer">
            <form method="GET" action="{{ route('video.edit', $row['id']) }}">
                @csrf
                <button type="submit" class="btn">Edit</button>
            </form>

            <form method="POST" action="{{ route('video.destroy', $row['id']) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn" onclick="return confirm('Apakah Anda yakin ingin menghapus video ini?')">Hapus</button>
            </form>
        </div>
    </div>
  @endforeach
</div>
</body>
</html>