<!-- MAIN -->
<main>
    <div class="head-title">
        <div class="left">
            <h1>Store</h1>
            <ul class="breadcrumb">
                <li>
                    <a href="#">Store</a>
                </li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li>
                    <a class="active" href="#">Overview</a>
                </li>
            </ul>
        </div>
    </div>

    <ul class="box-info">
        <li>
            <i class='bx bxs-calendar-check'></i>
            <span class="text">
                <h3>
                    <?php
                    include '../api/users.php';
                    $users = new Users();
                    $result = $users->getUsers();
                    if ($result) {
                        echo $result->num_rows;
                    }
                    ?>
                </h3>
                <p>Users</p>
            </span>
        </li>
    </ul>


    <div class="table-data">
        <div class="order">
            <div class="head">
                <h3>Recent Product</h3>
                <form method="post">
                    <input type="text" name="search" placeholder="Search">
                    <input type="submit" value="search" class="btn btn-primary btn-sm">
                </form>
                <i class='bx bx-filter'></i>
            </div>
            <div class="bg-body-tertiary p-3 rounded-5">

                <table class="table table-bordered table-hover text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Created At</th>
                            <th>Role</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php

                        if (isset($_POST['search'])) {
                            $search = $_POST['search'];
                            $result = $users->searchUsers($search);
                        } else {
                            $result = $users->getUsers();
                        }

                        while ($user = $result->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?php echo $user['id']; ?></td>
                                <td><?php echo $user['username']; ?></td>
                                <td><?php echo $user['email']; ?></td>
                                <td><?php echo $user['createdAt']; ?></td>
                                <td><?php echo $user['role']; ?></td>
                                <td>
                                    <a href="?action=users&id=<?php echo $user['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                </td>
                            </tr>
                        <?php
                        }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<!-- MAIN -->