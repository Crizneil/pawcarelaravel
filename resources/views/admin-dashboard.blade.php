<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="wpOceans">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/newicon.png') }}">
    <title>PawCare | Admin Dashboard</title>
    <link href="{{ asset('assets/css/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/flaticon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/owl.theme.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/slick-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/swiper.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/owl.transitions.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/jquery.fancybox.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/odometer-theme-default.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/sass/style.css') }}" rel="stylesheet">
</head>

<body class="pawcare-admin">
    @if(\Illuminate\Support\Facades\Auth::check())
    <!-- start page-wrapper -->
    <div class="page-wrapper">
        <section class="admin-dashboard-section section-padding">
            <div class="container">
                <div class="admin-brand-top">
                    <a href="{{ route('home') }}" class="admin-brand-link">
                        <img src="{{ asset('assets/images/newlogo.png') }}" alt="PawCare">
                    </a>
                </div>
            </div>

            <div class="container admin-layout">

                <aside class="admin-sidebar">
                    <div class="admin-side-user">
                        <div class="avatar">{{ strtoupper(substr(\Illuminate\Support\Facades\Auth::user()->name ?? 'AD', 0, 2)) }}</div>
                        <div class="meta">
                            <p class="label">Admin</p>
                            <p class="email" id="adminEmailSide">{{ \Illuminate\Support\Facades\Auth::user()->email ?? 'admin@gmail.com' }}</p>
                        </div>
                    </div>
                    <nav class="admin-nav">
                        <a class="active" href="{{ route('admin.dashboard') }}"><i class="ti-layout-grid2"></i> Dashboard</a>
                        <a href="{{ route('admin.employees') }}"><i class="ti-user"></i> Employees</a>
                        <a href="{{ route('admin.pet-records') }}"><i class="ti-archive"></i> Pet Records</a>
                        <a href="{{ route('admin.pet-owners') }}"><i class="ti-id-badge"></i> Pet Owners</a>
                        <a href="{{ route('admin.appointments') }}"><i class="ti-calendar"></i> Appointments</a>
                        <a href="{{ route('admin.vaccinations') }}"><i class="ti-shield"></i> Vaccinations</a>
                        <a href="{{ route('admin.reports') }}"><i class="ti-bar-chart"></i> Reports</a>
                        <a href="{{ route('admin.settings') }}"><i class="ti-settings"></i> Settings</a>
                    </nav>
                    <div class="admin-side-footer">
                        <form id="logoutForm" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <button class="theme-btn-s2 w-100" id="logoutBtnSide" type="button">Logout</button>
                    </div>
                </aside>

                <main class="admin-main">
                        <div class="admin-topbar">
                        <div class="search">
                            <i class="ti-search"></i>
                            <input type="text" placeholder="Search pets, owners, records..." />
                        </div>
                        <div class="admin-chip" id="adminChip">Admin: {{ \Illuminate\Support\Facades\Auth::user()->email ?? 'admin@gmail.com' }}</div>
                    </div>

                    <div class="admin-welcome">
                        <div>
                            <h3>Dashboard</h3>
                            <p>Track vaccinations, appointments, and pet health monitoring at a glance.</p>
                        </div>
                    </div>

                    <div class="row g-3 admin-cards">
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="admin-stat-card">
                                <div class="icon"><i class="ti-shield"></i></div>
                                <div class="text">
                                    <h4>Vaccinations Due</h4>
                                    <p class="value">12</p>
                                    <p class="hint">Next 7 days</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="admin-stat-card">
                                <div class="icon"><i class="ti-pulse"></i></div>
                                <div class="text">
                                    <h4>Health Checks</h4>
                                    <p class="value">18</p>
                                    <p class="hint">This week</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="admin-stat-card">
                                <div class="icon"><i class="ti-calendar"></i></div>
                                <div class="text">
                                    <h4>Appointments</h4>
                                    <p class="value">24</p>
                                    <p class="hint">Scheduled</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="admin-stat-card">
                                <div class="icon"><i class="ti-lock"></i></div>
                                <div class="text">
                                    <h4>Secure Access</h4>
                                    <p class="value">100%</p>
                                    <p class="hint">Records protected</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 admin-panels">
                        <div class="col-lg-8 col-12">
                            <div class="admin-panel">
                                <div class="admin-panel-head">
                                    <h3>Recent Activity</h3>
                                    <a class="theme-btn-s2" href="{{ route('service.single') }}">View Service</a>
                                </div>
                                <div class="admin-activity">
                                    <div class="activity-item">
                                        <div class="dot ok"></div>
                                        <div class="text">
                                            <p class="title">Buddy – vaccination record updated</p>
                                            <span>Today, 10:20 AM</span>
                                        </div>
                                        <span class="admin-pill ok">Completed</span>
                                    </div>
                                    <div class="activity-item">
                                        <div class="dot warn"></div>
                                        <div class="text">
                                            <p class="title">Luna – upcoming booster reminder</p>
                                            <span>Today, 9:05 AM</span>
                                        </div>
                                        <span class="admin-pill warn">Reminder</span>
                                    </div>
                                    <div class="activity-item">
                                        <div class="dot info"></div>
                                        <div class="text">
                                            <p class="title">Max – scan access used in clinic</p>
                                            <span>Yesterday</span>
                                        </div>
                                        <span class="admin-pill ok">Reviewed</span>
                                    </div>
                                    <div class="activity-item">
                                        <div class="dot danger"></div>
                                        <div class="text">
                                            <p class="title">Milo – vaccination due in 2 days</p>
                                            <span>Yesterday</span>
                                        </div>
                                        <span class="admin-pill danger">Pending</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-12">
                            <div class="admin-panel">
                                <div class="admin-panel-head">
                                    <h3>Quick Actions</h3>
                                </div>
                                <div class="admin-actions">
                                    <a class="theme-btn-s2 w-100" href="{{ route('admin.appointments.create') }}">Add Appointment</a>
                                    <a class="theme-btn-s2 w-100" href="{{ route('admin.vaccinations.create') }}">Record Vaccination</a>
                                    <a class="theme-btn-s2 w-100" href="{{ route('contact') }}">Contact Support</a>
                                </div>
                                <div class="admin-note">
                                    <p><strong>Tip:</strong> Use quick scan to reduce wait time and improve accuracy during consultations.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-12">
                            <div class="admin-panel">
                                <div class="admin-panel-head">
                                    <h3>Upcoming Appointments</h3>
                                </div>
                                <div class="admin-table-wrap">
                                    <table class="table admin-table">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Pet / Owner</th>
                                                <th>Type</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Jan 21</td>
                                                <td>Bella / Garcia</td>
                                                <td>Vaccination</td>
                                                <td><span class="admin-pill warn">Upcoming</span></td>
                                            </tr>
                                            <tr>
                                                <td>Jan 22</td>
                                                <td>Charlie / Ramos</td>
                                                <td>Check-up</td>
                                                <td><span class="admin-pill ok">Confirmed</span></td>
                                            </tr>
                                            <tr>
                                                <td>Jan 22</td>
                                                <td>Rocky / Santos</td>
                                                <td>Monitoring</td>
                                                <td><span class="admin-pill warn">Upcoming</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-12">
                            <div class="admin-panel">
                                <div class="admin-panel-head">
                                    <h3>Pet Owner Messages</h3>
                                </div>
                                <div class="admin-messages">
                                    <div class="message">
                                        <div class="bubble">
                                            "Can we reschedule Luna's booster to Friday?"
                                        </div>
                                        <span class="meta">Ana D. • 2h ago</span>
                                    </div>
                                    <div class="message">
                                        <div class="bubble">
                                            "I scanned Max's tag—records loaded instantly, thanks!"
                                        </div>
                                        <span class="meta">Leo M. • 5h ago</span>
                                    </div>
                                    <div class="message">
                                        <div class="bubble">
                                            "Need advice on Milo's nutrition for recovery."
                                        </div>
                                        <span class="meta">Kaye R. • 1d ago</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </section>

        <!-- start of wpo-site-footer-section -->
        <footer class="wpo-site-footer">
            <div class="wpo-lower-footer">
                <div class="container-fluid">
                    <div class="row g-0">
                        <div class="col col-lg-6 col-12"></div>
                        <div class="col col-lg-6 col-12">
                            <ul class="right">
                                <li><a href="{{ route('privacy') }}"><span class="rolling-text">Privace &amp; Policy</span></a></li>
                                <li><a href="{{ route('terms') }}"><span class="rolling-text">Terms</span></a></li>
                                <li><a href="{{ route('about') }}"><span class="rolling-text">About us</span></a></li>
                                <li><a href="{{ route('faq') }}"><span class="rolling-text">FAQ</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end of wpo-site-footer-section -->
    </div>
    @else
    <div class="page-wrapper">
        <div class="container text-center" style="padding: 100px 20px;">
            <h2>Access Denied</h2>
            <p>You must be logged in to access the admin dashboard.</p>
            <a href="{{ route('admin.login') }}" class="theme-btn-s2">Go to Login</a>
        </div>
    </div>
    @endif

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        // Set up CSRF token for AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Logout functionality
        document.addEventListener('DOMContentLoaded', function() {
            const logoutBtnSide = document.getElementById("logoutBtnSide");
            if (logoutBtnSide) {
                logoutBtnSide.addEventListener("click", function() {
                    document.getElementById('logoutForm').submit();
                });
            }
        });
    </script>
</body>

</html>
