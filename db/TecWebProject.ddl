-- *********************************************
-- * SQL MySQL generation                      
-- *--------------------------------------------
-- * DB-MAIN version: 10.0.0              
-- * Generator date: Dec 13 2016              
-- * Generation date: Tue Jan 17 21:01:15 2017 
-- * LUN file: /home/paolo/Scrivania/SchemaER+Logico+DDL.lun 
-- * Schema: MYALMA/1-1 
-- ********************************************* 


-- Database Section
-- ________________ 

create database MYALMA;
use MYALMA;


-- Tables Section
-- _____________ 

create table Assegnamento (
     CodiceCorso char(5) not null,
     IDCorsoStudi char(5) not null,
     DominioUtente varchar(20) not null,
     NomeUtente varchar(20) not null,
     constraint IDAssegnamento primary key (DominioUtente, NomeUtente, CodiceCorso, IDCorsoStudi));

create table Corso (
     Codice char(5) not null,
     IDCorsoStudi char(5) not null,
     Denominazione varchar(20) not null,
     Anno int not null,
     Ciclo char(1) not null,
     constraint IDCorso primary key (Codice, IDCorsoStudi));

create table CorsoStudi (
     ID char(5) not null,
     Denominazione varchar(20) not null,
     constraint IDCorsoStudi primary key (ID));

create table Evento (
     DominioUtente varchar(20) not null,
     NomeUtente varchar(20) not null,
     Numero int not null auto_increment,
     Inizio date not null,
     Fine date not null,
     Descrizione varchar(200) not null,
     constraint IDEvento primary key (DominioUtente, NomeUtente, Numero));

create table Iscrizione (
     IDCorsoStudi char(5) not null,
     DominioUtente varchar(20) not null,
     NomeUtente varchar(20) not null,
     AnnoAccademico varchar(9) not null,
     constraint IDiscrizione primary key (IDCorsoStudi, DominioUtente, NomeUtente, AnnoAccademico));

create table Lezione (
     Numero int not null auto_increment,
     OraInizio date not null,
     OraFine date not null,
     Aula varchar(20) not null,
     CodiceCorso char(5) not null,
     IDCorsoStudi char(5) not null,
     constraint IDLezione primary key (Numero));

create table NotificaInviata (
     DominioUtente varchar(20) not null,
     NomeUtente varchar(20) not null,
     Numero int not null auto_increment,
     Messaggio varchar(4096) not null,
     DataInvio date not null,
     constraint IDNotifica_ID primary key (DominioUtente, NomeUtente, Numero));

create table NotificaRicevuta (
     DominioUtenteMittente varchar(20) not null,
     NomeUtenteMittente varchar(20) not null,
     NumeroNotifica int not null,
     DominioUtente varchar(20) not null,
     NomeUtente varchar(20) not null,
     Vista char not null,
     constraint IDNotificaRicevuta primary key (DominioUtente, NomeUtente, DominioUtenteMittente, NomeUtenteMittente, NumeroNotifica));

create table TentativoLogin (
     DominioUtente varchar(20) not null,
     NomeUtente varchar(20) not null,
     accountID char(1) not null,
     orario char(1) not null,
     constraint IDTentativoLogin primary key (DominioUtente, NomeUtente, accountID));

create table TipoUtente (
     Dominio varchar(20) not null,
     constraint IDTipoEmail primary key (Dominio));

create table Utente (
     DominioUtente varchar(20) not null,
     NomeUtente varchar(20) not null,
     NomeAnag varchar(20) not null,
     Cognome varchar(20) not null,
     Password varchar(128) not null,
     Salt char(128) not null,
     Matricola char(10),
     constraint IDUtente primary key (DominioUtente, NomeUtente),
     constraint IDUtente_1 unique (Matricola));


-- Constraints Section
-- ___________________ 

alter table Assegnamento add constraint FKUtente
     foreign key (DominioUtente, NomeUtente)
     references Utente (DominioUtente, NomeUtente);

alter table Assegnamento add constraint FKCodiceCorso
     foreign key (CodiceCorso, IDCorsoStudi)
     references Corso (Codice, IDCorsoStudi);

alter table Corso add constraint FKofferta
     foreign key (IDCorsoStudi)
     references CorsoStudi (ID);

alter table Evento add constraint FKcreazione
     foreign key (DominioUtente, NomeUtente)
     references Utente (DominioUtente, NomeUtente);

alter table Iscrizione add constraint FKUtente
     foreign key (DominioUtente, NomeUtente)
     references Utente (DominioUtente, NomeUtente);

alter table Iscrizione add constraint FKIDCorso
     foreign key (IDCorsoStudi)
     references CorsoStudi (ID);

alter table Lezione add constraint FKesecuzione
     foreign key (CodiceCorso, IDCorsoStudi)
     references Corso (Codice, IDCorsoStudi);

-- Not implemented
-- alter table NotificaInviata add constraint IDNotifica_CHK
--     check(exists(select * from NotificaRicevuta
--                  where NotificaRicevuta.DominioUtenteMittente = DominioUtente and NotificaRicevuta.NomeUtenteMittente = NomeUtente and NotificaRicevuta.NumeroNotifica = Numero)); 

alter table NotificaInviata add constraint FKemissione
     foreign key (DominioUtente, NomeUtente)
     references Utente (DominioUtente, NomeUtente);

alter table NotificaRicevuta add constraint FKUtente
     foreign key (DominioUtente, NomeUtente)
     references Utente (DominioUtente, NomeUtente);

alter table NotificaRicevuta add constraint FKNotifica
     foreign key (DominioUtenteMittente, NomeUtenteMittente, NumeroNotifica)
     references NotificaInviata (DominioUtente, NomeUtente, Numero);

alter table TentativoLogin add constraint FKR
     foreign key (DominioUtente, NomeUtente)
     references Utente (DominioUtente, NomeUtente);

alter table Utente add constraint FKtipologia
     foreign key (DominioUtente)
     references TipoUtente (Dominio);


-- Index Section
-- _____________ 

