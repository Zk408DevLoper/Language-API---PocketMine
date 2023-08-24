This API can be used to check player language in-game

## Take Note
 This API checks player's language in-game, we can't be sure
 if player's language in real-life is the same as in-game

## Getting the plugin
 Make sure you have the Language plugin in your plugin's directory

```php
<?php

  $this->lang = $this->getServer()->getPluginManager()->getPlugin("Language");
  
?>
```

## Using the API
 Now we're gonna use the plugin API to retrieve player's language

```php
<?php

 $playerLang = $this->lang->getPlayerLanguage($player);
 
 // We can now check if its eng, rus, pt etc.
 
 if($playerLang == "english"){
    // Do something
?>
```

For more information contact me.
