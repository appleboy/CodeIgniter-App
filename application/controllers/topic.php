<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class topic extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('topic_model', 'topic');
        $this->load->library(['template', 'form_validation', 'ion_auth']);
        $this->load->helper('url');
        $this->template->set('is_login', $this->ion_auth->logged_in());
    }

    public function index()
    {
        $this->template->add_title_segment('新聞模組');
        $this->template->add_js('/assets/js/handlebars.js', true);
        $this->template->add_js('/assets/js/app.js', true);
        $this->template->render('topic/index');
    }

    public function items()
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
        $this->template->add_title_segment('新聞列表');
        $this->template->render('topic/items', $data);
    }

    public function create()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }

        //validate form input
        $this->form_validation->set_rules('title', '標題', 'required');
        $this->form_validation->set_rules('description', '描述', 'required');
        if ($this->form_validation->run() == true) {
            $is_feature = (bool) $this->input->post('is_feature');
            $this->topic->insert([
                'user_id' => $this->session->userdata('user_id'),
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'is_feature' => $is_feature
            ]);
            $this->session->set_flashdata('message', '成功建立新聞');
            redirect('/topic', 'refresh');
        } else {
            $this->template->add_title_segment('建立新聞');
            $this->template->render('topic/create');
        }
    }

    public function edit($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }

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
            $this->session->set_flashdata('message', '成功編輯新聞');
            redirect('/topic', 'refresh');
        } else {
            $data = [
                'item' => $row
            ];
            $this->template->add_title_segment('編輯新聞');
            $this->template->render('topic/update', $data);
        }
    }

    public function delete($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }

        if (!$this->ion_auth->is_admin()) {
            $this->session->set_flashdata('message', '您並無權限刪除資料');
            redirect('topic');
        }

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
