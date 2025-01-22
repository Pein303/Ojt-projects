<?php
defined("BASEPATH") or exit("No direct script access allowed");
class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');

    }

     function search() {
        $query = $this->input->post('query');
        $this->load->model('User_model'); 
        $results = $this->User_model->search_users($query);
    
        $i = 1;
        foreach ($results as $row) {
            echo "<tr>
                <td>{$i}</td>
                <td>{$row['username']}</td>
                <td>{$row['email']}</td>
                <td>{$row['mobile']}</td>
                <td>{$row['address']}</td>
                <td>
                    <a href='" . base_url("user/edit/{$row['id']}") . "' class='btn btn-sm btn-primary'>EDIT</a>
                    <a href='" . base_url("user/delete/{$row['id']}") . "' onclick='return confirm(\"Are you sure want to delete this user?\")' class='btn btn-sm btn-danger'>DELETE</a>
                </td>
            </tr>";
            $i++;
        }
    }

    function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = array(
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'mobile' => $this->input->post('mobile'),
                'address' => $this->input->post('address')
            );
            $status = $this->user_model->insertUser($data);
            if ($status == true) {
                $this->session->set_flashdata('success', 'successfully Added');
                redirect(base_url('user/add'));


            } else {
                $this->session->set_flashdata('error', 'Error');
                $this->load->view('user/add_user');

            }

        } else {
            $this->load->view('user/add_user');

        }

    }
    function index() {
        $this->load->model('User_model');
        $this->load->library('pagination');
    
        $entries_per_page = $this->input->get('entries_per_page') ? $this->input->get('entries_per_page') : 5;
    
        $config = [
            'base_url' => base_url('user/index'),
            'total_rows' => $this->User_model->getUserCount(),
            'per_page' => $entries_per_page,
            'uri_segment' => 3,
            'reuse_query_string' => TRUE,
            'full_tag_open' => '<nav><ul class="pagination justify-content-center" style="margin-top:20px;">',
            'full_tag_close' => '</ul></nav>',
            'first_tag_open' => '<li class="page-item">',
            'first_tag_close' => '</li>',
            'last_tag_open' => '<li class="page-item">',
            'last_tag_close' => '</li>',
            'next_tag_open' => '<li class="page-item">',
            'next_tag_close' => '</li>',
            'prev_tag_open' => '<li class="page-item">',
            'prev_tag_close' => '</li>',
            'cur_tag_open' => '<li class="page-item active"><a class="page-link">',
            'cur_tag_close' => '</a></li>',
            'num_tag_open' => '<li class="page-item">',
            'num_tag_close' => '</li>',
            'attributes' => ['class' => 'page-link'],
        ];
    
        $this->pagination->initialize($config);
    
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    
        $data['users'] = $this->User_model->getUsersWithPagination($config['per_page'], $page);
        $data['pagination'] = $this->pagination->create_links();
        $data['entries_per_page'] = $entries_per_page; 
    
        $this->load->view('user/index', $data); 
    }
    

    function edit($id)
    {
        $data['users'] = $this->user_model->getUser($id);
        $data['id'] = $id;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = array(
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'mobile' => $this->input->post('mobile'),
                'address' => $this->input->post('address')
            );
            $status = $this->user_model->updateUser($data, $id);
            if ($status == true) {
                $this->session->set_flashdata('success', 'successfully updated');
                redirect(base_url('user/edit/' . $id));


            } else {
                $this->session->set_flashdata('error', 'Error');
                $this->load->view('user/edit_user');

            }

        }

        $this->load->view('user/edit_user', $data);
    }

    function delete($id)
    {
        if (is_numeric($id)) {
            $status = $this->user_model->deleteUser($id);
            if ($status == true) {
                $this->session->set_flashdata('deleted', 'successfully deleted');
                redirect(base_url('user/index/'));


            } else {
                $this->session->set_flashdata('error', 'Error');
                redirect(base_url('user/index/'));

            }

        }
    }

}