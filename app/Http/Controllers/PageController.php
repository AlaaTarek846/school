<?php

namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class PageController extends BaseController
{
    // homepage one
    public function index(){
        $testimonials = Testimonial::where('status', 1)->latest()->get();
        return $this->view('index',[
            'page_title' => 'Lms and University Laravel 12 Template',
            'testimonials' => $testimonials
        ]);
    }

    // homepage two
    public function indexTwo(){
        return $this->view('index-two', [
            'page_title' => 'Lms and University Laravel 12 Template'
        ]);
    }

    // homepage three
    public function indexThree(){
        return $this->view('index-three', [
            'page_title' => 'Lms and University Laravel 12 Template'
        ]);
    }

    // homepage four

    public function indexFour(){
        return $this->view('index-four', [
            'page_title' => 'Lms and University Laravel 12 Template'
        ]);
    }

    // homepage five
    public function indexFive(){
        return $this->view('index-five',[
            'page_title' => 'Lms and University Laravel 12 Template'
        ]);
    }

    // homepage school and college
    public function indexSc(){
        return $this->view('index-sc',[
            'page_title' => 'School and College Laravel 12 Template'
        ]);
    }

    // about school and college
    public function aboutSc(){
        return $this->view('about-sc', [
            'page_title' => 'School and College About Template'
        ]);
    }

    // Admission School and College
    public function admissionSc(){
        return $this->view('admission-sc',[
            'page_title' => 'School and College Admission Template'
        ]);
    }

    // Campus life school college
    public function campusLifeSc(){
        return $this->view('campus-life-sc',[
            'page_title' => 'School and College Campus Life Template'
        ]);
    }

    // campus life school and college
    public function tutionFeeSc(){
        return $this->view('tution-fee-sc',[
            'page_title' => 'School and College Tution Fee Template'
        ]);
    }

    // six form school and college
    public function sixFormSc(){
        return $this->view('six-form',[
            'page_title' => 'School and College Six Form Template'
        ]);
    }

    // single resouce school and college
    public function singleResourceSc(){
        return $this->view('single-resource',[
            'page_title' => 'School and College Single Resource Template'
        ]);
    }

    // senior school and college
    public function seniorSchool(){
        return $this->view('senior-school',[
            'page_title' => 'School and College Senior School Template'
        ]);
    }

    // primary school and college
    public function primarySchool(){
        return $this->view('primary-school',[
            'page_title' => 'School and College Primary School Template'
        ]);
    }

    // middle school
    public function middleSchool(){
        return $this->view('middle-school',[
            'page_title' => 'School and College Middle School Template'
        ]);
    }

    // About page
    public function about(){
        return $this->view('about',[
            'page_title' => 'About Page Template'
        ]);
    }

    // academic area
    public function academicArea(){
        return $this->view('academic-area',[
            'page_title' => 'Academic Areas of study Template'
        ]);
    }

    // academic page
    public function academic(){
        return $this->view('academic',[
            'page_title' => 'Academic Page Template'
        ]);
    }

    // admission page
    public function admission(){
        return $this->view('admission',[
            'page_title' => 'Admission Page Template'
        ]);
    }

    // alumni page
    public function alumni(){
        return $this->view('alumni',[
            'page_title' => 'Alumni Page Template'
        ]);
    }

    // athletics
    public function athletics(){
        return $this->view('athletics',[
            'page_title' => 'Athletics Page Template'
        ]);
    }

    // blog details
    public function blogDetails(){
        return $this->view('blog-details',[
            'page_title' => 'Blog Details Page Template'
        ]);
    }

    // blog grid
    public function blogGrid(){
        return $this->view('blog-grid',[
            'page_title' => 'Blog Grid Page Template'
        ]);
    }

    // blog list
    public function blogList(){
        return $this->view('blog-list',[
            'page_title' => 'Blog List Page Template'
        ]);
    }

    // blog standard
    public function blog(){
        return $this->view('blog',[
            'page_title' => 'Blog Standard Page Template'
        ]);
    }
    // scholarship
    public function scholarship(){
        return $this->view('scholarship',[
            'page_title' => 'Scholarship Page Template'
        ]);
    }


    // Program single
    public function programSingle(){
        return $this->view('program-single',[
            'page_title' => 'Program Single Page Template'
        ]);
    }

    // notice details
    public function noticeDetails(){
        return $this->view('notice-details', [
            'page_title' => 'Notice Details Page Template'
        ]);
    }

    // campus life
    public function campusLife(){
        return $this->view('campus-life', [
            'page_title' => 'Campus Life Page Template'
        ]);
    }

    // contact
    public function contact(){
        return $this->view('contact',[
            'page_title' => 'Contact us page template'
        ]);
    }

    // Department details
    public function departmentDetails(){
        return $this->view('department-details',[
            'page_title' => 'Department Details Page Template'
        ]);
    }

    // event details
    public function eventDetails(){
        return $this->view('event-details',[
            'page_title' => 'Event Details Page Template'
        ]);
    }

    // event
    public function event(){
        return $this->view('event',[
            'page_title' => 'Event Page Template'
        ]);
    }

    // faculty details
    public function facultyDetails(){
        return $this->view('faculty-details',[
            'page_title' => 'Faculty Details Page Template'
        ]);
    }

    // faculty sub details
    public function facultySubDetails(){
        return $this->view('faculty-sub-details',[
            'page_title' => 'Faculty Sub Details Page Template'
        ]);
    }

    // faculty sub 
    public function facultySub(){
        return $this->view('faculty-sub',[
            'page_title' => 'Faculty Sub Page Template'
        ]);
    }

    // faculty 
    public function faculty(){
        return $this->view('faculty',[
            'page_title' => 'Faculty Page Template'
        ]);
    }

    // tution fee
    public function tutionFee(){
        return $this->view('tution-fee',[
            'page_title' => 'Tution Fee Page Template'
        ]);
    }
}
