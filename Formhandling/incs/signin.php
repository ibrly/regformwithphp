<?php
if (isset($_POST['signin'])) {

    require 'conn.php';
    $Email = $_POST['em'];
    $Password = $_POST['pw'];
    if (empty($Email) || empty($Password)) {
        header("Location: ../index.php?error=emptyfields");
        exit();
    } else {
        $sql = 'SELECT * FROM auth WHERE email= ?';
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../index.php?error=sqlerror");
            exit();

        } else {
            mysqli_stmt_bind_param($stmt, "s", $Email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
               $pwtest = password_verify($Password, $row['upasswrod']);
                if ($pwtest == 1) {
                    session_start();
                    $_SESSION['uid'] = $row['id'];
                    $_SESSION['uuid'] = $row['Uname'];
                    header("Location: ../index.php?login=success");
                    print_r($row);
                    exit();

                } else {
                    header("Location: ../index.php?error=wrongpassword");

                    exit();
                }
            } else {
                header("Location: ../index.php?error=nouser");
                exit();
            }
        }
    }
} else {
    header("Location: ../index.php");
    exit();
}