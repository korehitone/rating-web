<?php

class Review extends Model
{
    private $table = "reviews";
    private $tableUserReviews = "user_reviews";

    public function create($data, $userId)
    {
        $movieId = $data['movieId'];
        $rating = $data['ratingSelect'];
        $review = htmlspecialchars($data['reviewComment']);

        $this->db->query('INSERT INTO ' . $this->table . ' (movie_id, user_id, rating, review) VALUES (:mid, :uid, :rt, :rv)');
        $this->db->bind(':mid', $movieId);
        $this->db->bind(':uid', $userId);
        $this->db->bind(':rt', $rating);
        $this->db->bind(':rv', $review);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function update($data, $id, $createdDate)
    {
        $rating = $data['ratingSelect'];
        $review = htmlspecialchars($data['reviewComment']);

        $this->db->query('UPDATE '. $this->table .' SET rating = :rt, review = :rv, created_at = :cr WHERE id = :id');
        $this->db->bind(':rt', $rating);
        $this->db->bind(':rv', $review);
        $this->db->bind(':cr', $createdDate);
        $this->db->bind(':id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function delete($id){
        $this->db->query('DELETE FROM '. $this->table . ' WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getReview($movieId, $userId)
    {
        $this->db->query('SELECT id, created_at FROM ' . $this->table . ' WHERE movie_id = :mid AND user_id = :uid');
        $this->db->bind(':mid', $movieId);
        $this->db->bind(':uid', $userId);
        $this->db->execute();
        return $this->db->single();
    }

    public function getReviews($userId){
        $this->db->query('SELECT * FROM '.$this->tableUserReviews.' WHERE user_id = :uid');
        $this->db->bind(':uid', $userId);
        $this->db->execute();
        return $this->db->resultSet();
    }
}
