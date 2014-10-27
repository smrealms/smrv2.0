/* adding sector stuff */
ALTER TABLE sector
ADD feature_image VARCHAR( 64 ) NULL DEFAULT NULL;
ALTER TABLE sector
ADD feature_location VARCHAR( 32 ) NOT NULL DEFAULT 'center center';
ALTER TABLE sector
ADD feature_size VARCHAR( 32 ) NOT NULL DEFAULT '100% auto';

