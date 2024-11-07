<html>

<head>
    <title>Licensing</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            width: 100%;
        }

        .sidebar {
            width: 250px;
            background-color: #364C84;
            color: white;
            height: 100vh;
            padding: 20px;
            box-sizing: border-box;
            transition: width 0.3s;
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
            margin-left: 0;
            /* Menghilangkan margin kiri yang ada */
            padding: 20px;
            /* Padding tetap ada untuk memberi ruang di dalam content */
            background-color: #F8F9FA;
            flex-grow: 1;
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .content-header h2 {
            font-size: 24px;
            font-weight: 500;
        }

        .content-header .user-info {
            display: flex;
            align-items: center;
        }

        .content-header .user-info i {
            font-size: 24px;
            margin-right: 10px;
        }

        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-container h3 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .form-container p {
            font-size: 14px;
            margin-bottom: 20px;
        }

        .form-container input,
        .form-container select,
        .form-container textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: none;
            border-radius: 10px;
            background-color: #D6EAF8;
            font-size: 14px;
        }

        .form-container .date-icon {
            position: relative;
        }

        .form-container .date-icon i {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #2C3E50;
        }

        .form-container button {
            background-color: #2C3E50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            font-size: 14px;
            cursor: pointer;
        }

        /* Responsive styles */
        @media (max-width: 992px) {
            .sidebar {
                width: 200px;
            }

            .content {
                margin-left: 200px;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .content {
                margin-left: 0;
                /* Pastikan margin kiri dihapus pada tampilan kecil */
                padding: 20px 10px;
            }

            .container {
                flex-direction: column;
            }

            .content-header h2 {
                font-size: 22px;
            }
        }

        @media (max-width: 576px) {
            .content-header h2 {
                font-size: 20px;
            }

            .form-container h3 {
                font-size: 18px;
            }

            .form-container p {
                font-size: 12px;
            }

            .form-container button {
                font-size: 12px;
                padding: 8px 16px;
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
                <a href="{{ route('home') }}" class="active"><i class="fas fa-home"></i> Home</a>
                <a href="{{ route('history.attend') }}"><i class="fas fa-book"></i> History Attend</a>
                <a href="#"><i class="fas fa-chart-bar"></i> Report</a>
                <a href="{{ route('notifications.index') }}"><i class="fas fa-bell"></i> Notification</a>
                <a href="{{ route('profile') }}"><i class="fas fa-cog"></i> Setting</a>
                <a href="{{ route('licensing.form') }}"><i class="fas fa-key"></i> Licensing</a>
            </div>
        </div>
        <div class="content">
            <div class="content-header">
                <h2>Licensing</h2>
                <div class="user-info">
                    <i class="fas fa-user-circle"></i>
                    <span>{{ $user->name }}</span>
                </div>
            </div>
            <div class="form-container">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('licensing.submit') }}" method="POST">
                    @csrf
                    <h3>Form Perizinan Absensi</h3>
                    <p>Isi form ini untuk mengajukan izin ketidakhadiran pastikan semua informasi terisi !</p>
                    <input type="text" value="{{ $user->name }}" readonly>
                    <div class="date-icon">
                        <input type="date" name="start_date" required>
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="date-icon">
                        <input type="date" name="end_date" required>
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <select name="reason" required>
                        <option value="cuti">Cuti</option>
                    </select>
                    <textarea name="note" placeholder="Catatan :"></textarea>
                    <button type="submit">KIRIM</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
