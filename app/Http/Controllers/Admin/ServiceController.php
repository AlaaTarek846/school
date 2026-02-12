<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\HomeSliderRequest;
use App\Http\Requests\Admin\ServiceRequest;
use App\Http\Resources\Admin\HomeSliderResource;
use App\Http\Resources\Admin\ServiceResource;
use App\Models\HomeSlider;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    public function indexPage(Request $request): View
    {
        return view('admin.services.index');
    }

    public function index(Request $request)
    {
        $services = Service::with('image','pdf')->paginate(10);
        return responseJson(ServiceResource::collection($services->items()),'',200,getPaginates($services));
    }

    public function create(): View
    {
        return view('admin.homeSliders.create');
    }

    public function store(ServiceRequest $request)
    {
        $service = Service::create($request->validated());
        saveFiles($request->image,$service,"service");
         if(isset($request->image)) {
            saveFiles($request->image, $service, 'service', "image");
        }
         if(isset($request->image1)) {
            saveFiles($request->image1, $service, 'service', "icon");
        }
        if(isset($request->pdf)) {
            saveFiles($request->pdf, $service, 'service', "pdf");
        }

        return responseJson([],'Created Successfully',200);
    }

    public function show($id)
    {
        $service = Service::with(['translations','pdf','image','icon'])->find($id);
        return responseJson($service,'Data exited successfully',200);
    }

    public function update(ServiceRequest $request, Service $service)
    {    
        if($request->hasFile('image')) {
            saveFiles($request->image, $service, 'service', "image",'update');
        }
        if($request->hasFile('image1')) {
            saveFiles($request->image1, $service, 'service', "icon",'update');
        }
        if($request->hasFile('pdf')) {
           
            saveFiles($request->pdf, $service, 'service', "pdf",'update');
        }

        $service->update($request->validated());
        return responseJson([],'Updated Successfully',200);
    }

    public function destroy(Service $service)
    {
        deleteFile($service);
        $service->delete();
        return responseJson([],'Deleted Successfully',200);
    }

    public function dropdown( )
    {
        $services = Service::select('id','title_ar as title')->get();
        return responseJson($services,'Data exited successfully',200);
    }


}
