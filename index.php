<?php 
session_start();
require "config.php";

$sections = $mysqli->query("SELECT * FROM sections")->fetch_all(MYSQLI_ASSOC);
$section_content = [];
foreach($sections as $section){
  $sections_content[$section['section_name']] = $section;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Praxis Dr.Mustermann</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<?php include "./includes/header.php" ?>
    <!-- <div class="container mt-5">
        <h1 class="display-4">Willkommen in der Praxis Dr. Mustermann</h1>
        <p class="lead">Wir bieten umfassende medizinische Versorgung für die ganze Familie.</p>
        <img src="https://images.pexels.com/photos/287237/pexels-photo-287237.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="img-fluid" alt="Praxis">
        <p><a class="btn btn-primary btn-lg" href="about.php" role="button">Mehr erfahren</a></p>
    </div> -->
    <div id="carouselExampleCaptions" class="carousel slide">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="https://images.pexels.com/photos/3825541/pexels-photo-3825541.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="d-block w-100" alt="..." style="height: 100%; background-size:cover;">
      <div class="carousel-caption ">
        <h5>First slide label</h5>
        <p>Some representative placeholder content for the first slide.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="https://images.pexels.com/photos/69686/pexels-photo-69686.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="d-block w-100" alt="..."  style="height: 100%;">
      <div class="carousel-caption">
        <h5>Second slide label</h5>
        <p>Some representative placeholder content for the second slide.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="https://images.pexels.com/photos/3845129/pexels-photo-3845129.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="d-block w-100" alt="..."  style="height: 100%;">
      <div class="carousel-caption ">
        <h5>Third slide label</h5>
        <p>Some representative placeholder content for the third slide.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<div class="container mt-5">
        <section id="about" class="about section-padding">
          <div class="container">
            <div class="row">
              <div class="col-lg-4 col-md-12 col-12">
              <div class="about-img">
                        <img src="<?php echo $sections_content['about']['image_url']; ?>" alt="über uns" class="img-fluid">
                    </div>
              </div>

              <div class="col-lg-8 col-md12 col-12 ps-lg-5 mt-md-5">
                <div class="about-text">
                  <h2>Herzlich willkomen <br>Dr Dein <span style="color:orange;">Doc</span></h2>
                  <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. A, sapiente animi mollitia maiores ducimus, vel illo quisquam itaque aspernatur vero vitae magnam asperiores sed consequatur, cupiditate ab repudiandae tempore aliquid saepe ipsa laudantium distinctio eos quibusdam! Magnam facere exercitationem magni, aliquam labore iure natus voluptatibus maxime fugiat id, nihil voluptate commodi aspernatur optio cumque modi, nemo omnis sed consectetur ducimus pariatur distinctio officiis! Suscipit sunt harum, quis repellendus distinctio aut!</p>
                  <a href="#team" class="btn btn-warning">Unser Team</a>
                </div>
              </div>
            </div>
          </div>
        </section>
        
        <section id="team" class="team section-padding">
           <div class="container">
            <div class="row">
              <div class="col-md-12">
                <div class="section-header text-center pb-5">
                  <h2>Unser Team</h2>
                  <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repudiandae perferendis dolore quae fugiat expedita cum nesciunt at minima illo, dolorum vitae porro id eaque laboriosam perspiciatis sapiente delectus ipsa</p>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-12 col-md-6 col-lg-3">
                <div class="card text-center">
                  <div class="card-body">
                    <img src="https://images.pexels.com/photos/3714743/pexels-photo-3714743.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="" class="img-fluid rounded-circle">
                    <h3 class="card-title py-2">Dr. Julia Meyer</h3>
                    <p class="card-text">Fachärztin für Allgemeinmedizin. Dr. Meyer hat über 15 Jahre Erfahrung in der Patientenbetreuung.</p>

                    <p class="socials">
                    <i class="fa-brands fa-x-twitter font-dark mx-1"></i>
                    <i class="fa-brands fa-facebook font-dark mx-1"></i>
                    <i class="fa-brands fa-instagram font-dark mx-1"></i>
                    <i class="fa-brands fa-linkedin font-dark mx-1"></i>

                    </p>
                  </div>
                </div>
              </div>

              <div class="col-12 col-md-6 col-lg-3">
                <div class="card text-center">
                  <div class="card-body">
                    <img src="https://images.pexels.com/photos/3938023/pexels-photo-3938023.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="" class="img-fluid rounded-circle">
                    <h3 class="card-title py-2">Dr. Thomas Schmidt</h3>
                    <p class="card-text">Facharzt für Innere Medizin. Dr. Schmidt ist spezialisiert auf Herz-Kreislauf-Erkrankungen.</p>
                    <p class="socials">

                    <p class="socials">
                    <i class="fa-brands fa-x-twitter font-dark mx-1"></i>
                    <i class="fa-brands fa-facebook font-dark mx-1"></i>
                    <i class="fa-brands fa-instagram font-dark mx-1"></i>
                    <i class="fa-brands fa-linkedin font-dark mx-1"></i>

                    </p>
                  </div>
                </div>
              </div>

              <div class="col-12 col-md-6 col-lg-3">
                <div class="card text-center">
                  <div class="card-body">
                    <img src="https://images.pexels.com/photos/4167541/pexels-photo-4167541.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="" class="img-fluid rounded-circle">
                    <h3 class="card-title py-2">Dr. Anna Fischer</h3>
                    <p class="card-text">Fachärztin für Pädiatrie. Dr. Fischer betreut unsere kleinen Patienten mit viel Fürsorge.</p>

                    <p class="socials">
                    <i class="fa-brands fa-x-twitter font-dark mx-1"></i>
                    <i class="fa-brands fa-facebook font-dark mx-1"></i>
                    <i class="fa-brands fa-instagram font-dark mx-1"></i>
                    <i class="fa-brands fa-linkedin font-dark mx-1"></i>

                    </p>
                  </div>
                </div>
              </div>

              <div class="col-12 col-md-6 col-lg-3">
                <div class="card text-center">
                  <div class="card-body">
                    <img src="https://images.pexels.com/photos/5452201/pexels-photo-5452201.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="" class="img-fluid rounded-circle">
                    <h3 class="card-title py-2">Dr. Michael Bauer</h3>
                    <p class="card-text">Facharzt für Orthopädie. Dr. Bauer ist Experte für Bewegungsapparat und Rehabilitation.</p>

                    <p class="socials">
                    <i class="fa-brands fa-x-twitter font-dark mx-1"></i>
                    <i class="fa-brands fa-facebook font-dark mx-1"></i>
                    <i class="fa-brands fa-instagram font-dark mx-1"></i>
                    <i class="fa-brands fa-linkedin font-dark mx-1"></i>

                    </p>
                  </div>
                </div>
              </div>
            </div>

           </div>
        </section>
        
        <section id="services" class="mt-5">
            <h2>Unsere Leistungen</h2>
            <p>Informationen über die angebotenen Leistungen.</p>
        </section>
        
        <section id="contact" class="mt-5">
            <h2>Kontakt</h2>
            <p>Informationen, wie Sie uns kontaktieren können.</p>
        </section>
    </div>
    <?php include './includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>