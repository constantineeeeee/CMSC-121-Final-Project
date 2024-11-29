<?php
  include("top.html");
?>
  <div class="login">
      <div class="login2">
        <h2>SIGNUP</h2>
        <form action="student-signup-check.php" method="post">
            <label>Username <input type="text" name="username"> </label> <br/>
            <label>Password <input type="password" name="password"></label> <br/>
            <input type="submit" value="Sign Up">            
          </form>
      </div>
    </div>

<?php
  include("bottom.html");
?>