-- Active: 1664351913126@@127.0.0.1@3306@hotel

drop procedure listeclient;

DELIMITER |

CREATE PROCEDURE listeClient()
BEGIN
    SELECT cli_id, cli_nom, cli_prenom, cli_ville 
    FROM client;
END |

/* On rétablit le délimiteur initial */
DELIMITER ;


CALL listeClient;



CREATE PROCEDURE listeClient2(IN ville VARCHAR(50))
BEGIN
    SELECT cli_id, cli_nom, cli_prenom, cli_ville 
    FROM client
    WHERE cli_ville=ville;
END |


call listeclient2('Londre');