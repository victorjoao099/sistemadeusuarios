<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\I18n\Time;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
      integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Página Inicial</title>
</head>
<body>

<style>
    /* Geral */
* {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
  font-family: Verdana;
  color: #333;
}

body {
  background-image: url("../img/bg.jpg");
  background-position: center;
  background-size: cover;
}

button {
  background-color: #fdfdfd;
  color: #102f5e;
  border: 2px solid #102f5e;
  padding: 0.3rem 0.6rem;
  font-size: 1rem;
  cursor: pointer;
  display: flex;
  justify-content: center;
  align-items: center;
  transition: 0.4s;
}

button:hover {
  background-color: #102f5e;
}

button:hover > i {
  color: #fff;
}

button i {
  pointer-events: none;
  color: #102f5e;
  font-weight: bold;
}

input,
select {
  padding: 0.25rem 0.5rem;
}

.hide {
  display: none;
}

/* Todo Header */
.todo-container {
  max-width: 450px;
  margin: 3rem auto 0;
  background-color: #fdfdfd;
  padding: 1.5rem;
  border-radius: 15px;
}

.todo-container header {
  text-align: center;
  padding: 0 1rem 1rem;
  border-bottom: 1px solid #ccc;
}

/* Todo Form */
#todo-form,
#edit-form {
  padding: 1rem;
  border-bottom: 1px solid #ccc;
}

#todo-form p,
#edit-form p {
  margin-bottom: 0.5rem;
  font-weight: bold;
}

.form-control {
  display: flex;
}

.form-control input {
  margin-right: 0.3rem;
}

#cancel-edit-btn {
  margin-top: 1rem;
  color: #444;
}

/* Todo Toolbar */
#toolbar {
  padding: 1rem;
  border-bottom: 1px solid #ccc;
  display: flex;
}

#toolbar h4 {
  margin-bottom: 0.5rem;
}

#search {
  border-right: 1px solid #ddd;
  padding-right: 1rem;
  margin-right: 1rem;
  width: 65%;
  display: flex;
  flex-direction: column;
}

#search form {
  display: flex;
}

#search input {
  width: 100%;
  margin-right: 0.3rem;
}

#filter {
  width: 35%;
  display: flex;
  flex-direction: column;
}

#filter select {
  flex: 1;
}

/* Todo List */
.todo {
  display: flex;
  justify-content: space-around;
  align-items: center;
  padding: 1rem 1rem;
  border-bottom: 1px solid #ddd;
  transition: 0.3s;
}

.todo h3 {
  flex: 1;
  font-size: 0.9rem;
}

.todo button {
  margin-left: 0.4rem;
}

.done {
  background: #395169;
}

.done h3 {
  color: #fff;
  text-decoration: line-through;
  font-style: italic;
}

</style>

<div class="todo-container">
      <header>
        <h1>Todo List</h1>
      </header>
      <form id="todo-form">
        <p>Adicione sua tarefa</p>
        <div class="form-control">
          <input
            type="text"
            id="todo-input"
            placeholder="O que você vai fazer?"
          />
          <button type="submit">
            <i class="fa-thin fa-plus"></i>
          </button>
        </div>
      </form>
      <form id="edit-form" class="hide">
        <p>Edite sua tarefa</p>
        <div class="form-control">
          <input type="text" id="edit-input" />
          <button type="submit">
            <i class="fa-solid fa-check-double"></i>
          </button>
        </div>
        <button id="cancel-edit-btn">Cancelar</button>
      </form>
      <div id="toolbar">
        <div id="search">
          <h4>Pesquisar:</h4>
          <form>
            <input type="text" id="search-input" placeholder="Buscar..." />
            <button id="erase-button">
              <i class="fa-solid fa-delete-left"></i>
            </button>
          </form>
        </div>
        <div id="filter">
          <h4>Filtrar:</h4>
          <select id="filter-select">
            <option value="all">Todos</option>
            <option value="done">Feitos</option>
            <option value="todo">A fazer</option>
          </select>
        </div>
      </div>
      <div id="todo-list">
        <!-- 
          Template
          
          <div class="todo">
          <h3>Estou fazendo algo aqui...</h3>
          <button class="finish-todo">
            <i class="fa-solid fa-check"></i>
          </button>
          <button class="edit-todo">
            <i class="fa-solid fa-pen"></i>
          </button>
          <button class="remove-todo">
            <i class="fa-solid fa-xmark"></i>
          </button>
        </div> -->
      </div>
    </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
<script>
// Seleção de elementos
const todoForm = document.querySelector("#todo-form");
const todoInput = document.querySelector("#todo-input");
const todoList = document.querySelector("#todo-list");
const editForm = document.querySelector("#edit-form");
const editInput = document.querySelector("#edit-input");
const cancelEditBtn = document.querySelector("#cancel-edit-btn");
const searchInput = document.querySelector("#search-input");
const eraseBtn = document.querySelector("#erase-button");
const filterBtn = document.querySelector("#filter-select");

let oldInputValue;

// Funções
const saveTodo = (text, done = 0, save = 1) => {
  const todo = document.createElement("div");
  todo.classList.add("todo");

  const todoTitle = document.createElement("h3");
  todoTitle.innerText = text;
  todo.appendChild(todoTitle);

  const doneBtn = document.createElement("button");
  doneBtn.classList.add("finish-todo");
  doneBtn.innerHTML = '<i class="fa-solid fa-check"></i>';
  todo.appendChild(doneBtn);

  const editBtn = document.createElement("button");
  editBtn.classList.add("edit-todo");
  editBtn.innerHTML = '<i class="fa-solid fa-pen"></i>';
  todo.appendChild(editBtn);

  const deleteBtn = document.createElement("button");
  deleteBtn.classList.add("remove-todo");
  deleteBtn.innerHTML = '<i class="fa-solid fa-xmark"></i>';
  todo.appendChild(deleteBtn);

  // Utilizando dados da localStorage
  if (done) {
    todo.classList.add("done");
  }

  if (save) {
    saveTodoLocalStorage({ text, done: 0 });
  }

  todoList.appendChild(todo);

  todoInput.value = "";
};

const toggleForms = () => {
  editForm.classList.toggle("hide");
  todoForm.classList.toggle("hide");
  todoList.classList.toggle("hide");
};

const updateTodo = (text) => {
  const todos = document.querySelectorAll(".todo");

  todos.forEach((todo) => {
    let todoTitle = todo.querySelector("h3");

    if (todoTitle.innerText === oldInputValue) {
      todoTitle.innerText = text;

      // Utilizando dados da localStorage
      updateTodoLocalStorage(oldInputValue, text);
    }
  });
};

const getSearchedTodos = (search) => {
  const todos = document.querySelectorAll(".todo");

  todos.forEach((todo) => {
    const todoTitle = todo.querySelector("h3").innerText.toLowerCase();

    todo.style.display = "flex";

    console.log(todoTitle);

    if (!todoTitle.includes(search)) {
      todo.style.display = "none";
    }
  });
};

const filterTodos = (filterValue) => {
  const todos = document.querySelectorAll(".todo");

  switch (filterValue) {
    case "all":
      todos.forEach((todo) => (todo.style.display = "flex"));

      break;

    case "done":
      todos.forEach((todo) =>
        todo.classList.contains("done")
          ? (todo.style.display = "flex")
          : (todo.style.display = "none")
      );

      break;

    case "todo":
      todos.forEach((todo) =>
        !todo.classList.contains("done")
          ? (todo.style.display = "flex")
          : (todo.style.display = "none")
      );

      break;

    default:
      break;
  }
};

// Eventos
todoForm.addEventListener("submit", (e) => {
  e.preventDefault();

  const inputValue = todoInput.value;

  if (inputValue) {
    saveTodo(inputValue);
  }
});

document.addEventListener("click", (e) => {
  const targetEl = e.target;
  const parentEl = targetEl.closest("div");
  let todoTitle;

  if (parentEl && parentEl.querySelector("h3")) {
    todoTitle = parentEl.querySelector("h3").innerText || "";
  }

  if (targetEl.classList.contains("finish-todo")) {
    parentEl.classList.toggle("done");

    updateTodoStatusLocalStorage(todoTitle);
  }

  if (targetEl.classList.contains("remove-todo")) {
    parentEl.remove();

    // Utilizando dados da localStorage
    removeTodoLocalStorage(todoTitle);
  }

  if (targetEl.classList.contains("edit-todo")) {
    toggleForms();

    editInput.value = todoTitle;
    oldInputValue = todoTitle;
  }
});

cancelEditBtn.addEventListener("click", (e) => {
  e.preventDefault();
  toggleForms();
});

editForm.addEventListener("submit", (e) => {
  e.preventDefault();

  const editInputValue = editInput.value;

  if (editInputValue) {
    updateTodo(editInputValue);
  }

  toggleForms();
});

searchInput.addEventListener("keyup", (e) => {
  const search = e.target.value;

  getSearchedTodos(search);
});

eraseBtn.addEventListener("click", (e) => {
  e.preventDefault();

  searchInput.value = "";

  searchInput.dispatchEvent(new Event("keyup"));
});

filterBtn.addEventListener("change", (e) => {
  const filterValue = e.target.value;

  filterTodos(filterValue);
});

// Local Storage
const getTodosLocalStorage = () => {
  const todos = JSON.parse(localStorage.getItem("todos")) || [];

  return todos;
};

const loadTodos = () => {
  const todos = getTodosLocalStorage();

  todos.forEach((todo) => {
    saveTodo(todo.text, todo.done, 0);
  });
};

const saveTodoLocalStorage = (todo) => {
  const todos = getTodosLocalStorage();

  todos.push(todo);

  localStorage.setItem("todos", JSON.stringify(todos));
};

const removeTodoLocalStorage = (todoText) => {
  const todos = getTodosLocalStorage();

  const filteredTodos = todos.filter((todo) => todo.text != todoText);

  localStorage.setItem("todos", JSON.stringify(filteredTodos));
};

const updateTodoStatusLocalStorage = (todoText) => {
  const todos = getTodosLocalStorage();

  todos.map((todo) =>
    todo.text === todoText ? (todo.done = !todo.done) : null
  );

  localStorage.setItem("todos", JSON.stringify(todos));
};

const updateTodoLocalStorage = (todoOldText, todoNewText) => {
  const todos = getTodosLocalStorage();

  todos.map((todo) =>
    todo.text === todoOldText ? (todo.text = todoNewText) : null
  );

  localStorage.setItem("todos", JSON.stringify(todos));
};

loadTodos();


</script>

<div class="logout">
    <button id="logoutButton">Sair</button>
</div>
    
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>


<script>
    $(document).ready(function(){
        $('#logoutButton').click(function(){
            $.ajax({
                url: '<?=site_url('logout')?>',
                type: 'POST',
                dataType: 'JSON',
                success: function(response) {
                    if(response.status === 'success') {
                        window.location.href = '<?=site_url('login')?>';
                    }
                },
                error: function(error) {
                    console.log(error)
                }
            })
        })
    })
</script>

</body>
</html>