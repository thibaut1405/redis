# EPSI I4 - NoSQL

#### Collaborateurs : 
- Thibaut Villeneuve
- Paul Sauliere 

## Solution choisie :
Le langage choisi pour ce projet est `php` avec la librairie php `predis`.
L'application développée permet ainsi de lancer un serveur HTTP faisant passerelle vers un serveur redis local.

### Prérequis :
La documentation et les commandes suivantes sont faites pour une distribution `Linux`.

Il est nécessaire afin de pouvoir lancer l'application que votre poste dispose de :
- **RedisServer**
    En local ou sur un machine virtuel (si c'est sur une VM vous devrez modifier le fichier PHP qui réalise la connexion au serveur)
    - Commande d'installation : `sudo apt-get install redis-server`
- **Git**
    - Commande d'installation : `sudo apt install git`
- **LAMP**
    - Commande d'installation : `sudo apt install apache2 php libapache2-mod-php mysql-server php-mysql` 

### Installation du projet :

Pour télécharger le projet lancer la commande :
Déplacez vous dans le /var/www/html:
```
git clone https://github.com/thibaut1405/redis.git
```

### Lancer le serveur HTTP et le serveur Redis :

La partie suivante va permettre de démarrer un serveur Redis Local ainsi que notre application (serveur HTTP).

- **Lancer le server redis :**
```
$ sudo service redis-server start
```
Si vous êtes sur une machine distante de votre serveur redis il faudra commenter la ligne :

`bind 127.0.0.1 ::1`

### Utilisation de l'application : 

Plusieurs méthodes sont disponibles afin d'utiliser le serveur HTTP pour sauvegarder et consulter des données sur le serveur Redis,
notamment avec l'utilisation de commandes `curl`ou via l'application bureau `Postman`.

- **Créer une note :**
    - **Curl :** `$ curl -H "Content-Type:text/plain" --data 'le_contenu_de_la_note" http://localhost/redis/notes`
    - **Postman :** ![alt text](https://github.com/thibaut1405//images/creerNote.PNG)
- **Consulter une note via son id :**
    - **Curl :** `$ curl http://localhost:8080/notes/{idnote}` 
    - **Postman :** ![alt text](https://github.com/MarineLH/I4_no_sql_TP_3/blob/master/images/consulterNote.PNG)
- **Supprimer une  note via son id :**
    - **Curl :** `$ curl -X DELETE http://localhost:8080/notes/{id_note}` 
    - **Postman :** ![alt text](https://github.com/MarineLH/I4_no_sql_TP_3/blob/master/images/supprimerNote.PNG)
- **Consulter toutes les notes disponibles :**
    - **Curl :** `$ curl  http://localhost:8080/notes` 
    - **Postman :** ![alt text](https://github.com/MarineLH/I4_no_sql_TP_3/blob/master/images/consulterToutesNotes.PNG)

Il ne vous reste plus qu'à tester notre application !