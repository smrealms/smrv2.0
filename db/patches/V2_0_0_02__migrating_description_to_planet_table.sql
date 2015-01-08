ALTER TABLE planet_has_building
ADD min_amount int(10) NOT NULL DEFAULT 0;
ALTER TABLE planet_has_building
ADD max_amount int(10) NOT NULL DEFAULT 0;
ALTER TABLE planet_has_building
ADD cost_time int(10) NOT NULL DEFAULT 0;
ALTER TABLE planet_has_building
ADD cost_credit int(10) NOT NULL DEFAULT 0;
ALTER TABLE planet_has_building
ADD exp_gain int(10) NOT NULL DEFAULT 0;

