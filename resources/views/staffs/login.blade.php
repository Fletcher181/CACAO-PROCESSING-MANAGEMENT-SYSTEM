<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Login</title>
    <style>
        /* Center body content */
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #7B3F00; /* chocolate */
            font-family: Arial, sans-serif;
        }

        /* Login card */
        .login-card {
            background-color: #fff8dc; /* cream */
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
            width: 100%;
            max-width: 400px;
            text-align: center; /* centers inner text elements */
            display: flex;
            flex-direction: column;
            align-items: center; /* center inputs horizontally */
        }

        .login-card h2 {
            margin-bottom: 20px;
            color: #7B3F00;
        }

        .login-card form {
            width: 100%; /* ensures inputs take full width */
            display: flex;
            flex-direction: column;
            align-items: center; /* centers child elements */
        }

        .login-card input {
            width: 90%; /* a bit smaller than 100% for padding */
            padding: 12px;
            margin: 8px 0;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 1rem;
        }

        .login-card button {
            width: 90%;
            padding: 12px;
            margin-top: 15px;
            background-color: #7B3F00;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .login-card button:hover {
            background-color: #5a2e00;
        }

        .login-card .message {
            margin: 10px 0;
            font-weight: bold;
        }

        .login-card .error {
            color: red;
        }

        .login-card .success {
            color: green;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <h2>Account Login</h2>

        @if(session('error'))
            <p class="message error">{{ session('error') }}</p>
        @endif

        @if(session('success'))
            <p class="message success">{{ session('success') }}</p>
        @endif

        <form action="{{ route('staffs.login.submit') }}" method="POST">
            @csrf
            <input type="email" name="staff_email" placeholder="Email" required>
            <input type="password" name="staff_password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>

</body>
</html>
