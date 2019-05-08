<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpassword = "";
$dbname = "mathprobdb";
$con = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
$probIdArr = array();
$probContArr = array();
$assIdArr = array();
$assNameArr = array();
if(isset($_POST['problem'])) {
    $prob = $_POST['problem'];
    if($prob != "" || $prob != null) {
        $query = "INSERT INTO problem VALUES (DEFAULT, '$prob')";
        if (mysqli_query($con, $query)) {
            echo "New question created successfully";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($con);
        }
    }
    else
        echo "Please enter a question to add.";
}
if(isset($_POST['assignmentVal'])) {
    $ass = $_POST['assignmentVal'];
    $query = "INSERT INTO assignment VALUES (DEFAULT, '$ass')";
    mysqli_query($con, $query);
}
if(isset($_POST['idProblem'])) {
    $r = $_POST['idProblem'];
    $newProb = addslashes($_POST['prob']);
    $query = "DELETE FROM problem WHERE pid='$r'";
    if (mysqli_query($con, $query)) {
        echo "Problem #" . $r . " successfully removed.";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($con);
    }
}
if(isset($_POST['dropAssId'])) {
    $assNum = $_POST['dropAssId'];
    $probNum = $_POST['dropProbId'];
    if($assNum != "" || $assNum != 0)  {
        $query = "SELECT * FROM mapping WHERE problem_id='$probNum' AND assignment_id='$assNum'";
        $maps = mysqli_query($con, $query);
        if(mysqli_num_rows($maps)==0){
            $query = "INSERT INTO mapping VALUES (DEFAULT, '$probNum', '$assNum')";
            if(mysqli_query($con, $query))  {
                echo "The assignment was successfully added to question #" . $probNum . ".";
            } else  {
                echo "Error: " . $query . "<br>" . mysqli_error($con);
            }
        } else  {
            echo "Problem #" . $probNum . " already belongs to the selected assignment.";
        }
    } else  {
        echo "Please select a valid assignment.";
    }
}
if(isset($_POST['idAssignment'])) {
    $r = $_POST['idAssignment'];
    if(isset($_POST['sort'])) {
        $query = "SELECT pid, content FROM problem,
                  (SELECT * FROM mapping WHERE assignment_id='$r') AS A
                  WHERE pid=problem_id ORDER BY pid ASC";
        $result = mysqli_query($con, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $probIdArr[] = $row['pid'];
            $probContArr[] = $row['content'];
        }
    } else  {
        $newAss = $_POST['ass'];
        $query = "UPDATE assignment SET name='$newAss' WHERE aid='$r'";
        if (mysqli_query($con, $query)) {
            echo "Assignment successfully updated.";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($con);
        }
        $query = "SELECT pid, content FROM problem ORDER BY pid ASC";
        $result = mysqli_query($con, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $probIdArr[] = $row['pid'];
            $probContArr[] = $row['content'];
        }
    }
}   else    {
    $query = "SELECT pid, content FROM problem ORDER BY pid ASC";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $probIdArr[] = $row['pid'];
        $probContArr[] = $row['content'];
    }
}
$query = "SELECT aid, name FROM assignment ORDER BY aid DESC";
$result = mysqli_query($con, $query);
if($result != null) {
    while ($row = mysqli_fetch_assoc($result)) {
        $assIdArr[] = $row['aid'];
        $assNameArr[] = $row['name'];
    }
}
?>