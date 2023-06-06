<?php

include 'db_connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  $name = $_POST['name'];
  $rollNumber = $_POST['roll_number'];
  $department = $_POST['department'];
  $hostel = $_POST['hostel'];

  // Insert the new student into the database
  $sql = "INSERT INTO students (name, roll_number, department, hostel)
          VALUES ('$name', '$rollNumber', '$department', '$hostel')";

  if ($conn->query($sql) === TRUE) {
    
    header("Location: index.php");
    exit();
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}
?>


<html>
<head>
  <title >Add New Student</title>
  
</head>
<body bgcolor="tan">
  <h1 style="font-family: Tahoma;" ><center>Add New Student</center></h1>
  <a href="index.php"><input type ='submit' value='back' class ='back'></a>

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
  background-color:black;
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
  
  <form class="student-form" method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <label for="name"><h3 style="font-family:arial;">Name:</h3></label>
    <input type="text" name="name" id="name" required><br>
  
    <label for="roll_number"><h3 style="font-family:arial;">Roll Number:</h3></label>
    <input type="text" name="roll_number" id="roll_number" required>
  
    <label for="department"><h3 style="font-family:arial;">Department:</h3></label>
    <input type="text" name="department" id="department" required><br>
  
    <label for="hostel"><h3 style="font-family:arial;">Hostel:</h3></label>
    <input type="text" name="hostel" id="hostel" required><br><br>
  
    <input type="submit" value="Add Student">
  
  </form >
 

</body>
</html>
