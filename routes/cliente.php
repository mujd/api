<?php
$app->get('/cliente', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT * FROM cliente;");
	$sth->execute();
	$retorno = $sth->fetchAll();
	return $this->response->withJson($retorno);
});

$app->post('/cliente', function ($request, $response) {
    $input = $request->getParsedBody();
    $sql = "INSERT INTO cliente (nombres, apellidoP, apellidoM, rut, direccion, email, fono) VALUES (:nombres, :apellidoP, :apellidoM, :rut, :direccion, :email, :fono)";
    $sth = $this->db->prepare($sql);
    $sth->bindParam("nombres", $input['nombres']);
    $sth->bindParam("apellidoP", $input['apellidoP']);
    $sth->bindParam("apellidoM", $input['apellidoM']);
    $sth->bindParam("rut", $input['rut']);
    $sth->bindParam("direccion", $input['direccion']);
    $sth->bindParam("email", $input['email']);
    $sth->bindParam("fono", $input['fono']);
    $sth->execute();
    $input['id'] = $this->db->lastInsertId();
    return $this->response->withJson($input);
});

$app->put('/cliente/[{id}]', function ($request, $response, $args) {
    $input = $request->getParsedBody();
    $sql = "UPDATE cliente SET nombres = :nombres, apellidoP = :apellidoP, apellidoM = :apellidoM, rut = :rut, direccion = :direccion, email = :email, fono = :fono WHERE id = :id";
    $sth = $this->db->prepare($sql);
    $sth->bindParam("id", $args['id']);
    $sth->bindParam("nombres", $input['nombres']);
    $sth->bindParam("apellidoP", $input['apellidoP']);
    $sth->bindParam("apellidoM", $input['apellidoM']);
    $sth->bindParam("rut", $input['rut']);
    $sth->bindParam("direccion", $input['direccion']);
    $sth->bindParam("email", $input['email']);
    $sth->bindParam("fono", $input['fono']);
    $sth->execute();
    $input['id'] = $args['id'];
    return $this->response->withJson($input);
});


$app->delete('/cliente/[{id}]', function ($request, $response, $args) {
    $sth = $this->db->prepare("DELETE FROM cliente WHERE id = :id");
    $sth->bindParam("id", $args['id']);
    $sth->execute();
    $input['id'] = $args['id'];
    return $this->response->withJson($input);
});




