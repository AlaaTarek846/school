<div class="navigation">
    <nav class="navigation__menu">
        <ul>
            <li class="navigation__menu--item">
                <a href="{{ route('index') }}" class="navigation__menu--item__link">{{ __('Home') }}</a>
            </li>
            <li class="navigation__menu--item has-child has-arrow">
                <a href="javascript:void(0);" class="navigation__menu--item__link">{{ __('About Us') }}</a>
                <ul class="submenu sub__style">
                    <li><a href="{{ route('about') }}">{{ __('About Us') }}</a></li>
                    <li><a href="{{ route('principal-message') }}">{{ __("Principal's Message") }}</a></li>
                    <li><a href="{{ route('school-discipline-policy') }}">{{ __('School Discipline Policy') }}</a></li>
                    <li><a href="{{ route('parents-meeting') }}">{{ __("KG Parents' Meeting") }}</a></li>
                </ul>
            </li>
            <li class="navigation__menu--item has-child has-arrow">
                <a href="#" class="navigation__menu--item__link">{{ __('About School') }}</a>
                <ul class="submenu sub__style">
                    <li><a href="{{ route('quality-assurance-files') }}">{{ __('Quality Assurance Files') }}</a></li>
                    <li><a href="{{ route('social-specialist') }}">{{ __('Social Specialist') }}</a></li>
                    <li><a href="{{ route('mission-and-vision') }}">{{ __('Mission and Vision') }}</a></li>
                    <li><a href="{{ route('journey-of-success-and-excellence') }}">{{ __('Journey of Success and Excellence') }}</a></li>
                    <li><a href="{{ route('careers') }}">{{ __('Careers') }}</a></li>
                    <li><a href="{{ route('student-registration') }}">{{ __('Student Registration') }}</a></li>
                </ul>
            </li>
            <li class="navigation__menu--item">
                <a href="{{ route('school-facilities') }}" class="navigation__menu--item__link">{{ __('School Facilities') }}</a>
            </li>
            <li class="navigation__menu--item">
                <a href="{{ route('tuition-fees') }}" class="navigation__menu--item__link">{{ __('Tuition Fees') }}</a>
            </li>

            <li class="navigation__menu--item has-child has-arrow">
                <a href="#" class="navigation__menu--item__link">{{ __('Gallery') }}</a>
                <ul class="submenu sub__style">
                    <li><a href="{{ route('gallery') }}">{{ __('Gallery') }}</a></li>
                    <li><a href="{{ route('videos') }}">{{ __('Videos') }}</a></li>
                </ul>
            </li>

            <li class="navigation__menu--item">
                <a href="{{ route('contact') }}" class="navigation__menu--item__link">{{ __('Contact') }}</a>
            </li>
            <li class="navigation__menu--item">
                <a href="{{ route('contact') }}" class="navigation__menu--item__link">{{ __('Think and Learn') }}</a>
            </li>
        </ul>
    </nav>
</div>
