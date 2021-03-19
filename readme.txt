# Info

Potrzebujesz przynajmniej:

* PHP 5.3 lub nowszy
* Wybrany edytor tekstu lub IDE
* wybrany kompozytor lub autoloader (lub dostarczony autoloader spl)

# Wiedza, umiejętności

Zostaniesz przetestowany w następujących obszarach programowania PHP:

* Podstawowe zrozumienie implementacji OOP PHP, w tym interfejsów i wzorców projektowych.
* Przestrzenie nazw, zamknięcia / funkcje anonimowe
* Odczytywanie zasobów z lokalizacji w lokalnym systemie plików
* Radzenie sobie z JSON jako formatem danych

# Zadania

Poniżej znajduje się lista zadań do rozwiązania. Każde zadanie nie powinno zajmować więcej niż 45 do 60 minut czasu pracy.
Przeczytaj wszystkie zadania przed rozpoczęciem.
Proszę pamiętać o „zasadzie Boy Scout”.

## Zaimplementuj podstawową usługę ItemService

Zaimplementuj interfejs dla usługi elementu. Użyj pliku JSON z katalogu danych jako źródła danych.
Twoja implementacja musi odczytać zestaw wyników ze źródła danych i przekazać wartości z pliku json do odpowiednich klas z przestrzeni nazw Entity.

Byty hermetyzują się nawzajem:

(Marka) - [hasMany] -> (Pozycje) - [hasMany] -> (Cena)

Plik JSON ma podobną, ale nie równą strukturę. Przyjrzyj się dokładnie obu strukturom.

## Zbuduj podstawowy walidator dla jednostki elementu

Twoim zadaniem jest zbudowanie mechanizmu walidacji dla właściwości url jednostki elementu.
Umieść klasę walidacji we właściwym miejscu w danej architekturze i upewnij się, że wartość jest prawidłowa.
To od Ciebie zależy, jak ją zaimplementujesz i kiedy wywołasz ją w przepływie aplikacji.

## Zaimplementuj sposób, aby uzyskać różne implementacje BrandServiceInterface

Możesz to osiągnąć na kilka sposobów.
Wybierz wariant, w którym czujesz się najbardziej komfortowo lub który uważasz za najbardziej odpowiedni, a nie ten, który Twoim zdaniem może być najbardziej wyszukany.
Możesz chcieć napisać drugą implementację dla BrandServiceInterface, ale nie musisz.
Jeśli jej potrzebujesz, możesz pomyśleć o „PriceOrderedBrandService” lub „ItemNameOrderedBrandService”, które sortują wyniki po otrzymaniu ich z usługi item.

Powodzenia!