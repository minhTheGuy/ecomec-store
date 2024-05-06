// image modal viewer
$(".search-img").click(function () {
  var imgSrc = $(this).attr("src");
  $("#img-modal img").attr("src", imgSrc);
  $("#img-modal").modal("show");
});

// get cart and wishlist number
function getCartAndWishlistNum() {
  $.ajax({
    url: "./api/cart_wishlist_num.php",
    type: "GET",
    success: function (response) {
      var data = JSON.parse(response);
      console.log(data);
      $("#cart_num").text(data.cart_count);
      $("#wishlist_num").text(data.wishlist_count);
    },
    error: function (error) {
      console.log(error);
    },
  });
}

$(document).ready(function () {
  getCartAndWishlistNum();
});

// delete cart item
$(".delete-btn").click(function () {
  let isConfirm = confirm("delete this from cart?");
  if (isConfirm) {
    $.ajax({
      url: "./api/delete_cart.php",
      type: "POST",
      data: {
        delete: 1,
        cart_id: $(this).siblings('input[name="cart_id"]').val(),
      },
      success: function (response) {
        $(document).ready(function () {
          $.bootstrapGrowl("<?= $_SESSION['message'] ?>", {
            type: "success",
            align: "center",
            width: "auto",
            allow_dismiss: true,
          });
        });
        location.reload();
      },
    });
  } else {
    return false;
  }
});

// delete all cart item
$(".delete-all-btn").click(function () {
  let isConfirm = confirm("delete all from cart?");
  if (isConfirm) {
    $.ajax({
      url: "./api/delete_cart.php",
      type: "GET",
      data: {
        delete_all: 1,
      },
      success: function (response) {
        location.reload();
      },
    });
  } else {
    return false;
  }
});
