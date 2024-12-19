<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nightclub Pizzeria</title>
    <style>
        body {
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #000;
            color: #fff;
            font-family: 'Arial', sans-serif;
        }

        header {
            width: 100%;
            text-align: center;
            padding: 20px;
            background: linear-gradient(90deg, #ff00ff, #0000ff);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }

        header h1 {
            font-size: 5rem;
            text-transform: uppercase;
            color: #fff;
            text-shadow: 0 0 20px #ff00ff, 0 0 40px #0000ff, 0 0 60px #ff00ff;
            animation: glow 2s infinite alternate;
        }

        @keyframes glow {
            from {
                text-shadow: 0 0 10px #ff00ff, 0 0 20px #0000ff;
            }
            to {
                text-shadow: 0 0 30px #ff00ff, 0 0 60px #0000ff;
            }
        }

        main {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 20px;
        }

        main h2 {
            font-size: 2.5rem;
            margin: 20px 0;
            color: #ffcc00;
        }

        main p {
            font-size: 1.2rem;
            line-height: 1.5;
            max-width: 800px;
            color: #ccc;
        }

        .button {
            margin-top: 20px;
            padding: 15px 30px;
            font-size: 1.2rem;
            color: #fff;
            background: #ff00ff;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            box-shadow: 0 0 20px #ff00ff;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .button:hover {
            transform: scale(1.1);
            box-shadow: 0 0 30px #ff00ff, 0 0 60px #0000ff;
        }

        footer {
            margin-top: auto;
            padding: 20px;
            text-align: center;
            color: #555;
            background: #111;
            width: 100%;
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.5);
        }

        footer p {
            margin: 0;
        }

        footer a {
            color: #ff00ff;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <h1>Stonks Nightclub & Pizzeria</h1>
    </header>

    <main>
        <h2>Where Pizza Meets the Party</h2>
        <p>Welcome to Nightclub Pizzeria! The only place where the beats are as hot as the oven and the vibes are as fresh as our ingredients. Enjoy our signature neon-lit atmosphere and indulge in our gourmet pizzas while dancing the night away!</p>
        <button class="button">Order Now</button>
    </main>

    <footer>
        <p>&copy; 2024 Nightclub Pizzeria. All Rights Reserved. <a href="#">Privacy Policy</a></p>
    </footer>
</body>
</html>
