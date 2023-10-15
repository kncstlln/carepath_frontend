<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
      crossorigin="anonymous"
    />
    <script
      src="https://kit.fontawesome.com/2eead9cc17.js"
      crossorigin="anonymous"
    ></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    <link href="{{ asset('css/main.css') }}" rel="stylesheet" />
    <script src="{{ asset('js/main.js') }}"></script>
    <link rel="icon" type="image/x-icon" href="{{ asset('/images/logo.png') }}">
    <title>CarePath</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg sticky-top" style="font-family: 'Montserrat', sans-serif;">
      <div class="container-fluid">
        <a class="navbar-brand" style="color: #e61414" href="#">
          <img src="images/logo.png"alt="Logo" width="35" height="35" class="d-inline-block align-text-middle"/> CarePath
        </a>
        <button class="navbar-toggler btnToggle" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarToggler">
          <ul class="navbar-nav ms-auto me-auto">
            <li class="nav-item">
              <a class="nav-link" href="">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#about">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#services">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#contact">Contact Us</a>
            </li>
          </ul>
   
          <a class="btn btn-primary btnColor" href="/login" role="button">Login</a>

        </div>
      </div>
    </nav>


    <img class="img-fluid" alt="Child getting vaccine" src="images/jumbotron2.png"/>


    <div class="container">
      <div class="row justify-content-between">
        <div class="col-2 position-relative placement">
          <div class="row pt-3">
            <div class="col-5">
              <i
                class="fa-solid fa-syringe bigIcon ms-4 ps-2 mt-2"
                style="color: #b81414"
              ></i>
            </div>
            <div class="col title">
              Immunization Schedule Adherence
              <div class="col sub">
                Aims to ensure adherence to the recommended immunization
                schedule.
              </div>
            </div>
          </div>
        </div>
        <div class="col-2 position-relative placement">
          <div class="row pt-3">
            <div class="col-5">
              <i
                class="fa-solid fa-shield-virus bigIcon ms-4 ps-2 mt-2"
                style="color: #b81414"
              ></i>
            </div>
            <div class="col title">
              Vaccine Coverage and Protection
              <div class="col sub">
                Aims for broad vaccine coverage, protecting against preventable
                diseases.
              </div>
            </div>
          </div>
        </div>
        <div class="col-2 position-relative placement">
          <div class="row pt-3">
            <div class="col-5">
              <i
                class="fa-solid fa-person-breastfeeding bigIcon ms-4 ps-2 mt-2"
                style="color: #b81414"
              ></i>
            </div>
            <div class="col title">
              Parent Education and Engagement
              <div class="col sub" id="about">
                Aims to educate and engage parents or caregivers in the
                vaccination process.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

 

    <div class="container aboutUs">
      <div class="row observe mb-5">
        <div class="col-md-6 position-relative start">
          <span class="about-us-title">CAREPATH</span>
          <span class="subtitle">: Protecting Little Ones, Empowering the future!</span>
          <div class="row mt-3">
            <div class="col">
              CarePath is designed to safeguard the health and well-being of our
              youngest population. It is a carefully crafted pathway that
              ensures infants receive timely and appropriate vaccinations,
              providing them with optimal protection against vaccine-preventable
              diseases.
            </div>
          </div>
          <div class="row mt-4">
            <div class="col">
              <div class="row">
                <div class="col-12 col-lg-3 d-flex justify-content-center justify-content-lg-start">
                  <i
                    class="fa-solid fa-chart-line medIcon mt-3"
                    style="color: #b81414"
                  ></i>
                </div>
                <div class="col">
                  <div class="row">
                    <span class="titleAbout">Vaccine Registry</span>
                  </div>
                  <span>To store data of the infants for our local government to
                    contact you</span>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="row">
                <div class="col-12 col-lg-3 d-flex justify-content-center justify-content-lg-start">
                  <i
                    class="fa-solid fa-comment-sms medIcon mt-3"
                    style="color: #b81414"
                  ></i>
                </div>
                <div class="col">
                  <div class="row">
                    <span class="titleAbout">SMS Notification</span>
                  </div>
                  <span>To send text messages to due vaccines</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col ms-5 ps-5 image">
          <img
            src="images/banner.png"
            class="img-fluid"
            width="250"
          />
          <img
            src="images/banner1.JPG"
            class="img-fluid"
            width="250"
          />
          <img
            src="images/banner2.png"
            class="img-fluid third"
            width="250"
          />
          <img
            src="images/banner2.png"
            class="img-fluid fourth"
            width="250"
          />
        </div>
      </div>
    </div>
  
    <section class="services min-vh-100 pb-5 position-relative" id="services" >
      <div class="custom-shape-divider-top-1690472653">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M649.97 0L550.03 0 599.91 54.12 649.97 0z" class="shape-fill"></path>
        </svg>
      </div>
      <div class="container-fluid">
        <div class="row mt-5">
          <div class="col text-center serviceTitle">SERVICES</div>
        </div>
        <div class="row">
          <div class="col-md mt-2 d-flex justify-content-center">
            <div class="card animate__animated animate__fadeInLeft" style="width: 18rem;">
              <img src="images/banner.png" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title first">SMS-based Immunization Reminders</h5>
                <p class="card-text">Timely SMS notifications for parents about upcoming immunizations, reducing missed vaccinations.</p>
              </div>
            </div>
          </div>
          <div class="col-md mt-2 d-flex justify-content-center">
            <div class="card animate__animated animate__fadeInLeft" style="width: 18rem;">
              <img src="images/banner1.JPG" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Online Registration & Tracking</h5>
                <p class="card-text">Easy web portal for registering infants and tracking vaccination history, ensuring accurate data for healthcare providers.</p>
              </div>
            </div>
          </div>
          <div class="col-md mt-2 d-flex justify-content-center">
            <div class="card animate__animated animate__fadeInRight" style="width: 18rem;">
              <img src="images/banner2.png" class="card-img-top" alt="...">
              <div class="card-body pb-5">
                <h5 class="card-title pb-3">Data Analytics & Reporting:</h5>
                <p class="card-text">Real-time insights on immunization rates and trends, aiding decision-making and targeted interventions.</p>
              </div>
            </div>
          </div>
          <div class="col-md mt-2 d-flex justify-content-center">
            <div class="card animate__animated animate__fadeInRight" style="width: 18rem;">
              <img src="images/banner.png" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Community Outreach & Education:</h5>
                <p class="card-text">Engaging community with educational resources to raise awareness about infant immunization.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
        <figure class="text-center">
            <blockquote class="blockquote">
              <p><i>"The greatest gift you can give your family and the world is a healthy you.” </i></p>
            </blockquote>
            <figcaption class="blockquote-footer">
              <cite title="Source Title">Joyce Meyer</cite>
            </figcaption>
        </figure>
      </section>
      <div class="container-md mt-5 mb-5" id="contact">
          <div class="row justify-content-xl-between">
            <div class="col-12 col-md-5 col-xl-4 me-md-5">
              <h1 class="footer-head text-center text-md-start ps-3 ps-md-0">Carepath</h1>
                <div class="row justify-content-center">
                    <div class="col-1 d-block d-md-none">
                      <i class="fa-brands fa-facebook fa-lg"></i>
                    </div>
                    <div class="col-1 d-block d-md-none">
                    <i class="fa-brands fa-facebook-messenger fa-lg"></i>
                    </div>
                    <div class="col-1 d-block d-md-none"> 
                      <i class="fa-solid fa-envelope fa-lg"></i>
                    </div>
                </div>
              <p style="text-align:justify">At CAREPATH, we are dedicated to pioneering innovative solutions that 
                prioritize the well-being of the youngest members of our community. 
                Our mission is clear: to enhance infant healthcare
                in Angeles City through technology-driven initiatives.</p>
            </div>
            <div class="col-12 col-md-4 col-xl-3 mb-2">
              <h2 class="footer-text">Contact Us</h2>
              <div class="col-12 footer-text">
                Facebook: Angeles City Health Office
              </div>
              <div class="col-12 footer-text">
                Messenger: Carepath
              </div>
              <div class="col-12 footer-text">
                Email: carepath@gmail.com
              </div>
            </div>
            <div class="col-12 col-md-2">
              <h2 class="footer-text">Links</h2>
              <div class="col-12 footer-text">
                <a href="" style="text-decoration:none; color: black">Home</a>
              </div>
              <div class="col-12 footer-text">
                <a href="#about" style="text-decoration:none; color: black">About Us</a>
              </div>
              <div class="col-12 footer-text">
                <a href="#services" style="text-decoration:none; color: black">Services</a>
              </div>
            </div>
          </div>
      </div>
  </body>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"
  ></script>
  <script
    type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"
  ></script>
  <script>
    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        const start = entry.target.querySelector(".start");
        const image = entry.target.querySelector(".image");


        if (entry.isIntersecting) {
          start.classList.add("transition");
          image.classList.add("fade");

   
          return; // if we added the class, exit the function
        }

        // We're not intersecting, so remove the class!
        start.classList.remove("transition");
        image.classList.remove("fade");


      });
    });

    observer.observe(document.querySelector(".observe"));
    observer.observe(document.querySelector(".fade"));


  </script>
</html>
