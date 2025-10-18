<?php

class Category extends Model {
    private $table = "categories";

    public function getCategories(){
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }


    public function update($id, $name){
        $this->db->query('UPDATE '. $this->table . ' SET name = :n WHERE id = :id');
        $this->db->bind(':n', $name);
        $this->db->bind(':id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function create($name){
        $this->db->query('INSERT INTO '. $this->table . ' (name) VALUES (:n)');
        $this->db->bind(':n', $name);
        $this->db->execute();
        return $this->db->rowCount();
    }

     public function delete($id){
        $this->db->query('DELETE FROM '. $this->table . ' WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }
}