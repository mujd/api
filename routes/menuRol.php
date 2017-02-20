<?php
$app->get('/menuRol', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT * FROM menu_rol;");
    $sth->execute();
    $retorno = $sth->fetchAll();
    return $this->response->withJson($retorno);
});

$app->post('/menuRol', function ($request, $response) {
    $input = $request->getParsedBody();
    $sql = "INSERT INTO menu_rol (menu_id,  rol_id) VALUES (:menu_id, :rol_id)";
    $sth = $this->db->prepare($sql);
    $sth->bindParam("menu_id", $input['menu_id']);    
    $sth->bindParam("rol_id", $input['rol_id']);
    $sth->execute();
    $input['id'] = $this->db->lastInsertId();
    return $this->response->withJson($input);
});

$app->put('/menuRol/[{id}]', function ($request, $response, $args) {
    $input = $request->getParsedBody();
    $sql = "UPDATE menu_rol SET menu_id = :menu_id, rol_id = :rol_id WHERE id = :id";
    $sth = $this->db->prepare($sql);
    $sth->bindParam("id", $args['id']);
    $sth->bindParam("menu_id", $input['menu_id']);    
    $sth->bindParam("rol_id", $input['rol_id']);
    $$sth->execute();
    $input['id'] = $args['id'];
    return $this->response->withJson($input);
});


$app->delete('/menuRol/[{id}]', function ($request, $response, $args) {
    $sth = $this->db->prepare("DELETE FROM rol WHERE id = :id");
    $sth->bindParam("id", $args['id']);
    $sth->execute();
    $input['id'] = $args['id'];
    return $this->response->withJson($input);
});




