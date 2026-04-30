<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\ArticleCategoryController;
use App\Http\Controllers\Admin\CareerApplicationController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\CounterAboutController;
use App\Http\Controllers\Admin\CounterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\HomeSliderController;
use App\Http\Controllers\Admin\OneAboutController;
use App\Http\Controllers\Admin\WhyChooseUsController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\ProjectCategoryController;
use App\Http\Controllers\Admin\ProjectChallengeSolutionController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ServiceFaqController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SubscribeController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\StudentRegistrationController;
use App\Http\Controllers\Admin\StudentTransferController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\TwoAboutController;
use App\Http\Controllers\Admin\AchievementController;
use App\Http\Controllers\Admin\AchievementSectionController;
use App\Http\Controllers\Admin\SchoolPrideController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SchoolController;
use Illuminate\Support\Facades\Route;

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
Route::get('lang/{lang}', [LanguageController::class, 'switchLang'])->name('lang.switch');

// auth routes
Route::get('/', function () {
    return view('Frontend.Home.index');
});

Route::get('change-language/{locale}', function ($locale) {
    if (in_array($locale, ['ar', 'en'])) {
        session()->put('applocale', $locale);
    }
    return redirect()->back();
})->name('change.language');
Route::group([], function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
});

// admin routes

Route::prefix('api')->group(function () {

    // login
    Route::post('login', [AuthController::class, 'login']);

    Route::group(['middleware' => ['auth']], function () {

        Route::apiResource('home-sliders', HomeSliderController::class);
        Route::apiResource('partners', PartnerController::class);
        Route::apiResource('counters', CounterController::class);
        Route::apiResource('counter-abouts', CounterAboutController::class);
        Route::apiResource('one-abouts', OneAboutController::class);
        Route::apiResource('why-choose-us', WhyChooseUsController::class);
        Route::apiResource('two-abouts', TwoAboutController::class);
        Route::get('services-dropdown', [ServiceController::class, 'dropdown']);
        Route::apiResource('services', ServiceController::class);
        Route::get('projects-dropdown', [ProjectController::class, 'dropdown']);
        Route::apiResource('projects', ProjectController::class);
        Route::apiResource('settings', SettingController::class);
        Route::apiResource('articleCategory', ArticleCategoryController::class);
        Route::apiResource('service-faqs', ServiceFaqController::class);
        Route::apiResource('testimonials', TestimonialController::class);
        Route::apiResource('contact-messages', ContactMessageController::class);
        Route::apiResource('subscribes', SubscribeController::class);
        Route::apiResource('career-applications', CareerApplicationController::class);
        Route::apiResource('student-registrations', StudentRegistrationController::class);
        Route::get('project-categories-dropdown', [ProjectCategoryController::class, 'dropdown']);
        Route::apiResource('project-categories', ProjectCategoryController::class);
        Route::apiResource('project-challenge-solutions', ProjectChallengeSolutionController::class);
        Route::apiResource('galleries', GalleryController::class);
        Route::apiResource('videos', VideoController::class);
        Route::apiResource('how-we-welcome-child', \App\Http\Controllers\Admin\HowWeWelcomeChildController::class);
        Route::apiResource('campus-tour', \App\Http\Controllers\Admin\CampusTourController::class);
        Route::apiResource('principal-message', \App\Http\Controllers\Admin\PrincipalMessageController::class);
        Route::apiResource('school-discipline-policy', \App\Http\Controllers\Admin\SchoolDisciplinePolicyController::class);
        Route::apiResource('quality-assurance-files', \App\Http\Controllers\Admin\QualityAssuranceFileController::class);
        Route::apiResource('education-stages', \App\Http\Controllers\Admin\EducationStageController::class);
        Route::apiResource('academic-years', \App\Http\Controllers\Admin\AcademicYearController::class);
        Route::get('exams-data', [\App\Http\Controllers\Admin\ExamController::class, 'getInitialData']);
        Route::get('exams-semesters/{id}', [\App\Http\Controllers\Admin\ExamController::class, 'getSemesters']);
        Route::get('exams-stage-data/{id}', [\App\Http\Controllers\Admin\ExamController::class, 'getStageData']);
        Route::apiResource('exams', \App\Http\Controllers\Admin\ExamController::class);
        
        Route::get('exam-answers-data', [\App\Http\Controllers\Admin\StudentExamAnswerController::class, 'getInitialData']);
        Route::apiResource('exam-answers', \App\Http\Controllers\Admin\StudentExamAnswerController::class)->only(['index', 'update']);
        
        Route::apiResource('fees', \App\Http\Controllers\Admin\FeeController::class);
        Route::get('students/form-data', [\App\Http\Controllers\Admin\StudentController::class, 'getFormData']);
        Route::get('students/get-semesters/{academicYearId}', [\App\Http\Controllers\Admin\StudentController::class, 'getSemesters']);
        Route::get('students/get-classes/{educationStageId}', [\App\Http\Controllers\Admin\StudentController::class, 'getClasses']);
        Route::post('students/import', [\App\Http\Controllers\Admin\StudentController::class, 'import']);
        Route::put('students/{student}/update-score', [\App\Http\Controllers\Admin\StudentController::class, 'updateScore']);
        Route::post('students/bulk-update-score', [\App\Http\Controllers\Admin\StudentController::class, 'bulkUpdateScore']);
        Route::apiResource('students', \App\Http\Controllers\Admin\StudentController::class);
        Route::get('students-transfer-data', [StudentTransferController::class, 'getStudents']);
        Route::post('students-transfer-execute', [StudentTransferController::class, 'executeTransfer']);
        Route::apiResource('teams', TeamController::class);
        Route::get('get-achievement-sections', [AchievementController::class, 'getSections']);
        Route::apiResource('achievements', AchievementController::class);
        Route::apiResource('achievement-sections', AchievementSectionController::class);
        Route::apiResource('school-prides', SchoolPrideController::class)->only(['index', 'update']);
        Route::get('dashboard-stats', [DashboardController::class, 'getStats']);
    });

});

Route::prefix('admin')->name('admin.')->group(function () {

    Route::group(['middleware' => ['auth:web']], function () {

        // dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::name('page.')->prefix('page')->group(function () {

            Route::get('home-sliders', [HomeSliderController::class, 'indexPage'])->name('home-sliders');
            Route::get('partners', [PartnerController::class, 'indexPage'])->name('partners');
            Route::get('counters', [CounterController::class, 'indexPage'])->name('counter');
            Route::get('services', [ServiceController::class, 'indexPage'])->name('services');
            Route::get('setting', [SettingController::class, 'indexPage'])->name('setting');
            Route::get('products', [ProjectController::class, 'indexPage'])->name('projects');
            Route::get('one-about', [OneAboutController::class, 'indexPage'])->name('one-about');
            Route::get('why-choose-us', [WhyChooseUsController::class, 'indexPage'])->name('why-choose-us');
            Route::get('two-about', [TwoAboutController::class, 'indexPage'])->name('two-about');
            Route::get('counter-about', [CounterAboutController::class, 'indexPage'])->name('counter-about');
            Route::get('article-categories', [ArticleCategoryController::class, 'indexPage'])->name('article-categories');
            Route::get('service-faqs', [ServiceFaqController::class, 'indexPage'])->name('service-faqs');
            Route::get('testimonial', [TestimonialController::class, 'indexPage'])->name('testimonial');
            Route::get('project-categories', [ProjectCategoryController::class, 'indexPage'])->name('project-categories');
            Route::get('project-challenge-solutions', [ProjectChallengeSolutionController::class, 'indexPage'])->name('project-challenge-solutions');
            Route::get('galleries', [GalleryController::class, 'indexPage'])->name('galleries');
            Route::get('videos', [VideoController::class, 'indexPage'])->name('videos');
            Route::get('how-we-welcome-child', [\App\Http\Controllers\Admin\HowWeWelcomeChildController::class, 'indexPage'])->name('how-we-welcome-child');
            Route::get('campus-tour', [\App\Http\Controllers\Admin\CampusTourController::class, 'indexPage'])->name('campus-tour');
            Route::get('principal-message', [\App\Http\Controllers\Admin\PrincipalMessageController::class, 'indexPage'])->name('principal-message');
            Route::get('school-discipline-policy', [\App\Http\Controllers\Admin\SchoolDisciplinePolicyController::class, 'indexPage'])->name('school-discipline-policy');
            Route::get('quality-assurance-files', [\App\Http\Controllers\Admin\QualityAssuranceFileController::class, 'indexPage'])->name('quality-assurance-files');
    Route::get('education-stages', [\App\Http\Controllers\Admin\EducationStageController::class, 'indexPage'])->name('education-stages');
    Route::get('academic-years', [\App\Http\Controllers\Admin\AcademicYearController::class, 'indexPage'])->name('academic-years');
    Route::get('exams', [\App\Http\Controllers\Admin\ExamController::class, 'indexPage'])->name('exams');
    Route::get('exam-answers', [\App\Http\Controllers\Admin\StudentExamAnswerController::class, 'indexPage'])->name('exam-answers');
    Route::get('fees', [\App\Http\Controllers\Admin\FeeController::class, 'indexPage'])->name('fees');
            Route::get('contact-messages', [ContactMessageController::class, 'indexPage'])->name('contact-messages');
            Route::get('subscribes', [SubscribeController::class, 'indexPage'])->name('subscribes');
            Route::get('career-applications', [CareerApplicationController::class, 'indexPage'])->name('career-applications');
            Route::get('student-registrations', [StudentRegistrationController::class, 'indexPage'])->name('student-registrations');
            Route::get('students', [\App\Http\Controllers\Admin\StudentController::class, 'indexPage'])->name('students');
            Route::get('students-transfer', [StudentTransferController::class, 'indexPage'])->name('students-transfer');
            Route::get('teams', [TeamController::class, 'indexPage'])->name('teams');
            Route::get('achievements', [AchievementController::class, 'indexPage'])->name('achievements');
            Route::get('achievement-sections', [AchievementSectionController::class, 'indexPage'])->name('achievement-sections');
            Route::get('school-prides', [SchoolPrideController::class, 'indexPage'])->name('school-prides');
        });

        // logout
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    });

});

Route::controller(PageController::class)->group(function () {
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
    Route::get('why-choose-galaa', 'whyChooseGalaa')->name('why-choose-galaa');
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
    Route::post('contact-message', [\App\Http\Controllers\Frontend\ContactMessageController::class, 'store'])->name('contact-message.store');
    Route::post('/career-apply', [\App\Http\Controllers\Frontend\CareerApplicationController::class, 'store'])->name('career-apply');
    Route::post('/student-registration-apply', [\App\Http\Controllers\Frontend\StudentRegistrationController::class, 'store'])->name('student-registration-apply');
    Route::get('department-details', 'departmentDetails')->name('department-details');
    Route::get('event-details', 'eventDetails')->name('event-details');
    Route::get('event', 'event')->name('event');
    Route::get('faculty-details', 'facultyDetails')->name('faculty-details');
    Route::get('faculty-sub-details', 'facultySubDetails')->name('faculty-sub-details');
    Route::get('faculty-sub', 'facultySub')->name('faculty-sub');
    Route::get('faculty', 'faculty')->name('faculty');
    Route::get('tution-fee', 'tutionFee')->name('tution-fee');

});

Route::controller(AboutController::class)->group(function () {
    Route::get('principal-message', 'principalMessage')->name('principal-message');
    Route::get('core-values', 'coreValues')->name('core-values');
    Route::get('school-discipline-policy', 'schoolDisciplinePolicy')->name('school-discipline-policy');
    Route::get('parents-meeting', 'parentsMeeting')->name('parents-meeting');
});

Route::controller(SchoolController::class)->group(function () {
    Route::get('quality-assurance-files', 'qualityAssuranceFiles')->name('quality-assurance-files');
    Route::get('social-specialist', 'socialSpecialist')->name('social-specialist');
    Route::get('mission-and-vision', 'missionAndVision')->name('mission-and-vision');
    Route::get('journey-of-success-and-excellence', 'journeyOfSuccessAndExcellence')->name('journey-of-success-and-excellence');
    Route::get('careers', 'careers')->name('careers');
    Route::get('student-registration', 'studentRegistration')->name('student-registration');
    Route::get('gallery', 'gallery')->name('gallery');
    Route::get('api/galleries', 'getGalleries')->name('api.galleries');
    Route::get('videos', 'videos')->name('videos');
    Route::get('api/videos', 'getVideos')->name('api.videos');
    Route::get('tuition-fees', 'tuitionFees')->name('tuition-fees');
    Route::get('galaa-stages', 'galaaStages')->name('galaa-stages');
    Route::get('reviews', 'reviews')->name('reviews');
    Route::get('school-facilities', 'schoolFacilities')->name('school-facilities');
    Route::get('student-info', 'studentInfo')->name('student-info');
});

// Student Auth & Dashboard Routes
Route::prefix('student')->name('student.')->group(function () {
    Route::post('/login', [App\Http\Controllers\Frontend\StudentAuthController::class, 'login'])->name('login.post');
    Route::get('/logout', [App\Http\Controllers\Frontend\StudentAuthController::class, 'logout'])->name('logout');

    Route::group(['middleware' => ['auth:student']], function () {
        Route::get('/complete-profile', [App\Http\Controllers\Frontend\StudentAuthController::class, 'showCompleteProfile'])->name('complete_profile');
        Route::post('/complete-profile', [App\Http\Controllers\Frontend\StudentAuthController::class, 'updateProfile'])->name('complete_profile.post');

        Route::group(['middleware' => ['student.completed']], function () {
            Route::get('dashboard', [\App\Http\Controllers\Frontend\StudentDashboardController::class, 'index'])->name('dashboard');
            Route::get('courses', [\App\Http\Controllers\Frontend\StudentCourseController::class, 'index'])->name('courses');
            
            // Exams
            Route::get('exams', [\App\Http\Controllers\Frontend\StudentExamController::class, 'index'])->name('exams');
            Route::get('exam-results', [\App\Http\Controllers\Frontend\StudentExamController::class, 'results'])->name('exams.results');
            
            Route::group(['prefix' => 'api', 'as' => 'api.'], function () {
                Route::get('exams', [\App\Http\Controllers\Frontend\StudentExamController::class, 'getExams'])->name('exams');
                Route::get('exam-results', [\App\Http\Controllers\Frontend\StudentExamController::class, 'apiResults'])->name('exams.results');
                Route::post('exams/upload', [\App\Http\Controllers\Frontend\StudentExamController::class, 'uploadAnswer'])->name('exams.upload');
                Route::get('dashboard-statistics', [\App\Http\Controllers\Frontend\StudentDashboardController::class, 'apiStatistics'])->name('dashboard.statistics');
            });
        });
    });
});
