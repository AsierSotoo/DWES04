<?php

require_once __DIR__ . '/../../dao/CamisetaDAO.php';

class CamisetaController {

    private $dao;

    public function __construct() {
        $this->dao = new CamisetaDAO();
    }

    // =========================
    // GET /camisetas
    // =========================
    public function index() {
        $data = $this->dao->findAll();
        $this->response(200, 'Listado de camisetas', $data);
    }

    // =========================
    // GET /camisetas/{id}
    // =========================
    public function show($id) {
        $camiseta = $this->dao->findById($id);

        if (!$camiseta) {
            $this->response(404, 'Camiseta no encontrada', null, 'error');
            return;
        }

        $this->response(200, 'Camiseta encontrada', $camiseta);
    }

    // =========================
    // POST /camisetas
    // =========================
    public function store() {

        $input = json_decode(file_get_contents('php://input'), true);

        if (
            !$input ||
            !isset(
                $input['equipo'],
                $input['temporada'],
                $input['talla'],
                $input['precio_compra'],
                $input['precio_venta'],
                $input['estado'],
                $input['fecha_alta']
            )
        ) {
            $this->response(400, 'Datos inválidos o incompletos', null, 'error');
            return;
        }

        if (!array_key_exists('pedido_id', $input)) {
            $input['pedido_id'] = null;
        }

        $this->dao->create($input);

        $this->response(201, 'Camiseta creada correctamente', $input);
    }

    // =========================
    // PUT /camisetas/{id}
    // =========================
    public function update($id) {

        $input = json_decode(file_get_contents('php://input'), true);

        if (!$input) {
            $this->response(400, 'JSON inválido', null, 'error');
            return;
        }

        $existe = $this->dao->findById($id);
        if (!$existe) {
            $this->response(404, 'No existe la camiseta a actualizar', null, 'error');
            return;
        }

        $this->dao->update($id, $input);
        $actualizada = $this->dao->findById($id);

        $this->response(200, 'Camiseta actualizada correctamente', $actualizada);
    }

    // =========================
    // DELETE /camisetas/{id}
    // =========================
    public function destroy($id) {

        $existe = $this->dao->findById($id);

        if (!$existe) {
            $this->response(404, 'No existe la camiseta a eliminar', null, 'error');
            return;
        }

        $this->dao->delete($id);

        $this->response(200, 'Camiseta eliminada correctamente', null);
    }

    // =========================
    // RESPUESTA JSON UNIFICADA
    // =========================
    private function response($code, $message, $data = null, $status = 'success') {

        http_response_code($code);
        header('Content-Type: application/json');

        echo json_encode([
            'status'  => $status,
            'code'    => $code,
            'message' => $message,
            'data'    => $data
        ]);

        exit;
    }
}
