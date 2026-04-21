<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div id="output"></div>
    <script>
        let output = document.getElementById("output");
        let pets = [
            {name: "Minka", species: "cat", age: 4},
            {name: "Reksis", species: "dog", age: 10},
            {name: "Bruno", species: "dog", age: 1},
            {name: "Maija", species: "cat", age:8}
        ];

        function dogsOnly(pet) {
            return pet.species == "dog";
        }
        let dogs = pets.filter(dogsOnly)
        console.log(dogs.length)

        for(let i=0; i<dogs.length; i++) {
            let html = `Name: ${dogs[i].name}, Species: ${dogs[i].species}, Age: ${dogs[i].age}<br>`;
            output.insertAdjacentHTML("beforeend", html)            
        }
        output.insertAdjacentHTML("beforeend", `Kopā ir ${dogs.length} suns/ņi.<br>`)

    </script>
</body>
</html>