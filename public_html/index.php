<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <title>Inicio</title>
</head>
<body>
    <header class="header__container" id="index__container">
        <div class="item__content">
            <p>Gestiona tus reparaciones de vehiculos de manera eficiente</p>
            <a class="btn__header btn__primary" href="vista/signin.php">Ingresar</a>
            <a class="btn__header btn__secondary" href="">Gestionar</a>
        </div>
        <div class="item__content">
            <img class="" src="assets/img/images.jpg" alt="JC electronicos Calle">
        </div>
    </header>
    <!-- Carusel -->

    <section class="team">
        <div class="container__team">
            <h1>Nuestro equipo de trabajo </h1>
            <div class="owl-carousel">
                <div class="team-member">
                    <img src="assets/img/images.jpg" alt="Team Member 1">
                    <h3>John Doe</h3>
                    <p>Position: Developer</p>
                </div>
                <div class="team-member">
                    <img src="assets/img/images.jpg" alt="Team Member 2">
                    <h3>Jane Smith</h3>
                    <p>Position: Designer</p>
                </div>

                <div class="team-member">
                    <img src="assets/img/images.jpg" alt="Team Member 2">
                    <h3>Jane Smith</h3>
                    <p>Position: Designer</p>
                </div>

                <div class="team-member">
                    <img src="../assets/img/images.jpg" alt="Team Member 2">
                    <h3>Jane Smith</h3>
                    <p>Position: Designer</p>
                </div>

                <div class="team-member">
                    <img src="assets/img/images.jpg" alt="Team Member 2">
                    <h3>Jane Smith</h3>
                    <p>Position: Designer</p>
                </div>

                <!-- Add more team members here -->
            </div>
        </div>
    </section>




    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.8/ScrollMagic.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.8/plugins/animation.gsap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.owl-carousel').owlCarousel({
                items: 3,
                loop: false, // Cambiado de true a false para que no se repita
                autoplay: true,
                autoplayTimeout: 3000,
                autoplayHoverPause: true,
                margin: 10 // Ajusta esto para cambiar el espacio entre las imáge       nes
            });

            /*    $('.owl-carousel .team-member img').css({
                    'width': '', 
                }); */

            var controller = new ScrollMagic.Controller();

            var scene = new ScrollMagic.Scene({
                    triggerElement: '.owl-carousel',
                    duration: $('.owl-carousel').height(),
                    triggerHook: 0
                })
                .addTo(controller);

            scene.on("progress", function(event) {
                var progress = event.progress;
                var totalItems = $('.owl-carousel .team-member').length;
                var currentItem = Math.floor(progress * totalItems);
                $('.owl-carousel').trigger('to.owl.carousel', [currentItem, 300]);
            });
        });
    </script>
</html>


