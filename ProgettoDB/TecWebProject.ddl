-- *********************************************
-- * SQL MySQL generation                      
-- *--------------------------------------------
-- * DB-MAIN version: 10.0.0              
-- * Generator date: Dec 13 2016              
-- * Generation date: Wed Jan 11 18:15:49 2017 
-- * LUN file: /home/paolo/Scrivania/TecWebProject-SchemaLogico.lun 
-- * Schema: MYALMA/1-1 
-- ********************************************* 


-- Database Section
-- ________________ 

create database MYALMA;
use MYALMA;


-- Tables Section
-- _____________ 

create table Corso (
     Codice char(5) not null,
     CorsoDiStudi char(5) not null,
     Denominazione varchar(20) not null,
     Anno int not null,
     Ciclo char(1) not null,
     constraint IDCorso primary key (Codice, CorsoDiStudi));

create table CorsoAnnuale (
     CodiceCorso char(5) not null,
     CorsoDiStudi char(5) not null,
     AnnoAccademico char(9) not null,
     constraint IDCorsoAnnuale_ID primary key (CodiceCorso, CorsoDiStudi, AnnoAccademico));

create table CorsoStudi (
     ID char(5) not null,
     Denominazione varchar(20) not null,
     constraint IDCorsoStudi primary key (ID));

create table DocenteCorso (
     CodiceCorso char(5) not null,
     CorsoDiStudi char(5) not null,
     AnnoAccademico char(9) not null,
     DominioAccount varchar(20) not null,
     NomeUtente varchar(20) not null,
     constraint IDAssegnamentoAnnuale primary key (DominioAccount, NomeUtente, CodiceCorso, CorsoDiStudi, AnnoAccademico));

create table Evento (
     DominioAccount varchar(20) not null,
     NomeUtente varchar(20) not null,
     Numero int not null auto_increment,
     Inizio date not null,
     Fine date not null,
     Descrizione varchar(200) not null,
     constraint IDEvento primary key (DominioAccount, NomeUtente, Numero));

create table Iscrizione (
     IDCorsoStudio char(5) not null,
     DominioAccount varchar(20) not null,
     NomeUtente varchar(20) not null,
     AnnoAccademico varchar(9) not null,
     constraint IDIscrizione primary key (IDCorsoStudio, DominioAccount, NomeUtente, AnnoAccademico));

create table Lezione (
     CodiceCorso char(5) not null,
     CorsiStudi char(5) not null,
     AnnoAccademico char(9) not null,
     Numero int not null auto_increment,
     OraInizio date not null,
     OraFine date not null,
     Aula varchar(20) not null,
     constraint IDLezione primary key (CodiceCorso, CorsiStudi, AnnoAccademico, Numero));

create table Notifica (
     Mit_DominioAccount varchar(20) not null,
     Mit_NomeUtente varchar(20) not null,
     Numero int not null auto_increment,
     Messaggio varchar(4096) not null,
     Vista char not null,
     Ric_DominioAccount varchar(20) not null,
     Ric_NomeUtente varchar(20) not null,
     constraint IDNotifica primary key (Mit_DominioAccount, Mit_NomeUtente, Numero));

create table TentativoLogin (
     DominioAccount varchar(20) not null,
     NomeUtente varchar(20) not null,
     accountID char(1) not null,
     orario char(1) not null,
     constraint IDTentativoLogin primary key (DominioAccount, NomeUtente, accountID));

create table TipoUtente (
     Dominio varchar(20) not null,
     constraint IDTipoEmail primary key (Dominio));

create table Utente (
     DominioAccount varchar(20) not null,
     NomeUtente varchar(20) not null,
     NomeAnag varchar(20) not null,
     Cognome varchar(20) not null,
     Password varchar(128) not null,
     Salt char(128) not null,
     Matricola char(10),
     constraint IDUtente primary key (DominioAccount, NomeUtente),
     constraint IDUtente_1 unique (Matricola));


-- Constraints Section
-- ___________________ 

alter table Corso add constraint FKofferta
     foreign key (CorsoDiStudi)
     references CorsoStudi (ID);

-- Not implemented
-- alter table CorsoAnnuale add constraint IDCorsoAnnuale_CHK
--     check(exists(select * from DocenteCorso
--                  where DocenteCorso.CodiceCorso = CodiceCorso and DocenteCorso.CorsoDiStudi = CorsoDiStudi and DocenteCorso.AnnoAccademico = AnnoAccademico)); 

alter table CorsoAnnuale add constraint FKriferimento
     foreign key (CodiceCorso, CorsoDiStudi)
     references Corso (Codice, CorsoDiStudi);

alter table DocenteCorso add constraint FKDocente
     foreign key (DominioAccount, NomeUtente)
     references Utente (DominioAccount, NomeUtente);

alter table DocenteCorso add constraint FKCorso
     foreign key (CodiceCorso, CorsoDiStudi, AnnoAccademico)
     references CorsoAnnuale (CodiceCorso, CorsoDiStudi, AnnoAccademico);

alter table Evento add constraint FKcreazione
     foreign key (DominioAccount, NomeUtente)
     references Utente (DominioAccount, NomeUtente);

alter table Iscrizione add constraint FKStudente
     foreign key (DominioAccount, NomeUtente)
     references Utente (DominioAccount, NomeUtente);

alter table Iscrizione add constraint FKCorsiStudi
     foreign key (IDCorsoStudio)
     references CorsoStudi (ID);

alter table Lezione add constraint FKesecuzione
     foreign key (CodiceCorso, CorsiStudi, AnnoAccademico)
     references CorsoAnnuale (CodiceCorso, CorsoDiStudi, AnnoAccademico);

alter table Notifica add constraint FKemissione
     foreign key (Mit_DominioAccount, Mit_NomeUtente)
     references Utente (DominioAccount, NomeUtente);

alter table Notifica add constraint FKricezione
     foreign key (Ric_DominioAccount, Ric_NomeUtente)
     references Utente (DominioAccount, NomeUtente);

alter table TentativoLogin add constraint FKR
     foreign key (DominioAccount, NomeUtente)
     references Utente (DominioAccount, NomeUtente);

alter table Utente add constraint FKtipologia
     foreign key (DominioAccount)
     references TipoUtente (Dominio);


-- Index Section
-- _____________ 

