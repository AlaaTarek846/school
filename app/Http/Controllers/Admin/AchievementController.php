<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Achievement;
use Illuminate\View\View;

class AchievementController extends Controller
{
    public function indexPage(): View
    {
        return view('admin.achievement.index');
    }

    public function index(Request $request)
    {
        $data = Achievement::with('section')
            ->searchAndFilter()
            ->paginate(10);
        return responseJson($data->items(), '', 200, getPaginates($data));
    }

    public function getSections()
    {
        $sections = \App\Models\AchievementSection::all();
        return responseJson($sections, '', 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'achievement_section_id' => 'required|exists:achievement_sections,id',
            'icon' => 'required|string',
            'text_ar' => 'required|string',
            'text_en' => 'required|string',
            'badge_icon' => 'required|string',
        ]);

        Achievement::create($data);
        return responseJson([], 'Added Successfully', 200);
    }

    public function update(Request $request, Achievement $achievement)
    {
        $data = $request->validate([
            'achievement_section_id' => 'required|exists:achievement_sections,id',
            'icon' => 'required|string',
            'text_ar' => 'required|string',
            'text_en' => 'required|string',
            'badge_icon' => 'required|string',
        ]);

        $achievement->update($data);
        return responseJson([], 'Updated Successfully', 200);
    }

    public function destroy(Achievement $achievement)
    {
        $achievement->delete();
        return responseJson([], 'Deleted Successfully', 200);
    }
}
