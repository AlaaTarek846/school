<div class="navigation">
    <nav class="navigation__menu">
        <ul>
            <li class="navigation__menu--item">
                <a href="{{ route('index') }}" class="navigation__menu--item__link">{{ __('Home') }}</a>
            </li>
            <li class="navigation__menu--item has-child has-arrow">
                <a href="javascript:void(0);" class="navigation__menu--item__link">من نحن</a>
                <ul class="submenu sub__style">
                    <li><a href="{{ route('about') }}">من نحن</a></li>
                    <li><a href="{{ route('principal-message') }}">كلمة المدير</a></li>
                    <li><a href="{{ route('school-discipline-policy') }}">لائحة الانضباط المدرسي</a></li>
                    <li><a href="{{ route('parents-meeting') }}">مقابلة اولياء الامور كى جى</a></li>
                </ul>
            </li>
            <li class="navigation__menu--item has-child has-arrow">
                <a href="#" class="navigation__menu--item__link">عن المدرسة</a>
                <ul class="submenu sub__style">
                    <li><a href="{{ route('quality-assurance-files') }}">ملفات ضمان الجودة</a></li>
                    <li><a href="{{ route('social-specialist') }}">الأخصائي الاجتماعي</a></li>
                    <li><a href="{{ route('mission-and-vision') }}">الرسالة والرؤية</a></li>
                    <li><a href="{{ route('journey-of-success-and-excellence') }}">مسيرة النجاح والتفوق</a></li>
                    <li><a href="{{ route('careers') }}">الوظائف</a></li>
                    <li><a href="{{ route('student-registration') }}">تسجيل الطلاب</a></li>
                </ul>
            </li>
            <li class="navigation__menu--item">
                <a href="{{ route('school-facilities') }}" class="navigation__menu--item__link">إمكانيات المدرسة</a>
            </li>
            <li class="navigation__menu--item">
                <a href="{{ route('tuition-fees') }}" class="navigation__menu--item__link">المصروفات</a>
            </li>

            <li class="navigation__menu--item has-child has-arrow">
                <a href="#" class="navigation__menu--item__link">الصور</a>
                <ul class="submenu sub__style">
                    <li><a href="{{ route('gallery') }}">الصور</a></li>
                    <li><a href="{{ route('videos') }}">فيديو</a></li>
                </ul>
            </li>

            <li class="navigation__menu--item">
                <a href="{{ route('contact') }}" class="navigation__menu--item__link">{{ __('Contact') }}</a>
            </li>
            <li class="navigation__menu--item">
                <a href="{{ route('student-info') }}" class="navigation__menu--item__link">فكر و تعلم</a>
            </li>
        </ul>
    </nav>
</div>
