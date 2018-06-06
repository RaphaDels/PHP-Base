-- Récupére les brasseries ainsi que les marques qui y sont fabriqués
SELECT * FROM brewery
INNER JOIN brewery_made_brand ON brewery.id = brewery_made_brand.brewery_id
INNER JOIN brand ON brewery_made_brand.brand_id = brand.id

-- Récupére les bières ainsi que les marques
SELECT * FROM beer
INNER JOIN brand ON beer.brand_id = brand.id

-- Récupére les bières ainsi que les marques et les EBC
SELECT * FROM beer
INNER JOIN brand ON beer.brand_id = brand.id
INNER JOIN ebc ON beer.ebc_id = ebc.id

-- Récupére les bières avec un prix inférieur à 1.50 ainsi que les marques et les EBC
SELECT * FROM beer
INNER JOIN brand ON beer.brand_id = brand.id
INNER JOIN ebc ON beer.ebc_id = ebc.id
WHERE beer.price < 1.50

-- Récupère les marques qui n'ont pas de bières
SELECT * FROM beer
RIGHT JOIN brand ON beer.brand_id = brand.id
WHERE beer.id is NULL
