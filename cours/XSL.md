Format XML
=========
XML est valide dans la forme = abc jop hup est valide en français (bonne lettres).
c'est le langage qui donne ça mais ca veut rien dire : la forme n'est pas valide.
La forme doit respecter un modéle.
il faut toujours vérifier les deux.
question document valide ? => verifier si le modéle est là pour savoir si c'est valide

Différence entre DTD et schéma :
* les schemas sont en XML et vont pouvoir gerer les namespace contrairement au DTD
* Les XSD sont en XML donc parsable et verifier leur schéma (verifier validité et syntaxe d'un XSD)
* La DTD défini le XML(XSD) qui définit les XML
* les schema sont plus précis dans les cardinalités
* typage des attributs des balises dans le schema
* XSD facilement utilisable (en totalité ou en partie)

DTD
---------
* se déclare avec le doctype (PUBLIC ou SYSTEM)
* xmlns : <<RL> -> valable pour tous les enfants
* ns:math (les alias en gros) -> valable uniquement pour la balise

XSD
------------
* toujurs faire Dn seul element racine de type XXXX, ensuite faire des types complexes

XSL
----------
=> transformation d'un document XML en tout ce que l'on veut
Langage en XML
c'est une techno rare car on ne le voit pas