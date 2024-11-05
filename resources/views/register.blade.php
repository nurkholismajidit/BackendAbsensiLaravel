<html>

<head>
    <title>Check Point</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/LCP1.png') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #FFFDF5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 80%;
            flex-wrap: wrap;
            /* Allow wrapping on smaller screens */
        }

        .left-section {
            text-align: center;
            flex: 1 1 300px;
            /* Allow flexible width */
            padding: 20px;
            /* Add padding for better spacing */
        }

        .left-section img {
            width: 100%;
            max-width: 400px;
            height: auto;
            /* Maintain aspect ratio */
        }

        .left-section h2 {
            font-size: 24px;
            margin-top: 20px;
            color: #000;
        }

        .left-section p {
            font-size: 14px;
            color: #7a7a7a;
        }

        .right-section {
            background-color: #FFFDF5;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            height: 550px;
            flex: 1 1 300px;
            /* Allow flexible width */
            margin: 10px;
            /* Add margin for spacing */
        }

        .right-section h2 {
            font-size: 24px;
            color: #364C84;
            margin-bottom: 10px;
            text-align: center;
        }

        .right-section p {
            font-size: 14px;
            color: #7a7a7a;
            margin-bottom: 20px;
            text-align: center;
        }

        .right-section p a {
            color: #364C84;
            text-decoration: none;
        }

        .right-section p a:hover {
            text-decoration: underline;
        }

        .right-section form {
            display: flex;
            flex-direction: column;
        }

        .right-section form label {
            font-size: 14px;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .right-section form input {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            background-color: #FFFDF5
        }

        .right-section form button {
            padding: 10px;
            background-color: #364C84;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
        }

        .right-section form button:hover {
            background-color: #1a252f;
        }

        .right-section .social-login {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        .right-section .social-login a {
            margin: 0 10px;
            font-size: 24px;
            color: #7a7a7a;
            text-decoration: none;
        }

        .right-section .social-login a:hover {
            color: #2c3e50;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                /* Stack sections vertically */
                align-items: center;
                /* Center align */
            }

            .right-section {
                width: 90%;
                /* Full width on smaller screens */
                margin: 10px 0;
                /* Vertical margin */
            }

            .left-section {
                width: 90%;
                /* Full width on smaller screens */
            }

            .left-section img {
                max-width: 80%;
                /* Adjust image size */
            }
        }

        header {
            width: 100%;
            /* Memastikan header menutupi lebar halaman */
            display: flex;
            justify-content: center;
            /* Mencentralkan logo secara horizontal */
            padding-top: 5px;
            /* Beri jarak dari atas halaman */
            position: absolute;
            top: 0;
            /* Posisikan di atas halaman */
        }

        .center-logo {
            width: 192px;
            height: 45;
            /* Sesuaikan ukuran logo */
            height: auto;
        }

        /* Responsif untuk tablet */
        @media (max-width: 768px) {
            .center-logo {
                max-width: 120px;
                /* Ukuran lebih kecil untuk layar tablet */
            }
        }

        /* Responsif untuk ponsel */
        @media (max-width: 480px) {
            .center-logo {
                max-width: 100px;
                /* Ukuran lebih kecil untuk layar ponsel */
            }
        }
    </style>
</head>

<header>
    <img class="center-logo" src="{{ asset('images/CPLogo.png') }}" />
</header>

<body>
    <div class="container">
        <div class="left-section">
            <img alt="Illustration of a person interacting with a mobile app interface"
                src="{{ asset('images/pana.png') }}" />
            <h2>Absensi Mudah Hanya Di Check Point</h2>
            <p>Gabung dan rasakan absensi online dengan mudah</p>
        </div>
        <div class="right-section">
            <h2>Daftar Sekarang</h2>
            <p>Belum punya akun check point? <a href="{{ route('login') }}">Masuk</a></p>
            <p>atau masuk dengan</p>
            <form method="POST" action="{{ route('register.post') }}">
                @csrf
                {{-- <div> --}}
                <label for="name">Name</label>
                <input id="name" name="name" required>
                {{-- </div> --}}
                {{-- <div> --}}
                <label for="email">Email*</label>
                <input id="email" name="email" placeholder="Masukkan Alamat Email Anda" required type="email" />
                {{-- </div>
                <div> --}}
                <label for="password">Password*</label>
                <input id="password" name="password" placeholder="Password" required type="password" />
                {{-- </div>
                <div> --}}
                <label for="password_confirmation">Konfirmasi Password*</label>
                <input id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Password"
                    required type="password" />
                {{-- </div> --}}
                <button type="submit">Daftar Sekarang</button>
            </form>
            <p>atau masuk dengan sosial media</p>
            <div class="social-login">
                <a href="#"><i class="fab fa-google"></i></a>
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
</body>

</html>
