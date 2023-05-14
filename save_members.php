<?php
include('db_connect.php');
$id = $_POST['id'];
$member_id = $_POST['member_id'];
$lastname = $_POST['lastname'];
$firstname = $_POST['firstname'];
$middlename = $_POST['middlename'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$gender = $_POST['gender'];
$address = $_POST['address'];



if (empty($id)) {
    $date = date("Y-m-d");

    if (empty($member_id)) {
        //blank member id field
        $rand = mt_rand(1, 99999999);
        $rand = sprintf("%'08d", $rand);
        $member_id = $rand;

        $chk = $conn->query("Select * from members where member_id = '$member_id'")->num_rows;
        if ($chk > 0) {
            header("Location: index.php?page=members&msg='Try Again!'");
        }

        $save = $conn->query("INSERT INTO members (member_id,firstname,middlename,lastname,gender,contact,address,email,date_created) VALUES($member_id,'$firstname','$middlename','$lastname','$gender',$contact,'$address','$email','$date')");
        if ($save) {
            header("Location: index.php?page=members&msg='Data successfully saved'");
        } else {
            header("Location: index.php?page=members&msg='Error in Saving Data'");
        }
    } else {
        $chk = $conn->query("Select * from members where member_id = '$member_id'")->num_rows;
        if ($chk > 0) {
            header("Location: index.php?page=members&msg='Member ID already exist'");
        } else {
            $save = $conn->query("INSERT INTO members (member_id,firstname,middlename,lastname,gender,contact,address,email,date_created) VALUES($member_id,'$firstname','$middlename','$lastname','$gender',$contact,'$address','$email','$date')");
            if ($save) {
                header("Location: index.php?page=members&msg='Data successfully saved'");
            } else {
                header("Location: index.php?page=members&msg='Error in Saving Data'");
            }
        }
    }
} else {
    if (empty($member_id)) {
        header("Location: index.php?page=members&msg='Member ID field cannot be left empty'");
    } else {
        $chk = $conn->query("Select * from members where member_id = '$member_id' and id!=" . $id)->num_rows;
        if ($chk > 0) {
            header("Location: index.php?page=members&msg='Member ID already exist'");
        } else {
            $save = $conn->query("UPDATE members SET member_id=$member_id,firstname='$firstname',middlename='$middlename',lastname='$lastname',gender='$gender',contact=$contact,address='$address',email='$email' WHERE id=" . $id);
            if ($save) {
                header("Location: index.php?page=members&msg='Data successfully saved'");
            } else {
                header("Location: index.php?page=members&msg='Error in Saving Data'");
            }
        }
    }
}

?>