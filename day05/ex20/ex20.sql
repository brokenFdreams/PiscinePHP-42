SELECT film.id_genre, genre.name AS 'the genre''s name',
	   film.id_distrib, distrib.name AS 'the distributor''s name',
	   film.title AS 'the film''s title'
FROM film
LEFT JOIN genre ON film.id_genre = genre.id_genre
LEFT JOIN distrib ON film.id_distrib = distrib.id_distrib
WHERE film.id_genre BETWEEN 4 AND 8;
