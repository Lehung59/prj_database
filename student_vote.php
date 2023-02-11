<?php
                session_start();
                $_SESSION['std_vote'] = $_POST['vote'];
                $_SESSION['id2'] = $_POST['id2'];
                $_SESSION['student_id'] = $_POST['std_id'];
                $_SESSION['role'] = $_POST['role'];
                $id2 = $_SESSION['id2'];
                $role = $_SESSION['role'];

                $std_voting=$_SESSION['std_vote'];
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "teamdb";
                // Create connection
                $conn = mysqli_connect($servername, $username, $password,$dbname);
                // $student_id=64;
                $student_id=$_SESSION['student_id'];
                $class_id = 0; 
                $id = trim($_GET["id"]);

                $sql2 = "SELECT TeacherID FROM class WHERE ClassID='$class_id'" ;
                $results = mysqli_query($conn, $sql2);
                $row1 = mysqli_fetch_assoc($results);
                $teacher_id = $row1['TeacherID'];

                $sql1 = "UPDATE purchase_1 SET Student_voting_rate='$std_voting' WHERE StudentID=$student_id AND ClassID=$id";
                if(mysqli_query($conn, $sql1)){
                    echo "Records inserted successfully.";
                    header('Location: your_infor.php'."?id2=".urlencode($id2)."&role=".urlencode($role), true, 303);
                    exit;
                }
?>