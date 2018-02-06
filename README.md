# 30Hills-Spring-Internship-Test
Social Network Friends System (User, Friends List, Suggested Friends)

## Tabele Baze podataka:

1. Export-ovana verzija baze podataka se nalazi u fajlu 30hillsp.sql (dve tabele sa podacima) se nalazi u dbsql folderu
2. Podaci se mogu uneti automatski u bazu (ukoliko su tabele kreirane) pokretanjem ~/home/insertallusers
3. Podaci o korisnicima se nalaze u data.json fajlu u app/Models folderu

## Sta treba promeniti:

1. config.json 	- Informacije o DB konekciji
2. .htaccess 	- Promeniti putanju za RewriteBase
3. public/.htaccess - Promeniti putanju za RewriteBase

## Koriscenje:

1. Prikaz svih korisnika iz baze ~/home/users
2. Prikaz odrenjenog korisnika iz baze ~/home/user/{user_id}
3. Kada se prikaze korisnik, izlistavaju se njegovi direktni prijatelji i prijatelji njegovih prijatelja
4. Ukoliko se unese pogresan URL, ako korisnik sa odredjenim ID-om ne postoji ucitava se error/404.php - (u pitanju je jednostavna provera prosledjenog parametra)

## Opcija pod tri:
1. Suggestion.php - ideja za resenje za predlaganje novih prijatelja korisniku
