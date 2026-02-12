<div class="navigation">
    <nav class="navigation__menu">
        <ul>
            <li class="navigation__menu--item">
                <a href="{{ route('index-sc') }}" class="navigation__menu--item__link">Home</a>
            </li>

            <li class="navigation__menu--item has-child has-arrow">
                <a href="javascript:void(0);" class="navigation__menu--item__link">Program</a>
                <ul class="submenu sub__style">
                    <li><a href="{{ route('primary-school') }}">Primary School</a></li>
                    <li><a href="{{ route('middle-school') }}">Secondary School</a></li>
                    <li><a href="{{ route('six-form') }}">Sixth Form</a></li>
                    <li><a href="{{ route('senior-school') }}">Senior School</a></li>
                </ul>
            </li>
            <li class="navigation__menu--item">
                <a href="{{ route('campuslife-sc') }}" class="navigation__menu--item__link">School Life</a>
            </li>
            <li class="navigation__menu--item has-child has-arrow">
                <a href="#" class="navigation__menu--item__link">Academics</a>
                <ul class="submenu sub__style">
                    <li><a href="{{ route('tutionfee-sc') }}">Tution Fee</a></li>
                    <li><a href="{{ route('admission-sc') }}">Apply Admission</a></li>
                </ul>
            </li>
            <li class="navigation__menu--item">
                <a href="{{ route('single-resource') }}" class="navigation__menu--item__link">Resource</a>
            </li>
            <li class="navigation__menu--item">
                <a href="{{ route('about-sc') }}" class="navigation__menu--item__link">About</a>
            </li>
        </ul>
    </nav>
</div>