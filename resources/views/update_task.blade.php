<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Update Task</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
  <div class="container mt-5">
    <h2 class="text-center mb-4">Update Task</h2>
    <form id="update_task" method="POST">
      <div class="mb-3">
        <label for="taskName" class="form-label">Task Name</label>
        <input type="text" class="form-control" id="taskName" placeholder="Enter task name" required>
      </div>

      <div class="mb-3">
        <label for="taskDescription" class="form-label">Task Description</label>
        <textarea class="form-control" id="taskDesc" rows="3" placeholder="Enter task description" required></textarea>
      </div>

      <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-select" id="status" required>
          <option value="" disabled selected>Select status</option>
          <option value="Pending">Pending</option>
          <option value="In Progress">In Progress</option>
          <option value="Completed">Completed</option>
        </select>
      </div>

      <button type="submit" id="submit" onclick="return task()" class="btn btn-primary w-100">Update Task</button>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<script>
    const token = sessionStorage.getItem('token');
    if (!token)
    {
        alert('First login raa bewakuf..!!!');
        window.location.href = "/api/login";
    }
    // task_name, task_desc, status
    const name1 = sessionStorage.getItem('Name');
    const desc1 = sessionStorage.getItem('Desc');
    const sta1 = sessionStorage.getItem('status');
    document.getElementById('taskName').value = name1;
    document.getElementById('taskDesc').value = desc1;
    document.getElementById('status').value = sta1;

</script>

<script>
    function task()
    {
       const form = document.getElementById('update_task');
       form.addEventListener('submit', function(e){
        e.preventDefault();
        const data = {
            Task_Name:document.getElementById('taskName').value,
            Task_Description:document.getElementById('taskDesc').value,
            Status:document.getElementById('status').value,
        };
        const iid = sessionStorage.getItem('Id');
        fetch(`http://127.0.0.1:8000/api/tasks/${iid}`, {
            method:"PUT",
            headers:{"Content-type":"application/json"},
            body:JSON.stringify(data),
        }).then(res=>res.json()).then(data=>{
            // console.log(data);
            if(data.Status == 200)
            {
                alert(data.Message);
                // sessionStorage.clear();
                window.location.href = "/api/tasks"
            }
        });
       });
    }
</script>