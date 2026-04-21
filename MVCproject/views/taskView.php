<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uzdevumu pārvaldnieks</title>
    <style>
        .done {
            text-decoration: line-through;
            color: gray;
        }
    </style>
</head>
<body>

    <h1>To Do App</h1>
    <form id="ourForm">
        <input id="ourField" type="text" autocomplete="off">
        <button>Create item</button>
    </form>
    
    <h3>Need to Do</h3>
    <ul id="ourList">
    </ul>

    <script>
        let ourForm = document.getElementById("ourForm");
        let ourField = document.getElementById("ourField");
        let ourList = document.getElementById("ourList");

        window.addEventListener('load', loadTasks);

        function loadTasks() {
            fetch('index.php?action=getTasks')
            .then(response => response.json())
            .then(data => updateList(data));
        }

        ourForm.addEventListener('submit', (e) => {
            e.preventDefault();
            createItem(ourField.value);
            ourField.value = '';
            ourField.focus();
        });

        function createItem(x) {
            if (x.trim() == '') return;
            fetch('index.php?action=addAjax', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'task=' + encodeURIComponent(x.trim())
            })
            .then(response => response.json())
            .then(data => updateList(data));
        }

        function deleteItem(index) {
            fetch('index.php?action=deleteAjax', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'index=' + index
            })
            .then(response => response.json())
            .then(data => updateList(data));
        }

        function editItem(el, index) {
            el.insertAdjacentHTML("beforebegin", `<input id="editInput" type="text" value="${el.parentElement.firstChild.textContent.split(' (')[0].trim()}"><button id="saveEdit" onclick="saveEdit(this, ${index})">Save</button>`);
            el.remove();
        }

        function saveEdit(el, index) {
            let editInput = document.getElementById("editInput");
            fetch('index.php?action=editAjax', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'index=' + index + '&task=' + encodeURIComponent(editInput.value.trim())
            })
            .then(response => response.json())
            .then(data => updateList(data));
        }

        function toggleStatus(index) {
            fetch('index.php?action=toggleAjax', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'index=' + index
            })
            .then(response => response.json())
            .then(data => updateList(data));
        }

        function updateList(tasks) {
            let html = '';
            tasks.forEach((task, index) => {
                let className = task.status === 'done' ? 'done' : '';
                html += `<li class="${className}">${task.title} (${task.status}) <button onclick="editItem(this, ${index})">Edit</button> <button onclick="if (confirm('Are you sure?')) deleteItem(${index})">Delete</button> <button onclick="toggleStatus(${index})">Toggle</button></li>`;
            });
            ourList.innerHTML = html;
        }
    </script>

</body>
</html>