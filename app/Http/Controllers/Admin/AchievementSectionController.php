<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AchievementSection;
use Illuminate\Http\Request;

class AchievementSectionController extends Controller
{
    public function index(Request $request)
    {
        $data = AchievementSection::searchAndFilter()
            ->paginate(10);
        return responseJson($data->items(), '', 200, getPaginates($data));
    }

    public function indexPage()
    {
        return view('admin.achievement-section.index');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title_ar' => 'required|string',
            'title_en' => 'required|string',
            'border_color' => 'nullable|string',
            'background_color' => 'nullable|string',
        ]);

        AchievementSection::create($data);
        return responseJson([], 'Added Successfully', 200);
    }

    public function update(Request $request, AchievementSection $achievementSection)
    {
        $data = $request->validate([
            'title_ar' => 'required|string',
            'title_en' => 'required|string',
            'border_color' => 'nullable|string',
            'background_color' => 'nullable|string',
        ]);

        $achievementSection->update($data);
        return responseJson([], 'Updated Successfully', 200);
    }

    public function destroy(AchievementSection $achievementSection)
    {
        $achievementSection->delete();
        return responseJson([], 'Deleted Successfully', 200);
    }
}
