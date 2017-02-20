<?php
$app->get('/usuario', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT * FROM usuario;");
	$sth->execute();
	$retorno = $sth->fetchAll();
	return $this->response->withJson($retorno);
});

$app->post('/usuario', function ($request, $response) {
    $input = $request->getParsedBody();
    $sql = "INSERT INTO usuario (rol_id,rut,nombres, apellidoP, apellidoM, username, password, email) VALUES (:rol_id, :rut, :nombres, :apellidoP, :apellidoM, :username, :password, :email)";
    $sth = $this->db->prepare($sql);
    $sth->bindParam("rol_id", $input['rol_id']);
    $sth->bindParam("rut", $input['rut']);
    $sth->bindParam("nombres", $input['nombres']);
    $sth->bindParam("apellidoP", $input['apellidoP']);
    $sth->bindParam("apellidoM", $input['apellidoM']);
    $sth->bindParam("username", $input['username']);
    $sth->bindParam("password", $input['password']);
    $sth->bindParam("email", $input['email']);
    $sth->execute();
    $input['id'] = $this->db->lastInsertId();
    return $this->response->withJson($input);
});

$app->put('/usuario/[{id}]', function ($request, $response, $args) {
    $input = $request->getParsedBody();
    $sql = "UPDATE usuario SET rol_id = :rol_id, rut = :rut, nombres = :nombres, apellidoP = :apellidoP, apellidoM = :apellidoM, username = :username, password = :password, email = :email WHERE id = :id";
    $sth = $this->db->prepare($sql);
    $sth->bindParam("id", $args['id']);
    $sth->bindParam("rol_id", $input['rol_id']);
    $sth->bindParam("rut", $input['rut']);
    $sth->bindParam("nombres", $input['nombres']);
    $sth->bindParam("apellidoP", $input['apellidoP']);
    $sth->bindParam("apellidoM", $input['apellidoM']);
    $sth->bindParam("username", $input['username']);
    $sth->bindParam("password", $input['password']);
    $sth->bindParam("email", $input['email']);
    $sth->execute();
    $input['id'] = $args['id'];
    return $this->response->withJson($input);
});


$app->delete('/usuario/[{id}]', function ($request, $response, $args) {
    $sth = $this->db->prepare("DELETE FROM usuario WHERE id = :id");
    $sth->bindParam("id", $args['id']);
    $sth->execute();
    $input['id'] = $args['id'];
    return $this->response->withJson($input);
});




