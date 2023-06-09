<?php

//Importamos el modelo y la vista
require_once 'modelo.php';
require_once 'vista.php';

//Clase Controller
class Controller
{

    //Definimos las variables model, view y db
    private $model;
    private $view;
    private $db;

    //Constructor donde instanciamos modelo, vista y la BBDD
    public function __construct()
    {
        $this->model = new Model();
        $this->view = new View();
        $this->db = new DB("epiz_34160839_hotelgd");
    }

    //Página Web
    public function mostrarCabecera()
    {
        $this->view->cabecera();
    }

    public function mostrarIntroduccion()
    {
        $this->view->introduccion();
    }

    public function mostrarCarousel()
    {
        $this->view->carousel();
    }

    public function mostrarServicios()
    {
        $this->view->servicios();
    }

    public function mostrarFooter()
    {
        $this->view->footer();
    }

    public function borrarMain()
    {
        $this->view->main();
    }

    public function borrarHeader()
    {
        $this->view->borrarHeader();
    }

    public function borrarFooter()
    {
        $this->view->borrarFooter();
    }

    public function mostrarFormularioContacto()
    {
        $this->view->formularioContacto();
    }

    public function mostrarModalContacto()
    {
        $this->view->modalContacto();
    }

    public function mostrarModalReserva()
    {
        $this->view->modalReserva();
    }

    public function formularioSesion()
    {
        $this->view->formularioSesion();
    }

    public function modalSesion()
    {
        $this->view->modalSesion();
    }

    public function formularioRegistro()
    {
        $this->view->formularioRegistro();
    }

    public function modalRegistro()
    {
        $this->view->modalRegistro();
    }

    public function crearSesion($usuario)
    {
        $this->view->crearSesion($usuario);
    }

    public function cerrarSesion()
    {
        $this->view->cerrarSesion();
    }

    public function modalNoRegistro()
    {
        $this->view->modalNoRegistro();
    }

    public function datosUsuarioLogin($db, $usuario)
    {
        $this->model->datosUsuarioLogin($db, $usuario);
    }

    public function modalCarrito()
    {
        $this->view->modalCarrito();
    }

    public function formularioReserva()
    {
        $this->view->formularioReserva();
    }

    public function reservaHabitacion($db, $fechaInicio, $fechaFin, $usuario, $id_habitacion)
    {
        $this->model->reservaHabitacion($db, $fechaInicio, $fechaFin, $usuario, $id_habitacion);
    }

    public function modalReservaConfirmacion()
    {
        $this->view->modalReservaConfirmacion();
    }

    public function actualizarReservas($db)
    {
        $this->model->actualizarReservas($db);
    }

    public function modalLoginIncorrecto()
    {
        $this->view->modalLoginIncorrecto();
    }

    public function cancelarReserva($db, $id)
    {
        $this->model->cancelarReserva($db, $id);
    }

    public function mostrarMapa()
    {
        $this->view->mostrarMapa();
    }

    public function mostrarTipoHabitacion()
    {
        $this->view->mostrarTipoHabitacion();
    }

    public function opiniones()
    {
        $this->view->opiniones();
    }

    public function modalCancelarReserva()
    {
        $this->view->modalCancelarReserva();
    }

    public function modalFalloReserva()
    {
        $this->view->modalFalloReserva();
    }

    public function modalConfirmacionCancelacionReserva()
    {
        $this->view->modalConfirmacionCancelacionReserva();
    }

    public function modalHabitacionesNoDisponibles()
    {
        $this->view->modalHabitacionesNoDisponibles();
    }

    public function modalContactoNoDisponible()
    {
        $this->view->modalContactoNoDisponible();
    }

    public function formularioAgregaHabitacion()
    {
        $this->view->formularioAgregaHabitacion();
    }

    public function reservasAdmin($db)
    {
        $this->model->reservasAdmin($db);
    }

    public function formularioActualizaHabitacion()
    {
        $this->view->formularioActualizaHabitacion();
    }

    public function contactoDatos($db)
    {
        $this->model->contactoDatos($db);
    }

    public function modalBorrarMensaje()
    {
        $this->view->modalBorrarMensaje();
    }

    public function clientesAdmin($db)
    {
        $this->model->clientesAdmin($db);
    }

    public function modalClienteAdminBorrado()
    {
        $this->view->modalClienteAdminBorrado();
    }

    public function usuariosAdmin($db)
    {
        $this->model->usuariosAdmin($db);
    }

    public function modalUsuarioAdminBorrado()
    {
        $this->view->modalUsuarioAdminBorrado();
    }

}