<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Item</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 50%;
            margin: 50px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .message {
            text-align: center;
            margin-bottom: 20px;
            font-size: 16px;
        }

        .message p {
            margin: 0;
            padding: 10px;
            border-radius: 5px;
        }

        .message p.success {
            background-color: #d4edda;
            color: #155724;
        }

        .message p.error {
            background-color: #f8d7da;
            color: #721c24;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-size: 14px;
            color: #555;
            margin-bottom: 5px;
        }

        input[type="text"] {
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
            box-sizing: border-box;
        }

        input[type="text"]:focus {
            outline: none;
            border-color: #5c9ded;
        }

        button {
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }

        @media (max-width: 768px) {
            .container {
                width: 80%;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Create New Item</h2>

        <div class="message">
            @if(session('success'))
                <p class="success">{{ session('success') }}</p>
            @endif
            @if(session('error'))
                <p class="error">{{ session('error') }}</p>
            @endif
        </div>

        <form action="{{ route('store') }}" method="POST">
            @csrf

            <div>
                <label for="name">Item Name:</label>
                <input type="text" name="name" id="name" required>
            </div>

            <div>
                <label for="data_color">Color:</label>
                <input type="text" name="data[color]" id="data_color">
            </div>

            <div>
                <label for="data_capacity">Capacity:</label>
                <input type="text" name="data[capacity]" id="data_capacity">
            </div>

            <div>
                <label for="data_price">Price:</label>
                <input type="text" name="data[price]" id="data_price">
            </div>

            <button type="submit">Submit</button>
        </form>
    </div>

</body>
</html>
