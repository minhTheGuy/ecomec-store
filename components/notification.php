<?php

if (isset($_SESSION['status']) && $_SESSION['status'] == 'success') {
?>
    <script>
        $(document).ready(function() {
            $.bootstrapGrowl("<?= $message[0] ?>", {
                type: 'success',
                align: 'center',
                width: 'auto',
                allow_dismiss: true
            });
        });
    </script>
<?php
    unset($_SESSION['message']);
    unset($_SESSION['status']);
} else if (isset($message) && (isset($_POST['add_to_cart']) || isset($_POST['add_to_wishlist']))) {
?>
    <script>
        $(document).ready(function() {
            $.bootstrapGrowl("<?= $message[0] ?>", {
                type: 'danger',
                align: 'center',
                width: 'auto',
                allow_dismiss: true
            });
        });
    </script>
<?php
} else if (isset($_POST['delete'])) {
?>
    <script>
        $(document).ready(function() {
            $.bootstrapGrowl("item deleted!", {
                type: 'danger',
                align: 'center',
                width: 'auto',
                allow_dismiss: true
            });
        });
    </script>
<?php
} else if (isset($_GET['delete_all'])) {
?>
    <script>
        $(document).ready(function() {
            $.bootstrapGrowl("all items deleted!", {
                type: 'danger',
                align: 'center',
                width: 'auto',
                allow_dismiss: true
            });
        });
    </script>
<?php
}
?>