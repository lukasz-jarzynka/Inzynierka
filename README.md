## Organizer

Organizer to aplikacja webowa oparta na frameworku Symfony, która umożliwia użytkownikom tworzenie i zarządzanie notatkami. Zapewnia wygodny sposób przechowywania ważnych informacji i dostęp do nich w dowolnym momencie.

# Funkcje

- Rejestracja i uwierzytelnianie użytkowników
- Tworzenie, edycja i usuwanie notatek
- Przeglądanie istniejących notatek
- Aktualizacja informacji o profilu użytkownika

# Wykorzystane technologie

- PHP 8.1
- Symfony 6.2
- HTML/CSS
- JavaScript
- Bootstrap
- PostgreSQL

# Realizacja

Projekt został zrealizowany w oparciu o architekturę MVC (Model-View-Controller). Wykorzystano framework Symfony wraz z szeregiem komponentów do budowy aplikacji webowej:

- Symfony Framework Bundle: podstawowy pakiet frameworka Symfony, zapewniający funkcjonalności takie jak routing, kontrolery, konfiguracja itp.
- Doctrine ORM: biblioteka do zarządzania danymi w bazie danych.
- Twig: silnik szablonów wykorzystywany do generowania interfejsu użytkownika.
- Symfony Form: komponent do tworzenia formularzy i ich walidacji.
- Symfony Security: komponent odpowiedzialny za zarządzanie bezpieczeństwem aplikacji.
- Symfony Routing: komponent do definiowania tras (URL) w aplikacji.
- Symfony Console: komponent do tworzenia i uruchamiania poleceń konsolowych.
- Symfony Validator: komponent do walidacji danych wejściowych.

Interfejs użytkownika aplikacji został stworzony przy użyciu HTML, CSS oraz JavaScript. Dane są przechowywane w bazie danych PostgreSQL. Projekt został skonteneryzowany przy użyciu Dockera.

# Uruchamianie projektu

1. Uruchom Docker
2. Wykonaj polecenie  `docker compose build`
2. Wykonaj polecenie  `docker compose up -d`
3. Wykonaj polecenie  `docker compose exec app make init_project`

Serwer jest uruchomiony pod adresem http://localhost:8080/
