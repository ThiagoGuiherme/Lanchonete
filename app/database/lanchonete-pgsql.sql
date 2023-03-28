CREATE TABLE estado_pedido( 
      id  SERIAL    NOT NULL  , 
      nome text   NOT NULL  , 
      cor text   , 
      ordem integer   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE lista( 
      id  SERIAL    NOT NULL  , 
      system_user_id integer   NOT NULL  , 
      nome text   NOT NULL  , 
      cor text   , 
      ordem integer   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE mesas( 
      id  SERIAL    NOT NULL  , 
      nome text   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE pedido( 
      id  SERIAL    NOT NULL  , 
      estado_pedido_id integer   NOT NULL  , 
      cliente_id integer   NOT NULL  , 
      data_pedido date   NOT NULL  , 
      valor_total float   , 
      mes text   , 
      ano text   , 
      ordem integer   , 
      deletado char  (1)     DEFAULT 'F', 
      quantidade_id integer   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE pedido_item( 
      id  SERIAL    NOT NULL  , 
      pedido_id integer   NOT NULL  , 
      produto_id integer   NOT NULL  , 
      quantidade float   NOT NULL  , 
      valor float   NOT NULL  , 
      valor_total float   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE produto( 
      id  SERIAL    NOT NULL  , 
      tipo_produto_id integer   NOT NULL  , 
      nome text   NOT NULL  , 
      valor float   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE qunatidade( 
      id  SERIAL    NOT NULL  , 
      quantidade integer   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_group( 
      id integer   NOT NULL  , 
      name text   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_group_program( 
      id integer   NOT NULL  , 
      system_group_id integer   NOT NULL  , 
      system_program_id integer   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_preference( 
      id varchar  (255)   NOT NULL  , 
      preference text   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_program( 
      id integer   NOT NULL  , 
      name text   NOT NULL  , 
      controller text   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_unit( 
      id integer   NOT NULL  , 
      name text   NOT NULL  , 
      connection_name text   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_user_group( 
      id integer   NOT NULL  , 
      system_user_id integer   NOT NULL  , 
      system_group_id integer   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_user_program( 
      id integer   NOT NULL  , 
      system_user_id integer   NOT NULL  , 
      system_program_id integer   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_users( 
      id integer   NOT NULL  , 
      name text   NOT NULL  , 
      login text   NOT NULL  , 
      password text   NOT NULL  , 
      email text   , 
      frontpage_id integer   , 
      system_unit_id integer   , 
      active char  (1)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_user_unit( 
      id integer   NOT NULL  , 
      system_user_id integer   NOT NULL  , 
      system_unit_id integer   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE tarefa( 
      id  SERIAL    NOT NULL  , 
      lista_id integer   NOT NULL  , 
      titulo text   , 
      texto text   , 
      ordem text   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE tipo_produto( 
      id  SERIAL    NOT NULL  , 
      nome text   NOT NULL  , 
 PRIMARY KEY (id)) ; 

 
  
 ALTER TABLE lista ADD CONSTRAINT fk_lista_1 FOREIGN KEY (system_user_id) references system_users(id); 
ALTER TABLE pedido ADD CONSTRAINT fk_pedido_1 FOREIGN KEY (estado_pedido_id) references estado_pedido(id); 
ALTER TABLE pedido ADD CONSTRAINT fk_pedido_2 FOREIGN KEY (cliente_id) references mesas(id); 
ALTER TABLE pedido ADD CONSTRAINT fk_pedido_3 FOREIGN KEY (quantidade_id) references qunatidade(id); 
ALTER TABLE pedido_item ADD CONSTRAINT fk_pedido_item_1 FOREIGN KEY (pedido_id) references pedido(id); 
ALTER TABLE pedido_item ADD CONSTRAINT fk_pedido_item_2 FOREIGN KEY (produto_id) references produto(id); 
ALTER TABLE produto ADD CONSTRAINT fk_produto_1 FOREIGN KEY (tipo_produto_id) references tipo_produto(id); 
ALTER TABLE system_group_program ADD CONSTRAINT fk_system_group_program_1 FOREIGN KEY (system_program_id) references system_program(id); 
ALTER TABLE system_group_program ADD CONSTRAINT fk_system_group_program_2 FOREIGN KEY (system_group_id) references system_group(id); 
ALTER TABLE system_user_group ADD CONSTRAINT fk_system_user_group_1 FOREIGN KEY (system_group_id) references system_group(id); 
ALTER TABLE system_user_group ADD CONSTRAINT fk_system_user_group_2 FOREIGN KEY (system_user_id) references system_users(id); 
ALTER TABLE system_user_program ADD CONSTRAINT fk_system_user_program_1 FOREIGN KEY (system_program_id) references system_program(id); 
ALTER TABLE system_user_program ADD CONSTRAINT fk_system_user_program_2 FOREIGN KEY (system_user_id) references system_users(id); 
ALTER TABLE system_users ADD CONSTRAINT fk_system_user_1 FOREIGN KEY (system_unit_id) references system_unit(id); 
ALTER TABLE system_users ADD CONSTRAINT fk_system_user_2 FOREIGN KEY (frontpage_id) references system_program(id); 
ALTER TABLE system_user_unit ADD CONSTRAINT fk_system_user_unit_1 FOREIGN KEY (system_user_id) references system_users(id); 
ALTER TABLE system_user_unit ADD CONSTRAINT fk_system_user_unit_2 FOREIGN KEY (system_unit_id) references system_unit(id); 
ALTER TABLE tarefa ADD CONSTRAINT fk_tarefa_1 FOREIGN KEY (lista_id) references lista(id); 

  
