<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Responsive Navbar</title>
  <link rel="stylesheet" href="./Css/navbar.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    .navbar{
       background-color: #4B4FED;
       border-radius:10px;
       /* border:2px solid black; */
    }

    .btn{
      padding:5px 7px;
      border-radius:10px;
      background-color:red;
      color:white;
      cursor:pointer;
    }
    </style>
</head>
<body>
  <nav class="navbar">
    <div class="logo"><img src="./img/logo.png" height='50' width='50'/> PayGo</div>
    <ul class="nav-links" id="navLinks">
      <li><a href="index.php">Home</a></li>
      <li><a href="#">Developer Info</a></li>
      <li><a href="#"><i class="fa-brands fa-github" style="font-size:25px";></i></a></li>
      <li>
      <?php 
      if(isset($_SESSION['uname'])){
        echo "<a href='profile.php'>".$_SESSION['uname']."</a>";
      }else{
        echo "<a href='login.php'>Login</a>";
      }?></li>

      <?php
        if(isset($_SESSION['uname'])){
          echo "<li><a href='../Controller/logout_handler.php'><button class='btn'>Log out</button></a></li>";
        }
        else{
            echo "<li><a href='SignUp.php'>Sign Up</a></li>";
        }
      ?>
      
      
      
    </ul>
    <div class="hamburger" id="hamburger">
      ☰
    </div>
  </nav>

  <script src="./Js/navbar.js"></script>
</body>
</html>
