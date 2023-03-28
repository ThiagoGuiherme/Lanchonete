CREATE TABLE estado_pedido( 
      id  INT IDENTITY    NOT NULL  , 
      nome nvarchar(max)   NOT NULL  , 
      cor nvarchar(max)   , 
      ordem int   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE lista( 
      id  INT IDENTITY    NOT NULL  , 
      system_user_id int   NOT NULL  , 
      nome nvarchar(max)   NOT NULL  , 
      cor nvarchar(max)   , 
      ordem int   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE mesas( 
      id  INT IDENTITY    NOT NULL  , 
      nome nvarchar(max)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE pedido( 
      id  INT IDENTITY    NOT NULL  , 
      estado_pedido_id int   NOT NULL  , 
      cliente_id int   NOT NULL  , 
      data_pedido date   NOT NULL  , 
      valor_total float   , 
      mes nvarchar(max)   , 
      ano nvarchar(max)   , 
      ordem int   , 
      deletado char  (1)     DEFAULT 'F', 
      quantidade_id int   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE pedido_item( 
      id  INT IDENTITY    NOT NULL  , 
      pedido_id int   NOT NULL  , 
      produto_id int   NOT NULL  , 
      quantidade float   NOT NULL  , 
      valor float   NOT NULL  , 
      valor_total float   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE produto( 
      id  INT IDENTITY    NOT NULL  , 
      tipo_produto_id int   NOT NULL  , 
      nome nvarchar(max)   NOT NULL  , 
      valor float   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE qunatidade( 
      id  INT IDENTITY    NOT NULL  , 
      quantidade int  (100)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_group( 
      id int   NOT NULL  , 
      name nvarchar(max)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_group_program( 
      id int   NOT NULL  , 
      system_group_id int   NOT NULL  , 
      system_program_id int   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_preference( 
      id varchar  (255)   NOT NULL  , 
      preference nvarchar(max)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_program( 
      id int   NOT NULL  , 
      name nvarchar(max)   NOT NULL  , 
      controller nvarchar(max)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_unit( 
      id int   NOT NULL  , 
      name nvarchar(max)   NOT NULL  , 
      connection_name nvarchar(max)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_user_group( 
      id int   NOT NULL  , 
      system_user_id int   NOT NULL  , 
      system_group_id int   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_user_program( 
      id int   NOT NULL  , 
      system_user_id int   NOT NULL  , 
      system_program_id int   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_users( 
      id int   NOT NULL  , 
      name nvarchar(max)   NOT NULL  , 
      login nvarchar(max)   NOT NULL  , 
      password nvarchar(max)   NOT NULL  , 
      email nvarchar(max)   , 
      frontpage_id int   , 
      system_unit_id int   , 
      active char  (1)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_user_unit( 
      id int   NOT NULL  , 
      system_user_id int   NOT NULL  , 
      system_unit_id int   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE tarefa( 
      id  INT IDENTITY    NOT NULL  , 
      lista_id int   NOT NULL  , 
      titulo nvarchar(max)   , 
      texto nvarchar(max)   , 
      ordem nvarchar(max)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE tipo_produto( 
      id  INT IDENTITY    NOT NULL  , 
      nome nvarchar(max)   NOT NULL  , 
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

  
