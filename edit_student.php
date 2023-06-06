<?php

include 'db_connection.php';

// Check if the student ID is provided in the URL
if (isset($_GET['id'])) {
  $studentId = $_GET['id'];

  // Fetch the student details from the database
  $result = $conn->query("SELECT * FROM students WHERE id = $studentId");

  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Retrieve the form data
      $name = $_POST['name'];
      $rollNumber = $_POST['roll_number'];
      $department = $_POST['department'];
      $hostel = $_POST['hostel'];

      // Update the student record in the database
      $sql = "UPDATE students SET name='$name', roll_number='$rollNumber',
              department='$department', hostel='$hostel' WHERE id=$studentId";

      if ($conn->query($sql) === TRUE) {
        // Redirect back to the landing page
        header("Location: index.php");
        exit();
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }
  } else {
    echo "Student not found.";
  }
} else {
  echo "Student ID not provided.";
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Student Details</title>
  
</head>
<body bgcolor="tan">
  <a href="index.php"><input type ='submit' value='back' class ='back'></a><br><br>
<h2 align=center style="font-family: tahoma;" > FILL BELOW DETAILS:</h2>

  <style>

.student-form {
  width: 400px;
  margin: 0 auto;
}

/* Form labels */
.student-form label {
  display: block;
  margin-bottom: 10px;
  font-weight: bold;
   font-family: arial;
}

/* Form input fields */
.student-form input[type="text"],
.student-form input[type="number"],
.student-form select {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-bottom: 10px;

}

/* Form submit button */
.student-form input[type="submit"] {
  background-color: #4CAF50;
  color: white;
  padding: 10px 15px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.student-form input[type="submit"]:hover {
  background-color: #45a049;
}

/* Form field validation error message */
.student-form .error-message {
  color: red;
  font-size: 12px;
  margin-top: -10px;
  margin-bottom: 10px;

}

/* Success message */
.student-form .success-message {
  color: green;
  font-size: 14px;
  margin-top: -10px;
  margin-bottom: 10px;
}
</style>
  
  
  <?php if ($result->num_rows == 1) { ?>
    <form class="student-form" method="POST"  action="<?php echo $_SERVER["PHP_SELF"] . "?id=" . $studentId; ?>">
      <label for="name">Name:</label>
      <input type="text" name="name" id="name" value="<?php echo $row['name']; ?>" required><br><br>
  
      <label for="roll_number">Roll Number:</label>
      <input type="text" name="roll_number" id="roll_number" value="<?php echo $row['roll_number']; ?>" required><br><br>
  
      <label for="department">Department:</label>
      <input type="text" name="department" id="department" value="<?php echo $row['department']; ?>" required><br><br>
  
      <label for="hostel">Hostel:</label>
      <input type="text" name="hostel" id="hostel" value="<?php echo $row['hostel']; ?>" required><br><br>

      <input type="submit" value="update details" name="update">
  
     
    </form>
  <?php } ?>
</body>
</html>
