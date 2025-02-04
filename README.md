# Webshop

**Ein vollständiger Webshop mit PHP, HTML, CSS und JavaScript, der alle grundlegenden Funktionen eines Online-Shops bietet.**

---

## 📖 Überblick

Dieser *Webshop* ist eine funktionsreiche Anwendung, die die wichtigsten Funktionen eines Online-Shops abdeckt. Er umfasst eine **Produktanzeige**, einen **Warenkorb**, eine **Bestellbestätigung per E-Mail** und ein **Admin-Bereich**, in dem Produkte verwaltet werden können. Zusätzlich wurden Statistiken hinzugefügt, um die bestbewerteten Produkte anzuzeigen.

Die wichtigsten Funktionen:

- **Kundenbereich:** Produkte durchsuchen, in den Warenkorb legen und Bestellungen aufgeben.  
- **Admin-Bereich:** Produkte hinzufügen, bearbeiten und löschen.  
- **Statistiken:** Anzeige der bestbewerteten Produkte.  
- **Datenbankintegration:** Eine vollständige SQL-Datenbankstruktur ist enthalten.

---

## 🎮 Funktionen

1. **Produktanzeige**  
   - Zeigt alle verfügbaren Produkte mit Bildern, Beschreibungen und Preisen an.

2. **Warenkorb**  
   - Kunden können Produkte in den Warenkorb legen und Bestellungen aufgeben.

3. **E-Mail-Bestätigung**  
   - Nach Abschluss einer Bestellung erhält der Kunde eine E-Mail-Bestätigung.

4. **Admin-Bereich**  
   - Ermöglicht das Hinzufügen, Bearbeiten und Löschen von Produkten.

5. **Statistiken**  
   - Zeigt die am besten bewerteten Produkte an.

---

## 🛠️ Features

- **Vollständiger Webshop:** Alle grundlegenden Funktionen eines Online-Shops sind enthalten.  
- **Admin-Verwaltung:** Einfache Verwaltung des Produktkatalogs über ein Admin-Panel.  
- **Statistiken:** Nützliche Einblicke in die beliebtesten Produkte.  
- **Datenbankintegration:** Eine vorgefertigte SQL-Datenbankstruktur ist im Projekt enthalten.

---

## 🚀 Installation und Einrichtung

### Voraussetzungen
- Ein Webserver wie [XAMPP](https://www.apachefriends.org/) oder [WAMP](https://www.wampserver.com/).  
- PHP (Version 7.x oder höher).  
- MySQL-Datenbankserver.  

### Schritte zur Installation
1. **Repository klonen:**  
   Klone das Repository in dein lokales Verzeichnis:  
   ```bash
   git clone https://github.com/Vwalln99/webshop.git
   ```

2. **Projektdateien verschieben:**  
   Verschiebe die Projektdateien in den `htdocs`-Ordner (für XAMPP) oder den entsprechenden Ordner deines Webservers.

3. **Datenbank importieren:**  
   - Öffne phpMyAdmin oder ein anderes Datenbankverwaltungstool.  
   - Erstelle eine neue Datenbank (z. B.: `webshop`).  
   - Importiere die Datei `webshop.sql`, die im Projekt enthalten ist.

4. **Konfigurationsdateien anpassen:**  
   - Öffne die Datei `config.php` (falls vorhanden) oder passe die Datenbankverbindung in deinem Code an:  
     ```php
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "webshop";
     ```

5. **Webserver starten:**  
   Starte deinen lokalen Webserver (z. B.: XAMPP) und öffne den Webshop im Browser:  
   ```
   http://localhost/webshop
   ```

---

## 🌟 Warum solltest du diesen Webshop nutzen?

Dieser *Webshop* bietet eine vollständige Lösung für kleine bis mittelgroße E-Commerce-Projekte. Mit Funktionen wie einem Admin-Bereich, einer E-Mail-Bestätigung für Bestellungen und Statistiken über die beliebtesten Produkte eignet sich dieses Projekt perfekt als Grundlage für eigene Anpassungen oder zum Lernen von PHP und MySQL.

---

## 📧 Kontakt

Für Feedback oder Anfragen wende dich an den Entwickler:

- **GitHub-Profil:** [Vwalln99](https://github.com/Vwalln99)
