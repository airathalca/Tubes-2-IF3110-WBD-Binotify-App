<?php

class SubsController extends Controller implements ControllerInterface
{
    public function index()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    // Prevent CSRF Attacks
                    $tokenMiddleware = $this->middleware('TokenMiddleware');
                    $tokenMiddleware->putToken();
                    // Cari user ID
                    if (isset($_SESSION['user_id'])) {
                        $subsModel = $this->model('SubsModel');
                        $subs = $subsModel->getSubsFromID($_SESSION['user_id']);
                        header('Content-Type: application/json');
                        http_response_code(200);
                        echo json_encode(["data" => $subs]);
                    } else {
                        header('Content-Type: application/json');
                        http_response_code(401);
                        echo json_encode(["redirect_url" => BASE_URL . "/user/login"]);
                    }
                    exit;

                    break;
                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }
    }

    public function update()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'PUT':
                    parse_str(file_get_contents('php://input'), $req);
                    if (!isset($req['soap_key']) || $req['soap_key'] != SOAP_KEY) {
                        throw new LoggedException('Soap key is required', 400);
                    }
                    
                    if (!isset($req['creator_id']) || !isset($req['subscriber_id']) || !isset($req['status'])) {
                        throw new LoggedException('Data not complete', 400);
                    }

                    $subsModel = $this->model('SubsModel');
                    $success = $subsModel->updateSubs($req['creator_id'], $req['subscriber_id'], $req['status']);
                    
                    header('Content-Type: application/json');
                    http_response_code(200);
                    echo json_encode(["message" => $success]);
                    exit;

                    break;
                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }
    }

    public function create()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'POST':
                    // Prevent CSRF Attacks
                    $tokenMiddleware = $this->middleware('TokenMiddleware');
                    $tokenMiddleware->checkToken();

                    $subsModel = $this->model('SubsModel');
                    $subsModel->createSubs($_POST['creator_id'], $_POST['subscriber_id'], $_POST['creator_name']);
                    header('Content-Type: application/json');
                    http_response_code(200);
                    echo json_encode(["message" => "Subscription Request Sent"]);
                    exit;

                    break;
                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }
    }
}
