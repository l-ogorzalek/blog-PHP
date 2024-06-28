<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Superblog</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(45deg, #ff6f61, #ffaf61, #61ff6f, #61afff, #af61ff);
            background-size: 400% 400%;
            animation: gradientAnimation 10s ease infinite;
            color: #fff;
            font-family: 'Comic Sans MS', cursive, sans-serif;
            overflow: hidden;
            position: relative;
        }

        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .content {
            text-align: center;
            animation: textAnimation 3s infinite;
        }

        @keyframes textAnimation {
            0% { transform: scale(1); }
            50% { transform: scale(1.5); }
            100% { transform: scale(1); }
        }

        .moving-text {
            position: relative;
            font-size: 2rem;
            animation: movingTextAnimation 5s infinite alternate;
        }

        @keyframes movingTextAnimation {
            0% { left: 0; }
            100% { left: 50px; }
        }

        .rotating-text {
            display: inline-block;
            animation: rotatingTextAnimation 10s infinite linear;
        }

        @keyframes rotatingTextAnimation {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .color-changing-text {
            animation: colorChangingTextAnimation 2s infinite alternate;
        }

        @keyframes colorChangingTextAnimation {
            0% { color: #fff; }
            100% { color: #ff00ff; }
        }

        .floating-image {
            position: absolute;
            width: 200px;
            height: auto;
            animation: floatImage 20s infinite;
            opacity: 0;
        }

        @keyframes floatImage {
            0%, 100% { opacity: 0; }
            10%, 90% { opacity: 1; }
            0% { top: 10%; left: 10%; }
            25% { top: 20%; left: 70%; }
            50% { top: 80%; left: 30%; }
            75% { top: 50%; left: 80%; }
            100% { top: 10%; left: 10%; }
        }
    </style>
</head>
<body>
    <div class="content">
        <h1 class="moving-text">Superblog</h1>
        <p class="rotating-text">I just need a few points to pass, pls 🙏🙏</p>
        <p class="color-changing-text">Epilepsy in 3, 2, 1...</p>
    </div>
    <img src="https://i.pinimg.com/236x/4b/fd/ec/4bfdecf33c42e1d256696ef7fa8149d8.jpg" class="floating-image">
</body>
</html>
