<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function insertUser($data) {
        $this->db->insert('users', $data);
        return $this->db->affected_rows() > 0; 
    }

    function getUsers()
    {
        $query = $this->db->get('users');
        return $query->result_array();
    }

    public function getUsersWithPagination($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get('users');
        return $query->result_array();
    }

    public function getUserCount() {
        return $this->db->count_all('users');
    }   

    public function search_users($query) {
        $this->db->like('username', $query);
        $this->db->or_like('email', $query);
        $this->db->or_like('mobile', $query);
        return $this->db->get('users')->result_array(); 
    }
    
    
    function getUser($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('users');
        return $query->row();
    }

    function updateUser($data,$id)
    {
        $this->db->where('id', $id);
        $this->db->update('users', $data);
        if ($this->db->affected_rows() >= 0){
            return true;

        } else {
            return false;
        }

    }

    function deleteUser($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('users');
        if ($this->db->affected_rows() >= 0){
            return true;

        } else {
            return false;
        }

    }
}