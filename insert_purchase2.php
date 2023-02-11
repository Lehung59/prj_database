<?php

                session_start();
                $_SESSION['id2'] = $_POST['id2'];
                $_SESSION['role'] = $_POST['role'];
                // $_SESSION['student_id'] = $_POST['std_id'];
                $id2 = $_SESSION['id2'];
                $role = $_SESSION['role'];
                // $student_id=$_SESSION['student_id'];

                $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                $url_components = parse_url($actual_link);
                parse_str($url_components['query'], $params);
                $iddd = (int) $params['id2'];




                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "teamdb";
                // Create connection
                $conn = mysqli_connect($servername, $username, $password,$dbname);
                // $student_id=4;
                
                $class_id = trim($_GET["id"]); 

                $sql2 = "SELECT SubjectName FROM class JOIN subject ON class.SubjectID = subject.SubjectID WHERE ClassID='$class_id'" ;
                $results = mysqli_query($conn, $sql2);
                $row1 = mysqli_fetch_assoc($results);
                $subject_name = $row1['SubjectName'];

                $sql3="SELECT * FROM purchase_1 WHERE ClassID='$class_id' AND StudentID='$id2'";
                $result3 = mysqli_query($conn, $sql3);

                $sql1 = "INSERT INTO purchase_1 (ClassID,StudentID,Evaluation_score,Student_voting_rate, State) VALUES($class_id,$id2, '0','0', 'Not paid' ) ";
                if (mysqli_num_rows($result3) == 0) {
                    if(mysqli_query($conn, $sql1)===true){
                        echo "Records inserted successfully.";
                        header('Location: search_class.php?id='. rawurlencode($subject_name)."&id2=".urlencode($id2)."&role=".urlencode($role), true, 303);
                    exit;
                    }
                }
                else{
                    header('Location: search_class.php?id='. rawurlencode($subject_name)."&id2=".urlencode($id2)."&role=".urlencode($role), true, 303);
                }
?>