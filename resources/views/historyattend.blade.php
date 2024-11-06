<html>

<head>
    <title>History Attend</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/LCP1.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            display: flex;
            flex-direction: column;
        }

        /* Sidebar style */
        .sidebar {
            width: 250px;
            background-color: #2C3E70;
            color: white;
            padding: 20px;
            box-sizing: border-box;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            overflow-y: auto;
        }

        .sidebar h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .sidebar p {
            font-size: 12px;
            margin-top: -10px;
            margin-bottom: 20px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin: 20px 0;
            display: flex;
            align-items: center;
        }

        .sidebar ul li i {
            margin-right: 10px;
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            font-size: 18px;
        }

        .sidebar ul li.active a {
            background-color: #95B1EE;
            padding: 10px 20px;
            border-radius: 10px;
        }

        /* Content style */
        .content {
            margin-left: 250px;
            padding: 20px;
            background-color: #F8F8F8;
            box-sizing: border-box;
            width: calc(100% - 250px);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header h2 {
            font-size: 24px;
            color: #364C84;
        }

        .header .user {
            display: flex;
            align-items: center;
        }

        .header .user i {
            margin-right: 10px;
        }

        .header .user span {
            font-size: 18px;
            color: #2C3E70;
        }

        .date-selector {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .date-selector i {
            font-size: 24px;
            color: #2C3E70;
            margin: 0 10px;
        }

        .date-selector span {
            font-size: 18px;
            color: #364C84;
        }

        /* Table style */
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
        }

        table th,
        table td {
            padding: 15px;
            text-align: left;
        }

        table th {
            background-color: #F8F8F8;
            color: #364C84;
        }

        table td {
            border-bottom: 1px solid #F8F8F8;
        }

        table td.date {
            background-color: #95B1EE;
            color: white;
            border-radius: 5px;
            text-align: center;
        }

        table td.clock-in {
            color: #00C853;
        }

        table td.clock-out {
            color: #2C3E70;
        }

        table td.working-hours {
            color: #FF0000;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                width: 100%;
                padding: 10px;
                margin-bottom: 20px;
            }

            .content {
                margin-left: 0;
                width: 100%;
            }

            .header h2 {
                font-size: 20px;
            }

            .header .user span {
                font-size: 16px;
            }

            .date-selector span {
                font-size: 16px;
            }

            table th,
            table td {
                padding: 10px;
            }

            .sidebar ul li a {
                font-size: 16px;
            }
        }

        @media (max-width: 480px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .date-selector {
                flex-direction: column;
                align-items: flex-start;
            }

            .sidebar h1 {
                font-size: 20px;
            }

            .sidebar ul li a {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h1>Check Point</h1>
        <p>Akses kehadiran dengan mudah</p>
        <ul>
            <li><i class="fas fa-home"></i><a href="{{ route('home') }}">Home</a></li>
            <li class="active"><i class="fas fa-book"></i><a href="#">History Attend</a></li>
            <li><i class="fas fa-chart-bar"></i><a href="#">Licensing</a></li>
            <li><i class="fas fa-bell"></i><a href="{{ route('notifications.index') }}">Notification</a></li>
            <li><i class="fas fa-cog"></i><a href="{{ route('profile') }}">Setting</a></li>
        </ul>
    </div>
    <div class="content">
        <div class="header">
            <h2>History Attend</h2>
            <div class="user">
                <i class="fas fa-user-circle"></i>
                <span style="color: #364C84">{{ $user->name }}</span>
            </div>
        </div>
        <div class="date-selector">
            <i class="fas fa-calendar-alt" style="color: #364C84;"></i>
            <input id="datepicker" type="text" placeholder="Pilih Tanggal"
                style="border: none; background: transparent; font-size: 18px; color: #364C84;">
        </div>
        <table id="attendance-table" class="display">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Clock In</th>
                    <th>Clock Out</th>
                    <th>Working Hr’s</th>
                </tr>
            </thead>
            <tbody>
                @forelse($attendances as $attendance)
                    <tr>
                        <td class="date">{{ $attendance->date }}</td>
                        <td class="clock-in">{{ $attendance->clock_in }}</td>
                        <td class="clock-out">{{ $attendance->clock_out }}</td>
                        <td class="working-hours">{{ $attendance->working_hours }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align: center;">Tidak ada catatan kehadiran ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- DataTables jQuery Plugin -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTables
            const table = $('#attendance-table').DataTable({
                "language": {
                    "emptyTable": "Tidak ada catatan kehadiran ditemukan.",
                    "lengthMenu": "Tampilkan _MENU_ catatan per halaman",
                    "zeroRecords": "Tidak ditemukan catatan yang sesuai",
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                    "infoEmpty": "Tidak ada catatan tersedia",
                    "infoFiltered": "(difilter dari _MAX_ total catatan)"
                }
            });

            // Initialize Flatpickr Datepicker
            flatpickr("#datepicker", {
                dateFormat: "Y-m-d",
                onChange: function(selectedDates, dateStr, instance) {
                    if (dateStr) {
                        filterTableByDate(dateStr);
                    } else {
                        table.search('').draw(); // Reset table if no date selected
                    }
                }
            });

            // Filter DataTables based on selected date
            function filterTableByDate(date) {
                table.columns(0).search(date).draw();
            }
        });
    </script>
</body>

</html>
