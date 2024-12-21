<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Request Form</title>
</head>
<body>
    <h1>API Request Form</h1>
    <form method="POST" action="">
        <label for="method">Method:</label>
        <select name="method" id="method">
            <option value="GET">GET</option>
            <option value="POST">POST</option>
            <option value="PUT">PUT</option>
            <option value="DELETE">DELETE</option>
            <option value="PATCH">PATCH</option>
            <option value="HEAD">HEAD</option>
            <option value="OPTIONS">OPTIONS</option>
        </select><br><br>

        <label for="url">URL:</label>
        <input type="text" name="url" id="url" required><br><br>

        <label for="token">Bearer Token:</label>
        <input type="text" name="token" id="token"><br><br>

        <label for="params">Parameters (JSON format):</label>
        <textarea name="params" id="params"></textarea><br><br>

        <label for="body">Body (JSON format):</label>
        <textarea name="body" id="body"></textarea><br><br>

        <input type="submit" value="Send Request">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $method = $_POST['method'];
        $url = $_POST['url'];
        $token = $_POST['token'];
        $params = json_decode($_POST['params'], true);
        $body = $_POST['body'];

        $headers = [
            'Content-Type: application/json'
        ];

        if (!empty($token)) {
            $headers[] = 'Authorization: Bearer ' . $token;
        }

        $response = sendRequest($method, $url, $headers, $params, $body);
        echo '<h2>Response:</h2>';
        echo '<pre>' . htmlspecialchars($response) . '</pre>';
    }

    function sendRequest($method, $url, $headers = [], $params = [], $body = null) {
        $ch = curl_init();

        // Устанавливаем URL
        curl_setopt($ch, CURLOPT_URL, $url);

        // Устанавливаем метод запроса
        switch (strtoupper($method)) {
            case 'POST':
                curl_setopt($ch, CURLOPT_POST, true);
                break;
            case 'PUT':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
                break;
            case 'DELETE':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
                break;
            case 'PATCH':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
                break;
            case 'HEAD':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'HEAD');
                break;
            case 'OPTIONS':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'OPTIONS');
                break;
            default:
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
                break;
        }

        // Устанавливаем заголовки
        if (!empty($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        // Устанавливаем параметры запроса
        if (!empty($params)) {
            $url .= '?' . http_build_query($params);
            curl_setopt($ch, CURLOPT_URL, $url);
        }

        // Устанавливаем тело запроса
        if ($body !== null) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        }

        // Устанавливаем опции для получения ответа
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        // Выполняем запрос
        $response = curl_exec($ch);

        // Проверяем наличие ошибок
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }

        // Закрываем сеанс cURL
        curl_close($ch);

        return $response;
    }
    ?>
</body>
</html>