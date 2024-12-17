<?php
session_start();
// Database connection configuration
$servername = "localhost";
$username = "root"; 
$password = "";  
$dbname = "inventory";
include("db-connect.php");

// Function to fetch all borrow records
function getBorrowRecords($db) {
    // $sql = "SELECT b.SID, s.firstname, s.lastname, b.IID, i.itemName, b.quantity, b.date, b.status 
    $sql = "SELECT SID, IID, firstname, lastname, itemName, borrow.quantity, date, status 
            FROM borrow 
            JOIN student ON borrow.SID = student.ID 
            JOIN item ON borrow.IID = item.itemID";

    $result = $db->query($sql);
    
    return $result;
}

// Function to update borrow status
function updateBorrowStatus($db, $sid, $iid, $date, $newStatus) {
    $sid = (int)$sid;
    $iid = (int)$iid;
    $date = $db->quote($date);
    $newStatus = $db->quote($newStatus);

    try{
        $sql = "UPDATE borrow SET status = $newStatus WHERE SID = $sid AND IID = $iid AND date = $date";
        $db->exec($sql);    
        return true;
    }
    catch (Exception $e){
        return false;
    }
}

// Handle status update if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update_status'])) {
        $sid = $_POST['sid'];
        $iid = $_POST['iid'];
        $date = $_POST['date'];
        $newStatus = $_POST['status'];        

        if (updateBorrowStatus($db, $sid, $iid, $date, $newStatus)) {
            echo "<p style='color: green;'>Status updated successfully!</p>";
        } else {
            echo "<p style='color: red;'>Error updating status.</p>";
        }
    }
}

// Fetch current borrow records
$borrowRecords = getBorrowRecords($db);
?>
<?php
  include("top.html");

  if(!isset($_SESSION["adminUserCheck"])){
    header("Location: index.php");
    session_destroy();
  }

?>
  <div id="logout" hidden>LOGOUT</div>
  <div id="hrefLink" hidden>logout.php</div>
  <div id="homeLink" hidden>admin-menu.php</div>
  <div id="bgImg" hidden>none</div>

</head>
<body>
    <h1>Borrow Records</h1>
    <table class="borrowSlip">
        <tr>
            <th>Student ID</th>
            <th>Student</th>
            <!-- <th>Item ID</th> -->
            <th>Item</th>
            <th>Quantity</th>
            <th>Date Requested</th>
            <th>Current Status</th>
            <th>Action</th>
        </tr>
        <?php foreach ($borrowRecords as $record): ?>
        <tr>
            <td><?=$record['SID'] ?></td>
            <td><?= $record['firstname'] . ' ' . $record['lastname']; ?></td>
            <td><?=$record['itemName'] ?></td>
            <td><?=$record['quantity'] ?></td>
            <td><?=$record['date'] ?></td>
            <td><?=$record['status'] ?></td>
            <td>
                <form method="POST" action="">
                    <input type="hidden" name="sid" value="<?= $record['SID']; ?>" hidden>
                    <input type="hidden" name="iid" value="<?= $record['IID']; ?>" hidden>
                    <input type="hidden" name="date" value="<?= $record['date']; ?>" hidden>
                    <select name="status">
                        <option value="Pending" <?= $record['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="Confirmed" <?= $record['status'] == 'Confirmed' ? 'selected' : '' ?>>Confirmed</option>
                    </select>
                    <input class="admBtn" type="submit" name="update_status" value="Update">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

<?php
?>
<?php 
  include("bottom.html");  
?>