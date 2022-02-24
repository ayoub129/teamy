<?php 

require_once("includes/header.php");
session_start();

if(!isset($_SESSION['id'])) {
  header("Location:login.php");
} 

if(isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
}

?>
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center">
        <span  class="text-dark"><span class="text-primary">T</span>eamy </span>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="index.php#hero">Home</a></li>
          <li>
            <form method="POST">
                <button type="submit" name="logout" class="getstarted border-0 scrollto" >Logout</button>
             </form>    
         </li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center">
          <h1 data-aos="fade-up" class="mb-3">Waite Until You Got Approved  </h1>
          <h2 data-aos="fade-up" data-aos-delay="400">You Can't Access Your Team Until You Get Approved By The Admin</h2>
        </div>
        <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
          <img src="assets/images/hero-img.png" class="img-fluid" alt="">
        </div>
      </div>
    </div>
  </section><!-- End Hero -->


  <footer id="footer" class="footer">
  <div class="container">
    <div class="copyright">
      &copy; Copyright <strong class="ms-1">  Teamy</strong>. All Rights Reserved <p>
      Designed by <a href="https://DigitalFountain.com/">Digital Fountain</a></p>
    </div>
  </div>
  </footer> <!-- end footer -->

  <?php require_once("includes/footer.php") ?>
