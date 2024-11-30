<?php
  include("top.html");
?>
  <div id="logout" hidden>ADMIN LOGIN</div>
  <div id="hrefLink" hidden>admin-login.php</div>
 <div class="login">
      <div class="login2">
        <h2>LOGIN</h2>
        
        <form action="student-login-check.php" method="post">
            <label>Username <input type="text" name="username"> </label> <br/>
            <label>Password <input type="password" name="password"></label> <br/>
            <input type="submit" value="Login">
            <p>Click <a href="signup.php" class="signupButton"> here </a> to sign up</p>
        </form>
          
      </div>
    </div>
<?php
  include("bottom.html");
?>