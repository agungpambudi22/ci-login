<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu added successfully</div>');
            redirect('menu');
        }
    }

    public function delete($id)
    {
        $this->db->delete('user_menu', ['id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data deleted successfully</div>');
        redirect('menu');
    }

    public function get_edit()
    {
        $id = $_POST['id'];
        $data = $this->db->get_where('user_menu', ['id' => $id])->row_array();
        $data = json_encode($data);
        echo $data;
    }

    public function edit()
    {
        $data = [
            'menu' => $this->input->post('menu')
        ];
        $id = $this->input->post('id');

        $this->db->where('id', $id);
        $this->db->update('user_menu', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data updated successfully</div>');
        redirect('menu');
    }

    public function submenu()
    {
        $this->load->model('Menu_model', 'menu');
        $data['title'] = 'Submenu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['submenu'] = $this->menu->getSubmenu();
        $data['menu'] = $this->menu->getMenu();

        $text = 'Select menu';

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required', [
            'required' => 'You need to select a menu'
        ]);
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'menu_id' => $this->input->post('menu_id'),
                'title' => $this->input->post('title'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->insert('user_sub_menu', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Submenu added successfully</div>');
            redirect('menu/submenu');
        }
    }

    public function deleteSubMenu($id)
    {
        $this->db->delete('user_sub_menu', ['id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Submenu deleted successfully</div>');
        redirect('menu/submenu');
    }

    public function get_editSubMenu()
    {
        $id = $_POST['id'];

        $query = "SELECT `user_sub_menu`.*,`user_menu`.`menu`
                  FROM `user_sub_menu` JOIN `user_menu`
                  ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                  WHERE `user_sub_menu`.`id` = $id  
                 ";

        
        $data = $this->db->query($query)->row_array();
        $data = json_encode($data);
        echo $data;
        
    }

    public function editSubMenu()
    {
        // $is_active = 0;
        // if(isset($_POST['is_active'])){
        //     $is_active = 1;
        // }else{
        //     $is_active = 0;
        // }

        $data = [
            'menu_id' => $this->input->post('menu_id'),
            'title' => $this->input->post('title'),
            'url' => $this->input->post('url'),
            'icon' => $this->input->post('icon'),
            'is_active' => $is_active
        ];

        $id = $this->input->post('id');

        $this->db->where('id',$id);
        $this->db->update('user_sub_menu', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Submenu edited successfully</div>');
        redirect('menu/submenu');
    }
}
