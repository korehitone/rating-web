<?php

class Actor extends Model
{
    private $table = "actor";
    private $tableCastMovies = "actor_movies";

    public function getActor($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function getActors($page = 1, $limit = 10)
    {
        $offset = ($page - 1) * $limit;

        $this->db->query('SELECT * FROM ' . $this->table . ' ORDER BY fullname ASC LIMIT :limit OFFSET :offset');
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        $this->db->bind(':offset', $offset, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function getActorMovies($id)
    {
        $this->db->query('SELECT * FROM ' . $this->tableCastMovies . ' WHERE actor_id = :id');
        $this->db->bind('id', $id);
        return $this->db->resultSet();
    }

    public function getTotalActors()
    {
        $this->db->query('SELECT COUNT(*) as total FROM ' . $this->table);
        $result = $this->db->single();
        return $result ? $result['total'] : 0; 
    }

    public function update($data, $path = '')
    {
        $query = 'UPDATE ' . $this->table . ' SET fullname = :f, birthday = :b WHERE id = :id';
        if (!empty($path)) {
            $query = 'UPDATE ' . $this->table . ' SET fullname = :f, birthday = :b, img_url = :img WHERE id = :id';
        }
        $this->db->query($query);
        $this->db->bind(':f', $data['editName']);
        $this->db->bind(':b', $data['editBirthday']);
        if (!empty($path)) {
            $this->db->bind(':img', $path);
        }
        $this->db->bind(':id', $data['editId']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function create($data){
        $this->db->query('INSERT INTO '. $this->table .' (fullname, birthday) VALUES (:f, :b)');
        $this->db->bind(':f', $data['addName']);
        $this->db->bind(':b', $data['addBirthday']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function delete($id){
        $this->db->query('DELETE FROM '. $this->table . ' WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }


    public function searchActors($keyword, $page = 1, $limit = 10)
    {
        $offset = ($page - 1) * $limit;

        $sql = 'SELECT * FROM ' . $this->table . ' 
                WHERE fullname LIKE :keyword 
                ORDER BY fullname ASC 
                LIMIT :limit OFFSET :offset';

        $this->db->query($sql);
        $this->db->bind(':keyword', '%' . $keyword . '%');
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        $this->db->bind(':offset', $offset, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function getTotalSearchActors($keyword)
    {
        $sql = 'SELECT COUNT(*) as total FROM ' . $this->table . ' WHERE fullname LIKE :keyword';
        $this->db->query($sql);
        $this->db->bind(':keyword', '%' . $keyword . '%');
        $result = $this->db->single();
        return $result ? $result['total'] : 0; 
    }
}