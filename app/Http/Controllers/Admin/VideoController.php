<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\VideoRequest;
use App\Models\Video;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function indexPage()
    {
        return view('admin.video.index');
    }

    public function index()
    {
        $videos = Video::latest()->paginate(10);
        return responseJson($videos->items(), '', 200, getPaginates($videos));
    }

    public function store(VideoRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('video')) {
            $data['video'] = saveFile($request->file('video'), 'videos');
        }
        Video::create($data);
        return responseJson([], 'Added Successfully', 200);
    }

    public function update(VideoRequest $request, $id)
    {
        $video = Video::findOrFail($id);
        $data = $request->validated();
        if ($request->hasFile('video')) {
            if ($video->video) {
                unlink_image_by_path($video->video);
            }
            $data['video'] = saveFile($request->file('video'), 'videos');
        }
        $video->update($data);
        return responseJson([], 'Updated Successfully', 200);
    }

    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        if ($video->video) {
            unlink_image_by_path($video->video);
        }
        $video->delete();
        return responseJson([], 'Deleted Successfully', 200);
    }
}
