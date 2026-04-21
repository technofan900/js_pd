<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form id="form">
        <input id="input" type="text">
        <button >Submit</button>
        <div id="output"></div>
    </form>

    <script>
        let form = document.getElementById('form')
        let input = document.getElementById('input')
        let output = document.getElementById('output')

        form.addEventListener('submit', (e) => {
            e.preventDefault()
            output.textContent = ''
            createItem(input.value)
        })

        function createItem(x) {
            if (x == '') {
                let html = `<p>Ievadi vārdu.</p>`;
                output.insertAdjacentHTML("beforeend", html)
            } else {
                html = `<p>Sveiks, ${x}!<br>Vārdā ir ${x.length} burti.</p>`;
            }
            output.insertAdjacentHTML("beforeend", html);
        }
    </script>
</body>
</html>