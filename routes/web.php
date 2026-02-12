<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::controller(PageController::class)->group(function (){
    Route::get('/', 'index')->name('index');
    Route::get('index-two', 'indexTwo')->name('index-two');
    Route::get('index-three', 'indexThree')->name('index-three');
    Route::get('index-four', 'indexFour')->name('index-four');
    Route::get('index-five', 'indexFive')->name('index-five');
    Route::get('index-sc', 'indexSc')->name('index-sc');
    Route::get('about-sc', 'aboutSc')->name('about-sc');
    Route::get('admission-sc', 'admissionSc')->name('admission-sc');
    Route::get('campus-life-sc', 'campusLifeSc')->name('campuslife-sc');
    Route::get('tution-fee-sc', 'tutionFeeSc')->name('tutionfee-sc');
    Route::get('six-form', 'sixFormSc')->name('six-form');
    Route::get('single-resource', 'singleResourceSc')->name('single-resource');
    Route::get('senior-school', 'seniorSchool')->name('senior-school');
    Route::get('primary-school', 'primarySchool')->name('primary-school');
    Route::get('middle-school', 'middleSchool')->name('middle-school');
    Route::get('about', 'about')->name('about');
    Route::get('academic-area', 'academicArea')->name('academic-area');
    Route::get('academic', 'academic')->name('academic');
    Route::get('admission', 'admission')->name('admission');
    Route::get('alumni', 'alumni')->name('alumni');
    Route::get('athletics', 'athletics')->name('athletics');
    Route::get('blog-details', 'blogDetails')->name('blog-details');
    Route::get('blog-grid', 'blogGrid')->name('blog-grid');
    Route::get('blog-list', 'blogList')->name('blog-list');
    Route::get('blog', 'blog')->name('blog');
    Route::get('scholarship', 'scholarship')->name('scholarship');
    Route::get('research', 'research')->name('research');
    Route::get('program-single', 'programSingle')->name('program-single');
    Route::get('notice-details', 'noticeDetails')->name('notice-details');
    Route::get('campus-life', 'campusLife')->name('campus-life');
    Route::get('contact', 'contact')->name('contact');
    Route::get('department-details', 'departmentDetails')->name('department-details');
    Route::get('event-details', 'eventDetails')->name('event-details');
    Route::get('event', 'event')->name('event');
    Route::get('faculty-details', 'facultyDetails')->name('faculty-details');
    Route::get('faculty-sub-details', 'facultySubDetails')->name('faculty-sub-details');
    Route::get('faculty-sub', 'facultySub')->name('faculty-sub');
    Route::get('faculty', 'faculty')->name('faculty');
    Route::get('tution-fee', 'tutionFee')->name('tution-fee');
});