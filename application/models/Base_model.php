<?php

class Base_model extends CI_Model
{
    public function getMenu(){
        $sql = "SELECT * FROM menu WHERE parent IS NULL ORDER BY id_menu";
        $query = $this->db->query($sql);
        $i=0;
        foreach( $query->result() as $row) {
            $data[$i]=array(
                'id' => $row->id_menu,
                'name' => $row->name,
                'icon' => $row->icon,
                'title'=> $row->title,
                'alias' => $row->alias
            );

            $submenu = "SELECT * FROM menu WHERE parent = '".$row->id_menu."' ORDER BY id_menu";
            $q = $this->db->query($submenu);

            if ($q->num_rows () > 0){
                $j = 0;
                foreach( $q->result() as $r) {
                    $data[$i]['submenu'][$j] = array(
                        'id' => $r->id_menu,
                        'name' => $r->name,
                        'icon' => $row->icon,
                        'title'=> $row->title,
                        'alias' => $r->alias
                    );
                    $j++;
                }
                $q->free_result ();
            }
            $i++;
        }
        $query->free_result ();
        return json_encode ( $data );

    }
}