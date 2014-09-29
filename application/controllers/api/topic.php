<?php defined('BASEPATH') or exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

class topic extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('topic_model', 'topic');
        $this->load->library(['ion_auth', 'form_validation']);
    }

    public function list_get()
    {
        $rows = $this->topic
            ->with('user')
            ->order_by('is_feature', 'desc')
            ->order_by('updated_at', 'desc')
            ->get_all();
        $data = [
            'items' => $rows,
            'is_login' => $this->ion_auth->logged_in()
        ];

        if (empty($rows)) {
            $this->response(['error_text' => '404 NOT FOUND'], 404);
        }

        $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        $this->response($data);
    }

    public function index_get($id)
    {
        $id = (int) $id;

        $row = $this->topic->get($id);

        if (empty($row)) {
            $this->response(['error_text' => '404 NOT FOUND'], 404);
        }

        $this->response($row);
    }

    public function index_post()
    {
        if (!$this->ion_auth->logged_in()) {
            $this->response(['error_text' => 'You are not loggin'], 403);
        }

        $id = $this->topic->insert([
            'title' => $this->put('title'),
            'user_id' => $this->session->userdata('user_id'),
            'description' => $this->put('description'),
            'is_feature' => (bool) $this->put('is_feature')
        ]);

        $this->response([
            'id' => $id,
            'success_text' => 'ok'
        ]);
    }

    public function index_put($id)
    {
        if (!$this->ion_auth->logged_in()) {
            $this->response(['error_text' => 'You are not loggin'], 403);
        }

        $id = (int) $id;

        $row = $this->topic->get($id);

        if (empty($row)) {
            $this->response(['error_text' => '404 NOT FOUND'], 404);
        }

        $this->topic->update($id, [
            'title' => $this->put('title'),
            'description' => $this->put('description'),
            'is_feature' => (bool) $this->put('is_feature')
        ]);

        $this->response(['success_text' => 'ok']);
    }

    public function index_delete($id)
    {
        if (!$this->ion_auth->logged_in()) {
            $this->response(['error_text' => 'You are not loggin'], 403);
        }

        if (!$this->ion_auth->is_admin()) {
            $this->response(['error_text' => 'You don\'t have permission'], 403);
        }

        $id = (int) $id;

        $row = $this->topic->get($id);

        if (empty($row)) {
            $this->response(['error_text' => '404 NOT FOUND'], 404);
        }

        $this->topic->delete($id);
        $this->response(['success_text' => 'ok']);
    }
}
