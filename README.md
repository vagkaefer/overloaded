# Server Overloaded

![Example Image](img/overloaded.jpg "Example Image")

## Description - English
Script that blocks the load when the server is overloaded.

## Description - Português 
Script em PHP que verifica se o servidor não está sobrecarregado. Caso esteja bloqueia o carregamento para evitar mais requisições.

### Version

V 0.3 (This script is in Beta version)

### How to use
To use this script, upload the file "overloaded.class.php" for your project. At the beginning of your script includes this code:
```<php>
include 'overloaded.class.php';
$serverover = new overloaded();
$max_processing = 30; // 0 - 100
$serverover->check($max_processing); //$max_processing is the maximum percentage of processing
```

### Variables
##### - Language
Change the language of the alerts!
```
$serverover->set_language( string );
```
Languages available:
```
'pt-br'-> "Português do Brasil"
'en'-> "English"
'es'-> "Español"
```
##### - Autoreload
The page reloads automatically every X seconds. Set zero to disable!
```
$serverover->set_autoreload( int seconds );
```
The default value is 0
