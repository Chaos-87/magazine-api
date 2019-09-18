## Instalacja

1. Utworzyć plik z konfiguracją .env na podstawie .env.example
    - ustawić dostęp do bazy danych 
1. Dociągnięcie paczek za pomocą composer
    > composer install

1. W razie potrzeby nadanie odpowiednich uprawnień dla katalogu storage
    > sudo chmod a+rw -R storage/
1. Wygenerowanie klucza aplikacji
    > php artisan key:generate
1. Stworzenie struktury bazy danych
    > php artisan migrate

1. Dodanie usera (admin/admin)
    > php artisan db:seed --class UsersTableSeeder
                                  
    `można sprawdzić czy wszystko dobrze działa wysyłając żądanie GET pod api/authorize 
    gdzie body jest w formacie json i zawiera 
    {
        "name": "admin",
        "password": "admin"
    }
    W odpowiedzi otrzymujemy token`

1. Uzupełnienie bazy przykładowymi danymi
    > php  artisan db:seed 

## Działanie

1. Pobranie tokenu: 
    
    URL:
    ``` 
    HOST/api/authorize 
    ```
    body:
    ```
   {
        "name": "admin",
        "password": "admin"
   }
   ```                                                    
1. Lista wydawnictw `Wymagane wysłanie Beare Token`: 

    URL:
    ``` 
    HOST/api/publishers/list 
    ```
1. Pobranie pojedynczego magazynu `Wymagane wysłanie Beare Token`:

    URL:
    ``` 
    HOST/api/magazines/{id}
    ```
1. Pobranie listy magazynów `Wymagane wysłanie Beare Token`:
    URL:
    ``` 
    HOST/api/magazines/search
    ```
   BODY:
   ```
   {
       "resultOfPage": 2,
       "page": 1,
       "filters": {
           "name": "nazwa magazynu",
           "publishers": [1,2]
       }
   }
   ```
   
   * Wszystkie parametry są opcjonalne. Domyślnie jest strona 1 z 5 wynikami.
### DOCKER
Do uruchomienia projektu można wykorzystać [docker](https://github.com/Chaos-87/docker-base-laravel)
 
