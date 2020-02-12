DROP TABLE IF EXISTS movimientos;
DROP TABLE IF EXISTS informes;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
  username VARCHAR(100) NOT NULL,
  password VARCHAR(100) NOT NULL,
  CONSTRAINT PK_users PRIMARY KEY (username)
);

CREATE TABLE informes(
  id SERIAL NOT NULL,
  id_user VARCHAR(100) NOT NULL,
  anio INT NOT NULL,
  mes INT NOT NULL,
  ingresos DECIMAL,
  gastos DECIMAL,
  CONSTRAINT PK_informes PRIMARY KEY (id),
  FOREIGN KEY (id_user) REFERENCES users(username)
);

CREATE TABLE movimientos (
  id SERIAL NOT NULL,
  id_informe INT NOT NULL,
  id_user VARCHAR(100) NOT NULL,
  tipo VARCHAR(100) NOT NULL,
  fecha DATE NOT NULL,
  descripcion VARCHAR(100) NOT NULL,
  cantidad DECIMAL,
  CONSTRAINT PK_movimientos PRIMARY KEY (id),
  FOREIGN KEY (id_user) REFERENCES users(username),
  FOREIGN KEY (id_informe) REFERENCES informes(id)
);