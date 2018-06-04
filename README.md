# PHP Base

Slide : https://slides.com/matthieumota/php

Pour travailler, vous avez besoin de forker ce dépôt.
Ensuite, clonez votre dépôt sur votre machine.
Créez une branche avec votre prénom.

```
git branch prenom
```

Vous pouvez ajouter un remote upstream (en plus de votre origin) vers ce dépôt (WebforceLille9) avec :

```
git remote add upstream https://github.com/WebforceLille9/PHP-Base.git
```

Vous avez maintenant 2 branches master, celle de ce dépôt (du formateur) et de votre dépôt.
Parfois, vous voudrez récupérer une mise à jour du dépôt :

```
# Mets à jour la branche master
git checkout master
git fetch upstream
git merge upstream/master
git push origin master
# Revenir sur votre branche
git checkout prenom
# Attention à cette commande, la version de l'élève revient au même niveau que celle du formateur (Perte potentielle)
git rebase master
```

N'oubliez pas de toujours revenir sur votre branche lorsque vous travaillez sur votre propre code. Votre branche master ne doit servir que pour stocker les cours et le code du formateur.
