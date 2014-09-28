<?php defined('BASEPATH') or exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

class topic extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('topic_model', 'topic');
        $this->load->library(['ion_auth']);
    }

    public function index_get()
    {
        $rows = $this->topic
            ->with('user')
            ->order_by('is_feature', 'desc')
            ->order_by('updated_at', 'desc')
            ->get_all();
        $data = [
            'items' => $rows
        ];

        if (empty($rows)) {
            $this->response(['error_text' => '404 NOT FOUND'], 404);
        }

        $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        $this->response($data);
    }

}
