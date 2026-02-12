<div class="navigation">
    <nav class="navigation__menu">
        <ul>
            <li class="navigation__menu--item has-child has-arrow">
                <a href="javascript:void(0);" class="navigation__menu--item__link">{{ __('Home') }}</a>
                <ul class="submenu sub__style">
                    <li><a href="{{ route('index') }}">Home Style One</a></li>
                    <li><a href="{{ route('index-two') }}">Home Style Two</a></li>
                    <li><a href="{{ route('index-three') }}">Home Style three</a></li>
                    <li><a href="{{ route('index-four') }}">Home Style four</a></li>
                    <li><a href="{{ route('index-five') }}">Home Style five</a></li>
                </ul>
            </li>

            <li class="navigation__menu--item has-child has-arrow">
                <a href="javascript:void(0);" class="navigation__menu--item__link">{{ __('Pages') }}</a>
                <ul class="submenu sub__style">
                    <li><a href="{{ route('about') }}">{{ __('About') }}</a></li>
                    <li><a href="{{ route('athletics') }}">{{ __('Athletics') }}</a></li>
                    <li class="has-child has-arrow">
                        <a href="#">{{ __('Faculty') }}</a>
                        <ul class="sub__style">
                            <li><a class="mobile-menu-link" href="{{ route('faculty-sub') }}">Faculty</a></li>
                            <li><a class="mobile-menu-link" href="{{ route('faculty-sub-details') }}">Faculty Details</a></li>
                            <li><a href="{{ route('faculty') }}">Faculty Staff</a></li>
                            <li class="has-child"><a href="{{ route('faculty-details') }}">Faculty Staff details</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('research') }}">{{ __('Research') }}</a></li>
                </ul>
            </li>
            <li class="navigation__menu--item has-child has-arrow">
                <a href="#" class="navigation__menu--item__link">{{ __('Academics') }}</a>
                <ul class="submenu sub__style">
                    <li><a href="{{ route('academic') }}">{{ __('Academic') }}</a></li>
                    <li><a href="{{ route('admission') }}">{{ __('Admission') }}</a></li>
                    <li><a href="{{ route('academic-area') }}">Academic Area</a></li>
                    <li><a href="{{ route('campus-life') }}">{{ __('Campus Life') }}</a></li>
                    <li><a href="{{ route('scholarship') }}">{{ __('Scholarship') }}</a></li>
                    <li><a href="{{ route('tution-fee') }}">{{ __('Tution Fee') }}</a></li>
                    <li><a href="{{ route('alumni') }}">{{ __('Alumni') }}</a></li>
                    <li><a href="{{ route('program-single') }}">Program Single</a></li>
                    <li><a href="{{ route('department-details') }}">Department Details</a></li>
                </ul>
            </li>
            <li class="navigation__menu--item has-child has-arrow">
                <a href="#" class="navigation__menu--item__link">{{ __('Event') }}</a>
                <ul class="submenu sub__style">
                    <li><a href="{{ route('event') }}">Event</a></li>
                    <li><a href="{{ route('event-details') }}">Event Details</a></li>
                </ul>
            </li>
            <li class="navigation__menu--item has-child has-arrow">
                <a href="#" class="navigation__menu--item__link">{{ __('Blog') }}</a>
                <ul class="submenu sub__style">
                    <li><a href="{{ route('blog') }}">Blog</a></li>
                    <li><a href="{{ route('blog-grid') }}">Blog Grid</a></li>
                    <li><a href="{{ route('blog-list') }}">Blog List</a></li>
                    <li><a href="{{ route('blog-details') }}">Blog Details</a></li>
                </ul>
            </li>
            <li class="navigation__menu--item">
                <a href="{{ route('contact') }}" class="navigation__menu--item__link">{{ __('Contact') }}</a>
            </li>
        </ul>
    </nav>
</div>