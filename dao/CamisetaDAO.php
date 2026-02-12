<?php

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../dto/CamisetaDTO.php';

class CamisetaDAO {

    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    // =========================
    // GET ALL
    // =========================
    public function findAll() {

        $sql = "SELECT * FROM camisetas";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $result = [];

        foreach ($rows as $row) {
            $result[] = new CamisetaDTO(
                $row['id'],
                $row['equipo'],
                $row['temporada'],
                $row['talla'],
                (float)$row['precio_compra'],
                (float)$row['precio_venta'],
                $row['estado'],
                $row['fecha_alta'],
                $row['pedido_id']
            );
        }

        return $result;
    }

    // =========================
    // GET BY ID
    // =========================
    public function findById($id) {

        $sql = "SELECT * FROM camisetas WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return new CamisetaDTO(
            $row['id'],
            $row['equipo'],
            $row['temporada'],
            $row['talla'],
            (float)$row['precio_compra'],
            (float)$row['precio_venta'],
            $row['estado'],
            $row['fecha_alta'],
            $row['pedido_id']
        );
    }

    // =========================
    // CREATE
    // =========================
    public function create($data) {

        $sql = "INSERT INTO camisetas 
                (equipo, temporada, talla, precio_compra, precio_venta, estado, fecha_alta, pedido_id)
                VALUES
                (:equipo, :temporada, :talla, :precio_compra, :precio_venta, :estado, :fecha_alta, :pedido_id)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute($data);
    }

    // =========================
    // UPDATE
    // =========================
    public function update($id, $data) {

        $sql = "UPDATE camisetas SET
                equipo = :equipo,
                temporada = :temporada,
                talla = :talla,
                precio_compra = :precio_compra,
                precio_venta = :precio_venta,
                estado = :estado,
                fecha_alta = :fecha_alta,
                pedido_id = :pedido_id
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $data['id'] = $id;

        return $stmt->execute($data);
    }

    // =========================
    // DELETE
    // =========================
    public function delete($id) {

        $sql = "DELETE FROM camisetas WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
