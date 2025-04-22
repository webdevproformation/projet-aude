# lien

<https://github.com/webdevproformation/projet_aude/blob/main/tutorat/reunion2/00-questions.md>


# Erreurs des formulaire en rouge

- register.html.twig et contact/index.html.twig

```txt
les messages d'erreurs n'apparaissent pas en rouge quoique je fasse. style: 'red' ou classe error-message avec la couleur fixée dans la feuille form.css =>l'attribut n'apparait pas sur la balise li créée.  code extrait du code du thème bootstrap_5_layout.html.twig'. 
```

<https://github.com/adevoitinne/Correcteur-Au-Teur/blob/main/templates/registration/register.html.twig>

- 1 activer le theme bootstrap dans le fichier config 
- config/packages/twig.yaml

```yaml
twig:
    file_name_pattern: '*.twig'
    
when@test:
    twig:
        strict_variables: true
```

ajouter => 
voir la documentation => <https://symfony.com/doc/current/form/bootstrap5.html>


```yaml
twig:
    file_name_pattern: '*.twig'
    form_themes: ['bootstrap_5_layout.html.twig']
    

when@test:
    twig:
        strict_variables: true
```

<https://github.com/adevoitinne/Correcteur-Au-Teur/blob/main/templates/registration/register.html.twig>


```html
<div class="col-md-6 col-sm-12">
        {{ form_label(registrationForm.email, 'Email :' ) }}
        {{ form_widget(registrationForm.email, { attr: { aria_label:'Veuillez obligatoirement saisir votre email'} }) }}
        {{ form_errors(registrationForm.email) }}
</div>
```

<https://getbootstrap.com/docs/5.3/forms/form-control/>

```html
{{ form_label(registrationForm.email, 'Email :' ) }}

<label for="xxxxx" class="form-label">Email :</label>
```

// si tout va bien 

```html
{{ form_widget(registrationForm.email, { attr: { aria_label:'Veuillez obligatoirement saisir votre email'} }) }}

<input type="email" class="form-control"  aria_label="Veuillez obligatoirement saisir votre email" id="xxxxx">
```

// si tout erreur 

```html
<input type="email" class="form-control is-invalid"  aria_label="Veuillez obligatoirement saisir votre email" id="xxxxx">

{{ form_errors(registrationForm.email) }}

<div class="invalid-feedback"> 
```   

pour le texte dans l'erreur => `{{ form_errors() }}` , il vient de l'Assert dans l'entité

<https://symfony.com/doc/current/reference/constraints/Length.html>

1. ajouter la config au fichier .yaml
2. entité => ajouter une Constraint 

```php
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Column()]
    // le champ est OBLIGATOIRE sinon la bdd la refuse =>
    // et au maximum il ya 255 caractères 
    // VARCHAR(255) NOT NULL 
#[Assert\Length(
        min: 2, 
        max: 50, 
        minMessage: "au minimum 2 lettres" , 
        maxMessage: "blabla"
)]
private ?string $type = null ;
```

## CRUD via le terminal 

```sh
symfony console make:crud

entité ?? Requete

controller => OK

test unitaire => no
```

- créer le controller avec 5 méthodes
- formType 
- dossier dans template avec toutes les vues du CRUD 

```sh
symfony serve
```

<https://127.0.0.1:8001/requete>



# question sur les migrations

```txt
dans ma relation ManyToOne entre Request Offer et Member, le fichier de migrations a créé une TEMPORARY TABLE. Je ne sais pas ce que cela veut dire. J’ai fait une erreur quelque part ?dans ma relation ManyToOne entre Request Offer et Member, le fichier de migrations a créé une TEMPORARY TABLE. Je ne sais pas ce que cela veut dire. J’ai fait une erreur quelque part ?
```

on est sur une base de donnée SQLITE :

```txt
DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db"
```

- si j'ai une colonne ET que cette colonne contient des données ET sur l'on veut modifier le nom de cette colonne 
- table temporaire permettent de garder les données lorsque l'on veut changer le nom d'une colonne (sur SQLITE)

# Authentification

```txt
au rdv n°6,  tu as commencé à me dire que Member et User n’étaient pas forcément la même chose, mais on a embrayé sur autre chose. Je ne dois pas créer une entité User à part pour l’authentiification, non ? 
```

=> tu peux utiliser n'importe quel nom pour l'entité en charge de stocker les profils utilisateurs => `User` / `Membre` 

```sh
symfony console make:user

created: src/Entity/User.php
created: src/Repository/UserRepository.php
updated: src/Entity/User.php
updated: config/packages/security.yaml
```


- créer tout ce dont tu as besoin pour t'authentifier 
- table MEMBRE contient un champ email => RECHERCHER utiliseur
- table MEMBRE un colonne password => DOIT stoker les informations de manière hashée 
- symfony va comparer une valeur en clair (plainpassword) avec la colonne password de la table qui contient du texte hashé 



- il reste à créer le formulaire de connexion
- il reste à créer le formulaire de création de profil 

