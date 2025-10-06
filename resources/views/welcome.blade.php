<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <style>
        body {
            margin: 0;
            height: 100vh;
            background-color: #7B3F00; /* chocolate color */
            font-family: Arial, sans-serif;
            color: #fff;
        }

        /* Top navigation */
        .top-nav {
            display: flex;
            justify-content: flex-end;
            padding: 20px 40px;
            gap: 20px;
        }

        .top-nav a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            font-size: 1rem;
            padding: 8px 15px;
            border-radius: 5px;
            transition: 0.3s;
        }

        .top-nav a:hover {
            background-color: #fff8dc;
            color: #7B3F00;
        }

        /* Centered content */
        .center-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 80px); /* leave space for nav */
        }

        .center-content h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        .center-content a.login-button {
            padding: 15px 40px;
            background-color: #fff8dc;
            color: #7B3F00;
            text-decoration: none;
            font-size: 1.2rem;
            font-weight: bold;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .center-content a.login-button:hover {
            background-color: #f5e0b7;
            color: #5a2e00;
        }

    </style>
</head>
<body>

    <!-- Top Navigation -->
    <div class="top-nav">
        <a href="#">About Us</a>
        <a href="#">Contact</a>
        <a href="{{ route('staffs.login') }}">Login</a>
    </div>

    <!-- Centered content -->
    <div class="center-content">
        <h1>AURO Chocolate</h1>
    </div>

</body>
</html>
