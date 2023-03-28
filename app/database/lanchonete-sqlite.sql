PRAGMA foreign_keys=OFF; 

CREATE TABLE estado_pedido( 
      id  INTEGER    NOT NULL  , 
      nome text   NOT NULL  , 
      cor text   , 
      ordem int   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE lista( 
      id  INTEGER    NOT NULL  , 
      system_user_id int   NOT NULL  , 
      nome text   NOT NULL  , 
      cor text   , 
      ordem int   , 
 PRIMARY KEY (id),
FOREIGN KEY(system_user_id) REFERENCES system_users(id)) ; 

CREATE TABLE mesas( 
      id  INTEGER    NOT NULL  , 
      nome text   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE pedido( 
      id  INTEGER    NOT NULL  , 
      estado_pedido_id int   NOT NULL  , 
      cliente_id int   NOT NULL  , 
      data_pedido date   NOT NULL  , 
      valor_total double   , 
      mes text   , 
      ano text   , 
      ordem int   , 
      deletado char  (1)     DEFAULT 'F', 
      quantidade_id int   , 
 PRIMARY KEY (id),
FOREIGN KEY(estado_pedido_id) REFERENCES estado_pedido(id),
FOREIGN KEY(cliente_id) REFERENCES mesas(id),
FOREIGN KEY(quantidade_id) REFERENCES qunatidade(id)) ; 

CREATE TABLE pedido_item( 
      id  INTEGER    NOT NULL  , 
      pedido_id int   NOT NULL  , 
      produto_id int   NOT NULL  , 
      quantidade double   NOT NULL  , 
      valor double   NOT NULL  , 
      valor_total double   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(pedido_id) REFERENCES pedido(id),
FOREIGN KEY(produto_id) REFERENCES produto(id)) ; 

CREATE TABLE produto( 
      id  INTEGER    NOT NULL  , 
      tipo_produto_id int   NOT NULL  , 
      nome text   NOT NULL  , 
      valor double   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(tipo_produto_id) REFERENCES tipo_produto(id)) ; 

CREATE TABLE qunatidade( 
      id  INTEGER    NOT NULL  , 
      quantidade int  (100)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_group( 
      id int   NOT NULL  , 
      name text   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_group_program( 
      id int   NOT NULL  , 
      system_group_id int   NOT NULL  , 
      system_program_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(system_program_id) REFERENCES system_program(id),
FOREIGN KEY(system_group_id) REFERENCES system_group(id)) ; 

CREATE TABLE system_preference( 
      id varchar  (255)   NOT NULL  , 
      preference text   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_program( 
      id int   NOT NULL  , 
      name text   NOT NULL  , 
      controller text   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_unit( 
      id int   NOT NULL  , 
      name text   NOT NULL  , 
      connection_name text   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_user_group( 
      id int   NOT NULL  , 
      system_user_id int   NOT NULL  , 
      system_group_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(system_group_id) REFERENCES system_group(id),
FOREIGN KEY(system_user_id) REFERENCES system_users(id)) ; 

CREATE TABLE system_user_program( 
      id int   NOT NULL  , 
      system_user_id int   NOT NULL  , 
      system_program_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(system_program_id) REFERENCES system_program(id),
FOREIGN KEY(system_user_id) REFERENCES system_users(id)) ; 

CREATE TABLE system_users( 
      id int   NOT NULL  , 
      name text   NOT NULL  , 
      login text   NOT NULL  , 
      password text   NOT NULL  , 
      email text   , 
      frontpage_id int   , 
      system_unit_id int   , 
      active char  (1)   , 
 PRIMARY KEY (id),
FOREIGN KEY(system_unit_id) REFERENCES system_unit(id),
FOREIGN KEY(frontpage_id) REFERENCES system_program(id)) ; 

CREATE TABLE system_user_unit( 
      id int   NOT NULL  , 
      system_user_id int   NOT NULL  , 
      system_unit_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(system_user_id) REFERENCES system_users(id),
FOREIGN KEY(system_unit_id) REFERENCES system_unit(id)) ; 

CREATE TABLE tarefa( 
      id  INTEGER    NOT NULL  , 
      lista_id int   NOT NULL  , 
      titulo text   , 
      texto text   , 
      ordem text   , 
 PRIMARY KEY (id),
FOREIGN KEY(lista_id) REFERENCES lista(id)) ; 

CREATE TABLE tipo_produto( 
      id  INTEGER    NOT NULL  , 
      nome text   NOT NULL  , 
 PRIMARY KEY (id)) ; 

 
 
  
