<?php
$app->get('/rol', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT * FROM rol;");
    $sth->execute();
    $retorno = $sth->fetchAll();
    return $this->response->withJson($retorno);
});

$app->post('/rol', function ($request, $response) {
    $input = $request->getParsedBody();
    $sql = "INSERT INTO rol (nombre,  listar, agregar, editar, eliminar) VALUES (:nombre, :listar, :agregar, :editar, :eliminar)";
    $sth = $this->db->prepare($sql);
    $sth->bindParam("nombre", $input['nombre']);    
    $sth->bindParam("listar", $input['listar']);
    $sth->bindParam("agregar", $input['agregar']);
    $sth->bindParam("editar", $input['editar']);
    $sth->bindParam("eliminar", $input['eliminar']);
    $sth->execute();
    $input['id'] = $this->db->lastInsertId();
    return $this->response->withJson($input);
});

$app->put('/rol/[{id}]', function ($request, $response, $args) {
    $input = $request->getParsedBody();
    $sql = "UPDATE rol SET nombre = :nombre, listar = :listar, agregar = :agregar, editar = :editar, eliminar = :eliminar WHERE id = :id";
    $sth = $this->db->prepare($sql);
    $sth->bindParam("id", $args['id']);
    $sth->bindParam("nombre", $input['nombre']);    
    $sth->bindParam("listar", $input['listar']);
    $sth->bindParam("agregar", $input['agregar']);
    $sth->bindParam("editar", $input['editar']);
    $sth->bindParam("eliminar", $input['eliminar']);
    $sth->execute();
    $input['id'] = $args['id'];
    return $this->response->withJson($input);
});


$app->delete('/rol/[{id}]', function ($request, $response, $args) {
    $sth = $this->db->prepare("DELETE FROM rol WHERE id = :id");
    $sth->bindParam("id", $args['id']);
    $sth->execute();
    $input['id'] = $args['id'];
    return $this->response->withJson($input);
});




