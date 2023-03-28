CREATE TABLE estado_pedido( 
      id number(10)    NOT NULL , 
      nome varchar(3000)    NOT NULL , 
      cor varchar(3000)   , 
      ordem number(10)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE lista( 
      id number(10)    NOT NULL , 
      system_user_id number(10)    NOT NULL , 
      nome varchar(3000)    NOT NULL , 
      cor varchar(3000)   , 
      ordem number(10)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE mesas( 
      id number(10)    NOT NULL , 
      nome varchar(3000)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE pedido( 
      id number(10)    NOT NULL , 
      estado_pedido_id number(10)    NOT NULL , 
      cliente_id number(10)    NOT NULL , 
      data_pedido date    NOT NULL , 
      valor_total binary_double   , 
      mes varchar(3000)   , 
      ano varchar(3000)   , 
      ordem number(10)   , 
      deletado char  (1)    DEFAULT 'F' , 
      quantidade_id number(10)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE pedido_item( 
      id number(10)    NOT NULL , 
      pedido_id number(10)    NOT NULL , 
      produto_id number(10)    NOT NULL , 
      quantidade binary_double    NOT NULL , 
      valor binary_double    NOT NULL , 
      valor_total binary_double    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE produto( 
      id number(10)    NOT NULL , 
      tipo_produto_id number(10)    NOT NULL , 
      nome varchar(3000)    NOT NULL , 
      valor binary_double    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE qunatidade( 
      id number(10)    NOT NULL , 
      quantidade number(10)  (100)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_group( 
      id number(10)    NOT NULL , 
      name varchar(3000)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_group_program( 
      id number(10)    NOT NULL , 
      system_group_id number(10)    NOT NULL , 
      system_program_id number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_preference( 
      id varchar  (255)    NOT NULL , 
      preference varchar(3000)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_program( 
      id number(10)    NOT NULL , 
      name varchar(3000)    NOT NULL , 
      controller varchar(3000)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_unit( 
      id number(10)    NOT NULL , 
      name varchar(3000)    NOT NULL , 
      connection_name varchar(3000)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_user_group( 
      id number(10)    NOT NULL , 
      system_user_id number(10)    NOT NULL , 
      system_group_id number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_user_program( 
      id number(10)    NOT NULL , 
      system_user_id number(10)    NOT NULL , 
      system_program_id number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_users( 
      id number(10)    NOT NULL , 
      name varchar(3000)    NOT NULL , 
      login varchar(3000)    NOT NULL , 
      password varchar(3000)    NOT NULL , 
      email varchar(3000)   , 
      frontpage_id number(10)   , 
      system_unit_id number(10)   , 
      active char  (1)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_user_unit( 
      id number(10)    NOT NULL , 
      system_user_id number(10)    NOT NULL , 
      system_unit_id number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE tarefa( 
      id number(10)    NOT NULL , 
      lista_id number(10)    NOT NULL , 
      titulo varchar(3000)   , 
      texto varchar(3000)   , 
      ordem varchar(3000)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE tipo_produto( 
      id number(10)    NOT NULL , 
      nome varchar(3000)    NOT NULL , 
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
 CREATE SEQUENCE estado_pedido_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER estado_pedido_id_seq_tr 

BEFORE INSERT ON estado_pedido FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT estado_pedido_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE lista_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER lista_id_seq_tr 

BEFORE INSERT ON lista FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT lista_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE mesas_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER mesas_id_seq_tr 

BEFORE INSERT ON mesas FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT mesas_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE pedido_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER pedido_id_seq_tr 

BEFORE INSERT ON pedido FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT pedido_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE pedido_item_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER pedido_item_id_seq_tr 

BEFORE INSERT ON pedido_item FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT pedido_item_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE produto_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER produto_id_seq_tr 

BEFORE INSERT ON produto FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT produto_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE qunatidade_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER qunatidade_id_seq_tr 

BEFORE INSERT ON qunatidade FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT qunatidade_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE tarefa_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER tarefa_id_seq_tr 

BEFORE INSERT ON tarefa FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT tarefa_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE tipo_produto_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER tipo_produto_id_seq_tr 

BEFORE INSERT ON tipo_produto FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT tipo_produto_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
 
  
