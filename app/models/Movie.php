<?php

class Movie extends Model
{
    // deklarasi variable nama-nama table/view
    private $table = "movies"; // table movies
    private $tableMovie = "list_movies"; // view list_movies
    private $tableMovieDetails = "movie_details"; // view movie_details
    private $tableMovieReviews = "movie_reviews"; // view movie_reviews
    private $tableMovieCasts = "movie_casts"; // view movie_casts
    private $tableCastMovie = "cast_movie"; // table cast_movie

    public function getMovies($keyword, $page = 1, $limit = 10)
    {
        $offset = ($page - 1) * $limit;
        $query = 'SELECT * FROM ' . $this->tableMovie . ' LIMIT :limit OFFSET :offset';
        if (!empty($keyword)) {
            $query = 'SELECT * FROM ' . $this->tableMovie . ' WHERE title LIKE :keyword LIMIT :limit OFFSET :offset';
        }
        $this->db->query($query); // select semua dari view list_movies
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        $this->db->bind(':offset', $offset, PDO::PARAM_INT);
        if (!empty($keyword)) {
            $this->db->bind(':keyword', '%' . $keyword . '%');
        }
        return $this->db->resultSet(); // kembalikan hasilnya (dari select tadi)
    }

    public function searchMovies($page = 1, $limit = 10)
    {
        $offset = ($page - 1) * $limit;

        $keyword = $_POST['keyword']; // ambil data post keyword dari form html
        $query = "SELECT * FROM " . $this->tableMovie . ' WHERE title LIKE :keyword LIMIT :limit OFFSET :offset'; // query select semua dari list_movies dimana titlenya sesuai
        if (isset($_POST['cId'])) { // kalo data post category id ada
            $query = "SELECT * FROM " . $this->tableMovie . ' WHERE title LIKE :keyword AND categories_id = :cid LIMIT :limit OFFSET :offset'; // selectnya ditambah dimana categori idnya sesuai
        }
        $this->db->query($query); // set query
        $this->db->bind(':keyword', "%$keyword%"); // isi :keyword di query dengan value, contohnya keyword diisi $keyword
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        $this->db->bind(':offset', $offset, PDO::PARAM_INT);
        if (isset($_POST['cId'])) { // kalo data post category id ada
            $cid = $_POST['cId'];
            $this->db->bind(':cid', $cid); // isi :cid di queri dengan value
        }
        return $this->db->resultSet(); // kembalikan nilai beberapa data
    }

    public function getMoviesTotal($keyword)
    {
        $query = 'SELECT COUNT(*) as total FROM ' . $this->tableMovie;
        if (!empty($keyword)) {
            $query = 'SELECT COUNT(*) as total FROM ' . $this->tableMovie . ' WHERE title LIKE :keyword';
        }
        $this->db->query($query);
        if (!empty($keyword)) {
            $this->db->bind(':keyword', '%' . $keyword . '%');
        }
        $result = $this->db->single();
        return $result ? $result['total'] : 0;
    }

    public function getMoviesDetails($keyword, $page = 1, $limit = 10)
    {
        $offset = ($page - 1) * $limit;

        $query = 'SELECT * FROM ' . $this->tableMovieDetails . ' LIMIT :limit OFFSET :offset';
        if (!empty($keyword)) {
            $query = 'SELECT * FROM ' . $this->tableMovieDetails . ' WHERE title LIKE :keyword LIMIT :limit OFFSET :offset';
        }
        $this->db->query($query);
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        $this->db->bind(':offset', $offset, PDO::PARAM_INT);
        if (!empty($keyword)) {
            $this->db->bind(':keyword', '%' . $keyword . '%');
        }
        return $this->db->resultSet();
    }

    public function getMoviesDetailsTotal($keyword)
    {
        $query = 'SELECT COUNT(*) as total FROM ' . $this->tableMovieDetails;
        if (!empty($keyword)) {
            $query = 'SELECT COUNT(*) as total FROM ' . $this->tableMovieDetails . ' WHERE title LIKE :keyword';
        }
        $this->db->query($query);
        if (!empty($keyword)) {
            $this->db->bind(':keyword', '%' . $keyword . '%');
        }
        $result = $this->db->single();
        return $result ? $result['total'] : 0;
    }

    public function getMovieCasts($id, $page = 1, $limit = 10)
    {
        $offset = ($page - 1) * $limit;

        $this->db->query('SELECT * FROM ' . $this->tableMovieCasts . ' WHERE movie_id = :id LIMIT :limit OFFSET :offset');
        $this->db->bind('id', $id);
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        $this->db->bind(':offset', $offset, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function getMovieCastsTotal($id)
    {
        $this->db->query('SELECT COUNT(*) as total FROM ' . $this->tableMovieCasts . ' WHERE movie_id = :id');
        $this->db->bind(':id', $id);
        $result = $this->db->single();
        return $result ? $result['total'] : 0;
    }


    public function getMovieDetails($id)
    {
        $this->db->query('SELECT * FROM ' . $this->tableMovieDetails . ' WHERE id = :id');
        $this->db->bind('id', $id);
        return $this->db->single(); // kembalikan nilainya hanya satu data
    }

    public function getMovieReviews($id)
    {
        $this->db->query('SELECT * FROM ' . $this->tableMovieReviews . ' WHERE movie_id = :id');
        $this->db->bind('id', $id);
        return $this->db->resultSet();
    }

    public function getCategoryMovies($id, $keyword, $page = 1, $limit = 10)
    {
        $offset = ($page - 1) * $limit;
        $query = 'SELECT * FROM ' . $this->tableMovie . ' WHERE categories_id = :id LIMIT :limit OFFSET :offset';
        if (!empty($keyword)) {
            $query = 'SELECT * FROM ' . $this->tableMovie . ' WHERE categories_id = :id AND title  LIKE :keyword LIMIT :limit OFFSET :offset';
        }
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        $this->db->bind(':offset', $offset, PDO::PARAM_INT);
        if (!empty($keyword)) {
            $this->db->bind(':keyword', '%' . $keyword . '%');
        }
        return $this->db->resultSet();
    }

    public function getCategoryMoviesTotal($id, $keyword)
    {
        $query = 'SELECT COUNT(*) as total FROM ' . $this->tableMovie. ' WHERE categories_id = :id';
        if (!empty($keyword)) {
            $query = 'SELECT COUNT(*) as total FROM ' . $this->tableMovie . ' WHERE categories_id = :id AND title  LIKE :keyword';
        }
        $this->db->query($query);
        $this->db->bind('id', $id);
        if (!empty($keyword)) {
            $this->db->bind(':keyword', '%' . $keyword . '%');
        }
        $result = $this->db->single();
        return $result ? $result['total'] : 0;
    }

    public function update($data, $path = '')
    {
        $query = 'UPDATE ' . $this->table . ' SET title = :t, description = :d, categories_id = :cid, duration = :dr, release_year = :ry WHERE id = :id';
        if (!empty($path)) {
            $query = 'UPDATE ' . $this->table . ' SET title = :t, description = :d, categories_id = :cid, duration = :dr, release_year = :ry, img_cover = :img WHERE id = :id';
        }
        $this->db->query($query);
        $this->db->bind(':t', $data['editTitle']);
        $this->db->bind(':d', $data['editDescription']);
        $this->db->bind(':cid', $data['editCategory']);
        $this->db->bind(':dr', $data['editDuration']);
        $this->db->bind(':ry', $data['editReleaseYear']);
        $this->db->bind(':id', $data['editFilmId']);
        if (!empty($path)) {
            $this->db->bind(':img', $path);
        }
        $this->db->execute(); // jalanin querynya
        return $this->db->rowCount(); // return kembalikan nilai, rowCount buat ngecek apakah ada perubahan data di table
    }

    public function create($data)
    {
        $this->db->query('INSERT INTO ' . $this->table . ' (title, description, categories_id, duration, release_year) VALUES (:t, :d, :cid, :dr, :ry)');
        $this->db->bind(':t', $data['addTitle']);
        $this->db->bind(':d', $data['addDesc']);
        $this->db->bind(':cid', $data['addCategory']);
        $this->db->bind(':dr', $data['addDuration']);
        $this->db->bind(':ry', $data['addDate']);
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

    public function updateCast($id, $cast)
    {
        $this->db->query('UPDATE ' . $this->tableCastMovie . ' SET play_as = :c WHERE id = :id');
        $this->db->bind(':c', $cast);
        $this->db->bind(':id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function addCast($actorId, $movieId)
    {
        $this->db->query('INSERT INTO ' . $this->tableCastMovie . ' (movie_id, actor_id) VALUES (:m, :a)');
        $this->db->bind(':m', $movieId);
        $this->db->bind(':a', $actorId);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getMovieCastsId($id)
    {
        $this->db->query('SELECT actor_id FROM ' . $this->tableMovieCasts . ' WHERE movie_id = :id');
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function deleteCast($id)
    {
        $this->db->query('DELETE FROM ' . $this->tableCastMovie . ' WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }
}
