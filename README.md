<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Dokumentacja Sklepu Wędkarskiego

## Opis projektu
Projekt to sklep internetowy dla wędkarzy, zbudowany przy użyciu php ver. 8.2.4 frameworka Laravel ver.10.31.0 oraz silnika szablonów Blade. 
Platforma umożliwia zarówno użytkownikom, jak i administratorom wygodne korzystanie z różnorodnych funkcji. 

## Funkcjonalności

### Administrator
- Dodawanie nowych kategorii i podkategorii.   
- Dodawanie nowych produktów.
- Akceptacja komentarzy przed ich publikacją.

**Zarządzanie sliderem**
- Dodawanie różnych zdjęć do slidera.
- Ustalanie kolejności zdjęć.
### Użytkownik
- Dodawanie komentarzy do produktów.
- Usuwanie własnych komentarzy.
- Dodawanie produktów do koszyka.
- Składanie zamówienia po uzupełnieniu danych adresowych.
**Płatności**
- Integracja płatności za pomocą Stripe.
- Możliwość anulowania zamówienia przed opłaceniem.
**Powiadomienia email**
- Wysyłanie powiadomień o złożeniu zamówienia.
- Wysyłanie potwierdzenia otrzymania płatności.
## Instrukcja instalacji
1. Sklonuj repozytorium:
   ```bash
   git clone https://github.com/Yanniesh/LaravelShop.git
   cd sklep-wedkarski
   ```
2.Zainstaluj zależności:
```bash
    composer install
    npm install
```
3.Uruchom migracje i seedy:
```bash
   php artisan migrate --seed
```
4.Skonfiguruj plik .env.

5.Uruchom aplikację:
```bash
   php artisan serve
```
