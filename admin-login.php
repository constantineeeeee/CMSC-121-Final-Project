<?php
  include("top.html");
?>
  <div id="logout" hidden>STUDENT LOGIN</div>
  <div id="hrefLink" hidden>student-login.php</div>
  <div id="homeLink" hidden>index.php</div>
  
  <div class="login">
    <div class="login2">
      <h2>ADMIN LOGIN</h2>
      
      <?php 
        session_start();
        if(isset($_SESSION["failed"])) { 
      ?>
        <p class="incorrect">Incorrect username or password</p>
      <?php session_destroy(); } ?>

      <form action="admin-login-check.php" method="post">
          <label>Username: <input type="text" name="username" required> </label> <br/>
          <label>Password: <input type="password" name="password" required></label> <br/>
          <input class="reqBtn" type="submit" value="Login">
      </form>
    </div>
  </div>
<?php
  include("bottom.html");
?>