<html>

<head>
    <title>Check Point</title>
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
            width: 350px;
            flex: 1 1 300px;
            /* Allow flexible width */
            margin: 10px;
            /* Add margin for spacing */
        }

        .right-section h2 {
            font-size: 20px;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .right-section p {
            font-size: 12px;
            color: #7a7a7a;
            margin-bottom: 20px;
        }

        .right-section p a {
            color: #2c3e50;
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
    </style>
</head>

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
            <p>Belum punya akun check point? <a href="#">Masuk</a></p>
            <p>atau masuk dengan</p>
            <form>
                <label for="email">Email*</label>
                <input id="email" placeholder="Masukkan Alamat Email Anda" required type="email" />
                <label for="password">Password*</label>
                <input id="password" placeholder="Password" required type="password" />
                <label for="confirm-password">Konfirmasi Password*</label>
                <input id="confirm-password" placeholder="Konfirmasi Password" required type="password" />
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
