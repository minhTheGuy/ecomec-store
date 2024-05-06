<header class="header">
   <nav aria-label="breadcrumb" class="d-flex justify-content-between align-items-center px-4 py-2">
      <a href="?page=home">
         <i class="bi bi-github fs-3"></i>
      </a>
      <ol class="breadcrumb mb-0 d-flex justify-content-center align-items-center">
         <li class="breadcrumb-item"><a href="#">Help</a></li>
         <li class="breadcrumb-item"><a href="#">About</a></li>
         <li class="breadcrumb-item active" aria-current="page">
            <?php
            if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
               echo "Welcome back '" . $_SESSION['username'] . "'";
            } else {
               echo "<a href='./login/login.php'>Login</a>";
            }
            ?>
         </li>
         <?php
         if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
            echo "<li class='breadcrumb-item'><a href='?page=profile'>Profile</a></li>";
         }
         ?>
         <li class="breadcrumb-item">
            <?php if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
               echo "<a href='?action=logout'>Logout</a>";
               if (isset($_GET['action']) && $_GET['action'] == 'logout') {
                  session_destroy();
               }
            } else {
               echo "<a href='./login/register.php'>Register</a>";
            }
            ?>
         </li>
      </ol>
   </nav>
   <nav class="navbar navbar-expand-sm navbar-light bg-light mb-3 sticky-top">
      <div class="container-fluid px-4">
         <a class="navbar-brand jersey-25-charted-regular" href="index.php?page=home" style="font-size: 2rem;">ECOMEC</a>
         <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav ms-auto gap-3">
               <li class="nav-item">
                  <a class="nav-link" href="index.php?page=search">New &amp; Featured</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="index.php?page=search&category=men">Men</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="index.php?page=search&category=women">Women</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="index.php?page=search&category=kids">Kids</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="index.php?page=search&category=sale">Best Price</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="index.php?page=search"><i class="fas fa-search"></i>Search</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="index.php?page=wishlist"><i class="fas fa-heart"></i>(<span id="wishlist_num"></span>)</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="index.php?page=cart"><i class="fas fa-shopping-cart"></i>(<span id="cart_num"></span>)</a>
               </li>
            </ul>
         </div>
      </div>
   </nav>
</header>