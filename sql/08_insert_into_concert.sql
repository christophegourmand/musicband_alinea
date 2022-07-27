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
		, '2022-09-03' -- ou utiliser STR_TO_DATE('24-May-2005', '%d-%M-%Y')
		, '19:00:00'
		, '21:00:00'
		, 'Concert privé'
		, ''
		, ''
		, ''
		, ""
	)
;
