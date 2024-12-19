<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Pizzeria</title>
            <style>
                body {
                    margin: 0;
                    display: flex;
                    justify-content: center;
                    align-items: top;
                    height: 100vh;
                    background-color: #000;
                    color: #fff;
                    font-family: Arial, sans-serif;
                }
                h1 {
                    font-size: 10rem;
                    text-transform: uppercase;
                    color: #fff;
                    text-shadow: 0 0 20px #ff00ff, 0 0 40px #ff00ff, 0 0 60px #ff00ff, 0 0 80px #ff00ff;
                    animation: glow 2s infinite alternate;
                }
                @keyframes glow {
                    from {
                        text-shadow: 0 0 10px #ff00ff, 0 0 20px #ff00ff;
                    }
                    to {
                        text-shadow: 0 0 30px #ff00ff, 0 0 60px #ff00ff;
                    }
                }
            </style>
        </head>
        <body>
            <h1>Pizzeria</h1>
        </body>
        </html>
