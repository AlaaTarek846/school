<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Video;
use Illuminate\Http\Request;

class SchoolController extends BaseController
{
    //  ملفات ضمان الجودة
    public function qualityAssuranceFiles()
    {
        return $this->view('quality-assurance-files', [
            'page_title' => 'quality-assurance-files',
        ]);
    }

    // الأخصائي الاجتماعي
    public function socialSpecialist()
    {
        return $this->view('social-specialist', [
            'page_title' => 'social-specialist',
        ]);
    }

    // الرسالة والرؤية
    public function missionAndVision()
    {
        return $this->view('mission-and-vision', [
            'page_title' => 'mission-and-vision',
        ]);
    }

    // مسيرة النجاح والتفوق
    public function journeyOfSuccessAndExcellence()
    {
        return $this->view('journey-of-success-and-excellence', [
            'page_title' => 'journey-of-success-and-excellence',
        ]);
    }

    // مسيرة النجاح والتفوق
    public function careers()
    {
        return $this->view('careers', [
            'page_title' => 'careers',
        ]);
    }

    // مسيرة النجاح والتفوق
    public function studentRegistration()
    {
        return $this->view('student-registration', [
            'page_title' => 'student-registration',
        ]);
    }

    // مسيرة النجاح والتفوق
    public function gallery()
    {
        return $this->view('gallery', [
            'page_title' => 'gallery',
        ]);
    }

    public function getGalleries(Request $request)
    {
        $galleries = Gallery::latest()->paginate(12);

        return response()->json([
            'data' => $galleries->items(),
            'next_page_url' => $galleries->nextPageUrl(),
            'current_page' => $galleries->currentPage(),
            'last_page' => $galleries->lastPage(),
        ]);
    }

    // مسيرة النجاح والتفوق
    public function videos()
    {
        return $this->view('videos', [
            'page_title' => 'videos',
        ]);
    }

    public function getVideos(Request $request)
    {
        $videos = \App\Models\Video::latest()->paginate(6);

        return response()->json([
            'data' => $videos->items(),
            'next_page_url' => $videos->nextPageUrl(),
            'current_page' => $videos->currentPage(),
            'last_page' => $videos->lastPage(),
        ]);
    }

    // إمكانيات المدرسة
    public function schoolFacilities()
    {
        return $this->view('school-facilities', [
            'page_title' => 'school-facilities',
        ]);
    }

    // المصروفات
    public function tuitionFees()
    {
        return $this->view('tuition-fees', [
            'page_title' => 'tuition-fees',
        ]);
    }
}
