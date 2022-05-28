USE db_alinea;

-- insertion des produits (goodies)

INSERT INTO `product`
(
	`active`
	, `name`
	, `purchase_url`
	, `price`
	, `description`
)
VALUES
	(
		1
		, "Hoodie - blanc"
		, "https://alina-musique.creator-spring.com/listing/alinea-musique?product=1305"
		, 50.33
		, "Coupe décontractée, 100% coton éponge française, capuche non doublée, épaules tombantes, poche kangourou, cordon de serrage en métal de couleur assortie, ourlet et poignets côtelés, pré-rétréci pour minimiser le rétrécissement. \N (tailles : XS , S , M , L , XL) (couleur : blanc)"
	),
	(
		1
		, "Sweat manches longues - gris"
		, "https://alina-musique.creator-spring.com/listing/alinea-musique?product=756&variation=103344&size=4375"
		, 29.99
		, "Coupe 'Slim fit', unisexe. Matériaux : 100% coton doux premium. \n (tailles : S , M , L , XL , 2XL) (couleur: gris)"
	),
	(
		1
		, "Sweat manches longues - blanc"
		, "https://alina-musique.creator-spring.com/listing/alinea-musique?product=756&variation=103355&size=4375"
		, 29.99
		, "Coupe 'Slim fit', unisexe. Matériaux : 100% coton doux premium. \n (tailles : S , M , L , XL , 2XL) (couleur: blanc)"
	),
	(
		1
		, "Débardeur femme - blanc"
		, "https://alina-musique.creator-spring.com/listing/alinea-musique?product=536"
		, 28.99
		, "Coupe drapée décontractée, ourlet inférieur froncé, style dos nageur. Matériaux : 65% poly / 35% viscose. \n (tailles : S , M , L , XL) (couleur: blanc)"
	),
	(
		1
		, "Chaussettes - noires"
		, "https://alina-musique.creator-spring.com/listing/alinea-musique?product=655&variation=102829&size=4201"
		, 19.98
		, "Matériaux : 100% polyester. (Taille unique) (couleur : noir)."
	),
	(
		1
		, "Chaussettes - blanches"
		, "https://alina-musique.creator-spring.com/listing/alinea-musique?product=655&variation=102848&size=4201"
		, 19.98
		, "Matériaux : 100% polyester. (Taille unique) (couleur : noir)."
	),
	(
		1,
		, "Sac écologique - noir"
		, "https://alina-musique.creator-spring.com/listing/alinea-musique?product=932&variation=103878&size=4816"
		, 29.99
		, "Les sacs à main écologiques ont une capacité de stockage de 18 litres et une grande ouverture parfaite pour transporter et accéder aux articles. Ces sacs à main de la collection Conscious sont certifiés par la norme Global Organic Textile Standard. Matériaux : 100% coton organique. (Taille : 38cm x 35cm) (couleur : noir)."
	),
	(
		1,
		, "Sac écologique - beige"
		, "https://alina-musique.creator-spring.com/listing/alinea-musique?product=932&variation=103878&size=4816"
		, 29.99
		, "Les sacs à main écologiques ont une capacité de stockage de 18 litres et une grande ouverture parfaite pour transporter et accéder aux articles. Ces sacs à main de la collection Conscious sont certifiés par la norme Global Organic Textile Standard. Matériaux : 100% coton organique. (Taille : 38cm x 35cm) (couleur : beige)."
	),
	(
		1,
		, "Sticker - noir"
		, "https://alina-musique.creator-spring.com/listing/alinea-musique?product=661&variation=102915&size=4211"
		, 8.99
		, "(Tailles : 9.15 x 12.7 cm  ou  12.7 x 17.8 cm) (couleur : noir)."
	),
	(
		1,
		, "Sticker - blanc"
		, "https://alina-musique.creator-spring.com/listing/alinea-musique?product=661&variation=102914&size=4211"
		, 8.99
		, "(Tailles : 9.15 x 12.7 cm  ou  12.7 x 17.8 cm) (couleur : blanc)."
	)
;

INSERT INTO `productimage`
(
	`active` 
	, `fk_product_rowid`
	, `path_image`
	, `title`
	, `alt_text`
)
VALUES
	(
		1,
		1,
		, "assets/img/products/hoodie-white/front.jpg"
		, "Hoodie Blanc - devant"
		, "Hoodie Blanc - devant"
	),
	(
		1,
		1,
		, "assets/img/products/hoodie-white/back.jpg"
		, "Hoodie Blanc - au dos"
		, "Hoodie Blanc - au dos"
	),
	(
		1,
		2,
		, "assets/img/products/longsleeve-black/front.jpg"
		, "Sweat manches longues - gris - devant"
		, "Sweat manches longues - gris - devant"
	),
	(
		1,
		2,
		, "assets/img/products/longsleeve-black/back.jpg"
		, "Sweat manches longues - gris - au dos"
		, "Sweat manches longues - gris - au dos"
	),
	(
		1,
		3,
		, "assets/img/products/longsleeve-white/front.jpg"
		, "Sweat manches longues - blanc - devant"
		, "Sweat manches longues - blanc - devant"
	),
	(
		1,
		3,
		, "assets/img/products/longsleeve-white/back.jpg"
		, "Sweat manches longues - blanc - au dos"
		, "Sweat manches longues - blanc - au dos"
	),
	(
		1,
		4,
		, "assets/img/products/women-flowy-tank-top/front.jpg"
		, "Débardeur femme - blanc - devant"
		, "Débardeur femme - blanc - devant"
	),
	(
		1,
		4,
		, "assets/img/products/women-flowy-tank-top/back.jpg"
		, "Débardeur femme - blanc - au dos"
		, "Débardeur femme - blanc - au dos"
	),
	(
		1,
		5,
		, "assets/img/products/socks-black/front.jpg"
		, "Chaussettes - noires"
		, "Chaussettes - noires"
	),
	(
		1,
		6,
		, "assets/img/products/socks-white/front.jpg"
		, "Chaussettes - blanches"
		, "Chaussettes - blanches"
	),
	(
		1,
		7,
		, "assets/img/products/bag-black/front.jpg"
		, "Sac écologique - noir - devant"
		, "Sac écologique - noir - devant"
	),
	(
		1,
		7,
		, "assets/img/products/bag-black/back.jpg"
		, "Sac écologique - noir - derrière"
		, "Sac écologique - noir - derrière"
	),
	(
		1,
		8,
		, "assets/img/products/bag-white/front.jpg"
		, "Sac écologique - beige - devant"
		, "Sac écologique - beige - devant"
	),
	(
		1,
		8,
		, "assets/img/products/bag-white/back.jpg"
		, "Sac écologique - beige - derrière"
		, "Sac écologique - beige - derrière"
	),
	(
		1,
		9,
		, "assets/img/products/sticker-black/front.jpg"
		, "Sticker - noir"
		, "Sticker - noir"
	),
	(
		1,
		10,
		, "assets/img/products/sticker-white/white.jpg"
		, "Sticker - blanc"
		, "Sticker - blanc"
	)
;