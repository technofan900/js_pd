<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
           margin: 0;
           overflow: hidden;
        }


        #square {
            position: absolute;
            background-color: black;
            height: 70px;
            width: 70px;
        }
    </style>
</head>
<body>
    <div id="square"></div>
    <script>
        const square = document.getElementById('square');
        let x = 0;
        let y = 0;
        const step = 10;

        document.addEventListener('keydown', (e) => {
            // console.log(e.key);                         // Parāda pogu nosaukumsu
            switch (e.key) {
                case 'ArrowUp':
                    y -= step;
                    if (y <= 0) {
                        y = 0;
                    }                    
                    break;
                case 'ArrowDown':
                    y += step;
                    if (y >= window.innerHeight-70) {
                        y = window.innerHeight-70;
                    }   
                    break;
                case 'ArrowLeft':
                    x -= step;
                    if (x <= 0) {
                        x = 0;
                    }     
                    break;
                case 'ArrowRight':
                    x += step;
                    if (x >= window.innerWidth-70) {
                        x = window.innerWidth-70;
                    }
                    break;
            }
            square.style.left = x + 'px';
            square.style.top = y + 'px';
        })
    </script>
</body>
</html>