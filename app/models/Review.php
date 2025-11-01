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

        $this->db->query('UPDATE ' . $this->table . ' SET rating = :rt, review = :rv, created_at = :cr WHERE id = :id');
        $this->db->bind(':rt', $rating);
        $this->db->bind(':rv', $review);
        $this->db->bind(':cr', $createdDate);
        $this->db->bind(':id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function delete($id)
    {
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE id = :id');
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

    public function getReviews($userId, $keyword, $page = 1, $limit = 10)
    {
        $offset = ($page - 1) * $limit;
        $query = 'SELECT * FROM ' . $this->tableUserReviews . ' WHERE user_id = :uid LIMIT :limit OFFSET :offset';
        if (!empty($keyword)) {
            $query = 'SELECT * FROM ' . $this->tableUserReviews . ' WHERE user_id = :uid AND title  LIKE :keyword LIMIT :limit OFFSET :offset';
        }
        $this->db->query($query);
        $this->db->bind(':uid', $userId);
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        $this->db->bind(':offset', $offset, PDO::PARAM_INT);
        if (!empty($keyword)) {
            $this->db->bind(':keyword', '%' . $keyword . '%');
        }
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function getReviewsTotal($userId, $keyword)
    {
        $query = 'SELECT COUNT(*) as total FROM ' . $this->tableUserReviews . ' WHERE user_id = :uid';
        if (!empty($keyword)) {
            $query = 'SELECT COUNT(*) as total FROM ' . $this->tableUserReviews . ' WHERE user_id = :uid AND title  LIKE :keyword';
        }
        $this->db->query($query);
        $this->db->bind('uid', $userId);
        if (!empty($keyword)) {
            $this->db->bind(':keyword', '%' . $keyword . '%');
        }
        $result = $this->db->single();
        return $result ? $result['total'] : 0;
    }
}
