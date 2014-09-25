<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class topic extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('topic_model', 'topic');
        $this->load->library('form_validation');
        $this->load->helper('url');
    }

    public function index()
    {
        $rows = $this->topic
            ->with('user')
            ->order_by('is_feature', 'desc')
            ->order_by('updated_at', 'desc')
            ->get_all();
        $data = [
            'items' => $rows
        ];

        $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        $this->load->view('topic/index', $data);
    }

    public function create()
    {
        //validate form input
        $this->form_validation->set_rules('title', '標題', 'required');
        $this->form_validation->set_rules('description', '描述', 'required');
        if ($this->form_validation->run() == true) {
            $is_feature = (bool) $this->input->post('is_feature');
            $this->topic->insert([
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'is_feature' => $is_feature
            ]);
            $this->session->set_flashdata('message', '成功建立新聞');
            redirect('/topic', 'refresh');
        } else {
            $this->load->view('topic/create');
        }
    }

    public function edit($id)
    {
        $id = (int) $id;

        $row = $this->topic->get($id);

        if (empty($row)) {
            $this->session->set_flashdata('message', '無此新聞');
            redirect('/topic', 'refresh');
        }

        //validate form input
        $this->form_validation->set_rules('title', '標題', 'required');
        $this->form_validation->set_rules('description', '描述', 'required');
        if ($this->form_validation->run() == true) {
            $is_feature = (bool) $this->input->post('is_feature');
            $this->topic->update($id, [
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'is_feature' => $is_feature
            ]);
            $this->session->set_flashdata('message', '成功更新新聞');
            redirect('/topic', 'refresh');
        } else {
            $data = [
                'item' => $row
            ];
            $this->load->view('topic/update', $data);
        }
    }

    public function delete($id)
    {
        $id = (int) $id;

        $row = $this->topic->get($id);

        if (empty($row)) {
            $this->session->set_flashdata('message', '無此新聞');
            redirect('/topic', 'refresh');
        }

        $this->topic->delete($id);
        $this->session->set_flashdata('message', '成功刪除新聞');
        redirect('/topic', 'refresh');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/topic.php */
