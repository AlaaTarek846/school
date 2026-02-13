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
        Video::create($request->validated());
        return responseJson([], 'Added Successfully', 200);
    }

    public function update(VideoRequest $request, $id)
    {
        $video = Video::findOrFail($id);
        $video->update($request->validated());
        return responseJson([], 'Updated Successfully', 200);
    }

    public function destroy($id)
    {
        Video::findOrFail($id)->delete();
        return responseJson([], 'Deleted Successfully', 200);
    }
}
