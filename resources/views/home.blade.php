<html>

<head>
    <title>Check Point</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/LCP1.png') }}">
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
            flex-wrap: wrap;
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
            color: #364C84;
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
            flex-wrap: wrap;
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

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                height: auto;
                text-align: center;
            }

            .content {
                padding: 10px;
            }

            .header h2 {
                font-size: 20px;
            }

            .card {
                flex-direction: column;
                align-items: flex-start;
            }

            .card .clock {
                width: 100px;
                height: 100px;
                font-size: 16px;
            }

            .card .details h3 {
                font-size: 36px;
            }

            .card .details .info {
                flex-direction: column;
            }

            .sidebar .menu {
                flex-direction: column;
                align-items: center;
            }

            .sidebar .menu a {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
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
            <div class="header">
                <h2>Home</h2>
                <div class="profile">
                    <i class="fas fa-user-circle"></i>
                    <span style="color: #364C84">{{ $user->name }}</span>
                </div>
            </div>
            <div class="card">
                <form id="clockInForm" method="POST" action="{{ route('clock.in') }}">
                    @csrf
                    <input type="hidden" name="latitude" id="latitude">
                    <input type="hidden" name="longitude" id="longitude">
                    <button type="button" class="clock" onclick="getLocationAndClockIn()">
                        <i class="fas fa-hand-pointer"></i>
                        <p>CLOCK IN</p>
                    </button>
                </form>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const form = document.getElementById('clockInForm');

                        form.addEventListener('click', function(event) {
                            if (event.target.type === 'button') {
                                event.preventDefault(); // Mencegah submit form otomatis

                                if (navigator.geolocation) {
                                    navigator.geolocation.getCurrentPosition(function(position) {
                                        const latitude = position.coords.latitude;
                                        const longitude = position.coords.longitude;

                                        // Tambahkan field tersembunyi untuk latitude dan longitude
                                        document.getElementById('latitude').value = latitude;
                                        document.getElementById('longitude').value = longitude;

                                        // Kirim form setelah menambahkan latitude dan longitude
                                        form.submit();
                                    }, function(error) {
                                        alert('Gagal mendapatkan lokasi. Pastikan GPS aktif.');
                                        // Kirim form tanpa lokasi
                                        // Kirim form tanpa lokasi jika gagal
                                        form.submit();
                                    });
                                } else {
                                    alert('Geolocation tidak didukung oleh browser.');
                                    // Kirim form tanpa lokasi jika geolocation tidak didukung
                                    form.submit();
                                }
                            }
                        });
                    });

                    function getLocationAndClockIn() {
                        // Fungsi untuk menangani pengambilan lokasi dan mengirim formulir
                        if (navigator.geolocation) {
                            navigator.geolocation.getCurrentPosition(function(position) {
                                const latitude = position.coords.latitude;
                                const longitude = position.coords.longitude;

                                // Menyimpan koordinat ke dalam field tersembunyi
                                document.getElementById('latitude').value = latitude;
                                document.getElementById('longitude').value = longitude;

                                // Kirim form setelah menambahkan latitude dan longitude
                                document.getElementById('clockInForm').submit();
                            }, function(error) {
                                alert('Gagal mendapatkan lokasi. Pastikan GPS aktif.');
                                // Kirim form tanpa lokasi jika gagal
                                document.getElementById('clockInForm').submit();
                            });
                        } else {
                            alert('Geolocation tidak didukung oleh browser.');
                            // Kirim form tanpa lokasi jika geolocation tidak didukung
                            document.getElementById('clockInForm').submit();
                        }
                    }
                </script>

                <div class="details">
                    <h3>{{ isset($attendance) && $attendance->clock_in ? $attendance->clock_in->format('H:i') : '08:00' }}
                    </h3>
                    <p>{{ \Carbon\Carbon::now()->format('l, F Y') }}</p>
                    <div class="info">
                        <div>
                            <i class="fas fa-clock"></i>
                            <h4>{{ isset($attendance) && $attendance->clock_in ? $attendance->clock_in->format('H:i') : '08:40' }}
                            </h4>
                            <p>Clock in</p>
                        </div>
                        <div>
                            <i class="fas fa-clock"></i>
                            <h4>{{ isset($attendance) && $attendance->clock_out ? $attendance->clock_out->format('H:i') : '--:--' }}
                            </h4>
                            <p>Clock out</p>
                        </div>
                        <div>
                            <i class="fas fa-check-circle"></i>
                            <h4>{{ isset($attendance) && $attendance->clock_out && $attendance->clock_in
                                ? $attendance->clock_out->diffInHours($attendance->clock_in) . ' hrs'
                                : '0 hrs' }}
                            </h4>
                            <p>Working Hr's</p>
                        </div>
                    </div>
                    <div class="location">
                        <i class="fas fa-map-marker-alt"></i>
                        <p>{{ isset($attendance) && $attendance->location ? $attendance->location : 'Location unavailable' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Clock Out Card -->
            <div class="card">
                <form method="POST" action="{{ route('clock.out') }}">
                    @csrf
                    <button type="submit" class="clock clock-out @if (!isset($attendance) || !$attendance->clock_in || $attendance->clock_out) disabled @endif">
                        <i class="fas fa-hand-pointer"></i>
                        <p>CLOCK OUT</p>
                    </button>
                </form>
                <div class="details">
                    <h3>{{ isset($attendance) && $attendance->clock_out ? $attendance->clock_out->format('H:i') : '15:44' }}
                    </h3>
                    <p>{{ \Carbon\Carbon::now()->format('l, F Y') }}</p>
                    <div class="info">
                        <div>
                            <i class="fas fa-clock"></i>
                            <h4>{{ isset($attendance) && $attendance->clock_in ? $attendance->clock_in->format('H:i') : '08:40' }}
                            </h4>
                            <p>Clock in</p>
                        </div>
                        <div>
                            <i class="fas fa-clock"></i>
                            <h4>{{ isset($attendance) && $attendance->clock_out ? $attendance->clock_out->format('H:i') : '15:44' }}
                            </h4>
                            <p>Clock out</p>
                        </div>
                        <div>
                            <i class="fas fa-check-circle"></i>
                            <h4>{{ isset($attendance) && $attendance->clock_out && $attendance->clock_in
                                ? $attendance->clock_out->diffInHours($attendance->clock_in) . ' hrs'
                                : '0 hrs' }}
                            </h4>
                            <p>Working Hr's</p>
                        </div>
                    </div>
                    <div class="location">
                        <i class="fas fa-map-marker-alt"></i>
                        <p>{{ isset($attendance) && $attendance->location ? $attendance->location : 'Location unavailable' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
