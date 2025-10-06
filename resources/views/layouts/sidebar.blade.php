<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            background-color: #F5F5DC;
            font-family: 'Figtree', sans-serif;
        }

        .sidebar {
            background-color: #3b2313;
            color: white;
            width: 250px;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: fixed;
            top: 0;
            left: 0;
            padding: 20px 15px;
        }

        /* Top Section */
        .sidebar-logo {
            text-align: center;
        }

        .sidebar-logo h4 {
            font-weight: 700;
            color: #ffcc33;
            letter-spacing: 1px;
        }

        .sidebar-logo span {
            color: #fff;
            font-size: 0.9rem;
        }

        /* Middle Navigation */
        .nav-links {
            margin-top: 40px;
            flex-grow: 1;
        }

        .nav-links a {
            display: block;
            color: white;
            text-decoration: none;
            font-weight: 600;
            padding: 12px 15px;
            margin-bottom: 8px;
            border-left: 4px solid transparent;
            border-radius: 8px;
            transition: 0.3s;
        }

        .nav-links a:hover,
        .nav-links a.active {
            background-color: #ffcc33;
            color: #3b2313;
            border-left: 4px solid #3b2313;
        }

        /* Bottom Icons */
        .sidebar-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .sidebar-bottom i {
            font-size: 1.4rem;
            color: white;
            cursor: pointer;
            transition: 0.3s;
        }

        .sidebar-bottom i:hover {
            color: #ffcc33;
        }

        /* Main Content */
        .main-content {
            margin-left: 270px;
            padding: 30px;
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <!-- TOP SECTION -->
        <div class="sidebar-logo">
            <h4>AURO</h4>
            <span>Chocolate Production</span>
        </div>

        <div class="nav-links">
            <a href="{{ route('staffs.dashboard') }}" class="{{ request()->routeIs('staffs.dashboard') ? 'active' : '' }}">DASHBOARD</a>
            <a href="#">WEATHER</a>
            <a href="#">PROCESS</a>
            <a href="#">LOGS</a>
            <a href="#">INVENTORY</a>
            <a href="{{ route('staffs.index') }}" class="{{ request()->routeIs('staffs.index') ? 'active' : '' }}">ACCOUNTS</a>
        </div>

        <!-- BOTTOM SECTION -->
        <div class="sidebar-bottom">
            <!-- Logout -->
            <a href="{{ route('staffs.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi-box-arrow-left"></i>
            </a>

            <!-- Hidden logout form -->
            <form id="logout-form" action="{{ route('staffs.logout') }}" method="GET" class="d-none">
                @csrf
            </form>

            <!-- Help icon -->
            <i class="bi bi-question-circle"></i>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    @yield('scripts')
</body>
</html>
