<?php

class Auth_model extends CI_Model
{
    public function login($data) {

        $query = $this->db->query("
            SELECT id_user 
            FROM user 
            WHERE user_name = '".$data['username']."' 
            AND user_password = '".$data['password']."'");

        $row = $query->row();

        if (isset($row)){
            $data = array(
                'last_login' => date("Y-m-d H:i:s")
            );
            $this->db->where('id_user', $row->id_user);
            $this->db->update('user', $data);
            return $row;
        }else{
            return false;
        }


    }

    public function getChecked($idUser) {
        $query = $this->db->query("
            SELECT * 
            FROM user 
            WHERE id_user = '".$idUser."'");

        $row = $query->row();

        if (isset($row)){
            return $row;
        } else {
            return false;
        }
    }

    public function getGroups($idUser){
        $query = $this->db->query("
            SELECT id_group 
            FROM user_group 
            WHERE id_user = '".$idUser."'");

        $result = $query->result();

        if(isset($result)){
            return $result;
        }else{
            return false;
        }
    }


    function getLogged() {
        return ( object ) $this->session->userdata();
    }



}