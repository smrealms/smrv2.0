/* adding planet stuff */
ALTER TABLE planet
ADD planet_image VARCHAR( 32 ) NOT NULL DEFAULT 'images/planets/earth.png';
ALTER TABLE planet
ADD planet_size VARCHAR( 16 ) NOT NULL DEFAULT '100%';
ALTER TABLE planet
ADD moon_image VARCHAR( 32 ) NULL DEFAULT NULL;
ALTER TABLE planet
ADD moon_size VARCHAR( 16 ) NULL DEFAULT NULL;
ALTER TABLE planet
ADD ring_image VARCHAR( 32 ) NULL DEFAULT NULL;
ALTER TABLE planet
ADD ring_size VARCHAR( 16 ) NULL DEFAULT NULL;
