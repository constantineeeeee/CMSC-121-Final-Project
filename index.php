<?php
  include("top.html");
?>
    <div class="login">
      <div class="login2">
        <!-- <h2>WELCOME TO GEN LAB BORROWING SERVICES</h2> -->
        <a href="student-login.php" class="loginButton" id="studentButton" onclick="setVal('ADMIN')">
          <div class="studentButton">
            <img src="assets/images/studentIcon.png" alt="">
            <h4>
              Student
            </h4>
          </div>
        </a>

        <a href="admin-login.php" class="loginButton" id="adminButton" onclick="setVal('STUDENT')">

          <div class="adminButton">
            <img src="assets/images/adminIcon.png" alt="">
            <h4>Admin</h4>
          </div>
        </a>

      </div>
    </div>
<?php
  include("bottom.html");
?>