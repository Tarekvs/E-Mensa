CREATE PROCEDURE inkrAnzahlAnmeldungen(IN email varchar(100))
BEGIN
UPDATE emensawerbeseite.benutzer
SET anzahlanmeldungen = anzahlanmeldungen + 1
WHERE email = email;
end;