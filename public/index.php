<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
require '../src/vendor/autoload.php';

class DatabaseConnection {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "demo";
    private $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}

$app = new \Slim\App;

$database = new DatabaseConnection();
$conn = $database->getConnection();

$app->post('/postName', function (Request $request, Response $response, array $args) use ($conn) {
    $data = json_decode($request->getBody());
    $fname = $data->fname;
    $lname = $data->lname;

    try {
        $sql = "INSERT INTO names (fname, lname) VALUES (:fname, :lname)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':lname', $lname);
        $stmt->execute();

        $response->getBody()->write(json_encode(array("status" => "success", "data" => $data)));
    } catch (PDOException $e) {
        $response->getBody()->write(json_encode(array("status" => "error", "message" => $e->getMessage())));
    }
});

$app->get('/getName', function (Request $request, Response $response, array $args) use ($conn) {
    try {
        $stmt = $conn->prepare("SELECT * FROM names");
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $responseData = !empty($data) ? array("status" => "success", "data" => $data) : array("status" => "success", "data" => null);
        $response->getBody()->write(json_encode($responseData));
    } catch (PDOException $e) {
        $response->getBody()->write(json_encode(array("status" => "error", "message" => $e->getMessage())));
    }
});

$app->delete('/delName/{id}', function (Request $request, Response $response, array $args) use ($conn) {
    $id = $args['id'];

    try {
        $stmt = $conn->prepare("DELETE FROM names WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $response->getBody()->write(json_encode(array("status" => "success", "message" => "Data Successfully deleted")));
    } catch (PDOException $e) {
        $response->getBody()->write(json_encode(array("status" => "error", "message" => $e->getMessage())));
    }
});

$app->put('/updateName/{id}', function (Request $request, Response $response, array $args) use ($conn) {
    $id = $args['id'];
    $data = json_decode($request->getBody());
    $fname = $data->fname;
    $lname = $data->lname;

    try {
        $stmt = $conn->prepare("UPDATE names SET fname = :fname, lname = :lname WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':lname', $lname);
        $stmt->execute();

        $response->getBody()->write(json_encode(array("status" => "success", "message" => "Data updated")));
    } catch (PDOException $e) {
        $response->getBody()->write(json_encode(array("status" => "error", "message" => $e->getMessage())));
    }
});

$app->run();
