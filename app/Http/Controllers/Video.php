<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VideoModel;

class Video extends Controller
{
    function index()
    {
        return view("index");
    }


    function fetch()
    {
      $data=VideoModel::all()->toArray();
      return view('videos',compact('data'));
    }

    function insert(Request $request)
    {
       $request->validate([
           'video' => 'required|mimes:mp4,ogx,oga,ogv,ogg,webm'
       ]);

       $file=$request->file('video');
       $file->move('upload',$file->getClientOriginalName());
       $file_name=$file->getClientOriginalName();

       $insert=new VideoModel();
       $insert->video = $file_name;
       $insert->title = $request->input('title');
       $insert->save();

       return redirect('/list_video');
    }

    public function edit($id)
{
    $video = VideoModel::find($id);

    if (!$video) {
        return redirect('/list_video')->with('error', 'Video not found.');
    }

    return view('update', compact('video'));
}

public function add()
{
    return view("index");
}


    function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string', // You might want to add more validation if needed
        'new_video' => 'sometimes|required|mimes:mp4,ogx,oga,ogv,ogg,webm', // Optional new video update
    ]);

    $video = VideoModel::find($id);

    if (!$video) {
        return redirect('/list_video')->with('error', 'Video not found.');
    }

    // Handle new video upload if provided
    if ($request->hasFile('new_video')) {
        $newFile = $request->file('new_video');
        $newFile->move('upload', $newFile->getClientOriginalName());
        $newFileName = $newFile->getClientOriginalName();
        // Delete the old video file if needed
        // Storage::delete('upload/' . $video->video);
        $video->video = $newFileName;
    }

    // Update other data
    $video->title = $request->input('title');
    $video->save();

    return redirect('/list_video')->with('success', 'Video updated successfully.');
}

public function destroy($id)
{
    $video = VideoModel::find($id);

    if (!$video) {
        return redirect('/list_video')->with('error', 'Video not found.');
    }

    // Hapus video dari sistem penyimpanan (misalnya, Storage::delete() jika Anda menggunakan Storage)
    // Storage::delete('upload/' . $video->video);

    $video->delete();

    return redirect('/list_video')->with('success', 'Video berhasil dihapus.');
}


}
