<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FeeRequest;
use App\Models\Fee;
use App\Models\FeeDetail;
use App\Models\EducationStage; // Import EducationStage to pass to view if needed, though mostly for API
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class FeeController extends Controller
{
    public function indexPage()
    {
        return view('admin.fee.index');
    }

    public function index()
    {
        $data = Fee::with('details.educationStage')->latest()->paginate(10);
        return responseJson($data->items(), '', 200, getPaginates($data));
    }

    public function store(FeeRequest $request)
    {
        $data = $request->validated();
        
        $fee = Fee::create(Arr::except($data, ['details']));

        foreach ($data['details'] as $detail) {
            $fee->details()->create($detail);
        }

        return responseJson([], 'Added Successfully', 200);
    }

    public function update(FeeRequest $request, $id)
    {
        $fee = Fee::findOrFail($id);
        $data = $request->validated();

        $fee->update(Arr::except($data, ['details']));

        // Simplest approach: delete old details and recreate new ones
        // or check IDs to update existing ones. Recreating is safer for simple repeater logic.
        $fee->details()->delete();

        foreach ($data['details'] as $detail) {
            $fee->details()->create($detail);
        }

        return responseJson([], 'Updated Successfully', 200);
    }

    public function destroy($id)
    {
        $fee = Fee::findOrFail($id);
        $fee->delete(); // Details should cascade delete via DB constraint, but also defined in migration
        return responseJson([], 'Deleted Successfully', 200);
    }
}
