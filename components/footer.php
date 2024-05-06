<footer class="footer bg-body-tertiary">
   <div class="container">
      <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-5 py-5 my-5 border-top">
         <div class="col mb-3">
            <a href="#" class="d-flex align-items-center mb-3 link-body-emphasis text-decoration-none">
               <i class="bi bi-github fs-3"></i>
            </a>
            <p class="text-body-secondary">© 2024</p>
         </div>

         <div class="col mb-3">

         </div>

         <div class="col mb-3">
            <h5>Overview</h5>
            <ul class="nav flex-column">
               <li class="nav-item mb-2"><a href="?page=home" class="nav-link p-0 text-body-secondary">Home</a></li>
               <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">FAQs</a></li>
               <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">About</a></li>
            </ul>
         </div>

         <div class="col mb-3">
            <h5>Contribution</h5>
            <ul class="nav flex-column">
               <li class="nav-item mb-2"><a href="?page=search" class="nav-link p-0 text-body-secondary">Shop Now</a></li>
               <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Members</a></li>
               <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Source Code</a></li>
            </ul>
         </div>

         <div class="col mb-3">
            <h5>Contact Us</h5>
            <ul class="nav flex-column">
               <li class="nav-item mb-2"><a href="mailto:dangminh1312@gmail.com" class="nav-link p-0 text-body-secondary">Email Us</a></li>
               <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Hotline: 0815252789</a></li>
            </ul>
         </div>
      </footer>
   </div>
</footer>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
   var swiper = new Swiper(".mySwiper", {
      effect: "coverflow",
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: "auto",
      autoplay: {
         delay: 2500,
         disableOnInteraction: false
      },
      coverflowEffect: {
         rotate: 50,
         stretch: 0,
         depth: 100,
         modifier: 1,
         slideShadows: true,
      },
      pagination: {
         el: ".swiper-pagination",
      },
   });
</script>

<?php
   if (isset($_GET['page'])) {
      $page = $_GET['page'];
      switch ($page) {
         case 'profile':
            echo "<script>document.querySelector('footer').classList.add('fixed-bottom')</script>";
            break;
      }
   }
?>