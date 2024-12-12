

  <?php
// Database connection configuration
$servername = "localhost";
$username = "121";  // Replace with your database username
$password = "121";  // Replace with your database password
$dbname = "inventory";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to fetch all borrow records
function getBorrowRecords($conn) {
    $sql = "SELECT b.SID, s.firstname, s.lastname, b.IID, i.itemName, b.quantity, b.status 
            FROM borrow b
            JOIN student s ON b.SID = s.ID
            JOIN item i ON b.IID = i.itemID";
    $result = $conn->query($sql);
    
    $borrowRecords = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $borrowRecords[] = $row;
        }
    }
    return $borrowRecords;
}

// Function to update borrow status
function updateBorrowStatus($conn, $sid, $iid, $newStatus) {
    $sql = "UPDATE borrow SET status = ? WHERE SID = ? AND IID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sii", $newStatus, $sid, $iid);
    
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

// Handle status update if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update_status'])) {
        $sid = $_POST['sid'];
        $iid = $_POST['iid'];
        $newStatus = $_POST['status'];
        
        if (updateBorrowStatus($conn, $sid, $iid, $newStatus)) {
            echo "<p style='color: green;'>Status updated successfully!</p>";
        } else {
            echo "<p style='color: red;'>Error updating status.</p>";
        }
    }
}

// Fetch current borrow records
$borrowRecords = getBorrowRecords($conn);
?>
<?php
  include("top.html");
?>
  <div id="logout" hidden>LOGOUT</div>
  <div id="hrefLink" hidden>index.php</div>

</head>
<body>
    <h1>Borrow Records</h1>
    <table class="borrowSlip">
        <tr>
            <th>Student ID</th>
            <th>Student Name</th>
            <th>Item ID</th>
            <th>Item Name</th>
            <th>Quantity</th>
            <th>Current Status</th>
            <th>Action</th>
        </tr>
        <?php foreach ($borrowRecords as $record): ?>
        <tr>
            <td><?php echo htmlspecialchars($record['SID']); ?></td>
            <td><?php echo htmlspecialchars($record['firstname'] . ' ' . $record['lastname']); ?></td>
            <td><?php echo htmlspecialchars($record['IID']); ?></td>
            <td><?php echo htmlspecialchars($record['itemName']); ?></td>
            <td><?php echo htmlspecialchars($record['quantity']); ?></td>
            <td><?php echo htmlspecialchars($record['status']); ?></td>
            <td>
                <form method="POST" action="">
                    <input type="hidden" name="sid" value="<?php echo $record['SID']; ?>">
                    <input type="hidden" name="iid" value="<?php echo $record['IID']; ?>">
                    <select name="status">
                        <option value="Pending" <?php echo ($record['status'] == 'Pending' ? 'selected' : ''); ?>>Pending</option>
                        <option value="Confirmed" <?php echo ($record['status'] == 'Confirmed' ? 'selected' : ''); ?>>Confirmed</option>
                    </select>
                    <input type="submit" name="update_status" value="Update">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

<?php
// Close the database connection
$conn->close();
?>
<?php 
  include("bottom.html");  
?>