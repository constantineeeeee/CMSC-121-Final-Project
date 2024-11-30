<?php
  include("top.html");
?>
 <div class="login">
      <div class="login2">
        <h2>LOGIN</h2>
        
        <form action="student-menu.php" method="post">
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