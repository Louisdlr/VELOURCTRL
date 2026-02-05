<?php
namespace App\exceptions;
use Exception;
use Throwable;
class NotFoundException extends Exception {

  public function __construct($message ="", $code =0,Throwable $previus = null)
  {
    parent::__construct($message,$code,$previus);
  }

  public function error404()
  {
    http_response_code(404);
    require VIEWS .'errors/404.php';
  }

}