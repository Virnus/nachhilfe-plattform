# ToDo

- Rollenverteilung

- Glossar
- Dokumentation

## Oliver
- Adminverwaltung
- Angebote
- Account


## Serafin
- Adminverwaltung
- Lernzentrum
- Suche

## Routes

* /
  * /
* /lernzentrum (Serafin)
  * /{lernzentrum}
    * /signup
    * /signout
* /account
  * /profile  (Serafin)
  * /password (Serafin)
  * /angebote (Oliver)
    * /create
    * /update
    * /delete
  * /lernzentrum (Serafin)
    * /aufgebote
* /admin
  * /users  (Oliver)
    * /create
    * /{user}
      * /update
      * /delete
  * /lernzentrum (Serafin)
    * /create
    * /{lernzentrum}
      * /update
      * /delete
  * /angebote (Oliver)
    * /{angebot}
      * /update
      * /delete
* /webapi  (Serafin)
  * /search
  * /subject (used for autocomplete)
  * /topic (used for autocomplete)
