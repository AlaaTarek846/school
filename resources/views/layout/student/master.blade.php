<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="language" content="{{ app()->getLocale() }}">
    <title>{{ __('translation.student_dashboard') }}</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        :root {
            --primary-color: #3f51b5;
            --secondary-color: #f50057;
            --bg-light: #f8f9fa;
            --sidebar-width: 260px;
            --card-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }

        body {
            font-family: {{ app()->getLocale() == 'ar' ? "'Cairo'" : "'Inter'" }}, sans-serif;
            background-color: var(--bg-light);
            overflow-x: hidden;
        }

        #sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            {{ app()->getLocale() == 'ar' ? 'right' : 'left' }}: 0;
            background: #fff;
            box-shadow: var(--card-shadow);
            z-index: 1000;
            transition: all 0.3s;
        }

        #content {
            margin-{{ app()->getLocale() == 'ar' ? 'right' : 'left' }}: var(--sidebar-width);
            padding: 30px;
            transition: all 0.3s;
        }

        .sidebar-header {
            padding: 30px 20px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }

        .nav-link {
            padding: 15px 25px;
            color: #555;
            font-weight: 500;
            display: flex;
            align-items: center;
            border-radius: 10px;
            margin: 5px 15px;
            transition: all 0.2s;
        }

        .nav-link i {
            margin-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}: 15px;
            font-size: 1.1rem;
        }

        .nav-link:hover, .nav-link.active {
            background-color: var(--primary-color);
            color: #fff !important;
        }

        .top-navbar {
            background: #fff;
            padding: 12px 25px;
            border-radius: 50px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid rgba(0,0,0,0.05);
        }

        .student-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }

        .avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: var(--primary-color);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 0.9rem;
        }

        .smaller {
            font-size: 0.75rem;
        }

        .card {
            border: none;
            border-radius: 20px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .stat-card {
            padding: 25px;
            display: flex;
            align-items: center;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}: 20px;
        }

        .logout-btn {
            color: var(--secondary-color);
            font-weight: 600;
            display: flex;
            align-items: center;
            padding: 15px 25px;
            margin-top: auto;
        }

        @media (max-width: 991.98px) {
            #sidebar {
                transform: translateX({{ app()->getLocale() == 'ar' ? '100%' : '-100%' }});
            }
            #content {
                margin-{{ app()->getLocale() == 'ar' ? 'right' : 'left' }}: 0;
            }
            #sidebar.active {
                transform: translateX(0);
            }
        }
    </style>
    @if(app()->getLocale() == 'ar')
        <style>
            .end-0 {
                left: 0 !important;
                right: unset !important;
            }
            .modal-header .btn-close {
                margin: 0;
            }
        </style>
    @endif
    @stack('css')
</head>
<body>

    <div id="sidebar">
        <div class="sidebar-header">
            <h4>{{ __('translation.student_portal') }}</h4>
        </div>

        <div class="mt-4 nav-flex flex-column h-100">
            <a href="{{ route('student.dashboard') }}" class="nav-link {{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
                <i class="fas fa-th-large"></i>
                <span>{{ __('translation.student_dashboard') }}</span>
            </a>

            <a href="{{ route('student.courses') }}" class="nav-link {{ request()->routeIs('student.courses') ? 'active' : '' }}">
                <i class="fas fa-book"></i>
                <span>{{ __('translation.My Courses') }}</span>
            </a>

            <a href="{{ route('student.exams') }}" class="nav-link {{ request()->routeIs('student.exams') ? 'active' : '' }}">
                <i class="fas fa-file-alt"></i>
                <span>{{ __('translation.Exams') }}</span>
            </a>

            <a href="{{ route('student.exams.results') }}" class="nav-link {{ request()->routeIs('student.exams.results') ? 'active' : '' }}">
                <i class="fas fa-poll"></i>
                <span>{{ __('translation.Exam Results') }}</span>
            </a>

            <div class="mt-auto pb-4">
                 <a href="{{ route('student.logout') }}" class="nav-link logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>{{ __('translation.Logout') }}</span>
                </a>
            </div>
        </div>
    </div>

    <div id="content">
        <div class="top-navbar">
            <div class="d-flex align-items-center">
                <button class="btn me-3 d-lg-none" id="sidebarCollapse">
                    <i class="fas fa-bars"></i>
                </button>
                <h5 class="fw-bold mb-0 d-none d-sm-block text-primary">
                    @yield('title', __('translation.student_dashboard'))
                </h5>
            </div>

            <div class="d-flex align-items-center">
                <!-- Language Switcher -->
                <div class="dropdown me-3 me-md-4">
                    <button class="btn btn-light dropdown-toggle rounded-pill px-3 py-2 border shadow-sm" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-globe text-primary me-md-2"></i>
                        <span class="d-none d-md-inline">{{ app()->getLocale() == 'ar' ? __('translation.Arabic') : __('translation.English') }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-2" style="border-radius: 15px;" aria-labelledby="languageDropdown">
                        <li>
                            <a class="dropdown-item py-2 {{ app()->getLocale() == 'en' ? 'active' : '' }}" href="{{ route('change.language', 'en') }}">
                                <img src="https://flagcdn.com/w20/gb.png" class="me-2" alt="English"> {{ __('translation.English') }}
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item py-2 {{ app()->getLocale() == 'ar' ? 'active' : '' }}" href="{{ route('change.language', 'ar') }}">
                                <img src="https://flagcdn.com/w20/eg.png" class="me-2" alt="Arabic"> {{ __('translation.Arabic') }}
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Profile -->
                <div class="student-profile bg-light p-1 pe-3 rounded-pill border shadow-sm">
                    <div class="avatar shadow-sm me-2">
                        {{ substr(Auth::guard('student')->user()->name, 0, 1) }}
                    </div>
                    <div class="text-{{ app()->getLocale() == 'ar' ? 'start' : 'start' }} d-none d-md-block">
                        <span class="d-block fw-bold small lh-1">{{ Auth::guard('student')->user()->name }}</span>
                        <span class="text-muted smaller">{{ Auth::guard('student')->user()->code }}</span>
                    </div>
                </div>
            </div>
        </div>

        @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
