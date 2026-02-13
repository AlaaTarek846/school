<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\QualityAssuranceFileRequest;
use App\Models\QualityAssuranceFile;
use Illuminate\Http\Request;

class QualityAssuranceFileController extends Controller
{
    public function indexPage()
    {
        return view('admin.qualityAssuranceFile.index');
    }

    public function index()
    {
        $data = QualityAssuranceFile::latest()->paginate(10);
        return responseJson($data->items(), '', 200, getPaginates($data));
    }

    public function store(QualityAssuranceFileRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = saveFile($request->image, 'quality_assurance_files');
        }
        if ($request->hasFile('pdf')) {
            $data['pdf'] = saveFile($request->pdf, 'quality_assurance_files');
        }
        QualityAssuranceFile::create($data);
        return responseJson([], 'Added Successfully', 200);
    }

    public function update(QualityAssuranceFileRequest $request, $id)
    {
        $record = QualityAssuranceFile::findOrFail($id);
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($record->image) {
                unlink_image_by_path($record->image);
            }
            $data['image'] = saveFile($request->image, 'quality_assurance_files');
        }

        if ($request->hasFile('pdf')) {
            if ($record->pdf) {
                unlink_image_by_path($record->pdf);
            }
            $data['pdf'] = saveFile($request->pdf, 'quality_assurance_files');
        }

        $record->update($data);
        return responseJson([], 'Updated Successfully', 200);
    }

    public function destroy($id)
    {
        $record = QualityAssuranceFile::findOrFail($id);
        if ($record->image) {
            unlink_image_by_path($record->image);
        }
        if ($record->pdf) {
            unlink_image_by_path($record->pdf);
        }
        $record->delete();
        return responseJson([], 'Deleted Successfully', 200);
    }
}
