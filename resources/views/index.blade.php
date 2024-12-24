<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AccessPoint Project</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            text-align: center;
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        h1 {
            font-size: 1.8rem;
            margin-bottom: 20px;
            color: #444;
        }
        p {
            font-size: 1rem;
            margin-bottom: 20px;
        }
        .btn {
            display: block;
            padding: 10px 20px;
            margin: 10px 0;
            font-size: 1rem;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
            text-align: center;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .btn-light {
            background-color: #6c757d;
        }
        .btn-light:hover {
            background-color: #565e64;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Добро пожаловать в AccessPoint</h1>
        <p>Пожалуйста, выберите действие:</p>
        <a href="/register" class="btn">Регистрация</a>
        <a href="https://t.me/gromer" class="btn btn-light" target="_blank">Мой профиль в Telegram</a>
        <a href="https://github.com/xetcru/accesspoint" class="btn btn-light" target="_blank">Проект на GitHub</a>
    </div>
</body>
</html>
