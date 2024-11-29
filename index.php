<?php
  include("top.html");

?>
    <div class="login">
      <div class="login2">
        <h2>ADMIN LOGIN</h2>
        
        <form action="login_check.php" method="post">
            <label>Username <input type="text" name="username"> </label> <br/>
            <label>Password <input type="password" name="password"></label> <br/>
            <input type="submit" value="Login">
        </form>
      </div>
    </div>
<?php
  include("bottom.html");
?>