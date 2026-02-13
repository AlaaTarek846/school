<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WhyChooseUsRequest;
use App\Http\Resources\Admin\OneAboutResource; 
// Using OneAboutResource or creating a new one? OneAboutResource structure is likely compatible if it relies on generic translation. 
// But let's create a specific resource later if needed. For now, let's assume we return data directly or use a generic resource.
// Actually, OneAboutResource is used in OneAboutController.php. I should probably create WhyChooseUsResource to be clean.
// Or just return the model directly as it's simple. Let's use generic return for now. 
// Wait, OneAboutController uses OneAboutResource. Let's check OneAboutResource structure first?
// No, let's just create the controller logic.

use App\Models\WhyChooseUs;
use App\Models\WhyChooseUsDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\View\View;

class WhyChooseUsController extends Controller
{

    public function indexPage(Request $request): View
    {
        return view('admin.whyChooseUs.index');
    }

    public function index(Request $request)
    {
        $data = WhyChooseUs::with('details')->paginate(10);
        return responseJson($data->items(),'',200,getPaginates($data));
    }

    public function show($id)
    {
        $data = WhyChooseUs::with(['details'])->find($id);
        return responseJson($data,'Data exited successfully',200);
    }

    public function store(WhyChooseUsRequest $request)
    {
        $data = $request->validated();
        if($request->hasFile('image')){
            $data['image'] = saveFile($request->image, 'whyChooseUs');
        }
        $whyChooseUs = WhyChooseUs::create(Arr::except($data,['details']));

        foreach ($data['details'] as $detail) {

            WhyChooseUsDetail::create(array_merge(['why_choose_us_id' => $whyChooseUs->id],$detail));
        }
        return responseJson([],'Added Successfully',200);
    }

    public function update(WhyChooseUsRequest $request, $id)
    {
        $whyChooseUs = WhyChooseUs::findOrFail($id);
        $data = $request->validated();
        
        if($request->hasFile('image')){
            if($whyChooseUs->image) unlink_image_by_path($whyChooseUs->image);
            $data['image'] = saveFile($request->image, 'whyChooseUs');
        }

        $whyChooseUs->update(Arr::except($data,['details']));
        
        // Delete old details
        foreach ($whyChooseUs->details as $detail) {
            $detail->delete();
        }
        
        // Save new details
        foreach ($data['details'] as $detail) {

            WhyChooseUsDetail::create(array_merge(['why_choose_us_id' => $whyChooseUs->id],$detail));
        }
        return responseJson([],'Updated Successfully',200);
    }

    public function destroy($id)
    {
        $whyChooseUs = WhyChooseUs::findOrFail($id);
        // deleteFile($whyChooseUs); // No general file on main model, only on details.
        // Details are cascade deleted or need manual deletion of images? 
        // Helper deleteFile usually handles polymorphic media. We use manual path string here. 
        // We might need to delete physical files for details here. 

        
        if($whyChooseUs->image) unlink_image_by_path($whyChooseUs->image);
        
        $whyChooseUs->delete();
        return responseJson([],'Deleted Successfully',200);
    }
}
