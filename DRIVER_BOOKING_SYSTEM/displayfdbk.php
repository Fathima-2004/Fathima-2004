<html>
    <head>
        <title>Feedbacks</title>
        <link rel="stylesheet" href="displayfdbk.css">
    </head>
    <body>
        <nav class="ViewCandidatesNav">
            <h1 class="ViewCandidatesNavHeading">Feedbacks</h1>
            <div class="ViewCandidatesNavContainer">
            <a href="admindashboard.html">Home</a>
               
            </div>
        </nav>
        <div class="ViewCandidatesBodyContainer">
            <h1>Users</h1>

            <?php
    $conn = mysqli_connect("localhost", "root", "", "driver_booking_system");
    if(!$conn){
        echo "Database not connected";
    }

    $sql = "SELECT * FROM `feedback` ";
    $data=mysqli_query($conn,$sql);
    if(mysqli_num_rows($data)>0){
    
        echo "<table border=1 >";
        echo "<tr>";
        echo "<th>Name</th>";
        echo "<th>Email</th>";
        echo "<th>Feedback</th>";
        echo "<th>User ID</th>";
        echo "</tr>";

        while($row=mysqli_fetch_assoc($data)){
            $email = $row['email'];
            echo "<tr>";
            echo "<td>".$row['username']."</td>";
            echo "<td>".$row['email']."</td>";
            echo "<td>".$row['feedback']."</td>";
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
        $sql = "DELETE FROM `feedback` WHERE `email`='$email'";
        $data = mysqli_query($conn, $sql);
         echo "<script>window.location.replace('admindashboard.php');</script>";
    }
}
?>