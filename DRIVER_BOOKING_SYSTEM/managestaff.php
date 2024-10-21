<html>
    <head>
        <title>Manage staff</title>
        <link rel="stylesheet" href="managestaff.css">
    </head>
    <body>
        <nav class="ViewCandidatesNav">
            <h1 class="ViewCandidatesNavHeading"> Drivers</h1>
            <div class="ViewCandidatesNavContainer">
            <a href="admindashboard.php">Home</a>
               
            </div>
        </nav>
        <div class="ViewCandidatesBodyContainer">
            <h1>Candidates</h1>

            <?php
    $conn = mysqli_connect("localhost", "root", "", "driver_booking_system");
    if(!$conn){
        echo "Database not connected";
    }

    $sql = "SELECT * FROM `users` where user_type='driver'";
    $data=mysqli_query($conn,$sql);
    if(mysqli_num_rows($data)>0){
    
        echo "<table border=1 >";
        echo "<tr>";
        echo "<th>Name</th>";
        echo "<th>Email</th>";
        echo "<th>Phone Number</th>";
        echo "<th>User ID</th>";
        echo "</tr>";

        while($row=mysqli_fetch_assoc($data)){
            $email = $row['email'];
            echo "<tr>";
            echo "<td>".$row['username']."</td>";
            echo "<td>".$row['email']."</td>";
            echo "<td>".$row['phno']."</td>";
            echo "<td>".$row['user_id']."</td>";
            echo "<td>
                    <form method='POST'>
                        <button value='$email' name='userdel' type='submit'>Delete</button>
                    </form>
                </td>";
                // echo "<td>
                // <form method='post' action='staffedit.php'><button value='{$id}' name='staffedit' class='deluser' type='submit'>EDIT</button></form></td>";
 
            //   echo "</tr>";
         
        }
        echo "</table>";

    }
?>
        </div>
    </body>
</html>
<?php
$conn = mysqli_connect("localhost", "root", "", "driver_booking_system");
if(!$conn){
    echo "Database not connected";
}

if(isset($_POST['userdel'])){
    $email = $_POST['userdel'];
    if(!empty($_POST['userdel'])){
        $sql = "DELETE FROM `users` WHERE `email`='$email'";
        $data = mysqli_query($conn, $sql);
        $sql1 = "DELETE FROM `login` WHERE `email`='$email'";
        $data1 = mysqli_query($conn, $sql1);
         echo "<script>window.location.replace('managestaff.php');</script>";
    }
}
?>