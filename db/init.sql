CREATE TABLE entries (
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  colloquial TEXT NOT NULL,
  genus TEXT NOT NULL,
  plant_id TEXT NOT NULL,
  file_ext TEXT NOT NULL,
  perennial INTEGER NOT NULL,
  annual INTEGER NOT NULL,
  full_sun INTEGER NOT NULL,
  partial_shade INTEGER NOT NULL,
  full_shade INTEGER NOT NULL,
  class INTEGER NOT NULL
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

CREATE TABLE users (
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  username TEXT NOT NULL UNIQUE,
  password_str TEXT NOT NULL
);


INSERT INTO entries (
  id,
  colloquial,
  genus,
  plant_id,
  file_ext,
  perennial,
  annual,
  full_sun,
  partial_shade,
  full_shade,
  class
)
VALUES (
  1,
  'Cutleaf Weeping BirchÂ',
  'Betula pendula (Dalecarlica)',
  '0',
  'jpg',
  0, 0, 1, 1, 0, 3
);

INSERT INTO entries (
  id,
  colloquial,
  genus,
  plant_id,
  file_ext,
  perennial,
  annual,
  full_sun,
  partial_shade,
  full_shade,
  class
)
VALUES (
  2,
  'High mallow',
  'Malva sylvestris',
  '2',
  'jpg',
  1, 0, 1, 1, 0, 4
);

INSERT INTO entries (
  id,
  colloquial,
  genus,
  plant_id,
  file_ext,
  perennial,
  annual,
  full_sun,
  partial_shade,
  full_shade,
  class
)
VALUES (
  3,
  'Zebra Grass',
  'Miscanthus sinensis (Zebrinus)',
  '0',
  'jpg',
  1, 0, 1, 0, 0, 1
);

INSERT INTO entries (
  id,
  colloquial,
  genus,
  plant_id,
  file_ext,
  perennial,
  annual,
  full_sun,
  partial_shade,
  full_shade,
  class
)
VALUES (
  4,
  'Pincushion Moss',
  'Leucobryum glaucum',
  '0',
  'jpg',
  1, 0, 0, 1, 1, 6
);

INSERT INTO entries (
  id,
  colloquial,
  genus,
  plant_id,
  file_ext,
  perennial,
  annual,
  full_sun,
  partial_shade,
  full_shade,
  class
)
VALUES (
  5,
  'Burdock',
  'Arctium minusÂ',
  '0',
  'jpg',
  1, 0, 1, 1, 0, 4
);

INSERT INTO entries (
  id,
  colloquial,
  genus,
  plant_id,
  file_ext,
  perennial,
  annual,
  full_sun,
  partial_shade,
  full_shade,
  class
)
VALUES (
  6,
  'Hazelnut/Filbert',
  'Corylus avellana',
  '0',
  'jpg',
  1, 0, 1, 1, 0, 0
);

INSERT INTO entries (
  id,
  colloquial,
  genus,
  plant_id,
  file_ext,
  perennial,
  annual,
  full_sun,
  partial_shade,
  full_shade,
  class
)
VALUES (
  7,
  'Snowdrops',
  'Galanthus nivalis',
  '0',
  'jpg',
  1, 0, 1, 1, 0, 4
);

INSERT INTO entries (
  id,
  colloquial,
  genus,
  plant_id,
  file_ext,
  perennial,
  annual,
  full_sun,
  partial_shade,
  full_shade,
  class
)
VALUES (
  8,
  'Blue violet',
  'Viola sororia',
  '8',
  'jpg',
  1, 0, 1, 1, 0, 5
);

INSERT INTO entries (
  id,
  colloquial,
  genus,
  plant_id,
  file_ext,
  perennial,
  annual,
  full_sun,
  partial_shade,
  full_shade,
  class
)
VALUES (
  9,
  'Switchgrass',
  'Panicum virgatum',
  '9',
  'jpg',
  1, 0, 1, 1, 0, 1
);

INSERT INTO entries (
  id,
  colloquial,
  genus,
  plant_id,
  file_ext,
  perennial,
  annual,
  full_sun,
  partial_shade,
  full_shade,
  class
)
VALUES (
  10,
  'Northern Bush Honeysuckle',
  'Diervilla lonicera',
  '10',
  'jpg',
  1, 0, 1, 1, 0, 2
);

INSERT INTO entries (
  id,
  colloquial,
  genus,
  plant_id,
  file_ext,
  perennial,
  annual,
  full_sun,
  partial_shade,
  full_shade,
  class
)
VALUES (
  11,
  'Solomans Seal',
  'Polygonatum biflorumÂ',
  '11',
  'jpg',
  1, 0, 0, 1, 1, 4
);

INSERT INTO entries (
  id,
  colloquial,
  genus,
  plant_id,
  file_ext,
  perennial,
  annual,
  full_sun,
  partial_shade,
  full_shade,
  class
)
VALUES (
  12,
  'Ostrich fern',
  'Matteuccia struthiopteris',
  '12',
  'jpg',
  1, 0, 0, 1, 1, 6
);

INSERT INTO entries (
  id,
  colloquial,
  genus,
  plant_id,
  file_ext,
  perennial,
  annual,
  full_sun,
  partial_shade,
  full_shade,
  class
)
VALUES (
  13,
  'Red Pine',
  'Pinus resinosa',
  '13',
  'jpg',
  1, 0, 1, 1, 0, 3
);

INSERT INTO entries (
  id,
  colloquial,
  genus,
  plant_id,
  file_ext,
  perennial,
  annual,
  full_sun,
  partial_shade,
  full_shade,
  class
)
VALUES (
  14,
  'Black-Eyed Susan',
  'Rudbekia hirta',
  '14',
  'jpg',
  1, 0, 1, 0, 0, 4
);

INSERT INTO entries (
  id,
  colloquial,
  genus,
  plant_id,
  file_ext,
  perennial,
  annual,
  full_sun,
  partial_shade,
  full_shade,
  class
)
VALUES (
  15,
  'Juneberry Regent',
  'Amelanchier alniflora',
  '15',
  'jpg',
  1, 0, 1, 1, 0, 0
);

INSERT INTO entries (
  id,
  colloquial,
  genus,
  plant_id,
  file_ext,
  perennial,
  annual,
  full_sun,
  partial_shade,
  full_shade,
  class
)
VALUES (
  16,
  'Summer-Sweet',
  'Clethra alnifolia',
  '16',
  'jpg',
  0, 0, 1, 1, 0, 0
);

INSERT INTO tags (
  id,
  tag_name
)
VALUES (
  1,
  'Exploratory Constructive Play'
);

INSERT INTO tags (
  id,
  tag_name
)
VALUES (
  2,
  'Exploratory Sensory Play'
);

INSERT INTO tags (
  id,
  tag_name
)
VALUES (
  3,
  'Physical Play'
);

INSERT INTO tags (
  id,
  tag_name
)
VALUES (
  4,
  'Imaginative Play'
);

INSERT INTO tags (
  id,
  tag_name
)
VALUES (
  5,
  'Restorative Play'
);

INSERT INTO tags (
  id,
  tag_name
)
VALUES (
  6,
  'Expressive Play'
);

INSERT INTO tags (
  id,
  tag_name
)
VALUES (
  7,
  'Play With Rules'
);

INSERT INTO tags (
  id,
  tag_name
)
VALUES (
  8,
  'Bio Play'
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  1, 1, 1
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  2, 1, 2
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  3, 1, 3
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  4, 1, 4
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  5, 1, 5
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  6, 1, 8
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  7, 2, 2
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  8, 2, 3
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  9, 2, 4
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  10, 2, 8
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  11, 3, 1
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  12, 3, 2
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  13, 3, 3
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  14, 3, 4
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  15, 3, 5
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  16, 3, 7
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  17, 3, 8
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  18, 4, 2
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  19, 4, 4
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  20, 4, 5
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  21, 4, 8
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  22, 5, 2
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  23, 5, 3
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  24, 5, 4
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  25, 5, 8
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  26, 6, 2
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  27, 6, 3
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  28, 6, 8
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  29, 7, 2
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  30, 7, 4
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  31, 7, 5
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  32, 8, 2
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  33, 8, 3
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  34, 8, 8
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  35, 9, 1
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  36, 9, 2
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  37, 9, 3
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  38, 9, 5
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  39, 9, 7
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  40, 9, 8
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  41, 10, 1
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  42, 10, 2
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  43, 10, 3
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  44, 10, 4
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  45, 10, 5
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  46, 10, 7
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  47, 10, 8
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  48, 11, 2
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  49, 11, 3
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  50, 11, 4
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  51, 11, 5
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  52, 11, 7
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  53, 11, 8
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  54, 12, 1
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  55, 12, 2
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  56, 12, 3
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  57, 12, 4
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  58, 12, 5
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  59, 12, 7
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  60, 12, 8
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  61, 13, 1
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  62, 13, 2
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  63, 13, 3
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  64, 13, 4
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  65, 13, 5
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  66, 13, 8
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  67, 14, 2
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  68, 14, 3
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  69, 14, 4
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  70, 14, 5
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  71, 14, 8
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  72, 15, 2
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  73, 15, 3
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  74, 15, 4
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  75, 15, 5
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  76, 15, 8
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  77, 16, 2
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  78, 16, 3
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  79, 16, 4
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  80, 16, 5
);

INSERT INTO entries_tags (
  id, entry_id, tag_id
)
VALUES (
  81, 16, 8
);
