<html>

<head></head>

<body>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <?php

    //Página Web
    class View
    {

        //Función que muestra la cabecera de la página web
        public function cabecera()
        {

            if (isset($_SESSION['cliente'])) {
                $sesionUsuario = "Cerrar Sesion";
                $id = "cerrarSesion";
                $url = "https://hotelgdfree.epizy.com/?cerrarSesion";
            } else {
                $sesionUsuario = "Iniciar Sesion";
                $id = "sesion";
                $url = "https://hotelgdfree.epizy.com/?sesion";
            }

            echo '<div id="header" class="header">

            <header class="p-3 text-bg-dark">
                <nav>
                    <div class="container">
                        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">

                            <img src="../images/logo.jpg" alt="logotipo" class="header__logo" itemprop="associatedMedia">

                            <ul id="menu" class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">

                                <li>
                                    <strong><a id="init" href="#" class="nav-link px-2 text-light">HOTEL GD</a></strong>
                                </li>

                            </ul>

                            <ul id="menu" class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                                <li>
                                    <strong><a id="init" href="https://hotelgdfree.epizy.com/" class="nav-link px-2 text-light">Inicio</a></strong>
                                </li>

                                <li>
                                    
                                    <strong><a id="habitaciones" href="https://hotelgdfree.epizy.com/?habitaciones" class="nav-link px-2 text-light">Habitaciones</a></strong>
                                </li>

                                <li>
                                    <strong><a id="contacto" href="https://hotelgdfree.epizy.com/?contacto" class="nav-link px-2 text-light">Contacto</a></strong>
                                </li>

                            </ul>

                            <div class="text-end d-flex justify-content-center align-items-center gap-5 mr-2">
                                <a id="' . $id . '" href="' . $url . '" class="nav-link px-2 text-light">' . $sesionUsuario . '</a>
                                
                                <button id="carrito" class="button-image" type="button">
                                    <img src="../images/carrito.png" alt="Carrito">
                                </button>
                                
                        </div>
                        
                    </div>
                </nav>
            </header>
        </div>';
        }

        public function boton()
        {
            echo '<form method="post">
                <!-- otros campos del formulario -->
                <button type="submit" class="btn btn-primary" name="mostrar">Mostrar</button>
                <button type="submit" class="btn btn-primary" name="actualizar">Actualizar</button>
            </form>
            ';
        }

        public function footer()
        {
            echo '<!-- Footer -->
            <footer id="footer" class="bg-dark text-center text-white">
                <!-- Grid container -->
                <div class="container-fluid p-4">
                    <!-- Section: Social media -->
                    <section class="mb-4">
                        <!-- Facebook -->
                        <a class="btn btn-outline-light btn-floating m-1" href="https://es-es.facebook.com/"
                            role="button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-facebook" viewBox="0 0 16 16">
                                <path
                                    d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                            </svg><p class="ocultar_parrafo">f</p></a>
    
                        <!-- Twitter -->
                        <a class="btn btn-outline-light btn-floating m-1" href="https://twitter.com/?lang=es"
                            role="button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-twitter" viewBox="0 0 16 16">
                                <path
                                    d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
                            </svg><p class="ocultar_parrafo">t</p></a>
    
                        <!-- Google -->
                        <a class="btn btn-outline-light btn-floating m-1" href="https://www.google.com/" role="button"><svg
                                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-google" viewBox="0 0 16 16">
                                <path
                                    d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z" />
                            </svg><p class="ocultar_parrafo">g</p></a>
    
                        <!-- Instagram -->
                        <a class="btn btn-outline-light btn-floating m-1" href="https://www.instagram.com/"
                            role="button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-instagram" viewBox="0 0 16 16">
                                <path
                                    d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
                            </svg><p class="ocultar_parrafo">i</p></a>
    
                        <!-- Linkedin -->
                        <a class="btn btn-outline-light btn-floating m-1" href="https://www.linkedin.com/"
                            role="button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-linkedin" viewBox="0 0 16 16">
                                <path
                                    d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z" />
                            </svg><p class="ocultar_parrafo">l</p></a>
    
                        <!-- Github -->
                        <a class="btn btn-outline-light btn-floating m-1" href="https://github.com/" role="button"><svg
                                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-github" viewBox="0 0 16 16">
                                <path
                                    d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z" />
                            </svg><p class="ocultar_parrafo">g</p></a>
                    </section>
                    <!-- Section: Social media -->
    
                    <!-- Section: Text -->
                    <section class="mb-4">
                        <div itemscope itemtype="https://schema.org/Person" class="footer__datos">
    
                            <p itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
                                Direccion:
                                <span itemprop="streetAddress">Calle La Mata 46</span>
                            </p>
                            <p>
                                Correo:
                                <span itemprop="email">hotelgd@gmail.com</span>
                            </p>
                            <p>
                                Telefono:
                                <span itemprop="telephone">666777888</span>
                            </p>
    
                        </div>
                    </section>
                    <!-- Section: Text -->
    
                    <!-- Copyright -->
                    <div class="text-center p-3 container-fluid" style="background-color: rgba(0, 0, 0, 0.2);">
                        © 2023 Copyright:
                        <a class="text-white" href="#">hotelgd.com</a>
                    </div>
                    <!-- Copyright -->
            </footer>
            <!-- Footer -->';
        }

        public function introduccion()
        {
            echo '<section class="intro d-flex justify-content-center mt-5">
            <div class="container introduccion">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="d-flex justify-content-center">Bienvenidos a Hotel GD</h2>
                        <p class="d-flex justify-content-center centered-text"> Un lugar para relajarse y disfrutar de unas vacaciones
                            inolvidables. Ubicado en el corazón de
                            la hermosa ciudad de Almagro, nuestro hotel ofrece una
                            experiencia única y relajante para todos nuestros huéspedes.
                            Con una amplia gama de habitaciones y suites lujosas y modernas, Hotel GD es perfecto para
                            parejas que buscan una escapada romántica, familias que buscan unas vacaciones divertidas y
                            relajantes o viajeros de negocios que buscan comodidad y conveniencia.</p>
                    </div>
                </div>
            </div>
        </section>';
        }

        public function carousel()
        {
            echo '<div id="carouselExampleCaptions" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="4" aria-label="Slide 5"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="5" aria-label="Slide 6"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="6" aria-label="Slide 7"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="7" aria-label="Slide 8"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="../images/imagen4.jpg" class="d-block w-100 img-fluid" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="../images/imagen5.jpg" class="d-block w-100 img-fluid" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="../images/imagen6.JPEG" class="d-block w-100 img-fluid" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="../images/principal2.webp" class="d-block w-100 img-fluid" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="../images/patio.webp" class="d-block w-100 img-fluid" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="../images/salon.webp" class="d-block w-100 img-fluid" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="../images/salon2.webp" class="d-block w-100 img-fluid" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="../images/piscina.webp" class="d-block w-100 img-fluid" alt="...">
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
            ';
        }

        public function servicios()
        {
            echo '<p class="d-flex justify-content-center mb-5 mt-5 pruebaMargen centered-text">Estos son los diferentes servicios que puedes encontrar en nuestro hotel:</p>

            <!-- Servicios -->
            <section class="services">
                <div class="container mb-5">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <img src="../images/wifi.jpg" class="card-img-top" alt="Foto de la piscina">
                                <div class="card-body">
                                    <h3 class="card-title">Wifi</h3>
                                    <p class="card-text">En nuestro hotel, nos preocupamos por hacer que su estancia sea lo
                                        más cómoda posible, por lo que ofrecemos acceso a internet de alta velocidad y WiFi
                                        gratuito en todas nuestras instalaciones.
    
                                        Además, nuestro WiFi gratuito es fácil de usar y seguro. Simplemente seleccione la
                                        red inalámbrica del hotel en su dispositivo y comience a navegar. Contamos con un
                                        equipo de soporte técnico disponible las 24 horas para asegurarnos de que su
                                        conexión sea estable y segura.
    
                                        Sabemos que para muchos viajeros, la conexión a internet es esencial, ya sea para
                                        trabajar o para mantenerse en contacto con sus seres queridos. En nuestro hotel, nos
                                        aseguramos de que pueda estar conectado en todo momento sin preocupaciones
                                        adicionales. ¡Disfrute de la comodidad de la conectividad gratuita en nuestro hotel!
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <img src="../images/smart.webp" class="card-img-top" alt="Foto del gimnasio">
                                <div class="card-body">
                                    <h3 class="card-title">Smart TV</h3>
                                    <p class="card-text">En nuestro hotel, nos enorgullece ofrecer servicios de alta calidad
                                    para que su estancia sea lo más cómoda posible. Por esta razón, todas nuestras
                                    habitaciones cuentan con televisores inteligentes de última generación.

                                    Con nuestro servicio de Smart TV, podrá acceder a una amplia variedad de canales de
                                    televisión, películas y programas en línea. Nuestros televisores inteligentes también
                                    cuentan con un navegador web incorporado, para que pueda navegar por internet desde
                                    la comodidad de su habitación.


                                    En resumen, en nuestro hotel podrá disfrutar de lo último en tecnología de
                                    entretenimiento en su habitación, para que pueda relajarse y disfrutar de su tiempo
                                    libre como se merece. ¡Esperamos que disfrute de nuestra oferta de Smart TV!.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <img src="../images/familia.jpg" class="card-img-top" alt="Foto del spa">
                                <div class="card-body">
                                    <h3 class="card-title">Habitaciones Familiares</h3>
                                    <p class="card-text">En nuestro hotel, nos esforzamos por hacer que su estancia sea lo
                                    más agradable posible, especialmente si viaja en familia. Para ello, ofrecemos
                                    amplias habitaciones familiares, diseñadas para satisfacer las necesidades de su
                                    familia y hacer su estancia más cómoda.

                                    Dichas habitaciones están equipadas con camas cómodas y amplias, para
                                    que todos los miembros de su familia puedan dormir plácidamente durante su estancia.
                                    Además, contamos con amenities para niños, como cunas y sillitas de comer, para que
                                    no tenga que preocuparse por llevar todo el equipo de su casa.

                                    Además, nuestras habitaciones familiares están diseñadas para ofrecer una amplia
                                    zona de estar.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            ';
        }

        //Método que borra el main de la página web
        public function main()
        {

            echo "<script>

                let main = $('#main');

                main.empty();

            </script>";
        }

        //Método que borra el header de la página web
        public function borrarHeader()
        {

            echo "<script>

                let header = $('#header');

                header.empty();

            </script>";
        }

        //Método que borra el footer de la página web
        public function borrarFooter()
        {

            echo "<script>

                let footer = $('#footer');

                footer.empty();

            </script>";
        }

        //Método que muestra el formulario de contacto
        public function formularioContacto()
        {

            echo '<script>

                let body = document.body;

                body.classList.add("formuContacto");

                main = $("#main");

                main.append(`<div class="container-fluid bg-image">
                <div class="container bg-form">
                    <form id="formContacto" class="needs-validation" novalidate>
                        <div class="card-header">
                            <h4>Formulario de Contacto</h4>
                        </div>

                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" placeholder="Ingrese su nombre" pattern="[A-Z]{1}[a-z]{3,12}" required>

                            <div class="valid-feedback">
                                ¡Correcto!
                            </div>
                            <div class="invalid-feedback">
                                El nombre debe incluir 1 mayúscula y 3 minúsculas mínimo
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="correo">Correo:</label>
                            <input type="email" class="form-control" id="correo" placeholder="Ingrese su correo" required>

                            <div class="valid-feedback">
                                ¡Correcto!
                            </div>
                            <div class="invalid-feedback">
                                El correo es obligatorio
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="telefono">Telefono:</label>
                            <input type="text" class="form-control" id="telefono" placeholder="Ingrese su telefono" pattern="[0-9]{9}" required>

                            <div class="valid-feedback">
                                ¡Correcto!
                            </div>
                            <div class="invalid-feedback">
                            El telefono debe incluir 9 números
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="mensaje">Mensaje:</label>
                            <textarea class="form-control" id="mensaje" rows="3" placeholder="Ingrese su mensaje" required></textarea>
    
                            <div class="valid-feedback">
                                ¡Correcto!
                            </div>
                            <div class="invalid-feedback">
                                El mensaje es obligatorio
                            </div>
    
                        </div>

                        <button type="submit" class="btn btn-primary mt-2" id="enviar" data-toggle="modal" data-target="#exampleModal">Enviar</button>
                        <a href="https://hotelgdfree.epizy.com/" class="btn btn-primary mt-2">Volver</a>
                    </form>
                </div>
                </div>`);

            </script>';
        }


        //Método que muestra el modal de contacto
        public function modalContacto()
        {

            echo '<script>

                main = $("#main");

                main.append(`<div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="miModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="miModalLabel">Mensaje de confirmación</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Tu mensaje ha sido enviado correctamente</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cerrar">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>`);

            </script>';
        }

        //Método que muestra el modal de reserva
        public function modalReserva()
        {

            echo '<script>

                main = $("#main");

                main.append(`<div class="modal fade" id="modalReserva" tabindex="-1" role="dialog" aria-labelledby="miModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="miModalLabel">ACCIÓN NO IMPLEMENTADA</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Esta acción no está implementada</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cerrar">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>`);

            </script>';
        }

        public function formularioSesion()
        {

            echo '<script>

                let body = document.body;

                body.classList.add("formuContacto");

                main = $("#main");

                main.append(`<div class="container-fluid bg-image">
                <div class="container bg2-form">
                    <form id="formSesion" class="needs-validation" novalidate>

                        <div class="card-header">
                            <h4>Formulario de Sesión</h4>
                        </div>

                        <div class="form-group">
                            <label for="usuario">Usuario:</label>
                            <input type="text" class="form-control" id="usuario" placeholder="Ingrese su usuario" required>
                            <div class="valid-feedback">
                                ¡Correcto!
                            </div>
                            <div class="invalid-feedback">
                                El usuario es obligatorio
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input type="password" class="form-control" id="password" placeholder="Ingrese su contraseña" required>
                            <div class="valid-feedback">
                                ¡Correcto!
                            </div>
                            <div class="invalid-feedback">
                                La contraseña es obligatoria
                            </div>
                        </div>
                    
                        <button type="submit" class="btn btn-primary mt-2" id="iniciar" data-toggle="modal" data-target="#exampleModal">Iniciar Sesión</button>
                        <button type="button" class="btn btn-primary mt-2" id="registrar" data-toggle="modal" data-target="#exampleModal">Registrarse</button>
                        <a href="https://hotelgdfree.epizy.com/" class="btn btn-primary mt-2">Volver</a>
                    </form>
                </div>
                </div>`);

            </script>';
        }

        public function modalSesion()
        {

            echo '<script>

                main = $("#main");

                main.append(`<div class="modal fade" id="modalSesion" tabindex="-1" role="dialog" aria-labelledby="miModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="miModalLabel">Mensaje de confirmación</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Has iniciado sesión correctamente</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cerrar">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>`);

            </script>';
        }

        public function formularioRegistro()
        {

            echo '<script>

                let body = document.body;

                body.classList.add("formuContacto");

                main = $("#main");

                main.append(`<div class="container-fluid bg-image">
                <div class="container bg3-form">
                    <form id="formRegistro" class="needs-validation" novalidate>

                        <div class="card-header">
                            <h4>Formulario de Registro</h4>
                        </div>

                        <div class="form-group">
                                        <label for="nombre">Nombre:</label>
                                        <input type="text" class="form-control" id="nombre" placeholder="Ingrese su nombre"
                                            pattern="[A-Z]{1}[a-z]{3,12}" required>
    
                                        <div class="valid-feedback">
                                            ¡Correcto!
                                        </div>
                                        <div class="invalid-feedback">
                                            El nombre debe incluir 1 mayúscula y 3 minúsculas mínimo
                                        </div>
    
                                    </div>

                                    <div class="form-group">
                                        <label for="apellido">Apellido:</label>
                                        <input type="text" class="form-control" id="apellido" placeholder="Ingrese su apellido"
                                            pattern="[A-Z]{1}[a-z]{3,12}" required>
    
                                        <div class="valid-feedback">
                                            ¡Correcto!
                                        </div>
                                        <div class="invalid-feedback">
                                            El apellido debe incluir 1 mayúscula y 3 minúsculas mínimo
                                        </div>
    
                                    </div>

                                    <div class="form-group">
                                        <label for="usuario">Usuario:</label>
                                        <input type="text" class="form-control" id="usuario" placeholder="Ingrese su usuario"
                                            pattern="[A-Z]{1}[a-z]{3,12}" required>
    
                                        <div class="valid-feedback">
                                            ¡Correcto!
                                        </div>
                                        <div class="invalid-feedback">
                                            El usuario debe incluir 1 mayúscula y 3 minúsculas mínimo
                                        </div>
    
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Contraseña</label>
                                        <input type="password" class="form-control" id="password"
                                            placeholder="Ingrese su contraseña" required>
    
                                        <div class="valid-feedback">
                                            ¡Correcto!
                                        </div>
                                        <div class="invalid-feedback">
                                            La contraseña es obligatoria
                                        </div>
    
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Correo electrónico:</label>
                                        <input type="email" class="form-control" id="email"
                                            placeholder="Ingrese su correo electrónico" required>
    
                                        <div class="valid-feedback">
                                            ¡Correcto!
                                        </div>
                                        <div class="invalid-feedback">
                                            El correo electrónico es obligatorio
                                        </div>
    
                                    </div>

                                    <div class="form-group">
                                        <label for="telefono">Teléfono:</label>
                                        <input type="text" class="form-control" id="telefono"
                                            placeholder="Ingrese su número de teléfono" pattern="[0-9]{9}" required>
    
                                        <div class="valid-feedback">
                                            ¡Correcto!
                                        </div>
                                        <div class="invalid-feedback">
                                            El telefono debe incluir 9 números
                                        </div>
    
                                    </div>

                                    <button type="submit" class="btn btn-primary mt-2" id="enviar" data-toggle="modal"
                                        data-target="#exampleModal">Registrarse</button>
                                    <a href="https://hotelgdfree.epizy.com/?sesion" class="btn btn-primary mt-2">Volver</a>
                    </form>
                </div>
                </div>`);

            </script>';
        }

        public function modalRegistro(){

            echo '<script>
            
                main = $("#main");

                main.append(`<div class="modal fade show" id="modalRegistro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">Registro</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Te has registrado correctamente
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cerrar">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>`)
            
            </script>';
        }

        public function modalNoRegistro(){

            echo '<script>
            
                main = $("#main");

                main.append(`<div class="modal fade show" id="modalNoRegistro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">Registro</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            No te has podido registrar. El usuario ya está registrado
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cerrar">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>`)
            
            </script>';
        }

        public function crearSesion($usuario)
        {
            $_SESSION['cliente']['usuario'] = $usuario;
            $_SESSION['cliente']['email'] = "prueba@gmail.com";

            echo '<script>

                window.location.href = "https://hotelgdfree.epizy.com/";
            
            </script>';
        }

        public function cerrarSesion()
        {
            session_destroy();

            echo '<script>

                window.location.href = "https://hotelgdfree.epizy.com/";
            
            </script>';
        }

        public function modalCarrito(){

            echo '<script>
            
                main = $("#main");

                main.append(`<div class="modal fade show" id="modalCarrito" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">Carrito No Disponible</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Debes iniciar sesión para consultar tu carrito
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cerrar">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>`)
            
            </script>';
        }

        public function formularioReserva()
        {

            echo '<script>

                let body = document.body;

                body.classList.add("formuContacto");

                main = $("#main");

                main.append(`<div class="container-fluid bg-image">
                <div class="container bg2-form">
                    <form id="formReserva" class="needs-validation" novalidate>

                        <div class="card-header">
                            <h4>Formulario de Reserva</h4>
                        </div>

                        <div class="form-group">
                            <label for="fechaInicio">Fecha de Inicio:</label>
                            <input type="date" class="form-control" id="fechaInicio" placeholder="Ingrese la fecha de inicio" required>
                            <div class="valid-feedback">
                                ¡Correcto!
                            </div>
                            <div class="invalid-feedback">
                                La fecha de inicio es obligatoria
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="fechaFin">Fecha de Fin:</label>
                            <input type="date" class="form-control" id="fechaFin" placeholder="Ingrese la fecha de fin" required>
                            <div class="valid-feedback">
                                ¡Correcto!
                            </div>
                            <div class="invalid-feedback">
                                La fecha de fin es obligatoria
                            </div>

                        </div>
                    
                        <button id="confirmarReserva" type="submit" class="btn btn-primary mt-2" id="iniciar" data-toggle="modal" data-target="#exampleModal">Confirmar Reserva</button>
                        <a href="https://hotelgdfree.epizy.com/" class="btn btn-primary mt-2">Volver</a>
                    </form>
                </div>
                </div>`);

            </script>';
        }

        public function modalReservaConfirmacion(){

            echo '<script>
            
                main = $("#main");

                main.append(`<div class="modal fade show" id="modalReservaConfirmacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">Confirmación de Reserva</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Se ha reservado correctamente la habitación. Muchas gracias por confiar en nuestro magnifico hotel
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cerrar">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>`)
            
            </script>';
        }

        public function modalLoginIncorrecto(){

            echo '<script>
            
                main = $("#main");

                main.append(`<div class="modal fade show" id="modalLoginIncorrecto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">Login Incorrecto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Los datos son incorrectos
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cerrar">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>`)
            
            </script>';
        }

        public function modalPruebaFondo(){

            echo '<script>
            
                main = $("#main");

                main.append(`<div class="modal fade" id="myModal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Mensaje de Confirmación</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    
                    <!-- Modal body -->
                    <div class="modal-body" style="background-color: #fff1e6;">
                        <img src="../images/mensaje.png" alt="Placeholder Image" style="width:100%;">
                        <p>El mensaje se ha enviado correctamente</p>
                    </div>
                    
                    <!-- Modal footer -->
                    <div class="modal-footer" style="background-color: #ffc107;">
                        <button id="cerrar" type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary">Guardar cambios</button>
                    </div>
                    
                    </div>
                </div>
                </div>`)
            
            </script>';
            
        }

        public function mostrarMapa(){

            echo '<p class="d-flex justify-content-center centered-text mb-5">Esta es la ubicación de nuestro magnífico hotel en la famosa localidad de Almagro:</p>';

            echo'<script>

                main = $("#main");

                main.append(`<div class="container"><div class="m-4" id="mapid"></div></div>`);

                let mapContainer = $("#mapid");
                mapContainer.css({
                    height: "350px",
                    border: "2px solid #faa541"
                });

                let map = L.map("mapid").setView([38.88979498688846, -3.710147340608609], 15);

                L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                    maxZoom: 18
                }).addTo(map);

                let marker = L.marker([38.88979498688846, -3.710147340608609]).addTo(map);

                marker.bindPopup("<strong>Hotel GD</strong>").openPopup();

            </script>';

        }

        public function mostrarTipoHabitacion(){

            echo '<p class="d-flex justify-content-center centered-text mb-5 mt-5">Estos son los tipos de habitaciones que existen en nuestro hotel:</p>';

            echo '
            <section class="tipos">
                <div class="container mb-5 mt-5">
                    <div class="row">
                        <div class="col-md-6 mb-5">
                            <div class="card">
                                <img src="../images/individual.jpg" class="card-img-top" alt="Foto de la piscina">
                                <div class="card-body">
                                    <h3 class="card-title">Individual</h3>
                                    <p class="card-text">Habitaciones muy luminosas y silenciosas, TV LED SMART 42 pulgadas, minibar, wifi
                                    gratuito, 1 cama de 1,20 x 1,90 con colchón visco air de máximo confort. Dispone también de baño completo con plato de ducha
                                    secador de pelo, dispensadores del gel y papel WC y toallas. Además, cuenta con aire acondicionado y calefacción.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-5">
                            <div class="card">
                                <img src="../images/dobles.jpg" class="card-img-top" alt="Foto del gimnasio">
                                <div class="card-body">
                                    <h3 class="card-title">Doble</h3>
                                    <p class="card-text">Habitaciones muy luminosas y confortables, con smart tv 42 pulgadas, minibar y wifi gratuito. Cama de 
                                    1,50 x 1,90 con colchón visco air de máximo confort, posibilidad de cama supletoria, baño completo con plato de ducha,
                                    secador de pelo, dispensadores antibacterias para gel y papel higiénico y toallas. Cuenta con aire acondicionado y 
                                    calefacción.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-5">
                            <div class="card">
                                <img src="../images/apartamento.jpg" class="card-img-top" alt="Foto del spa">
                                <div class="card-body">
                                    <h3 class="card-title">Apartamento</h3>
                                    <p class="card-text">Apartamento familiar situado en la planta baja y con puerta independiente del hotel.
                                    Dormitorio a todo confort con cama grande de 1,90 x 1,50 y cama pequeña de 1.90 x 0.90 con colchones de visco
                                    air de máximo confort. El salón incluye sofá cama para 2 personas de 1,50 de ancho. Posibilidad de cama supletoria
                                    o cuna bajo petición.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-5">
                            <div class="card">
                                <img src="../images/suites.jpg" class="card-img-top" alt="Foto del spa">
                                <div class="card-body">
                                    <h3 class="card-title">Suite</h3>
                                    <p class="card-text">Nuestras suites disponen de cama de 1,60, baño privado con ducha, aire acondicionado,
                                    zona de comedor con TV de pantalla plana de 60 pulgadas y cocina office con nevera y microondas, sofá cama
                                    y balcones a la calle principal. Además, cuenta con un aire acondicionado y calefacción.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>';

        }

        public function opiniones(){

            echo '<p class="d-flex justify-content-center centered-text mb-5 mt-5">Se pueden observar las distintas reseñas que han dejado algunos de nuestros clientes:</p>';

            echo '<div class="card mb-5 noReserva" style="max-width: 800px; background: #ADD8E6">
                <div class="row g-0">
                <div class="col-md-4">
                    <img src="../images/usuario.png" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                    <h5 class="card-title">Increíble estancia en un hotel excepcional</h5>
                    <p class="card-text">Increíble estancia en este hotel! El personal fue muy amable y servicial, las habitaciones eran limpias y cómodas, y la ubicación era perfecta. Definitivamente volvería a alojarme aquí.</p>
                    <p class="card-text"><small class="text-muted">Escrito por BlueRaven87</small></p>
                    </div>
                </div>
                </div>
            </div>

            <div class="card mb-5 noReserva" style="max-width: 800px; background: #ADD8E6">
                <div class="row g-0">
                <div class="col-md-4">
                    <img src="../images/usuario.png" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                    <h5 class="card-title">Excelente hotel con una ubicación inmejorable</h5>
                    <p class="card-text">Excelente hotel, con una ubicación inmejorable en el centro de la ciudad. El personal era muy amable y servicial, y las habitaciones eran cómodas y modernas. La vista desde mi habitación era impresionante. Definitivamente volveré a alojarme aquí</p>
                    <p class="card-text"><small class="text-muted">Escrito por SunnyDays44</small></p>
                    </div>
                </div>
                </div>
            </div>

            <div class="card mb-5 noReserva" style="max-width: 800px; background: #ADD8E6">
                <div class="row g-0">
                <div class="col-md-4">
                    <img src="../images/usuario.png" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                    <h5 class="card-title">El hotel perfecto para familias con niños</h5>
                    <p class="card-text">El hotel es agradable y tiene una buena relación calidad-precio. La habitación era cómoda y tenía todo lo que necesitaba. El personal era amable y servicial.</p>
                    <p class="card-text"><small class="text-muted">Escrito por JazzFusion23</small></p>
                    </div>
                </div>
                </div>
            </div>

            <div class="card mb-5 noReserva" style="max-width: 800px; background: #ADD8E6">
                <div class="row g-0">
                <div class="col-md-4">
                    <img src="../images/usuario.png" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                    <h5 class="card-title">Experiencia perfecta en este hotel excepcional</h5>
                    <p class="card-text">Mi estancia en este hotel fue perfecta. La habitación era cómoda y bien equipada, el personal era extremadamente amable y servicial, y la comida en el restaurante era deliciosa. Además, la ubicación era perfecta para explorar la ciudad. Definitivamente volvería a alojarme aquí.</p>
                    <p class="card-text"><small class="text-muted">Escrito por MountainHiker99</small></p>
                    </div>
                </div>
                </div>
            </div>
            ';

        }

    }

    ?>

</body>

</html>