<div class="navigation">
    <nav class="navigation__menu">
        <ul>
            <li class="navigation__menu--item">
                <a href="{{ route('index-sc') }}" class="navigation__menu--item__link">{{ __('Home') }}</a>
            </li>

            <li class="navigation__menu--item has-child has-arrow">
                <a href="javascript:void(0);" class="navigation__menu--item__link">{{ __('Program') }}</a>
                <ul class="submenu sub__style">
                    <li><a href="{{ route('primary-school') }}">{{ __('Primary School') }}</a></li>
                    <li><a href="{{ route('middle-school') }}">{{ __('Secondary School') }}</a></li>
                    <li><a href="{{ route('six-form') }}">{{ __('Sixth Form') }}</a></li>
                    <li><a href="{{ route('senior-school') }}">{{ __('Senior School') }}</a></li>
                </ul>
            </li>
            <li class="navigation__menu--item">
                <a href="{{ route('campuslife-sc') }}" class="navigation__menu--item__link">{{ __('School Life') }}</a>
            </li>
            <li class="navigation__menu--item has-child has-arrow">
                <a href="#" class="navigation__menu--item__link">{{ __('Academics') }}</a>
                <ul class="submenu sub__style">
                    <li><a href="{{ route('tutionfee-sc') }}">{{ __('Tution Fee') }}</a></li>
                    <li><a href="{{ route('admission-sc') }}">{{ __('Apply Admission') }}</a></li>
                </ul>
            </li>
            <li class="navigation__menu--item">
                <a href="{{ route('single-resource') }}" class="navigation__menu--item__link">{{ __('Resource') }}</a>
            </li>
            <li class="navigation__menu--item">
                <a href="{{ route('about-sc') }}" class="navigation__menu--item__link">{{ __('About') }}</a>
            </li>
        </ul>
    </nav>
</div>