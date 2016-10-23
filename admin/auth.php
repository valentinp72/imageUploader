<?php if(!isset($_POST["submit"]) or empty($_POST["login"]) or empty($_POST["password"]) ){
    include("header.php");
    echo "<h1>Authentication</h2>";
    if(isset($_POST["submit"])) echo "<h3 class='error'>All fields are requiered</h3>";
  ?>

  <form method="post">
    <fieldset>
      <label for="login">Login : </label><input name="login" id="login" required/><br/>
      <label for="password">Password : </label><input type="password" name="password" id="password" required/><br/>
      <input type="submit" name="submit" value="Log In"/>
    </fieldset>
  </form>

  <?php
    include('footer.php');
  } else{
    include("users.php");
    if(password_verify($_POST['password'], $users[$_POST['login']] )){


      session_start();
      $_SESSION['login'] = $_POST['login'];
      $_SESSION['password'] = $_POST['password'];

      header('location: index.php');

    }
    else{
      echo "Wrong login / password.<br/><a href='auth.php'>Back to the log-in page</a>";
    }

  }
  ?>
