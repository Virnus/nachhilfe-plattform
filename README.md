# Nachhilfe Plattform

Eine Plattform für Schulen um den Kontakt unter den Schülern zu fördern.
Schüler haben die Möglichkeit auf Angebote ihrer Mitschüler zu antworten oder eigene Angebote zu erstellen.

## Routes

*   /
    *   /
*   /lernzentrum (Serafin)
    *   /{lernzentrum}
        *   /signup
        *   /signout
*   /account
    *   /profile (Serafin)
    *   /password (Serafin)
    *   /angebote (Oliver)
        *   /create
        *   /update
        *   /delete
    *   /lernzentrum (Serafin)
        *   /aufgebote
*   /admin
    *   /users (Oliver)
        *   /create
        *   /{user}
            *   /update
            *   /delete
    *   /lernzentrum (Serafin)
        *   /create
        *   /{lernzentrum}
            *   /update
            *   /delete
    *   /angebote (Oliver)
        *   /{angebot}
            *   /update
            *   /delete
*   /webapi (Serafin)
    *   /search
    *   /subject (used for autocomplete)
    *   /topic (used for autocomplete)
