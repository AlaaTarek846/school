<ul class="main-menu">

     <!-- Start::Dashboard -->
     <li class="slide">
         <a href="{{ route('admin.dashboard') }}"
             class="side-menu__item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
             <i class="bx bx-home side-menu__icon"></i>
             <span class="side-menu__label">الرئيسية</span>
         </a>
     </li>

     <!-- Start::About School Dropdown -->
     <li class="slide has-sub {{ request()->routeIs('admin.page.one-about') || request()->routeIs('admin.page.why-choose-us') || request()->routeIs('admin.page.how-we-welcome-child') || request()->routeIs('admin.page.campus-tour') || request()->routeIs('admin.page.principal-message') || request()->routeIs('admin.page.school-discipline-policy') || request()->routeIs('admin.page.quality-assurance-files') || request()->routeIs('admin.page.achievements') || request()->routeIs('admin.page.achievement-sections') || request()->routeIs('admin.page.school-prides') ? 'active open' : '' }}">
         <a href="javascript:void(0);" class="side-menu__item {{ request()->routeIs('admin.page.one-about') || request()->routeIs('admin.page.why-choose-us') || request()->routeIs('admin.page.how-we-welcome-child') || request()->routeIs('admin.page.campus-tour') || request()->routeIs('admin.page.principal-message') || request()->routeIs('admin.page.school-discipline-policy') || request()->routeIs('admin.page.quality-assurance-files') || request()->routeIs('admin.page.achievements') || request()->routeIs('admin.page.achievement-sections') || request()->routeIs('admin.page.school-prides') ? 'active' : '' }}">
             <i class="bi bi-info-circle side-menu__icon"></i>
             <span class="side-menu__label">عن المدرسة</span>
             <i class="fe fe-chevron-right side-menu__angle"></i>
         </a>
         <ul class="slide-menu child1">
             <li class="slide side-menu__label1"><a href="javascript:void(0)">عن المدرسة</a></li>
             <li class="slide"><a href="{{ route('admin.page.one-about') }}" class="side-menu__item {{ request()->routeIs('admin.page.one-about') ? 'active' : '' }}">السكشن من نحن</a></li>
             <li class="slide"><a href="{{ route('admin.page.why-choose-us') }}" class="side-menu__item {{ request()->routeIs('admin.page.why-choose-us') ? 'active' : '' }}">لماذا تختارنا</a></li>
             <li class="slide"><a href="{{ route('admin.page.how-we-welcome-child') }}" class="side-menu__item {{ request()->routeIs('admin.page.how-we-welcome-child') ? 'active' : '' }}">القيم الجوهرية</a></li>
             <li class="slide"><a href="{{ route('admin.page.campus-tour') }}" class="side-menu__item {{ request()->routeIs('admin.page.campus-tour') ? 'active' : '' }}">جولة في حرم المدرسة</a></li>
             <li class="slide"><a href="{{ route('admin.page.principal-message') }}" class="side-menu__item {{ request()->routeIs('admin.page.principal-message') ? 'active' : '' }}">كلمة المدير</a></li>
             <li class="slide"><a href="{{ route('admin.page.school-discipline-policy') }}" class="side-menu__item {{ request()->routeIs('admin.page.school-discipline-policy') ? 'active' : '' }}">لائحة الانضباط المدرسي</a></li>
             <li class="slide"><a href="{{ route('admin.page.quality-assurance-files') }}" class="side-menu__item {{ request()->routeIs('admin.page.quality-assurance-files') ? 'active' : '' }}">ملفات ضمان الجودة</a></li>
             <li class="slide has-sub {{ request()->routeIs('admin.page.achievements') || request()->routeIs('admin.page.achievement-sections') || request()->routeIs('admin.page.school-prides') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="side-menu__item {{ request()->routeIs('admin.page.achievements') || request()->routeIs('admin.page.achievement-sections') || request()->routeIs('admin.page.school-prides') ? 'active' : '' }}">
                    <span class="side-menu__label">رحلة النجاح والتميز</span>
                    <i class="fe fe-chevron-right side-menu__angle"></i>
                </a>
                <ul class="slide-menu child2">
                    <li class="slide"><a href="{{ route('admin.page.achievement-sections') }}" class="side-menu__item {{ request()->routeIs('admin.page.achievement-sections') ? 'active' : '' }}">أقسام الإنجازات</a></li>
                    <li class="slide"><a href="{{ route('admin.page.achievements') }}" class="side-menu__item {{ request()->routeIs('admin.page.achievements') ? 'active' : '' }}">الإنجازات</a></li>
                    <li class="slide"><a href="{{ route('admin.page.school-prides') }}" class="side-menu__item {{ request()->routeIs('admin.page.school-prides') ? 'active' : '' }}">فخر المدرسة</a></li>
                </ul>
            </li>
         </ul>
     </li>

     <!-- Start::Academic Setup Dropdown -->
     <li class="slide has-sub {{ request()->routeIs('admin.page.academic-years') || request()->routeIs('admin.page.education-stages') ? 'active open' : '' }}">
         <a href="javascript:void(0);" class="side-menu__item {{ request()->routeIs('admin.page.academic-years') || request()->routeIs('admin.page.education-stages') ? 'active' : '' }}">
             <i class="bi bi-mortarboard side-menu__icon"></i>
             <span class="side-menu__label">الإعدادات الأكاديمية</span>
             <i class="fe fe-chevron-right side-menu__angle"></i>
         </a>
         <ul class="slide-menu child1">
             <li class="slide side-menu__label1"><a href="javascript:void(0)">الإعدادات الأكاديمية</a></li>
             <li class="slide"><a href="{{ route('admin.page.education-stages') }}" class="side-menu__item {{ request()->routeIs('admin.page.education-stages') ? 'active' : '' }}">مراحل التعليم</a></li>
             <li class="slide"><a href="{{ route('admin.page.academic-years') }}" class="side-menu__item {{ request()->routeIs('admin.page.academic-years') ? 'active' : '' }}">السنوات الدراسية</a></li>
         </ul>
     </li>

     <!-- Start::Exams & Grading Dropdown -->
     <li class="slide has-sub {{ request()->routeIs('admin.page.exams') || request()->routeIs('admin.page.exam-answers') ? 'active open' : '' }}">
         <a href="javascript:void(0);" class="side-menu__item {{ request()->routeIs('admin.page.exams') || request()->routeIs('admin.page.exam-answers') ? 'active' : '' }}">
             <i class="bi bi-journal-check side-menu__icon"></i>
             <span class="side-menu__label">الواجبات</span>
             <i class="fe fe-chevron-right side-menu__angle"></i>
         </a>
         <ul class="slide-menu child1">
             <li class="slide side-menu__label1"><a href="javascript:void(0)">الواجبات</a></li>
             <li class="slide"><a href="{{ route('admin.page.exams') }}" class="side-menu__item {{ request()->routeIs('admin.page.exams') ? 'active' : '' }}">إدارة الواجبات</a></li>
{{--             <li class="slide"><a href="{{ route('admin.page.exam-answers') }}" class="side-menu__item {{ request()->routeIs('admin.page.exam-answers') ? 'active' : '' }}">إجابات الطلاب</a></li>--}}
         </ul>
     </li>

     <!-- Start::Student Hub Dropdown -->
     <li class="slide has-sub {{ request()->routeIs('admin.page.students') || request()->routeIs('admin.page.student-registrations') || request()->routeIs('admin.page.students-transfer') ? 'active open' : '' }}">
         <a href="javascript:void(0);" class="side-menu__item {{ request()->routeIs('admin.page.students') || request()->routeIs('admin.page.student-registrations') || request()->routeIs('admin.page.students-transfer') ? 'active' : '' }}">
             <i class="bi bi-people-fill side-menu__icon"></i>
             <span class="side-menu__label">شؤون الطلاب</span>
             <i class="fe fe-chevron-right side-menu__angle"></i>
         </a>
         <ul class="slide-menu child1">
             <li class="slide side-menu__label1"><a href="javascript:void(0)">شؤون الطلاب</a></li>
             <li class="slide"><a href="{{ route('admin.page.students') }}" class="side-menu__item {{ request()->routeIs('admin.page.students') ? 'active' : '' }}">قائمة الطلاب</a></li>
             <li class="slide"><a href="{{ route('admin.page.student-registrations') }}" class="side-menu__item {{ request()->routeIs('admin.page.student-registrations') ? 'active' : '' }}">طلبات التسجيل</a></li>
             <li class="slide"><a href="{{ route('admin.page.students-transfer') }}" class="side-menu__item {{ request()->routeIs('admin.page.students-transfer') ? 'active' : '' }}">نقل الطلاب</a></li>
         </ul>
     </li>

     <!-- Start::Financial Management Dropdown -->
     <li class="slide has-sub {{ request()->routeIs('admin.page.fees') ? 'active open' : '' }}">
         <a href="javascript:void(0);" class="side-menu__item {{ request()->routeIs('admin.page.fees') ? 'active' : '' }}">
             <i class="bi bi-wallet2 side-menu__icon"></i>
             <span class="side-menu__label">النظام المالي</span>
             <i class="fe fe-chevron-right side-menu__angle"></i>
         </a>
         <ul class="slide-menu child1">
             <li class="slide side-menu__label1"><a href="javascript:void(0)">النظام المالي</a></li>
             <li class="slide"><a href="{{ route('admin.page.fees') }}" class="side-menu__item {{ request()->routeIs('admin.page.fees') ? 'active' : '' }}">المصروفات الدراسية</a></li>
         </ul>
     </li>

     <!-- Start::HR & Careers Dropdown -->
     <li class="slide has-sub {{ request()->routeIs('admin.page.teams') || request()->routeIs('admin.page.career-applications') ? 'active open' : '' }}">
         <a href="javascript:void(0);" class="side-menu__item {{ request()->routeIs('admin.page.teams') || request()->routeIs('admin.page.career-applications') ? 'active' : '' }}">
             <i class="bi bi-briefcase side-menu__icon"></i>
             <span class="side-menu__label">التوظيف وفريق العمل</span>
             <i class="fe fe-chevron-right side-menu__angle"></i>
         </a>
         <ul class="slide-menu child1">
             <li class="slide side-menu__label1"><a href="javascript:void(0)">التوظيف وفريق العمل</a></li>
             <li class="slide"><a href="{{ route('admin.page.teams') }}" class="side-menu__item {{ request()->routeIs('admin.page.teams') ? 'active' : '' }}">فريق العمل</a></li>
             <li class="slide"><a href="{{ route('admin.page.career-applications') }}" class="side-menu__item {{ request()->routeIs('admin.page.career-applications') ? 'active' : '' }}">طلبات التوظيف</a></li>
         </ul>
     </li>

     <!-- Start::Media & Feedback Dropdown -->
     <li class="slide has-sub {{ request()->routeIs('admin.page.galleries') || request()->routeIs('admin.page.videos') || request()->routeIs('admin.page.testimonial') ? 'active open' : '' }}">
         <a href="javascript:void(0);" class="side-menu__item {{ request()->routeIs('admin.page.galleries') || request()->routeIs('admin.page.videos') || request()->routeIs('admin.page.testimonial') ? 'active' : '' }}">
             <i class="bi bi-collection side-menu__icon"></i>
             <span class="side-menu__label">المحتوى المرئي والآراء</span>
             <i class="fe fe-chevron-right side-menu__angle"></i>
         </a>
         <ul class="slide-menu child1">
             <li class="slide side-menu__label1"><a href="javascript:void(0)">المحتوى المرئي والآراء</a></li>
             <li class="slide"><a href="{{ route('admin.page.galleries') }}" class="side-menu__item {{ request()->routeIs('admin.page.galleries') ? 'active' : '' }}">المعرض</a></li>
             <li class="slide"><a href="{{ route('admin.page.videos') }}" class="side-menu__item {{ request()->routeIs('admin.page.videos') ? 'active' : '' }}">الفيديوهات</a></li>
             <li class="slide"><a href="{{ route('admin.page.testimonial') }}" class="side-menu__item {{ request()->routeIs('admin.page.testimonial') ? 'active' : '' }}">اراء العملاء</a></li>
         </ul>
     </li>

     <!-- Start::Contact Messages -->
     <li class="slide">
         <a href="{{ route('admin.page.contact-messages') }}"
             class="side-menu__item {{ request()->routeIs('admin.page.contact-messages') ? 'active' : '' }}">
             <i class="bi bi-envelope side-menu__icon"></i>
             <span class="side-menu__label">رسائل التواصل</span>
         </a>
     </li>

     <!-- Start::Setting -->
     <li class="slide">
         <a href="{{ route('admin.page.setting') }}"
             class="side-menu__item {{ request()->routeIs('admin.page.setting') ? 'active' : '' }}">
             <i class="bi bi-gear side-menu__icon"></i>
             <span class="side-menu__label">الاعدادات</span>
         </a>
     </li>

 </ul>
