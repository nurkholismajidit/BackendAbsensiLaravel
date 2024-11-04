<html>

<head>
    <title>Check Point</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Nunito', sans-serif;
            background-color: #F8F8F8;
        }

        .container {
            display: flex;
        }

        .sidebar {
            width: 250px;
            background-color: #2C3E50;
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
            background-color: #5A6DAF;
        }

        .sidebar .menu a i {
            margin-right: 10px;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #E0E0E0;
        }

        .header h2 {
            margin: 0;
            font-size: 24px;
            color: #2C3E50;
        }

        .header .profile {
            display: flex;
            align-items: center;
        }

        .header .profile i {
            font-size: 24px;
            margin-right: 10px;
        }

        .card {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .card .clock {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 150px;
            height: 150px;
            border-radius: 10px;
            background: linear-gradient(135deg, #5A6DAF, #A8C0FF);
            color: white;
            font-size: 18px;
            text-align: center;
        }

        .card .clock-out {
            background: linear-gradient(135deg, #A8C0FF, #F8FFAE);
        }

        .card .details {
            flex-grow: 1;
            margin-left: 20px;
        }

        .card .details h3 {
            margin: 0;
            font-size: 48px;
            color: #2C3E50;
        }

        .card .details p {
            margin: 0;
            font-size: 18px;
            color: #2C3E50;
        }

        .card .details .info {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            padding: 10px;
            border-radius: 10px;
            background-color: #E0E0E0;
        }

        .card .details .info div {
            text-align: center;
        }

        .card .details .info div p {
            margin: 0;
            font-size: 14px;
            color: #2C3E50;
        }

        .card .details .info div h4 {
            margin: 0;
            font-size: 18px;
            color: #2C3E50;
        }

        .location {
            display: flex;
            align-items: center;
            margin-top: 10px;
            font-size: 14px;
            color: #2C3E50;
        }

        .location i {
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="sidebar">
            <h1>Check Point</h1>
            <p>Akses kehadiran dengan mudah</p>
            <div class="menu">
                <a href="#" class="active"><i class="fas fa-home"></i> Home</a>
                <a href="#"><i class="fas fa-book"></i> Data</a>
                <a href="#"><i class="fas fa-chart-bar"></i> Report</a>
                <a href="#"><i class="fas fa-bell"></i> Notification</a>
                <a href="#"><i class="fas fa-cog"></i> Setting</a>
            </div>
        </div>
        <div class="content">
            <div class="header">
                <h2>Home</h2>
                <div class="profile">
                    <i class="fas fa-user-circle"></i>
                    <span>Bintang_</span>
                </div>
            </div>
            <div class="card">
                <div class="clock">
                    <i class="fas fa-hand-pointer"></i>
                    <p>CLOCK IN</p>
                </div>
                <div class="details">
                    <h3>08 : 45</h3>
                    <p>Senin, januari 2024</p>
                    <div class="info">
                        <div>
                            <i class="fas fa-clock"></i>
                            <h4>08 : 40</h4>
                            <p>Clock in</p>
                        </div>
                        <div>
                            <i class="fas fa-clock"></i>
                            <h4>15 : 44</h4>
                            <p>Clock out</p>
                        </div>
                        <div>
                            <i class="fas fa-check-circle"></i>
                            <h4>15 : 44</h4>
                            <p>working hr's</p>
                        </div>
                    </div>
                    <div class="location">
                        <i class="fas fa-map-marker-alt"></i>
                        <p>lokasi: Anda tidak dalam jangkauan kantor</p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="clock clock-out">
                    <i class="fas fa-hand-pointer"></i>
                    <p>CLOCK OUT</p>
                </div>
                <div class="details">
                    <h3>15 : 44</h3>
                    <p>Senin, januari 2024</p>
                    <div class="info">
                        <div>
                            <i class="fas fa-clock"></i>
                            <h4>08 : 40</h4>
                            <p>Clock in</p>
                        </div>
                        <div>
                            <i class="fas fa-clock"></i>
                            <h4>15 : 44</h4>
                            <p>Clock out</p>
                        </div>
                        <div>
                            <i class="fas fa-check-circle"></i>
                            <h4>15 : 44</h4>
                            <p>working hr's</p>
                        </div>
                    </div>
                    <div class="location">
                        <i class="fas fa-map-marker-alt"></i>
                        <p>lokasi: Anda tidak dalam jangkauan kantor</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
