<div class="navigation">
    <nav class="navigation__menu">
        <ul>
            <li class="navigation__menu--item has-child has-arrow">
                <a href="javascript:void(0);" class="navigation__menu--item__link">Home</a>
                <ul class="submenu sub__style">
                    <li><a href="{{ route('index') }}">Home Style One</a></li>
                    <li><a href="{{ route('index-two') }}">Home Style Two</a></li>
                    <li><a href="{{ route('index-three') }}">Home Style three</a></li>
                    <li><a href="{{ route('index-four') }}">Home Style four</a></li>
                    <li><a href="{{ route('index-five') }}">Home Style five</a></li>
                </ul>
            </li>

            <li class="navigation__menu--item has-child has-arrow">
                <a href="javascript:void(0);" class="navigation__menu--item__link">Pages</a>
                <ul class="submenu sub__style">
                    <li><a href="{{ route('about') }}">About</a></li>
                    <li><a href="{{ route('athletics') }}">Athletics</a></li>
                    <li class="has-child has-arrow">
                        <a href="#">Faculty</a>
                        <ul class="sub__style">
                            <li><a class="mobile-menu-link" href="{{ route('faculty-sub') }}">Faculty</a></li>
                            <li><a class="mobile-menu-link" href="{{ route('faculty-sub-details') }}">Faculty Details</a></li>
                            <li><a href="{{ route('faculty') }}">Faculty Staff</a></li>
                            <li class="has-child"><a href="{{ route('faculty-details') }}">Faculty Staff details</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('research') }}">Research</a></li>
                </ul>
            </li>
            <li class="navigation__menu--item has-child has-arrow">
                <a href="#" class="navigation__menu--item__link">Academics</a>
                <ul class="submenu sub__style">
                    <li><a href="{{ route('academic') }}">Academic</a></li>
                    <li><a href="{{ route('admission') }}">Admission</a></li>
                    <li><a href="{{ route('academic-area') }}">Academic Area</a></li>
                    <li><a href="{{ route('campus-life') }}">Campus Life</a></li>
                    <li><a href="{{ route('scholarship') }}">Scholarship</a></li>
                    <li><a href="{{ route('tution-fee') }}">Tution Fee</a></li>
                    <li><a href="{{ route('alumni') }}">Alumni</a></li>
                    <li><a href="{{ route('program-single') }}">Program Single</a></li>
                    <li><a href="{{ route('department-details') }}">Department Details</a></li>
                </ul>
            </li>
            <li class="navigation__menu--item has-child has-arrow">
                <a href="#" class="navigation__menu--item__link">Event</a>
                <ul class="submenu sub__style">
                    <li><a href="{{ route('event') }}">Event</a></li>
                    <li><a href="{{ route('event-details') }}">Event Details</a></li>
                </ul>
            </li>
            <li class="navigation__menu--item has-child has-arrow">
                <a href="#" class="navigation__menu--item__link">Blog</a>
                <ul class="submenu sub__style">
                    <li><a href="{{ route('blog') }}">Blog</a></li>
                    <li><a href="{{ route('blog-grid') }}">Blog Grid</a></li>
                    <li><a href="{{ route('blog-list') }}">Blog List</a></li>
                    <li><a href="{{ route('blog-details') }}">Blog Details</a></li>
                </ul>
            </li>
            <li class="navigation__menu--item">
                <a href="{{ route('contact') }}" class="navigation__menu--item__link">Contact</a>
            </li>
        </ul>
    </nav>
</div>