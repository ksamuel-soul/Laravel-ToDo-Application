<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>To-Do Task Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <style>
    body {
      padding-top: 70px;
    }
    .form-section {
      background-color: #f8f9fa;
      padding: 40px 20px;
      border-radius: 10px;
    }
    footer {
      background: #f1f1f1;
      padding: 1.5rem 0;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold">Hello <span id="name"> </span></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
              data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
              aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Features</a></li>
          <li class="nav-item"><a class="nav-link" style="cursor: pointer;" onclick="return logout()">Logout</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- To-Do Task Section -->
  <section class="container">
    <div class="form-section shadow">
      <h2 class="text-center mb-4">Add New Task</h2>
      <form id="task_form" method="POST">
        <div class="mb-3">
          <label for="taskName" class="form-label">Task Name</label>
          <input type="text" class="form-control" id="taskName" placeholder="Enter task name">
        </div>
        <div class="mb-3">
          <label for="taskDescription" class="form-label">Task Description</label>
          <textarea class="form-control" id="taskDesc" rows="3" placeholder="Describe the task..."></textarea>
        </div>
        <div class="mb-3">
          <label for="status" class="form-label">Status</label>
          <select class="form-select" id="status">
            <option selected disabled>Select status</option>
            <option value="Pending">Pending</option>
            <option value="In Progress">In Progress</option>
            <option value="Completed">Completed</option>
          </select>
        </div>
        <div class="text-center">
          <button type="submit" id="submit" onclick="return add_task()" class="btn btn-primary">Add Task</button>
        </div>
      </form>
    </div>
  </section>

  <style>
    .view_task{
      /* border: 5px solid lightgreen; */
      display: flex;
      justify-content: space-evenly;
      flex-direction: column;
      padding-top: 25px;

    }

    th{
      border: 2px solid red;
      text-align: center;
      font-size: 20px;
    }

    td{
      text-align: center;
      border: 2px solid black;
      font-weight: 450;
    }
    #tsk{
      text-align: center;
      color: Green;
    }
  </style>

  <div class="view_task">
    <h2 id="tsk"><u>All Tasks</u></h2>
      <table id="allTasks">
        <thead>
          <th>S_No.</th>
          <th>Task_Name</th>
          <th>Task_Description</th>
          <th>Status</th>
          <th>Created</th>
          <th>Controls</th>
        </thead>
        <tbody>

        </tbody>
      </table>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!-- Script to get Name and Token..!!! -->
<script>
  const token = sessionStorage.getItem('token');
  const name = sessionStorage.getItem('name');
  if(token == null)
  {
    alert("First Login");
    window.location.href="/api/login";
  }
  // console.log(token +" "+ name);
  document.getElementById('name').innerHTML = '<span style="color:red; font-size:20px;">'+name+'</span>..!!!';
</script>

<!-- Script for Logout Function..!!! -->
<script>
  function logout()
  {
    const token = sessionStorage.getItem('token');
    // alert(token);
    fetch(`http://127.0.0.1:8000/api/logout`, {
      method:"POST",
      headers:{"Content-type":"application/json", "Authorization": "Bearer " + token},
    }).then(res=>res.json()).then(data=>{
      if(data.Status == 200)
      {
        alert(data.Message);
        sessionStorage.clear();
        window.location.href = "/api/login";
      }
    });
  }
</script>

<!-- Script to Add a Task to The List -->
<script>
  function add_task()
  {
    const name = sessionStorage.getItem('name');
    const form = document.getElementById('task_form');
    form.addEventListener('submit', function(e){
      e.preventDefault();
      const data = {
        "Task_Name":document.getElementById('taskName').value,
        "User_Name":name,
        "Task_Description":document.getElementById('taskDesc').value,
        "Status":document.getElementById('status').value
      };
      fetch(`http://127.0.0.1:8000/api/tasks`, {
        method:"POST",
        headers:{"Content-type":'application/json'},
        body:JSON.stringify(data)
      }).then(res=>res.json()).then(data=>{
        if(data.Status == 200){
          // console.log(data);
          alert("Task Added Successfully..!!!");
          location.reload();
        }
      });
    });
  }
</script>

<!-- Script to retrive all the Tasks from the DataBase -->
<script>
  const name12 = sessionStorage.getItem('name');
  fetch(`http://127.0.0.1:8000/api/allTasks/${name12}`, {
    method:"GET",
    headers:{"Content-type":"application/json"},
  }).then(res=>res.json()).then(data=>{
    const tdata = document.querySelector("#allTasks tbody");
    tdata.innerHTML = "";
    let x = 1;
    data.forEach((pro)=>{
      const row = `<tr>
                    <td>${x}</td>
                    <td>${pro.Task_Name}</td>
                    <td>${pro.Task_Description}</td>
                    <td>${pro.Status}</td>
                    <td>${pro.created_at}</td>
                    <td>
                        <button type='button' onclick='return update_task(${pro.id}, "${pro.Task_Name}", "${pro.Task_Description}", "${pro.Status}")' id='update'>Update</button>
                        <button type='button' onclick='return delete_task(${pro.id})' id='delete'>Delete</button>
                    </td>
                   </tr>`;
        x += 1;
        tdata.innerHTML += row;
    });
  });
</script>

<!-- Script to Delete a Specific Task..!!! -->
<script>
  function delete_task(id)
  {
    //alert(id);
    fetch(`http://127.0.0.1:8000/api/tasks/${id}`, {
      method:"DELETE",
      headers:{"Content-type":"application/json"}
    }).then(res=>res.json()).then(data=>{
      if(data.Status == 200)
      {
        alert(data.Message);
        location.reload();
      }
    });
  }
</script>

<script>
  function update_task(id, name, desc, status)
  {
    window.location.href = "/api/update_task";
    sessionStorage.setItem('Id', id);
    sessionStorage.setItem('Name', name);
    sessionStorage.setItem('Desc', desc);
    sessionStorage.setItem('status', status);
    // const name1 = sessionStorage.getItem('Name');
    // const desc1 = sessionStorage.getItem('Desc');
    // const sta1 = sessionStorage.getItem('status');
    // alert(name1 + desc1 + sta1);
  }
</script>