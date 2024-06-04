<?php
function getDB(){
    $db = new PDO('mysql:host=localhost;dbname=bd_materia;charset=utf8','root', '');
    return $db;
}
function getMateria(){
    $db = getDB();
    $sentencia = $db->prepare( "select * from materia");
    $sentencia->execute();
    $materias = $sentencia->fetchAll(PDO::FETCH_OBJ);
    return $materias;
}

function addMateria($nombre, $profesor){
    $db = getDB();
    $sentencia = $db->prepare("INSERT INTO materia(nombre, profesor) VALUES(:nombre, :profesor)");
    $sentencia->execute([':nombre'=>$nombre, ':profesor'=>$profesor]);
    return $db->lastInsertId();
}
function deleteMateria($id){
    $db = getDB();
    $sentencia = $db->prepare("delete from materia where id=?");    
    $sentencia->execute([$id]);
}
function completarMateria($id){
    $db = getDB();
    $sentencia = $db->prepare("update materia set finalizado = 1 where id=?");    
    $sentencia->execute([$id]);
}
function searchMateria($nombre){
    $db = getDB();
    $sentencia = $db->prepare("select * from  materia where nombre like ?");    
    $nombre = "%$nombre%";
    $sentencia->execute([$nombre]);
    return $sentencia->fetchAll(PDO::FETCH_OBJ);
}
