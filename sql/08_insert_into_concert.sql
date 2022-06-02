USE db_alinea;

INSERT INTO `concert`
(
	`active`
	, `date`
	, `hour_start`
	, `hour_end`
	, `venue_name`
	, `city_name`
	, `url_map`
	, `path_image`
	, `description`
)
VALUES
	(
		1
		, '2022-04-09' -- ou utiliser STR_TO_DATE('24-May-2005', '%d-%M-%Y')
		, '20:00:00'
		, '22:00:00'
		, 'Les Ursulines'
		, 'Crémieux'
		, 'https://goo.gl/maps/dfiKFMc7ahCrUYkUA'
		, 'assets/img/concerts/2022-04-09_les-ursulines.jpeg'
		, "Ici apparaîtra un texte d\'accroche du concert. Venez nombreux pour boire de la bonne bière brassée dans ce lieu convivial, tout en assistant au concert que nous vous avons préparé !"
	)
;
