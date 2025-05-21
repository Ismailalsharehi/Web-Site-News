<?php
namespace Controllers\Functions;



class Functions
{


  public static function cleanInput($data)
  {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8'); // to clean inputs 
  }

  public static  function generateSlug($title) // generate a spasific links to tags  
  {
    $slug = mb_strtolower(trim($title));
    $slug = preg_replace('/[^a-z0-9أ-ي\s-]/u', '', $slug); // remove any Character that is spasefic
    $slug = preg_replace('/[\s-]+/', '-', $slug);
    return $slug;
  }
}
