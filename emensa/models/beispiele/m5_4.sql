use emensawerbeseite;

CREATE VIEW view_suppengerichte AS
SELECT * FROM gericht
WHERE name LIKE '%suppe%';

CREATE VIEW view_anmeldungen AS
SELECT name,email,anzahlanmeldungen FROM benutzer
ORDER BY anzahlanmeldungen desc;

CREATE VIEW view_kategoriegerichte_vegetarisch AS
SELECT g.name as Gerichtname, GROUP_CONCAT(k.name) AS Kategoriename FROM gericht g
LEFT JOIN
gericht_hat_kategorie gk ON g.id=gk.gericht_id
LEFT JOIN kategorie k on gk.kategorie_id = k.id
WHERE vegetarisch=1
GROUP BY g.name;