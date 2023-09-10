<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="container">
    <h3>Update Video</h3>
    <form method="POST" action="{{ route('video.update', $video->id) }}" enctype="multipart/form-data">
      @csrf
      @method('PATCH')
        <input type="text" class="input" name="title" id="title" value="{{ $video->title }}">
        <small>{{ $video->video }}</small>
        <input class="input" type="file" id="video" name="new_video">
        <div style="padding: 0" class="btnContainer"><button type="submit" style="margin: 0" class="btn" name="click">Update</button></div>
    </form>
</div>
</body>
</html>