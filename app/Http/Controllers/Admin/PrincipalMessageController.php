<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PrincipalMessageRequest;
use App\Models\PrincipalMessage;
use Illuminate\Http\Request;

class PrincipalMessageController extends Controller
{
    public function indexPage()
    {
        return view('admin.principalMessage.index');
    }

    public function index()
    {
        $data = PrincipalMessage::latest()->paginate(10);
        return responseJson($data->items(), '', 200, getPaginates($data));
    }

    public function store(PrincipalMessageRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = saveFile($request->image, 'principal_messages');
        }
        PrincipalMessage::create($data);
        return responseJson([], 'Added Successfully', 200);
    }

    public function update(PrincipalMessageRequest $request, $id)
    {
        $record = PrincipalMessage::findOrFail($id);
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($record->image) {
                unlink_image_by_path($record->image);
            }
            $data['image'] = saveFile($request->image, 'principal_messages');
        }

        $record->update($data);
        return responseJson([], 'Updated Successfully', 200);
    }

    public function destroy($id)
    {
        $record = PrincipalMessage::findOrFail($id);
        if ($record->image) {
            unlink_image_by_path($record->image);
        }
        $record->delete();
        return responseJson([], 'Deleted Successfully', 200);
    }
}
