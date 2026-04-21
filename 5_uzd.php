<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div id="ourList"></div>

    <script>
        fetch("data.json")
        .then(response => response.json())
        .then(items => {
            items.forEach(item => {
                let html = `Name: ${item.name}, City: ${item.city}<br>`;
                ourList.insertAdjacentHTML("beforeend", html)            
            })
        })
        .catch(
            error => console.error("cant load data: ", error)
        )
        
    </script>
</body>
</html>