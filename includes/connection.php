<?php 

require_once("../includes/constants.php");

/*class connection  extends PDO
{
protected $pdo; // atributo de la clase, que contiene la conexion a la base de datos.

public function getConexion()
{ 
    return $this->pdo;
}// Fin de public fuction getConexion()

public fuction_construct(){
*/
    try {
        $connection= new PDO('mysql:host=' .DB_HOST.';dbname=' .DB_NAME, DB_USER, DB_PASS);
        //$this->pdo->setAttribute::ATTR_ERAMDDE, (PDO::ERRMODE_EXCEPTION);
    } // Fin de try
    catch(Exception $e)
    {
        die($e->getMessage());
    } //Fin de catch(Exception $e)

    //}fin de public fuction_construct()
    //}// Fin de class conection extends_PDO

?>