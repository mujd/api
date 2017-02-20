<?php
$app->get('/menu', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT * FROM menu;");
	$sth->execute();
	$retorno = $sth->fetchAll();
	return $this->response->withJson($retorno);
});

$app->post('/menu', function ($request, $response) {
    $input = $request->getParsedBody();
    $sql = "INSERT INTO menu (nombre, ruta, listar, agregar, editar, eliminar) VALUES (:nombre, :ruta, :listar, :agregar, :editar, :eliminar)";
    $sth = $this->db->prepare($sql);
    $sth->bindParam("nombre", $input['nombre']);
    $sth->bindParam("ruta", $input['ruta']);
    $sth->bindParam("listar", $input['listar']);
    $sth->bindParam("agregar", $input['agregar']);
    $sth->bindParam("editar", $input['editar']);
    $sth->bindParam("eliminar", $input['eliminar']);
    $sth->execute();
    $input['id'] = $this->db->lastInsertId();
    return $this->response->withJson($input);
});

$app->put('/menu/[{id}]', function ($request, $response, $args) {
    $input = $request->getParsedBody();
    $sql = "UPDATE menu SET nombre = :nombre, ruta =:ruta, listar = :listar, agregar = :agregar, editar = :editar, eliminar = :eliminar WHERE id = :id";
    $sth = $this->db->prepare($sql);
    $sth->bindParam("id", $args['id']);
    $sth->bindParam("nombre", $input['nombre']);
    $sth->bindParam("ruta", $input['ruta']);
    $sth->bindParam("listar", $input['listar']);
    $sth->bindParam("agregar", $input['agregar']);
    $sth->bindParam("editar", $input['editar']);
    $sth->bindParam("eliminar", $input['eliminar']);
    $sth->execute();
    $input['id'] = $args['id'];
    return $this->response->withJson($input);
});


$app->delete('/menu/[{id}]', function ($request, $response, $args) {
    $sth = $this->db->prepare("DELETE FROM menu WHERE id = :id");
    $sth->bindParam("id", $args['id']);
    $sth->execute();
    $input['id'] = $args['id'];
    return $this->response->withJson($input);
});




