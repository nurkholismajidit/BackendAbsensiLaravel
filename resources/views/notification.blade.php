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
            width: 250px;
            background-color: #364C84;
            color: white;
            height: 100vh;
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

        .sidebar .menu {
            margin-top: 50px;
        }

        .sidebar .menu a {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            color: white;
            text-decoration: none;
            border-radius: 25px;
            margin-bottom: 10px;
        }

        .sidebar .menu a.active {
            background-color: #95B1EE;
        }

        .sidebar .menu a i {
            margin-right: 10px;
        }

        .content {
            padding: 20px;
            box-sizing: border-box;
            flex-grow: 1;
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
                padding-left: 20px;
            }
        }

        /* Mobile and smaller tablet devices */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                height: auto;
                padding: 10px;
                box-sizing: border-box;
            }

            .content {
                padding: 15px;
            }

            .header h2 {
                font-size: 20px;
            }

            .notification {
                flex-direction: column;
                align-items: flex-start;
            }

            .notification img {
                margin-bottom: 10px;
            }

            .notification .time {
                margin-top: 10px;
                text-align: left;
            }
        }

        /* Extra small screens (phones) */
        @media (max-width: 576px) {
            .header h2 {
                font-size: 18px;
            }

            .header .user {
                font-size: 14px;
            }

            .notification .text h3 {
                font-size: 16px;
            }

            .notification .text p {
                font-size: 14px;
            }

            .notification .time {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="sidebar">
            <h1>Check Point</h1>
            <p>Akses kehadiran dengan mudah</p>
            <div class="menu">
                <a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a>
                <a href="{{ route('history.attend') }}"><i class="fas fa-book"></i> History Attend</a>
                <a href="#"><i class="fas fa-chart-bar"></i> Report</a>
                <a href="{{ route('notifications.index') }}" class="active"><i class="fas fa-bell"></i> Notification</a>
                <a href="{{ route('profile') }}"><i class="fas fa-cog"></i> Setting</a>
                <a href="{{ route('licensing.form') }}"><i class="fas fa-key"></i> Licensing</a>
            </div>
        </div>
        <div class="content">
            <div class="header">
                <h2><i class="fas fa-arrow-left"></i> Notification</h2>
                <div class="user"><i class="fas fa-user-circle"></i> {{ Auth::user()->name }}</div>
            </div>

            @php
                $displayedMessages = [];
            @endphp


            @foreach ($notifications as $notification)
                @if (!in_array($notification->message, $displayedMessages))
                    <div class="notification">
                        <img alt="User image" src="{{ asset('images/LCP1.png') }}" />
                        <div class="text">
                            <h3>Check Point</h3>
                            <p>{{ $notification->message }}</p>
                        </div>
                        <div class="time">{{ $notification->created_at->timezone('Asia/Jakarta')->format('H:i A') }}
                        </div>
                    </div>
                    @php
                        $displayedMessages[] = $notification->message; // Tambahkan pesan yang sudah ditampilkan
                    @endphp
                @endif
            @endforeach
        </div>
    </div>
</body>

</html>
