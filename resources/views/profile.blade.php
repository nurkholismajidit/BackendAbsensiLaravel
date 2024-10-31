<html>

<head>
    <title>Check Point</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8e5;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: #2c3e75;
            color: white;
            padding: 20px;
            text-align: left;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .header p {
            margin: 0;
            font-size: 14px;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: flex-start;
            padding: 20px;
        }

        .sidebar {
            width: 200px;
            background-color: #FFFDF5;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-right: 20px;
            flex-shrink: 0;
        }

        .sidebar i {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .sidebar p {
            margin: 0;
            font-size: 18px;
        }

        .content {
            background-color: #FFFDF5;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 400px;
            flex: 1;
            /* Allow the content to grow */
            min-width: 300px;
            /* Minimum width for smaller screens */
        }

        .content h2 {
            margin-top: 0;
            font-size: 20px;
        }

        .content p {
            font-size: 14px;
            color: #666;
        }

        .content label {
            display: block;
            margin-top: 10px;
            font-size: 14px;
        }

        .content input {
            width: calc(100% - 20px);
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            background-color: #FFFDF5;
        }

        .footer {
            background-color: #2c3e75;
            color: white;
            text-align: center;
            padding: 20px;
            position: relative;
            /* Changed from absolute */
            bottom: 0;
            width: 100%;
            /* tambahan */
            position: fixed;
            left: 0;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
        }

        /* tambahan */
        /* Media query untuk tampilan di perangkat besar */
        @media (min-width: 601px) {
            .footer {
                padding: 20px;
                /* Padding standar untuk perangkat besar */
                font-size: 16px;
                /* Ukuran font standar untuk perangkat besar */
            }
        }

        .footer p {
            margin: 0;
            font-size: 14px;
        }

        /* Media Queries for Responsiveness */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                /* Stack elements vertically */
                align-items: stretch;
                /* Stretch to fill the container */
            }

            .sidebar {
                margin: 0 0 20px 0;
                /* Add margin at the bottom for spacing */
            }

            .content {
                width: auto;
                /* Allow full width */
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <img style="width: 196"
            alt="Illustration of a person working at a desk with a computer, cloud upload icon, and office background"
            src="{{ asset('images/check point putih 1.png') }}" />
    </div>
    <div class="container">
        <div class="sidebar">
            <i class="fas fa-user"></i>
            <p>Profil</p>
        </div>
        <div class="content">
            <h2>Profil Saya</h2>
            <p>Kelola informasi profil Anda untuk mengontrol, melindungi dan mengamankan akun</p>
            <label for="username">Username</label>
            <input type="text" id="username" placeholder="Masukkan Username Anda">
            <label for="nama">Nama</label>
            <input type="text" id="nama">
            <label for="email">Email</label>
            <input type="email" id="email">
            <label for="status">Status</label>
            <input type="text" id="status">
        </div>
    </div>
    <div class="footer">
        <p>Aplikasi absensi online hadir sebagai solusi modern yang praktis dan efisien. Aplikasi ini memungkinkan Anda
            untuk memantau kehadiran tim dari mana saja dan kapan saja.</p>
    </div>
</body>

</html>
