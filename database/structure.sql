CREATE TABLE diagram_shape
(
  id         INT AUTO_INCREMENT
    PRIMARY KEY,
  diagram_id INT          NULL,
  category   INT          NULL,
  `key`      INT          NULL,
  loc        VARCHAR(255) NULL
)
  ENGINE = InnoDB;

CREATE INDEX diagram_shape_diagrams__fk
  ON diagram_shape (diagram_id);

CREATE INDEX diagram_shape_shapes__fk
  ON diagram_shape (category);

CREATE TABLE diagrams
(
  id         INT AUTO_INCREMENT
    PRIMARY KEY,
  sector     VARCHAR(255)    NULL,
  image      TEXT            NULL,
  width      INT DEFAULT '0' NULL,
  height     INT DEFAULT '0' NULL,
  background VARCHAR(255)    NULL,
  created    DATETIME        NULL,
  updated    VARCHAR(255)    NULL
)
  ENGINE = InnoDB;

ALTER TABLE diagram_shape
  ADD CONSTRAINT diagram_shape_diagrams__fk
FOREIGN KEY (diagram_id) REFERENCES diagrams (id)
  ON UPDATE CASCADE
  ON DELETE CASCADE;

CREATE TABLE ports
(
  id       INT AUTO_INCREMENT
    PRIMARY KEY,
  shape_id INT         NULL,
  name     VARCHAR(55) NULL,
  location VARCHAR(55) NULL,
  color    VARCHAR(55) NULL,
  created  DATETIME    NULL,
  updated  VARCHAR(55) NULL
)
  ENGINE = InnoDB;

CREATE INDEX ports_shapes__fk
  ON ports (shape_id);

CREATE TABLE shapes
(
  id         INT AUTO_INCREMENT
    PRIMARY KEY,
  note       VARCHAR(255) NOT NULL,
  type       VARCHAR(55)  NULL,
  width      VARCHAR(55)  NULL,
  height     VARCHAR(55)  NULL,
  background VARCHAR(55)  NULL,
  color      VARCHAR(55)  NULL,
  created    DATETIME     NULL,
  updated    DATETIME     NULL
)
  ENGINE = InnoDB;

ALTER TABLE diagram_shape
  ADD CONSTRAINT diagram_shape_shapes__fk
FOREIGN KEY (category) REFERENCES shapes (id);

ALTER TABLE ports
  ADD CONSTRAINT ports_shapes__fk
FOREIGN KEY (shape_id) REFERENCES shapes (id)
  ON UPDATE CASCADE
  ON DELETE CASCADE;

