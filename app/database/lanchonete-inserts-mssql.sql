SET IDENTITY_INSERT estado_pedido ON; 

INSERT INTO estado_pedido (id,nome,cor,ordem) VALUES (1,'Novo Pedido','#3498db',1); 

SET IDENTITY_INSERT estado_pedido OFF; 

SET IDENTITY_INSERT mesas ON; 

INSERT INTO mesas (id,nome) VALUES (01,'Mesa 01'); 

INSERT INTO mesas (id,nome) VALUES (02,'Mesa 02'); 

INSERT INTO mesas (id,nome) VALUES (03,'Mesa 03 '); 

INSERT INTO mesas (id,nome) VALUES (04,'Mesa 04'); 

INSERT INTO mesas (id,nome) VALUES (05,'Mesa 05'); 

INSERT INTO mesas (id,nome) VALUES (06,'Mesa 06'); 

INSERT INTO mesas (id,nome) VALUES (07,'Mesa 07'); 

INSERT INTO mesas (id,nome) VALUES (08,'Mesa 08'); 

INSERT INTO mesas (id,nome) VALUES (09,'Mesa 09'); 

INSERT INTO mesas (id,nome) VALUES (10,'Mesa 10'); 

INSERT INTO mesas (id,nome) VALUES (11,'Mesa 11'); 

INSERT INTO mesas (id,nome) VALUES (12,'Mesa 12'); 

INSERT INTO mesas (id,nome) VALUES (13,'Mesa 13'); 

INSERT INTO mesas (id,nome) VALUES (14,'Mesa 14'); 

INSERT INTO mesas (id,nome) VALUES (15,'Mesa 15'); 

SET IDENTITY_INSERT mesas OFF; 

SET IDENTITY_INSERT produto ON; 

INSERT INTO produto (id,tipo_produto_id,nome,valor) VALUES (1,1,'Risoles de Frango',7.50); 

INSERT INTO produto (id,tipo_produto_id,nome,valor) VALUES (2,2,'Latinha',7.00); 

INSERT INTO produto (id,tipo_produto_id,nome,valor) VALUES (3,3,'Hamburguer',35.00); 

INSERT INTO produto (id,tipo_produto_id,nome,valor) VALUES (4,1,'Coxinha',7.50); 

SET IDENTITY_INSERT produto OFF; 

SET IDENTITY_INSERT qunatidade ON; 

INSERT INTO qunatidade (id,quantidade) VALUES (1,1); 

INSERT INTO qunatidade (id,quantidade) VALUES (2,2); 

INSERT INTO qunatidade (id,quantidade) VALUES (3,3); 

INSERT INTO qunatidade (id,quantidade) VALUES (4,4); 

INSERT INTO qunatidade (id,quantidade) VALUES (5,5); 

INSERT INTO qunatidade (id,quantidade) VALUES (6,6); 

INSERT INTO qunatidade (id,quantidade) VALUES (7,7); 

INSERT INTO qunatidade (id,quantidade) VALUES (8,8); 

INSERT INTO qunatidade (id,quantidade) VALUES (9,9); 

INSERT INTO qunatidade (id,quantidade) VALUES (10,10); 

SET IDENTITY_INSERT qunatidade OFF; 

INSERT INTO system_group (id,name) VALUES (1,'Admin'); 

INSERT INTO system_group (id,name) VALUES (2,'Standard'); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (1,1,1); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (2,1,2); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (3,1,3); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (4,1,4); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (5,1,5); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (6,1,6); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (7,1,8); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (8,1,9); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (9,1,11); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (10,1,14); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (11,1,15); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (12,2,10); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (13,2,12); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (14,2,13); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (15,2,16); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (16,2,17); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (17,2,18); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (18,2,19); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (19,2,20); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (20,1,21); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (21,2,22); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (22,2,23); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (23,2,24); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (24,2,25); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (25,1,26); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (26,1,27); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (27,1,28); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (28,1,29); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (29,2,30); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (30,1,31); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (31,1,32); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (32,1,33); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (33,1,34); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (34,1,35); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (35,1,36); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (36,1,37); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (37,1,38); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (38,1,39); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (39,1,40); 

INSERT INTO system_program (id,name,controller) VALUES (1,'System Group Form','SystemGroupForm'); 

INSERT INTO system_program (id,name,controller) VALUES (2,'System Group List','SystemGroupList'); 

INSERT INTO system_program (id,name,controller) VALUES (3,'System Program Form','SystemProgramForm'); 

INSERT INTO system_program (id,name,controller) VALUES (4,'System Program List','SystemProgramList'); 

INSERT INTO system_program (id,name,controller) VALUES (5,'System User Form','SystemUserForm'); 

INSERT INTO system_program (id,name,controller) VALUES (6,'System User List','SystemUserList'); 

INSERT INTO system_program (id,name,controller) VALUES (7,'Common Page','CommonPage'); 

INSERT INTO system_program (id,name,controller) VALUES (8,'System PHP Info','SystemPHPInfoView'); 

INSERT INTO system_program (id,name,controller) VALUES (9,'System ChangeLog View','SystemChangeLogView'); 

INSERT INTO system_program (id,name,controller) VALUES (10,'Welcome View','WelcomeView'); 

INSERT INTO system_program (id,name,controller) VALUES (11,'System Sql Log','SystemSqlLogList'); 

INSERT INTO system_program (id,name,controller) VALUES (12,'System Profile View','SystemProfileView'); 

INSERT INTO system_program (id,name,controller) VALUES (13,'System Profile Form','SystemProfileForm'); 

INSERT INTO system_program (id,name,controller) VALUES (14,'System SQL Panel','SystemSQLPanel'); 

INSERT INTO system_program (id,name,controller) VALUES (15,'System Access Log','SystemAccessLogList'); 

INSERT INTO system_program (id,name,controller) VALUES (16,'System Message Form','SystemMessageForm'); 

INSERT INTO system_program (id,name,controller) VALUES (17,'System Message List','SystemMessageList'); 

INSERT INTO system_program (id,name,controller) VALUES (18,'System Message Form View','SystemMessageFormView'); 

INSERT INTO system_program (id,name,controller) VALUES (19,'System Notification List','SystemNotificationList'); 

INSERT INTO system_program (id,name,controller) VALUES (20,'System Notification Form View','SystemNotificationFormView'); 

INSERT INTO system_program (id,name,controller) VALUES (21,'System Document Category List','SystemDocumentCategoryFormList'); 

INSERT INTO system_program (id,name,controller) VALUES (22,'System Document Form','SystemDocumentForm'); 

INSERT INTO system_program (id,name,controller) VALUES (23,'System Document Upload Form','SystemDocumentUploadForm'); 

INSERT INTO system_program (id,name,controller) VALUES (24,'System Document List','SystemDocumentList'); 

INSERT INTO system_program (id,name,controller) VALUES (25,'System Shared Document List','SystemSharedDocumentList'); 

INSERT INTO system_program (id,name,controller) VALUES (26,'System Unit Form','SystemUnitForm'); 

INSERT INTO system_program (id,name,controller) VALUES (27,'System Unit List','SystemUnitList'); 

INSERT INTO system_program (id,name,controller) VALUES (28,'System Access stats','SystemAccessLogStats'); 

INSERT INTO system_program (id,name,controller) VALUES (29,'System Preference form','SystemPreferenceForm'); 

INSERT INTO system_program (id,name,controller) VALUES (30,'System Support form','SystemSupportForm'); 

INSERT INTO system_program (id,name,controller) VALUES (31,'System PHP Error','SystemPHPErrorLogView'); 

INSERT INTO system_program (id,name,controller) VALUES (32,'System Database Browser','SystemDatabaseExplorer'); 

INSERT INTO system_program (id,name,controller) VALUES (33,'System Table List','SystemTableList'); 

INSERT INTO system_program (id,name,controller) VALUES (34,'System Data Browser','SystemDataBrowser'); 

INSERT INTO system_program (id,name,controller) VALUES (35,'System Menu Editor','SystemMenuEditor'); 

INSERT INTO system_program (id,name,controller) VALUES (36,'System Request Log','SystemRequestLogList'); 

INSERT INTO system_program (id,name,controller) VALUES (37,'System Request Log View','SystemRequestLogView'); 

INSERT INTO system_program (id,name,controller) VALUES (38,'System Administration Dashboard','SystemAdministrationDashboard'); 

INSERT INTO system_program (id,name,controller) VALUES (39,'System Log Dashboard','SystemLogDashboard'); 

INSERT INTO system_program (id,name,controller) VALUES (40,'System Session dump','SystemSessionDumpView'); 

INSERT INTO system_unit (id,name,connection_name) VALUES (1,'Matriz','matriz'); 

INSERT INTO system_user_group (id,system_user_id,system_group_id) VALUES (1,1,1); 

INSERT INTO system_user_group (id,system_user_id,system_group_id) VALUES (2,2,2); 

INSERT INTO system_user_group (id,system_user_id,system_group_id) VALUES (3,1,2); 

INSERT INTO system_user_program (id,system_user_id,system_program_id) VALUES (1,2,7); 

INSERT INTO system_users (id,name,login,password,email,frontpage_id,system_unit_id,active) VALUES (1,'Administrator','admin','21232f297a57a5a743894a0e4a801fc3','admin@admin.net',10,NULL,'Y'); 

INSERT INTO system_users (id,name,login,password,email,frontpage_id,system_unit_id,active) VALUES (2,'User','user','ee11cbb19052e40b07aac0ca060c23ee','user@user.net',7,NULL,'Y'); 

INSERT INTO system_user_unit (id,system_user_id,system_unit_id) VALUES (1,1,1); 

SET IDENTITY_INSERT tipo_produto ON; 

INSERT INTO tipo_produto (id,nome) VALUES (1,'Quentes '); 

INSERT INTO tipo_produto (id,nome) VALUES (2,'Frios'); 

INSERT INTO tipo_produto (id,nome) VALUES (3,'Agendados'); 

SET IDENTITY_INSERT tipo_produto OFF; 
