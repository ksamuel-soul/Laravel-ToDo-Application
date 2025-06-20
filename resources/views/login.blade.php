<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <h2 class="mb-4 text-center">Login</h2>
    <form id="log_form" method="POST">
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="pass" placeholder="Enter password" required>
      </div>
      <button type="submit" class="btn btn-primary w-100" id="submit" onclick="return login()">Login</button>
      <br><br>
      <button type="button" class="btn btn-primary w-100" onclick="window.location.href = '/api/register'">Regsiter</button>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<script>
  function login()
  {
      const form = document.getElementById('log_form');
      form.addEventListener('submit', function(e){
        e.preventDefault();
        const data = {
          Email:document.getElementById('email').value,
          Password:document.getElementById('pass').value
        };
        //console.log(data);
        fetch(`http://127.0.0.1:8000/api/login`, {
          method:"POST",
          headers:{"Content-type":"application/json"},
          body:JSON.stringify(data)
        }).then(res=>res.json()).then(data=>{
          if(data.Status == 200)
          {
            alert(data.Message);
            // console.log(data.Token);
            sessionStorage.setItem('token', data.Token);
            sessionStorage.setItem('name', data.user_details.Name);
            window.location.href="/api/tasks";
          }
          else if(data.Status == 404)
          {
            alert(data.Message);
          }
        });
      });
    }
</script>