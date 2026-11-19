# 📚 Sistema de Gestió de Biblioteca Digital

**Mòdul:** M0613-B2 - PHP orientat a objectes

## 1. Descripció del projecte

Aquest projecte consisteix en una aplicació web per gestionar una biblioteca digital mitjançant PHP i programació orientada a objectes.

L'aplicació permet gestionar materials (llibres, revistes i DVD), usuaris, préstecs i reserves. També incorpora un sistema d'estadístiques, auditoria i gestió d'errors mitjançant excepcions personalitzades.

## 2. Tecnologies utilitzades

- PHP 8
- Composer
- HTML
- Programació orientada a objectes (POO)
- Sessions PHP
- Autoloading PSR-4

## 3. Instal·lació

Per executar el projecte és necessari tenir PHP i Composer instal·lats.

**1. Clonar el repositori**

```bash
git clone URL_DEL_REPOSITORI
```

**2. Entrar a la carpeta del projecte**

```bash
cd biblioteca
```

**3. Instal·lar les dependències**

```bash
composer install
```

Aquest procés genera la carpeta `vendor/` i configura l'autoloading de Composer.

**4. Iniciar el servidor PHP**

```bash
php -S localhost:8000
```

**5. Obrir l'aplicació al navegador**

http://localhost:8000

## 4. Estructura del projecte

```text
biblioteca/
│
├── composer.json
├── composer.lock
├── .gitignore
├── README.md
├── index.php
│
├── vendor/
│
├── views/
│   ├── inici.php
│   ├── materials.php
│   ├── material.php
│   ├── usuaris.php
│   ├── usuari.php
│   ├── prestecs.php
│   ├── prestec.php
│   ├── retorn.php
│   ├── reserves.php
│   ├── reserva.php
│   ├── estadistiques.php
│   ├── auditoria.php
│   └── ...
│
└── src/
    ├── Models/
    ├── Interfaces/
    ├── Traits/
    ├── Exceptions/
    └── Data/
```

## 5. Funcionalitats i URLs

| URL | Funcionalitat |
|---|---|
| `index.php` | Pàgina principal amb el resum de la biblioteca. |
| `index.php?page=materials` | Mostra tots els materials. |
| `index.php?page=materials&type=llibre` | Filtra els llibres. |
| `index.php?page=materials&type=revista` | Filtra les revistes. |
| `index.php?page=materials&type=dvd` | Filtra els DVD. |
| `index.php?page=material&id=X` | Mostra el detall d'un material. |
| `index.php?page=usuaris` | Mostra tots els usuaris. |
| `index.php?page=usuari&id=X` | Mostra el perfil d'un usuari. |
| `index.php?page=usuari&id=X&action=prestecs` | Mostra l'historial de préstecs d'un usuari. |
| `index.php?page=prestecs` | Mostra els préstecs actius. |
| `index.php?page=prestec&material_id=X&usuari_id=Y` | Realitza un préstec. |
| `index.php?page=retorn&material_id=X` | Retorna un material i calcula la multa. |
| `index.php?page=reserves` | Mostra les reserves actives. |
| `index.php?page=reserva&material_id=X&usuari_id=Y` | Realitza una reserva. |
| `index.php?page=estadistiques` | Mostra les estadístiques de la biblioteca. |
| `index.php?page=auditoria` | Mostra l'historial d'accions dels materials. |

### Demostracions tècniques

| URL | Funcionalitat |
|---|---|
| `index.php?page=demo_magic` | Demostra els mètodes màgics de PHP. |
| `index.php?page=demo_serialization` | Demostra la serialització d'objectes. |
| `index.php?page=demo_exceptions` | Demostra les excepcions personalitzades. |
| `index.php?page=demo_autoload` | Mostra les classes carregades amb Composer. |
| `index.php?page=reset` | Reinicia les dades de la sessió. |

**Nota:** Substitueix `X` i `Y` pels identificadors corresponents.

## 6. Conceptes de programació orientada a objectes

Durant el desenvolupament s'han treballat els conceptes següents:

- **Classes abstractes i herència:** la classe `Material` és abstracta i les classes `Llibre`, `Revista` i `DVD` n'hereten les característiques.
- **Interfícies:** la interfície `Reservable` defineix les operacions de reserva. Només l'implementen `Llibre` i `DVD`.
- **Traits:** el trait `Auditoria` permet registrar les accions dels materials.
- **Encapsulació:** s'utilitzen propietats privades i protegides, getters i setters.
- **Mètodes màgics:** s'utilitzen `__toString()`, `__call()`, `__get()`, `__set()`, `__sleep()` i `__wakeup()`.
- **Excepcions personalitzades:** permeten controlar els errors de préstecs, reserves, materials i usuaris.
- **Namespaces i Composer:** s'utilitza autoloading PSR-4 per carregar les classes automàticament.
- **Sessions:** permeten conservar les dades de la biblioteca entre diferents peticions.

## 7. Decisions de disseny

- S'ha utilitzat `index.php` com a únic punt d'entrada de l'aplicació, amb un router basat en `match`.
- Les dades es generen mitjançant la classe `DataGenerator`.
- S'utilitzen sessions PHP per mantenir els objectes i els canvis realitzats sense necessitat d'una base de dades.
- S'han separat les classes, les interfícies, els traits, les excepcions i les vistes en carpetes diferents.
- La carpeta `vendor/` no s'inclou al repositori, ja que es pot generar novament amb Composer.

## 8. Vídeo de demostració

**Enllaç al vídeo:** [Afegir aquí l'enllaç del vídeo de demostració]

## 9. Autor

Projecte realitzat com a part del mòdul **M0613-B2 - PHP orientat a objectes**.