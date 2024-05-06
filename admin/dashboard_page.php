<!-- MAIN -->
<main>
    <div class="head-title">
        <div class="left">
            <h1>Dashboard</h1>
            <ul class="breadcrumb">
                <li>
                    <a href="#">Dashboard</a>
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
                    include '../api/dashboard.php';
                    $dashboard = new Dashboard();
                    $orders = $dashboard->getOrders();
                    if ($orders) {
                        echo $orders->num_rows;
                    }
                    ?>
                </h3>
                <p>New Orders</p>
            </span>
        </li>
        <li>
            <i class='bx bxs-group'></i>
            <span class="text">
                <h3>
                    <?php
                    $users = $dashboard->getUsers();
                    if ($users) {
                        echo $users->num_rows;
                    }
                    ?>
                </h3>
                <p>Users</p>
            </span>
        </li>
        <li>
            <i class='bx bxs-dollar-circle'></i>
            <span class="text">
                <h3>
                    <?php
                    $totalSales = $dashboard->getTotalSales();
                    echo $totalSales . ' vnđ';
                    ?>
                </h3>
                <p>Total Sales Today</p>
            </span>
        </li>
    </ul>


    <div class="table-data bg-secondary-subtle p-5 rounded-5">
        <div class="order">
            <div class="head d-flex justify-content-between">
                <h3>Recent Orders</h3>
                <form method="post">
                    <input type="text" name="search" placeholder="Search">
                    <input type="submit" value="search" class="btn btn-primary btn-sm">
                </form>
            </div>
            <div class="bg-body-tertiary p-3 rounded-5">
                <table class="table table-light table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>UID</th>
                            <th>Number</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Total Products</th>
                            <th>Total Price</th>
                            <th>Placed On</th>
                            <th>Status</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                        if (isset($_POST['search'])) {
                            $search = $_POST['search'];
                            $orders = $dashboard->searchOrder($search);
                        }

                        if ($orders) {
                            while ($result = $orders->fetch_assoc()) {
                        ?>
                                <tr>
                                    <td><?php echo $result['name']; ?></td>
                                    <td><?php echo $result['user_id']; ?></td>
                                    <td><?php echo $result['number']; ?></td>
                                    <td><?php echo $result['email']; ?></td>
                                    <td><?php echo $result['address'] ?></td>
                                    <td><?php echo $result['total_products']; ?></td>
                                    <td><?php echo $result['total_price']; ?> vnđ</td>
                                    <td><?php echo $result['placed_on']; ?></td>
                                    <td class="<?= $result['payment_status'] == 'processed' ? 'text-success' : 'text-info' ?>"><?php echo $result['payment_status']; ?></td>
                                    <!-- <td><a href="../api/process_order.php?action=process&id=<?= $result['id']; ?>">Process</a></td> -->
                                    <?php if ($result['payment_status'] == 'pending') { ?>
                                        <td><a href="../api/process_order.php?action=process&id=<?= $result['id']; ?>">Process</a></td>
                                    <?php } else { ?>
                                        <td></td>
                                    <?php } ?>

                                    <td><a href="../api/process_order.php?action=delete&id=<?= $result['id']; ?>">Delete</a></td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo '<tr><td colspan="11">No orders found</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<!-- MAIN -->