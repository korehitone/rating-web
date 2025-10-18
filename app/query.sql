CREATE OR REPLACE VIEW list_movies AS SELECT m.id, m.img_cover, m.title, m.categories_id, c.name FROM movies m JOIN categories c ON c.id = m.categories_id

-- CREATE VIEW user_watchlist AS SELECT u.id, u.username, w.id as watchlist_id, w.name, w.description FROM users u JOIN watchlists w ON w.user_id = u.id

-- CREATE VIEW watchlist_detail AS SELECT w.id, w.name, w.description, m.id as movie_id, m.img_cover, m.title FROM watchlists w JOIN watchlist_movies wm ON wm.watchlist_id = w.id JOIN movies m ON m.id = wm.movie_id


CREATE  OR REPLACE VIEW movie_details AS SELECT 
    m.id, 
    m.img_cover, 
    m.title, 
    m.description, 
    c.id as category_id,
    c.name, 
    m.duration, 
    m.release_year
FROM movies m 
JOIN categories c ON c.id = m.categories_id

CREATE OR REPLACE VIEW movie_reviews AS SELECT 
    m.id as movie_id,
    avg.avg_rating,
    c.name, 
    u.username, 
    r.rating, 
    r.review, 
    r.created_at
FROM movies m 
JOIN categories c ON c.id = m.categories_id 
JOIN reviews r ON r.movie_id = m.id 
JOIN users u ON u.id = r.user_id
JOIN (
    SELECT movie_id, AVG(rating) AS avg_rating 
    FROM reviews 
    GROUP BY movie_id
) avg ON avg.movie_id = m.id
ORDER BY m.id;


CREATE OR REPLACE VIEW movie_casts AS SELECT cm.id, m.id as movie_id, a.img_url , a.fullname, cm.play_as, a.id as actor_id FROM cast_movie cm JOIN movies m ON m.id = cm.movie_id JOIN actor a ON a.id = cm.actor_id

CREATE OR REPLACE VIEW actor_movies AS SELECT a.id as actor_id, m.img_cover, m.title, m.id as movie_id FROM cast_movie cm JOIN movies m ON m.id = cm.movie_id JOIN actor a ON a.id = cm.actor_id;