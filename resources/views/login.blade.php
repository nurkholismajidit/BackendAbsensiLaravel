<html>

<head>
    <title>Check Point</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
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
            align-items: center;
            justify-content: center;
            width: 100%;
            max-width: 1200px;
            flex-wrap: wrap;
            /* Allow wrapping on smaller screens */
        }

        .left-section,
        .right-section {
            flex: 1;
            text-align: center;
            padding: 20px;
            /* Add padding for better spacing */
        }

        .left-section img {
            width: 100%;
            max-width: 400px;
            height: auto;
            /* Ensure image maintains aspect ratio */
        }

        .left-section h2,
        .right-section h2 {
            font-size: 24px;
            color: #000;
            margin-top: 20px;
        }

        .left-section p,
        .right-section p {
            font-size: 16px;
            color: #7a7a7a;
        }

        .right-section {
            max-width: 400px;
            background-color: #FFFDF5;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .right-section .btn-primary,
        .right-section .btn-submit {
            display: block;
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            margin-bottom: 20px;
        }

        .right-section .btn-primary {
            color: #2c3e50;
            background-color: #FFFDF5;
            border: 2px solid #2c3e50;
        }

        .right-section .btn-submit {
            color: #fff;
            background-color: #364C84;
            border: none;
        }

        .right-section .form-group {
            margin-bottom: 20px;
            background-color: #FFFDF5;
        }

        .right-section .form-group label {
            display: block;
            font-size: 14px;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .right-section .form-group input {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            color: #2c3e50;
            border: 1px solid #ccc;
            border-radius: 5px;
            //tambahan
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #FFFDF5;
        }

        .right-section .form-group input[type="password"] {
            position: relative;
            //tambahan

            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .right-section .form-group .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                /* Stack sections vertically */
                text-align: center;
                /* Center text on smaller screens */
            }

            .left-section,
            .right-section {
                max-width: 100%;
                /* Allow full width */
                padding: 10px;
                /* Adjust padding */
            }

            .left-section img {
                max-width: 80%;
                /* Adjust image size */
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="left-section">
            <img alt="Illustration of a person working at a desk with a computer, cloud upload icon, and office background"
                src="{{ asset('images/cuate.png') }}" />
            <h2>Absensi Mudah Hanya Di Check Point</h2>
            <p>Gabung dan rasakan absensi online dengan mudah</p>
        </div>
        <div class="right-section">
            <h2>Masuk</h2>
            <p>Belum punya akun check point? Daftar dengan klik tombol di bawah ini!</p>
            <a href="{{ route('register') }}" class="btn-primary" href="#">Daftar Sekarang</a>
            <p>atau masuk dengan</p>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email <span style="color: red;">*</span></label>
                    <input id="email" name="email" placeholder="Masukkan Alamat Email Anda" type="email" />
                </div>
                <div class="form-group">
                    <label for="password">Password <span style="color: red;">*</span></label>
                    <input id="password" name="password" placeholder="Masukkan Password Anda" type="password" />
                    <i class="fas fa-eye toggle-password"></i>
                </div>
                <button type="submit" class="btn-submit">Masuk</button>
                {{-- <a class="btn-submit" href="#">Masuk</a> --}}
            </form>
            @if ($errors->any())
                <script>
                    alert("{{ $errors->first() }}"); // Menampilkan pesan kesalahan dalam alert
                </script>
            @endif
        </div>
    </div>
    <script>
        document.querySelector('.toggle-password').addEventListener('click', function() {
            const passwordField = document.getElementById('password');
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>

</html>
