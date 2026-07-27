<?php
$servername = "sql213.infinityfree.com";
$username = "if0_42442169";
$password = "xZpZOo6tuE";
$dbname = "if0_42442169_myfirst";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// إضافة سجل جديد لو الفورم انبعث
if (isset($_GET['name']) && isset($_GET['age']) && $_GET['name'] !== '' && $_GET['age'] !== '') {
    $name = $conn->real_escape_string($_GET['name']);
    $age = $conn->real_escape_string($_GET['age']);
    $sql = "INSERT INTO user (Name, Age, status) VALUES ('$name', '$age', 0)";
    $conn->query($sql);
}

// تبديل الحالة (Toggle)
if (isset($_GET['toggle_id'])) {
    $id = intval($_GET['toggle_id']);
    $conn->query("UPDATE user SET status = 1 - status WHERE ID = $id");
}
?>

<!DOCTYPE html>
<html>
<body>

<h2>HTML Forms</h2>
<form action="n.php" method="get">
  Name: <input type="text" name="name" placeholder="Your name">
  Age: <input type="text" name="age" placeholder="Your age">
  <input type="submit" value="Submit">
</form>

<br>
<table border="1" cellpadding="8">
  <tr>
    <th>ID</th><th>Name</th><th>Age</th><th>Status</th><th>Action</th>
  </tr>
  <?php
  $result = $conn->query("SELECT * FROM user");
  while ($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td>" . $row['ID'] . "</td>";
      echo "<td>" . $row['Name'] . "</td>";
      echo "<td>" . $row['Age'] . "</td>";
      echo "<td>" . $row['status'] . "</td>";
      echo "<td><a href='n.php?toggle_id=" . $row['ID'] . "'><button>Toggle</button></a></td>";
      echo "</tr>";
  }
  ?>
</table>

<?php $conn->close(); ?>
</body>
</html>