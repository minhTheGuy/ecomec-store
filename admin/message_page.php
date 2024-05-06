<main>
    <div class="head-title">
        <div class="left">
            <h1>Messages</h1>
            <ul class="breadcrumb">
                <li>
                    <a href="#">Messages</a>
                </li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li>
                    <a class="active" href="#">Overview</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="table-data">
        <div class="order">
            <div class="head">
                <h3>Recent Messages</h3>
                <i class='bx bx-search'></i>
                <i class='bx bx-filter'></i>
            </div>
            <table>
                <thead>
                    <tr>
                        <th scope="col">User</th>
                        <th scope="col">Date</th>
                        <th scope="col">Message</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../api/message.php';
                    $message = new Message();
                    $messages = $message->getMessages();
                    if ($messages) {
                        while ($row = $messages->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['name'] . $row['email'] . "</td>";
                            echo "<td>" . $row['date'] . "</td>";
                            echo "<td>" . $row['message'] . "</td>";
                            echo "<td><a href='?action=delete&id=" . $row['id'] . "'>Delete</a></td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</main>