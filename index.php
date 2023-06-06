<?php

include 'db_connection.php';


$students = $conn->query("SELECT * FROM students");

?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport"
  content="width=device-width, initial-scale=1.0">
 <title>Student Information Management System</title>
  
  
  <style>
    body{
      margin: 0;
    }
  #header{
      width:100%;
      background-color:black;
      color: white;
      display: flex;
      font-family:Tahoma ;
    }
    #header h2{
      margin-left: 30%;
    }

    #header a{
      margin: 20px 0 0 20px;
    }
  .update,.delete{
    background-color:green;
    color: white;
    border: 0;
    outline: none;
    border-radius: 5px;
    width:60px;
    cursor: pointer;
  }   
  .delete
  {
    background-color:red;
  }

    .addnewstudent {
    border: 0;
    outline: none;
    border-radius: 5px;
    width:110px;
    height:30px;
    cursor: pointer;
    color:black;
    background-color:lightgray;

    }
    .searchbar {
      width: 41%;
      height:20px;

    }
@media screen and (max-width: 680px) {
  #header h2{
      margin-left: 10%;
    }

  table { 
    width: 100% !important;
    overflow-x: scroll; 
}
} 
    </style>
</head>
<body bgcolor="gray">
    <div id="header">
    <a href="add_student.php"><input type ='submit' value='Add new student' class ='addnewstudent'></a>
    <h2> Student Management System </h2>
    </div>
  <br><br>

  
   <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
 <center><input type="text" name="search" placeholder="Search by name" class="searchbar">
    <button type="submit">Search</button></center>
  </form><br><br>
  
<?php

if (isset($_GET['search'])) {
  $search = $_GET['search'];
  
  // Fetch the students matching the search query from the database
  $students = $conn->query("SELECT * FROM students WHERE name LIKE '%$search%'");
} else {
  // Fetch all the students from the database
  $students = $conn->query("SELECT * FROM students");
}

?>

  
  <table border ="1" width = "600" height= "60" cell spacing = "5" align= "center" cellpadding="4.5px" >

    <tr bgcolor ="BDBB76" style="color:black";
     >
      <th > Name</th>
      <th>Roll Number</th>
      <th>Department</th>
      <th>Hostel</th>
      <th>Actions</th>
    </tr>
    <?php while ($row = $students->fetch_assoc()) { ?>
      <tr bgcolor ='FFFFE0' style="color:black"; >
        <td ><?php echo $row['name']; ?></td>
        <td><?php echo $row['roll_number']; ?></td>
        <td><?php echo $row['department']; ?></td>
        <td><?php echo $row['hostel']; ?></td>
        <td>

          <a href="edit_student.php?id=<?php echo $row['id']; ?>"><input type ='submit' value='update' class ='update'> </a>
          
        
       <a href="delete_student.php?id=<?php echo $row['id']; ?>">  <input type='submit' value='delete' class ='delete' onclick='return checkdelete()'></a>
        </td>
      </tr>
    <?php } ?>
  </table>
  <script>
function checkdelete()
{
  return confirm('Are you sure you want to delete this Record');
}
  </script>

</body>
</html>
