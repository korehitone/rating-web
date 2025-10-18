<?php

class User extends Model
{
    private $table = "users";

    public function getProfile($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->execute(); // jalanin query
        return $this->db->single();
    }

    public function getUser($email = "", $username = "")
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE email = :email OR username = :usn');
        $this->db->bind('email', htmlspecialchars($email));
        $this->db->bind('usn', htmlspecialchars($username));
        $this->db->execute();
        return $this->db->single();
    }

    public function register($data)
    {
        $username = htmlspecialchars($data['usernameInput']);
        $email = htmlspecialchars($data['emailInput']);
        $password = password_hash($data['passwordInput'], PASSWORD_DEFAULT);
        $role = $data['roleInput'];


        $query = 'INSERT INTO ' . $this->table . ' (username, email, password, isAdmin) VALUES (:usn, :email, :pass, :role)';
        $this->db->query($query);
        $this->db->bind('usn', $username);
        $this->db->bind('email', $email);
        $this->db->bind('pass', $password);
        $this->db->bind('role', $role);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function update($id, $username, $path = '')
    {
        $query = 'UPDATE ' . $this->table . ' SET username = :usn WHERE id = :id';
        if (!empty($path)) {
            $query = 'UPDATE ' . $this->table . ' SET username = :usn, img_url = :img WHERE id = :id';
        }
        $this->db->query($query);
        $this->db->bind(':usn', $username);
        $this->db->bind(':id', $id);
        if (!empty($path)) {
            $this->db->bind(':img', $path);
        }
        $this->db->execute();
        return $this->db->rowCount();
    }
}
