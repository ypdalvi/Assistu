<?php

$error = '';
if(isset($_POST['uname'])){
    if(empty($_POST['uname']) || empty($_POST['psw'])){
        echo '<script>alert("User Not Found")</script>';
    }
    else{
        $user=$_POST['uname'];
        $password=$_POST['psw'];
        $rollno=$_POST['rollno'];
    
        $conn = mysqli_connect("localhost","root","");
        
        $db = mysqli_select_db($conn,"assistu");
    
        $querry = mysqli_query($conn,"SELECT * FROM login WHERE name='$user' AND rollno='$rollno' AND password='$password'");
    
        $rows= mysqli_num_rows($querry);
       
        if($rows == 1)
        {
          $var = mysqli_fetch_assoc($querry);
          if($var["usertype"]=='s'){
            session_start();
            $_SESSION['usertype']='s';

            header("Location: homepage.php");
          }
          else
          {
            session_start();
            $_SESSION['usertype']='c';

            header("Location: homepage.php");
          }
        }
        else
        {
          echo '<script>alert("User Not Found")</script>';
        }
    
        mysqli_close($conn);
    }

}   
?> 


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <title>AssiSTU</title>
  <style>
    * {
      padding: 0;
      margin: 0;
      box-sizing: border-box;
    }

    body {
      background-image: url("assets/back.jpg");
      background-color: rgb(255, 255, 255);
      height: 100%;
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
    }

    .row {
      background: whitesmoke;
      border-radius: 30px;
      align-items: center;
      font-size: medium;
      justify-content: center;
    }

    img {
      width: 75%;
      height: 700px;
    }

    .btn1 {
      border: none;
      outline: none;
      height: 50px;
      width: 100%;
      background-color: black;
      color: white;
      border-radius: 4px;
      font-weight: bold;
    }

    .btn1:hover {
      background: white;
      border: 1px solid;
      color: black;
    }
  </style>
</head>



<body>

  <section class="form my-4 mx-5 pt-5 ">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 px-5">
          <img src="assets/undraw_secure_login_pdn4.svg" alt="Avatar" class="avatar">
        </div>
        <div class="col-lg-7 px-5 pt-5">
          <h1 class="font-weight-bold pt-3 pb-2">AssiSTU</h1>
          <h4>A Student Assistant</h4>
          <form method="post">
            <div class="form-row">
              <div class="col-lg-5">
                <label for="uname" class="font-weight-bold "><b>Username</b></label>
                <input type="text" placeholder="Enter Username" class="form-control mb-3 p-3" name="uname" required>
              </div>
            </div>
            <div class="form-row">
              <div class="col-lg-5">
                <label for="rollno"><b>Roll No</b></label>
                <input type="rollno" placeholder="Enter Roll No" class="form-control mb-3 p-3" name="rollno" required>
              </div>
            </div>
            <div class="form-row">
              <div class="col-lg-5">
                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="*********" class="form-control mb-3 p-3" name="psw" required>
              </div>
            </div>
            <div class="form-row">
              <div class="col-lg-5">
                <button class="btn1 mt-2 mb-3">Login</button>
              </div>
              <span class="psw">Forgot <a href="#">password?</a></span>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>







<!-- <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>AssiSTU</title>
  <style>
    form {
  border: 3px solid #f1f1f1;
}

/* Full-width inputs */
input[type=text], input[type=password], input[type=rollno] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/* Set a style for all buttons */
button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

/* Add a hover effect for buttons */
button:hover {
  opacity: 0.8;
}

/* Extra style for the cancel button (red) */
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

/* Center the avatar image inside this container */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

/* Avatar image */
img.avatar {
  width: 40%;
  border-radius: 50%;
}

/* Add padding to containers */
.container {
  padding: 16px;
}

/* The "Forgot password" text */
span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
    display: block;
    float: none;
  }
  .cancelbtn {
    width: 100%;
  }
  body .container , .imgcontainer{ 
  height: 3000px; 
  background: linear-gradient(55deg, #0fb8ad 0%, #1fc8db 51%, #2cb5e8 85%);
    }
}
html {
  scroll-behavior: smooth;
}
  </style>
</head>
<body>
    <form method="post" >
        <div class="imgcontainer">
          <img src="logo.jpg" alt="Avatar" class="avatar">
        </div>

        <div class="container">
          <label for="uname"><b>Username</b></label>
          <input type="text" placeholder="Enter Username" name="uname" required>
            <br>
          <label for="rollno"><b>Roll No</b></label>
          <input type="rollno" placeholder="Enter Rollno" name="rollno" required>
            <br>
          <label for="psw"><b>Password</b></label>
          <input type="password" placeholder="Enter Password" name="psw" required>
            <br>
            <button >Login</button>
           
          <br>
          <label>
            <input type="checkbox" checked="checked" name="remember"> Remember me
          </label>
        </div>

        <div class="container" style="background-color:#f1f1f1">
          <button type="button" class="cancelbtn">Cancel</button>
          <span class="psw">Forgot <a href="#">password?</a></span>
        </div>
      </form>
</body>
</html> -->