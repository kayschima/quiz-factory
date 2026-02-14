# Quiz Factory

Eine moderne Quiz-Webanwendung, mit der Benutzer Quizfragen erstellen, verwalten und beantworten können.

## 📖 Über das Projekt

Quiz Factory ist eine Full-Stack-Webanwendung, die es ermöglicht:

- **Quizfragen erstellen** - Benutzer können eigene Fragen mit mehreren Antwortmöglichkeiten einreichen
- **Kategorien nutzen** - Fragen werden in verschiedene Kategorien eingeteilt
- **Schwierigkeitsgrade wählen** - Fragen können nach Schwierigkeit klassifiziert werden
- **Quizze spielen** - Interaktive Quiz-Sessions mit sofortigem Feedback
- **Benutzerverwaltung** - Registrierung, Anmeldung und Profilverwaltung

## 🚀 Technologie-Stack

### Backend

- **PHP 8.5** - Moderne PHP-Version
- **Laravel 12** - PHP-Framework
- **Laravel Fortify** - Authentifizierung
- **Spatie Laravel Permission** - Rollen- und Berechtigungsverwaltung

### Frontend

- **Vue.js 3** - Reaktives JavaScript-Framework
- **Inertia.js** - Moderne Monolith-Architektur
- **Tailwind CSS 4** - Utility-First CSS-Framework
- **TypeScript** - Typsicheres JavaScript

### Entwicklungstools

- **Vite** - Build-Tool
- **Pest** - Testing-Framework
- **Laravel Pint** - Code-Styling
- **ESLint & Prettier** - Frontend-Code-Qualität

## 📋 Voraussetzungen

- PHP >= 8.5
- Composer
- Node.js >= 18
- npm oder yarn

## 🔧 Installation

1. **Repository klonen**
   ```bash
   git clone https://github.com/kayschima/quiz-factory.git
   cd quiz-factory
   ```

2. **Setup ausführen**
   ```bash
   composer setup
   ```

   Dieser Befehl führt automatisch folgende Schritte aus:
    - Composer-Abhängigkeiten installieren
    - `.env`-Datei erstellen
    - Anwendungsschlüssel generieren
    - Datenbankmigrationen ausführen
    - npm-Abhängigkeiten installieren
    - Frontend-Assets kompilieren

3. **Entwicklungsserver starten**
   ```bash
   composer dev
   ```

   Dies startet gleichzeitig:
    - PHP-Entwicklungsserver
    - Queue-Worker
    - Vite-Entwicklungsserver

4. **Anwendung öffnen**

   Öffne [http://localhost:8000](http://localhost:8000) im Browser.

## 🧪 Tests

```bash
# Alle Tests ausführen
composer test

# Nur PHP-Tests
php artisan test

# Code-Style prüfen
composer test:lint
```

## 📁 Projektstruktur

```
quiz-factory/
├── app/
│   ├── Http/Controllers/    # Controller
│   ├── Models/              # Eloquent-Modelle
│   └── Services/            # Business-Logik
├── database/
│   ├── factories/           # Model-Factories
│   ├── migrations/          # Datenbankmigrationen
│   └── seeders/             # Datenbank-Seeder
├── resources/
│   └── js/                  # Vue-Komponenten
├── routes/                  # Routen-Definitionen
└── tests/                   # Test-Dateien
```

## 🤝 Beitragen

Beiträge sind herzlich willkommen! So kannst du mithelfen:

1. **Fork erstellen**

   Klicke auf "Fork" oben rechts auf der GitHub-Seite.

2. **Feature-Branch erstellen**
   ```bash
   git checkout -b feature/meine-neue-funktion
   ```

3. **Änderungen vornehmen**

    - Halte dich an den bestehenden Code-Style
    - Schreibe Tests für neue Funktionen
    - Aktualisiere die Dokumentation bei Bedarf

4. **Code-Style prüfen**
   ```bash
   # PHP
   composer lint
   
   # JavaScript/Vue
   npm run lint
   npm run format
   ```

5. **Tests ausführen**
   ```bash
   composer test
   ```

6. **Änderungen committen**
   ```bash
   git commit -m "feat: Beschreibung der Änderung"
   ```

7. **Branch pushen**
   ```bash
   git push origin feature/meine-neue-funktion
   ```

8. **Pull Request erstellen**

   Öffne einen Pull Request auf GitHub mit einer Beschreibung deiner Änderungen.

### Richtlinien für Beiträge

- **Commits**: Verwende aussagekräftige Commit-Nachrichten
- **Code-Style**: Befolge PSR-12 für PHP und die ESLint-Konfiguration für TypeScript/Vue
- **Tests**: Neue Features sollten mit Tests abgedeckt sein
- **Dokumentation**: Aktualisiere die README bei größeren Änderungen

## 📄 Lizenz

Dieses Projekt ist unter der **MIT-Lizenz** lizenziert. Siehe die [LICENSE](LICENSE)-Datei für Details.

```
MIT License

Copyright (c) 2024-2026 Quiz Factory

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```

## 🔗 Links

- [GitHub Repository](https://github.com/kayschima/quiz-factory)
- [Laravel Dokumentation](https://laravel.com/docs)
- [Vue.js Dokumentation](https://vuejs.org/)
- [Inertia.js Dokumentation](https://inertiajs.com/)

---

Mit ❤️ entwickelt

