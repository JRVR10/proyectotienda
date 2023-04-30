<?php

require_once "..\config\database.php";


$db = new Database();



switch ($_SERVER['REQUEST_METHOD']){

    case 'GET':

        if(isset($_GET['id']) && $_GET['id']>0){
            echo json_encode($db->getProducto($_GET['id']));
        }
        
        if(isset($_GET['id']) && $_GET['id']==0){
            echo json_encode($db->getProductosAll());    
        }

        if(isset($_GET['name'])){
            echo json_encode($db->getProductoByName($_GET['name']));
 
        }
        

        break;
    case 'POST':
        $datos = json_decode(file_get_contents('php://input'));
        $db->InsertProductos(
            $datos->categoria_animal_id,
            $datos->categoria_producto_id,
            $datos->nombre,
            $datos->marca,
            $datos->descripcion,
            $datos->precio,
            $datos->stock,
            $datos->codigo_barra,
            $datos->imagenes);
        break;
    case 'PUT':
        $datos = json_decode(file_get_contents('php://input'));

        $db->UpdateProductos(
            $datos->producto_id,
            $datos->categoria_animal_id,
            $datos->categoria_producto_id,
            $datos->nombre,
            $datos->marca,
            $datos->descripcion,
            $datos->precio,
            $datos->stock,
            $datos->codigo_barra,
            $datos->imagenes
        );

        break;
    case 'DELETE':

        $db->DeleteProducto($_GET['id']);

        break;

    default:
    #code...
        break;
}