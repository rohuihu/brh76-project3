CREATE TABLE entries (
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  colloquial TEXT NOT NULL,
  genus TEXT NOT NULL,
  plant_id TEXT NOT NULL,
  image_id TEXT NOT NULL,
  file_ext TEXT NOT NULL,
  explore_constructive INTEGER NOT NULL,
  explore_sensory INTEGER NOT NULL,
  physical INTEGER NOT NULL,
  imaginative INTEGER NOT NULL,
  restorative INTEGER NOT NULL,
  expressive INTEGER NOT NULL,
  play_with_rules INTEGER NOT NULL,
  bio_play INTEGER NOT NULL,
  hardiness TEXT NOT NULL
);

CREATE TABLE entries_tags (
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  entry_id INTEGER NOT NULL,
  tag_id INTEGER NOT NULL,
  FOREIGN KEY (entry_id) REFERENCES entries(id),
  FOREIGN KEY (tag_id) REFERENCES tags(id)
);

CREATE TABLE tags (
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  tag_name TEXT NOT NULL
);

CREATE TABLE groups (
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  name TEXT NOT NULL UNIQUE
);

CREATE TABLE sessions (
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  user_id INTEGER NOT NULL,
  session TEXT NOT NULL UNIQUE,
  last_login TEXT NOT NULL,
  FOREIGN KEY(user_id) REFERENCES users(id)
);

CREATE TABLE users (
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  name TEXT NOT NULL,
  username TEXT NOT NULL UNIQUE,
  password TEXT NOT NULL
);

-- password: monkey
INSERT INTO
  users (id, name, username, password)
VALUES
  (
    1,
    'Kyle Harms',
    'kyle',
    '$2y$10$QtCybkpkzh7x5VN11APHned4J8fu78.eFXlyAMmahuAaNcbwZ7FH.'
  );

INSERT INTO
  groups (id, name)
VALUES
  (1, 'admin');


-- Memberships
CREATE TABLE memberships (
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  group_id INTEGER NOT NULL,
  user_id INTEGER NOT NULL,
  FOREIGN KEY(group_id) REFERENCES groups(id),
  FOREIGN KEY(user_id) REFERENCES users(id)
);

-- User 'kyle' is a member of the 'admin' group.
INSERT INTO
  memberships (group_id, user_id)
VALUES
  (1, 1);


INSERT INTO entries (
  id,
  colloquial,
  genus,
  plant_id,
  image_id,
  file_ext,
  explore_constructive,
  explore_sensory,
  physical,
  imaginative,
  restorative,
  expressive,
  play_with_rules,
  bio_play,
  hardiness
)
VALUES (
  1,
  'Cutleaf Weeping BirchÂ',
  'Betula pendula (Dalecarlica)',
  'TR_07',
  '0',
  'jpg',
  1, 1, 1, 1, 1, 0, 0, 1,
  '2-7'
);

INSERT INTO entries (
  id,
  colloquial,
  genus,
  plant_id,
  image_id,
  file_ext,
  explore_constructive,
  explore_sensory,
  physical,
  imaginative,
  restorative,
  expressive,
  play_with_rules,
  bio_play,
  hardiness
)
VALUES (
  2,
  'High mallow',
  'Malva sylvestris',
  'FL_37',
  '2',
  'jpg',
  0, 1, 1, 1, 0, 0, 0, 1,
  '4-8'
);

INSERT INTO entries (
  id,
  colloquial,
  genus,
  plant_id,
  image_id,
  file_ext,
  explore_constructive,
  explore_sensory,
  physical,
  imaginative,
  restorative,
  expressive,
  play_with_rules,
  bio_play,
  hardiness
)
VALUES (
  3,
  'Zebra Grass',
  'Miscanthus sinensis (Zebrinus)',
  'GA_16',
  '0',
  'jpg',
  1, 1, 1, 1, 1, 0, 1, 1,
  '5-9'
);

INSERT INTO entries (
  id,
  colloquial,
  genus,
  plant_id,
  image_id,
  file_ext,
  explore_constructive,
  explore_sensory,
  physical,
  imaginative,
  restorative,
  expressive,
  play_with_rules,
  bio_play,
  hardiness
)
VALUES (
  4,
  'Pincushion Moss',
  'Leucobryum glaucum',
  'FE_13',
  '0',
  'jpg',
  0, 1, 0, 1, 1, 0, 0, 1,
  '4-10'
);

INSERT INTO entries (
  id,
  colloquial,
  genus,
  plant_id,
  image_id,
  file_ext,
  explore_constructive,
  explore_sensory,
  physical,
  imaginative,
  restorative,
  expressive,
  play_with_rules,
  bio_play,
  hardiness
)
VALUES (
  5,
  'Burdock',
  'Arctium minusÂ',
  'FL_13',
  '0',
  'jpg',
  0, 1, 1, 1, 0, 0, 0, 1,
  '3-10'
);

INSERT INTO entries (
  id,
  colloquial,
  genus,
  plant_id,
  image_id,
  file_ext,
  explore_constructive,
  explore_sensory,
  physical,
  imaginative,
  restorative,
  expressive,
  play_with_rules,
  bio_play,
  hardiness
)
VALUES (
  6,
  'Hazelnut/Filbert',
  'Corylus avellana',
  'SH_12',
  '0',
  'jpg',
  0, 1, 1, 0, 0, 0, 0, 1,
  '4-8'
);

INSERT INTO entries (
  id,
  colloquial,
  genus,
  plant_id,
  image_id,
  file_ext,
  explore_constructive,
  explore_sensory,
  physical,
  imaginative,
  restorative,
  expressive,
  play_with_rules,
  bio_play,
  hardiness
)
VALUES (
  7,
  'Snowdrops',
  'Galanthus nivalis',
  'FL_11',
  '0',
  'jpg',
  0, 1, 0, 1, 1, 0, 0, 0,
  '3-7'
);

INSERT INTO entries (
  id,
  colloquial,
  genus,
  plant_id,
  image_id,
  file_ext,
  explore_constructive,
  explore_sensory,
  physical,
  imaginative,
  restorative,
  expressive,
  play_with_rules,
  bio_play,
  hardiness
)
VALUES (
  8,
  'Blue violet',
  'Viola sororia',
  'GR_15',
  '8',
  'jpg',
  0, 1, 1, 0, 0, 0, 0, 1,
  '3-7'
);

INSERT INTO entries (
  id,
  colloquial,
  genus,
  plant_id,
  image_id,
  file_ext,
  explore_constructive,
  explore_sensory,
  physical,
  imaginative,
  restorative,
  expressive,
  play_with_rules,
  bio_play,
  hardiness
)
VALUES (
  9,
  'Switchgrass',
  'Panicum virgatum',
  'GA_03',
  '9',
  'jpg',
  1, 1, 1, 1, 1, 0, 1, 1,
  '5-9'
);

INSERT INTO entries (
  id,
  colloquial,
  genus,
  plant_id,
  image_id,
  file_ext,
  explore_constructive,
  explore_sensory,
  physical,
  imaginative,
  restorative,
  expressive,
  play_with_rules,
  bio_play,
  hardiness
)
VALUES (
  10,
  'Northern Bush Honeysuckle',
  'Diervilla lonicera',
  'VI_02',
  '10',
  'jpg',
  0, 1, 1, 1, 0, 0, 0, 1,
  '3-7'
);

INSERT INTO entries (
  id,
  colloquial,
  genus,
  plant_id,
  image_id,
  file_ext,
  explore_constructive,
  explore_sensory,
  physical,
  imaginative,
  restorative,
  expressive,
  play_with_rules,
  bio_play,
  hardiness
)
VALUES (
  11,
  'Solomans Seal',
  'Polygonatum biflorumÂ',
  'FL_12',
  '11',
  'jpg',
  0, 1, 1, 1, 0, 0, 0, 1,
  '3-9'
);

INSERT INTO entries (
  id,
  colloquial,
  genus,
  plant_id,
  image_id,
  file_ext,
  explore_constructive,
  explore_sensory,
  physical,
  imaginative,
  restorative,
  expressive,
  play_with_rules,
  bio_play,
  hardiness
)
VALUES (
  12,
  'Ostrich fern',
  'Matteuccia struthiopteris',
  'FE_11',
  '12',
  'jpg',
  0, 1, 0, 1, 1, 0, 0, 1,
  '3-7'
);

INSERT INTO entries (
  id,
  colloquial,
  genus,
  plant_id,
  image_id,
  file_ext,
  explore_constructive,
  explore_sensory,
  physical,
  imaginative,
  restorative,
  expressive,
  play_with_rules,
  bio_play,
  hardiness
)
VALUES (
  13,
  'Red Pine',
  'Pinus resinosa',
  'TR_04',
  '13',
  'jpg',
  1, 1, 1, 0, 1, 0, 0, 1,
  '3-9'
);

INSERT INTO entries (
  id,
  colloquial,
  genus,
  plant_id,
  image_id,
  file_ext,
  explore_constructive,
  explore_sensory,
  physical,
  imaginative,
  restorative,
  expressive,
  play_with_rules,
  bio_play,
  hardiness
)
VALUES (
  14,
  'Black-Eyed Susan',
  'Rudbekia hirta',
  'FL_35',
  '14',
  'jpg',
  0, 1, 1, 0, 0, 0, 0, 1,
  '3-7'
);

INSERT INTO entries (
  id,
  colloquial,
  genus,
  plant_id,
  image_id,
  file_ext,
  explore_constructive,
  explore_sensory,
  physical,
  imaginative,
  restorative,
  expressive,
  play_with_rules,
  bio_play,
  hardiness
)
VALUES (
  15,
  'Juneberry Regent',
  'Amelanchier alniflora',
  'SH_22',
  '15',
  'jpg',
  0, 1, 1, 0, 0, 0, 0, 1,
  '2-7'
);

INSERT INTO entries (
  id,
  colloquial,
  genus,
  plant_id,
  image_id,
  file_ext,
  explore_constructive,
  explore_sensory,
  physical,
  imaginative,
  restorative,
  expressive,
  play_with_rules,
  bio_play,
  hardiness
)
VALUES (
  16,
  'Summer-Sweet',
  'Clethra alnifolia',
  'SH_07',
  '16',
  'jpg',
  0, 1, 1, 0, 0, 0, 0, 1,
  '3-9'
);

INSERT INTO tags (
  id,
  tag_name
)
VALUES (
  1,
  'Shrub'
);

INSERT INTO tags (
  id,
  tag_name
)
VALUES (
  2,
  'Grass'
);

INSERT INTO tags (
  id,
  tag_name
)
VALUES (
  3,
  'Vine'
);

INSERT INTO tags (
  id,
  tag_name
)
VALUES (
  4,
  'Tree'
);

INSERT INTO tags (
  id,
  tag_name
)
VALUES (
  5,
  'Flower'
);

INSERT INTO tags (
  id,
  tag_name
)
VALUES (
  6,
  'Groundcovers'
);

INSERT INTO tags (
  id,
  tag_name
)
VALUES (
  7,
  'Other'
);

INSERT INTO tags (
  id,
  tag_name
)
VALUES (
  8,
  'Perennial'
);

INSERT INTO tags (
  id,
  tag_name
)
VALUES (
  9,
  'Annual'
);

INSERT INTO tags (
  id,
  tag_name
)
VALUES (
  10,
  'Full Sun'
);

INSERT INTO tags (
  id,
  tag_name
)
VALUES (
  11,
  'Partial Shade'
);

INSERT INTO tags (
  id,
  tag_name
)
VALUES (
  12,
  'Full Shade'
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  1, 1, 4
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  2, 1, 10
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  3, 1, 11
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  4, 2, 5
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  5, 2, 8
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  6, 2, 10
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  7, 2, 11
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  8, 3, 2
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  9, 3, 8
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  10, 3, 10
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  11, 4, 7
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  12, 4, 8
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  13, 4, 11
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  14, 4, 12
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  15, 5, 5
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  16, 5, 8
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  17, 5, 10
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  18, 5, 11
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  19, 6, 1
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  20, 6, 8
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  21, 6, 10
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  22, 6, 11
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  23, 7, 5
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  24, 7, 8
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  25, 7, 10
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  26, 7, 11
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  27, 8, 6
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  28, 8, 8
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  29, 8, 10
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  30, 8, 11
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  31, 9, 2
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  32, 9, 8
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  33, 9, 10
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  34, 9, 11
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  35, 10, 3
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  36, 10, 8
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  37, 10, 10
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  38, 10, 11
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  39, 11, 5
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  40, 11, 8
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  41, 11, 11
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  42, 11, 12
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  43, 12, 7
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  44, 12, 8
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  45, 12, 11
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  46, 12, 12
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  47, 13, 4
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  48, 13, 8
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  49, 13, 10
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  50, 13, 11
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  51, 14, 5
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  52, 14, 8
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  53, 14, 10
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  54, 15, 1
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  55, 15, 8
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  56, 15, 10
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  57, 15, 11
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  58, 16, 1
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  59, 16, 10
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  60, 16, 11
);
