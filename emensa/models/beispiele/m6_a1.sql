create table bewertungen
(
    bewertungs_id int auto_increment,
    benutzer      varchar(50) null,
    datum         DATE        null,
    bemerkung     text        null,
    bewertung     int         null,
    constraint bewertungsid_pk
        primary key (bewertungs_id)
)
    comment 'Bewertungen der Nutzer';


alter table bewertungen
    add gericht_id int null;

alter table bewertungen
    add markiert bool default false not null;
