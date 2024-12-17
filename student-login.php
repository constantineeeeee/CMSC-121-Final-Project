<?php
  include("top.html");
?>
  
  <div id="logout" hidden>ADMIN LOGIN</div>
  <div id="hrefLink" hidden>admin-login.php</div>
  <div id="homeLink" hidden>index.php</div>

  <div class="login">
      <div class="login2">
        <h2>STUDENT LOGIN</h2>

        <?php 
          session_start();

          if(isset($_SESSION["userCheck"])){
            header("Location: student-menu.php");
          }

          if(isset($_SESSION["failed"])) { 
        ?>
          <p class="incorrect">Incorrect username or password</p>
        <?php session_destroy(); } ?>

        <?php 
          if(isset($_SESSION["signupSuccess"])) {
        ?>
          <p class="status-confirmed">Sign Up Successful!</p>
        <?php session_destroy(); } ?>

        <form action="student-login-check.php" method="post">
            <label>Username: <input type="text" name="username" required> </label> <br/>
            <label>Password: <input type="password" name="password" required></label> <br/>
            <input class="reqBtn" type="submit" value="Login">
            <p>Click <a href="signup.php" class="signupButton"> here </a> to sign up</p>
        </form>          
      </div>
    </div>
<?php
  include("bottom.html");
?>