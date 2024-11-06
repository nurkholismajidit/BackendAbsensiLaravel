<html>

<head>
    <title>Notification</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f8f5f0;
        }

        .container {
            display: flex;
            flex-direction: column;
        }

        .sidebar {
            width: 100%;
            background-color: #2c3e75;
            color: white;
            padding: 20px;
            box-sizing: border-box;
        }

        .sidebar h1 {
            font-size: 24px;
            margin: 0;
        }

        .sidebar p {
            font-size: 12px;
            margin: 0;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin-top: 20px;
        }

        .sidebar ul li {
            margin: 20px 0;
            font-size: 18px;
            display: flex;
            align-items: center;
        }

        .sidebar ul li i {
            margin-right: 10px;
        }

        .sidebar ul li.active {
            background-color: #8fa9e9;
            padding: 10px;
            border-radius: 10px;
        }

        .content {
            padding: 20px;
            box-sizing: border-box;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .header h2 {
            margin: 0;
            font-size: 24px;
            color: #2c3e75;
        }

        .header .user {
            display: flex;
            align-items: center;
            font-size: 18px;
            color: #2c3e75;
            margin-top: 10px;
        }

        .header .user i {
            margin-right: 10px;
        }

        .notification {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .notification img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }

        .notification .text {
            flex-grow: 1;
            margin-left: 20px;
            min-width: 200px;
        }

        .notification .text h3 {
            margin: 0;
            font-size: 18px;
            color: #2c3e75;
        }

        .notification .text p {
            margin: 5px 0 0 0;
            font-size: 16px;
            color: #2c3e75;
        }

        .notification .time {
            font-size: 16px;
            color: #2c3e75;
            min-width: 70px;
            text-align: right;
        }

        /* Responsive styling */
        @media (min-width: 768px) {
            .container {
                flex-direction: row;
            }

            .sidebar {
                width: 250px;
                height: 100vh;
            }

            .content {
                flex-grow: 1;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="sidebar">
            <h1>Check Point</h1>
            <p>Akses kehadiran dengan mudah</p>
            <ul>
                <li><i class="fas fa-home"></i>Home</li>
                <li><i class="fas fa-book"></i>Data</li>
                <li><i class="fas fa-chart-line"></i>Lecensing</li>
                <li class="active"><i class="fas fa-bell"></i>Notification</li>
                <li><i class="fas fa-cog"></i>Account</li>
            </ul>
        </div>
        <div class="content">
            <div class="header">
                <h2><i class="fas fa-arrow-left"></i> Notification</h2>
                <div class="user"><i class="fas fa-user-circle"></i> {{ Auth::user()->name }}</div>
            </div>

            @foreach ($notifications as $notification)
                <div class="notification">
                    <img alt="User image" src="{{ asset('images/LCP1.png') }}" />
                    <div class="text">
                        <h3>Check Point</h3>
                        <p>{{ $notification->message }}</p>
                    </div>
                    <div class="time">{{ $notification->created_at->format('H:i A') }}</div>
                </div>
            @endforeach
        </div>
    </div>
</body>

</html>
