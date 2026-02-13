<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\GalleryRequest;
use App\Models\Gallery;
use App\Http\Controllers\Controller; // Added Controller usage
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function indexPage()
    {
        return view('admin.gallery.index');
    }

    public function index()
    {
        $galleries = Gallery::latest()->paginate(10);
        return responseJson($galleries->items(), '', 200, getPaginates($galleries));
    }

    public function store(GalleryRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = saveFile($request->image, 'gallery');
        }
        Gallery::create($data);
        return responseJson([], 'Added Successfully', 200);
    }

    public function update(GalleryRequest $request, $id)
    {
        // For Gallery, update usually means replacing the image.
        // If it's a new image, delete old and save new.
        $gallery = Gallery::findOrFail($id);
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($gallery->image) {
                unlink_image_by_path($gallery->image);
            }
            $data['image'] = saveFile($request->image, 'gallery');
        }

        $gallery->update($data);
        return responseJson([], 'Updated Successfully', 200);
    }

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);
        if ($gallery->image) {
            unlink_image_by_path($gallery->image);
        }
        $gallery->delete();
        return responseJson([], 'Deleted Successfully', 200);
    }
}
