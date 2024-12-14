<?php
  include("top.html");
?>
<div id="logout" hidden>STUDENT LOGIN</div>
<div id="hrefLink" hidden>student-login.php</div>

  <div class="login">
      <div class="login2">
        <h2>SIGNUP</h2>
        <form action="student-signup-check.php" method="post">
            <label>First Name <input type="text" name="firstname" required></label> <br/>
            <label>Last Name <input type="text" name="lastname" required></label> <br/>
            <label>Username <input type="text" name="username" required> </label> <br/>
            <label>Password <input type="password" name="password" required></label> <br/>
            <input type="submit" value="Sign Up">            
          </form>
      </div>
    </div>

<?php
  include("bottom.html");
?>