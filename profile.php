<?php
$sql = "SELECT * FROM `user_info` WHERE user_id =" . $_SESSION['id'];
$result = $conn->query($sql);
$username = "";
$number = "";
$email = "";
$address1 = "";
$address2 = "";
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row['name'];
    $number = $row['number'];
    $email = $row['email'];
    $address1 = $row['address'];
    $address2 = $row['address2'];
}
?>
<div class="container mt-5">
    <div class="">
        <div class="row container d-flex justify-content-center">
            <div class="col-xl-8 col-md-12">
                <div class="card user-card-full">
                    <div class="row p-3">
                        <div class="col-sm-4 bg-c-lite-green user-profile">
                            <div class="card-block text-center">
                                <div class="mb-2">
                                    <img src="https://img.icons8.com/bubbles/100/000000/user.png" class="img-radius" alt="User-Profile-Image">
                                </div>
                                <h6 class="fw-600">
                                    <?php if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
                                        echo $username;
                                    } else {
                                        echo "Guest";
                                    }
                                    ?>
                                </h6>
                                <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                            </div>
                            <div class="row d-flex justify-content-center">
                                <div class="col-4">
                                    <a href="?page=profile&action=edit" class="btn btn-sm btn-primary">Edit Profile</a>
                                </div>
                                <div class="col-4">
                                    <a href="?page=profile&action=change" class="btn btn-sm btn-primary">Change Password</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="card-block">
                                <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h6>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p class="mb-1 fw-bold">Email:</p>
                                        <h6 class="text-muted fw-400">
                                            <?php if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
                                                echo $email;
                                            } else {
                                                echo "Guest";
                                            }
                                            ?>
                                        </h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="mb-1 fw-bold">Phone:</p>
                                        <h6 class="text-muted f-w-400">
                                            <?php if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
                                                echo $number;
                                            } else {
                                                echo "Guest";
                                            }
                                            ?>
                                        </h6>
                                    </div>
                                </div>
                                <h6 class="mb-2 mt-3 pb-2 fw-bold">Address</h6>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Address 1</p>
                                        <h6 class="text-muted f-w-400">
                                            <?php if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
                                                echo $address1;
                                            } else {
                                                echo "None";
                                            }
                                            ?>
                                        </h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Address 2</p>
                                        <h6 class="text-muted f-w-400">
                                            <?php if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
                                                echo $address2;
                                            } else {
                                                echo "None";
                                            }
                                            ?>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>