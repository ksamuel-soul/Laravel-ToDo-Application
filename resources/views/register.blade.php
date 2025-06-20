<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <h2 class="mb-4 text-center">Register</h2>
    <form id="reg_form" method="POST">
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" placeholder="Enter your name" required>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
      </div>
      <div class="mb-3">
        <label for="age" class="form-label">Age</label>
        <input type="number" class="form-control" id="age" placeholder="Enter your age" min="0" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" placeholder="Enter password" required>
      </div>
      <div class="mb-3">
        <label for="confirm_password" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" id="con_pass" placeholder="Re-enter password" required>
      </div>
      <button type="submit" class="btn btn-primary w-100" id="submit" onclick="return login()">Register</button><br><br>
      <button type="button" class="btn btn-primary w-100" onclick="window.location.href = '/api/login'">Login</button>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<script>
  function login()
  {
    const form = document.getElementById('reg_form');
    form.addEventListener('submit', function(e){
      e.preventDefault();
      const data = {
        "Name":document.getElementById('name').value,
        "Email":document.getElementById('email').value,
        "Age":document.getElementById('age').value,
        "Password":document.getElementById('password').value,
        "Password_confirmation":document.getElementById('con_pass').value
      };

      fetch(`http://127.0.0.1:8000/api/register`, {
        method:"POST",
        headers:{"Content-type":"application/json"},
        body:JSON.stringify(data)
      }).then(res=>res.json()).then(data=>{
        if(data.Status == 200)
        {
          alert(data.Message);
          window.location.href="/api/login/";
        }
      });
    });
  }
</script>
