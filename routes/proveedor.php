<?php
$app->get('/proveedor', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT * FROM proveedor;");
	$sth->execute();
	$retorno = $sth->fetchAll();
	return $this->response->withJson($retorno);
});

$app->post('/proveedor', function ($request, $response) {
    $input = $request->getParsedBody();
    $sql = "INSERT INTO proveedor (nombres, apellidoP, apellidoM, rut, razonSocial, email, fono) VALUES (:nombres, :apellidoP, :apellidoM, :rut, :razonSocial, :email, :fono)";
    $sth = $this->db->prepare($sql);
    $sth->bindParam("nombres", $input['nombres']);
    $sth->bindParam("apellidoP", $input['apellidoP']);
    $sth->bindParam("apellidoM", $input['apellidoM']);
    $sth->bindParam("rut", $input['rut']);
    $sth->bindParam("razonSocial", $input['razonSocial']);
    $sth->bindParam("email", $input['email']);
    $sth->bindParam("fono", $input['fono']);
    $sth->execute();
    $input['id'] = $this->db->lastInsertId();
    return $this->response->withJson($input);
});

$app->put('/proveedor/[{id}]', function ($request, $response, $args) {
    $input = $request->getParsedBody();
    $sql = "UPDATE proveedor SET nombres = :nombres, apellidoP = :apellidoP, apellidoM = :apellidoM, rut = :rut, razonSocial = :razonSocial, email = :email, fono = :fono WHERE id = :id";
    $sth = $this->db->prepare($sql);
    $sth->bindParam("id", $args['id']);
    $sth->bindParam("nombres", $input['nombres']);
    $sth->bindParam("apellidoP", $input['apellidoP']);
    $sth->bindParam("apellidoM", $input['apellidoM']);
    $sth->bindParam("rut", $input['rut']);
    $sth->bindParam("razonSocial", $input['razonSocial']);
    $sth->bindParam("email", $input['email']);
    $sth->bindParam("fono", $input['fono']);
    $sth->execute();
    $input['id'] = $args['id'];
    return $this->response->withJson($input);
});


$app->delete('/proveedor/[{id}]', function ($request, $response, $args) {
    $sth = $this->db->prepare("DELETE FROM proveedor WHERE id = :id");
    $sth->bindParam("id", $args['id']);
    $sth->execute();
    $input['id'] = $args['id'];
    return $this->response->withJson($input);
});

