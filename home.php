<!-- Go to top button -->
<div class="position-fixed bottom-0 end-0 mb-1 me-1">
    <a class="btn btn-outline-secondary dropdown-toggle d-flex align-items-center" id="bd-theme" href="#" aria-expanded="false" style="opacity: 0.5;">
        Go To Top
    </a>
</div>


<!-- Info -->
<section class="px-4 py-2 mb-5 text-shadow">
    <p class="fw-bold text-center mb-2">Lifestyle Running Shoes</p>
    <h2 class="fw-bold fs-1 text-center">EXTRA-ORDINARY</h2>
    <p class="text-center">Meet the latest collection of retro running inspired shoes.The unlikely heroes of your easiest styling hack.</p>
    <div class="d-flex justify-content-center">
        <a href="?page=search" class="btn btn-dark px-4 py-2 rounded-pill">Buy It Now</a>
    </div>
</section>

<!-- Thumbnail -->
<div class="container px-4 py-2 mb-5">
    <img src="https://static.nike.com/a/images/f_auto/dpr_1.3,cs_srgb/w_1417,c_limit/2c87526e-3dae-45a0-94ba-345bab73619f/nike-just-do-it.png" class="img-fluid shadow-lg bg-body-tertiary rounded" alt="">
</div>

<!-- Recent Product -->
<div class="container px-4 py-5" id="featured-3">
    <h2 class="pb-2 border-bottom">Recent Products</h2>
    <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
        <?php
        include './api/database.php';
        $conn = new Database();

        $sql = "SELECT * FROM `products` LIMIT 3";
        $select_categories = $conn->query($sql);

        if ($select_categories->num_rows > 0)
            while ($fetch_category = $select_categories->fetch_assoc()) {
        ?>
            <div class="feature col">
                <div class=" d-inline-flex align-items-center justify-content-center fs-2 mb-3 img-container">
                    <img src="uploaded_img/<?= $fetch_category['image_01']; ?>" class="card-img-top img-fluid rounded-4 shadow-lg bg-body-tertiary" alt="..." style="box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);">
                </div>
                <h3 class="fs-2 text-body-emphasis"><?= $fetch_category['name']; ?></h3>
                <p><?= $fetch_category['details']; ?></p>
                <a href="?page=search&category=<?= $fetch_category['name']; ?>" class="icon-link">
                    Go to <?= $fetch_category['name']; ?>
                    <svg class="bi">
                        <use xlink:href="#chevron-right"></use>
                    </svg>
                </a>
            </div>
        <?php
            }
        ?>
    </div>
</div>

<!-- Thumbnail -->
<section class="container px-4 py-2 mb-5 text-shadow">
    <p class="fw-bold mb-0 text-center">Coming Soon</p>
    <h2 class="fw-bold fs-1 text-center">NIKE AIR MAX DN</h2>
    <p class="text-center">The next generation of Air technology launches on March 26th. Preview the full lineup of colourways now.</p>
    <div class="d-flex justify-content-center">
        <a href="https://www.nike.com/vn/" class="btn btn-dark px-4 py-2 rounded-pill">Find more in Nike</a></a>
    </div>
</section>

<!-- Show men&women products -->
<section class="container px-4 py-2 mb-5">
    <h3>Icons of Air</h3>
    <div class="swiper autoSwiper swiper-initialized swiper-horizontal swiper-backface-hidden rounded-5">
        <div class="swiper-wrapper" id="swiper-wrapper-1037a881096b939e5c" aria-live="off" style="transition-duration: 0ms; transform: translate3d(0px, 0px, 0px); transition-delay: 0ms;">
            <?php
            $sql = "SELECT * FROM `products` WHERE category LIKE '%men%' LIMIT 7";
            $select_products = $conn->query($sql);
            if ($select_products->num_rows > 0) {
                while ($fetch_product = $select_products->fetch_assoc()) {
            ?>
                    <div class="swiper-slide px-4 py-2" role="group" aria-label="4 / 5" style="width: 333px; margin-right: 30px;">
                        <div class="card bg-body-tertiary rounded-3">
                            <a href="?page=search&id=<?= $fetch_product['id']; ?>">
                                <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="" class="card-img-top img-fluid rounded-top">
                            </a>
                            <div class="card-body">
                                <h4 class="card-title
                                mb-2"><?= $fetch_product['name']; ?></h4>
                                <p><a href="?page=search&id=<?= $fetch_product['id']; ?>" class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Buy It</a></p>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "No products found";
            }
            ?>

        </div>
        <div class="swiper-button-next" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-1037a881096b939e5c" aria-disabled="false"></div>
        <div class="swiper-button-prev swiper-button-disabled" tabindex="-1" role="button" aria-label="Previous slide" aria-controls="swiper-wrapper-1037a881096b939e5c" aria-disabled="true"></div>
        <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal"><span class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0" role="button" aria-label="Go to slide 1" aria-current="true"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 2"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 3"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 4"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 5"></span></div>
        <div class="autoplay-progress">
            <svg viewBox="0 0 48 48" style="--progress: 0.4144;">
                <circle cx="24" cy="24" r="20"></circle>
            </svg>
            <span>2s</span>
        </div>
        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
    </div>
</section>

<!-- Swiper JS for above -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
    const progressCircle = document.querySelector(".autoplay-progress svg");
    const progressContent = document.querySelector(".autoplay-progress span");
    var swiper = new Swiper(".autoSwiper", {
        spaceBetween: 30,
        centeredSlides: true,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev"
        },
        on: {
            autoplayTimeLeft(s, time, progress) {
                progressCircle.style.setProperty("--progress", 1 - progress);
                progressContent.textContent = `${Math.ceil(time / 1000)}s`;
            }
        }
    });
</script>

<!-- Trending Thumbnail -->
<section class="container px-4 py-2 mb-5">
    <h2 class="text-shadow">Trending</h2>
    <div class="thumbnail">
        <div class="row">
            <div class="col-md-12">
                <a href="?page=search&category=trending">
                    <img src="https://static.nike.com/a/images/f_auto/dpr_1.3,cs_srgb/w_1416,c_limit/5dac0785-1c08-40f8-9d56-2d0fffaa0af5/nike-just-do-it.png" class="w-100 d-block shadow-lg bg-body-tertiary" alt="First slide">
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Info -->
<section class="px-4 py-2 mb-5 text-shadow">
    <p class="fw-bold text-center mb-2">Just in</p>
    <h2 class="fw-bold fs-1 text-center">AJI HIGH OG 'BLACK &amp; WHITE'</h2>
    <p class="text-center">Serve up your undeniable style in the iconic versatility of a hoops legend.</p>
    <div class="d-flex justify-content-center">
        <a href="?page=search" class="btn btn-dark px-4 py-2 rounded-pill">Shop</a>
    </div>
</section>

<!-- Swiper Slider for shoe products -->
<section class="auto-slider mb-5">
    <div class="swiper mySwiper swiper-coverflow swiper-3d swiper-initialized swiper-horizontal swiper-watch-progress">
        <div class="swiper-wrapper" id="swiper-wrapper-8cc4246823617169" aria-live="off" style="cursor: grab; transition-duration: 0ms; transform: translate3d(-1159.5px, 0px, 0px); transition-delay: 0ms;">
            <?php
            $sql = "SELECT * FROM `products` WHERE category LIKE '%shoe%' LIMIT 7";
            $select_products = $conn->query($sql);
            if ($select_products->num_rows > 0) {
                while ($fetch_product = $select_products->fetch_assoc()) {
            ?>
                    <div class="swiper-slide coverflow" role="group" aria-label="2 / 7" style="transition-duration: 0ms; transform: translate3d(0px, 0px, -300px) rotateX(0deg) rotateY(150deg) scale(1); z-index: -2;">
                        <a href="?page=search&id=<?= $fetch_product['id']; ?>" class="img-container img-slider">
                            <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" class="coverflow shadow-lg bg-body-tertiary">
                        </a>

                        <div class="swiper-slide-shadow-left swiper-slide-shadow-coverflow" style="opacity: 3; transition-duration: 0ms;"></div>
                        <div class="swiper-slide-shadow-right swiper-slide-shadow-coverflow" style="opacity: 0; transition-duration: 0ms;"></div>
                    </div>
            <?php
                }
            } else {
                echo "No products found";
            }
            ?>
        </div>
        <div class="swiper-pagination swiper-pagination-bullets swiper-pagination-horizontal"><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet swiper-pagination-bullet-active" aria-current="true"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span></div>
        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
    </div>
</section>
<!-- <div class="swiper mySwiper2">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            <img src="https://static.nike.com/a/images/f_auto/dpr_1.3,cs_srgb/w_1417,c_limit/2c87526e-3dae-45a0-94ba-345bab73619f/nike-just-do-it.png" class="img-fluid shadow-lg bg-body-tertiary rounded" alt="">
        </div>
        <div class="swiper-slide">
            <img src="https://swiperjs.com/demos/images/nature-2.jpg" />
        </div>
        <div class="swiper-slide">
            <img src="https://swiperjs.com/demos/images/nature-3.jpg" />
        </div>
        <div class="swiper-slide">
            <img src="https://swiperjs.com/demos/images/nature-4.jpg" />
        </div>
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-pagination"></div>
</div>
<script>
    var swiper = new Swiper(".mySwiper2", {
        spaceBetween: 30,
        effect: "fade",
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });
</script> -->

<?php
if (!isset($_SESSION['firstVisit']) || 1) {
    $_SESSION['firstVisit'] = true;
?>
    <!-- Modal -->
    <div class="modal fade" id="visitModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex">
                    <h5 class="modal-title" id="ModalLabel">
                        <?php
                        if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
                            echo "Welcome back '" . $_SESSION['username'] . "'";
                        } else {
                            echo "Welcome to Ecomec Store";
                        }
                        ?>
                    </h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal" aria-label="Close">OK</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#visitModal').modal('show');
            setTimeout(function() {
                $('#visitModal').modal('hide');
            }, 2000);
        })
    </script>
    <!-- Modal -->
<?php
}
?>