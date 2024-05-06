<div class="modal fade" id="modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header p-5 pb-4 border-bottom-0">
                <h1 class="fw-bold mb-0 fs-2">Checkout Confirmation</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-5 pt-0">
                <form action="./api/create_order.php" method="post">
                    <?php
                    $uid = $_SESSION['id'];
                    
                    $sql = "SELECT * FROM user_info WHERE user_id = $uid";
                    $user_info = $conn->query($sql);
                    
                    $sql = "SELECT * FROM cart WHERE user_id = $uid";
                    $cart_item = $conn->query($sql);
                    $total_price = 0;
                    while ($fetch_cart_item = $cart_item->fetch_assoc()) {
                        $total_price += $fetch_cart_item['price'] * $fetch_cart_item['quantity'];
                    }
                    
                    if ($user_info->num_rows > 0) {
                        $fetch_user_info = $user_info->fetch_assoc();
                    ?>
                        <input type="hidden" name="uid" value="<?= $uid; ?>">
                        <input type="hidden" name="total" value="<?= $total_price; ?>">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Full name" value="<?= $fetch_user_info['name']; ?>" required>
                                <div class="invalid-feedback">
                                    Valid name is required.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="phone" class="form-label">Phone number</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text">
                                        <i class="bi bi-telephone"></i>
                                    </span>
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value="<?= $fetch_user_info['number']; ?>" required>
                                    <div class="invalid-feedback">
                                        Your phone number is required.
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?= $fetch_user_info['email']; ?>" required>
                                    <div class="invalid-feedback">
                                        Your email address is required.
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="address" class="form-label">Address</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text">
                                        <i class="bi bi-house"></i>
                                    </span>
                                    <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="<?= $fetch_user_info['address']; ?>" required>
                                    <div class="invalid-feedback">
                                        Your address is required.
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="address2" class="form-label">Address 2 <span class="text-body-secondary">(Optional)</span></label>
                                <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
                            </div>
                        </div>
                    <?php
                    } else {
                        
                    ?>
                        <div class="row g-3">
                            <input type="hidden" name="uid" value="<?= $uid; ?>">
                            <input type="hidden" name="total" value="<?= $total_price; ?>">
                            <div class="col-sm-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Full name" value="" required>
                                <div class="invalid-feedback">
                                    Valid name is required.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="phone" class="form-label">Phone number</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text">
                                        <i class="bi bi-telephone"></i>
                                    </span>
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" required>
                                    <div class="invalid-feedback">
                                        Your phone number is required.
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
                                    <div class="invalid-feedback">
                                        Your email address is required.
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="address" class="form-label">Address</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text">
                                        <i class="bi bi-house"></i>
                                    </span>
                                    <input type="text" class="form-control" id="address" name="address" placeholder="Address" required>
                                    <div class="invalid-feedback">
                                        Your address is required.
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="address2" class="form-label">Address 2 <span class="text-body-secondary">(Optional)</span></label>
                                <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <hr class="my-4">

                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="same-address" required>
                        <label class="form-check-label" for="same-address">Shipping address is the same as my billing address</label>
                    </div>

                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="save-info" name="save_info">
                        <label class="form-check-label" for="save-info">Save this information for next time</label>
                    </div>

                    <hr class="my-4">

                    <h4 class="mb-3">Payment</h4>

                    <div class="my-3">
                        <div class="form-check">
                            <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked="" required="">
                            <label class="form-check-label" for="credit">ShipCod</label>
                        </div>
                    </div>

                    <hr class="my-4">

                    <button class="w-100 btn btn-primary btn-lg" type="submit">Continue to checkout</button>
                </form>
            </div>
        </div>
    </div>
</div>
