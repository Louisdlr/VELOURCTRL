<?php
namespace Router;
use Database\DBConnection;
class Route{

    public $path;
    public $action;
    public $matches;

    public function __construct($path,$action)
    {
        $this->path = trim($path,'/');
        $this->action = $action;
    }

    public function matches(string $url)
    {
        // vC'est une fonction en PHP qui effectue une recherche et un remplacement de motifs (pattern) dans une chaîne de caractères en utilisant des expressions régulières (regex).
        // # ... # : C'est la syntaxe des délimiteurs d'expressions régulières. Dans cet exemple, # est utilisé comme délimiteur, mais vous pourriez également utiliser d'autres caractères, tels que /, !, ou ~, tant que le délimiteur est le même au début et à la fin de l'expression régulière.
        // :([\w]+) : C'est le motif (pattern) de recherche. Il s'agit d'une expression régulière qui recherche une chaîne de caractères qui commence par : suivi de un ou plusieurs caractères alphanumériques (lettres, chiffres, ou souligné).
        // : : Correspond littéralement au caractère :.
        // ([\w]+) : Utilise des parenthèses pour capturer le texte correspondant à un ou plusieurs caractères alphanumériques (motifs \w signifiant "word character").
        // ([^/]+) : C'est le motif de remplacement. Il s'agit d'une expression régulière qui correspond à un ou plusieurs caractères qui ne sont pas des barres obliques /.
        // ([^/]+) : Utilise des parenthèses pour capturer le texte correspondant à un ou plusieurs caractères qui ne sont pas des barres obliques.
        // si $this->path est la chaîne "abc:def/123:ghi", après l'exécution de preg_replace,

        $path = preg_replace('#:([\w]+)#','([^/]+)',$this->path);

        // Ainsi, la ligne de code construit une expression régulière complète qui commence par ^ (correspondance au début de la chaîne) et se termine par $path (votre motif). Les délimiteurs # entourent l'expression régulière, ce qui est une pratique courante pour délimiter les expressions régulières en PHP.
        // Par exemple, si la variable $path contient le motif "abc", alors $pathToMatch serait égal à "#^abc$#". Cela signifie que l'expression régulière recherchera une correspondance exacte avec la chaîne "abc" au début et à la fin de la chaîne sur laquelle elle est appliquée.
        // Cette construction est couramment utilisée pour créer dynamiquement des expressions régulières en fonction des besoins de votre application, en insérant des motifs variables dans le modèle de recherche. Cela permet de personnaliser les correspondances selon les données ou les paramètres de l'application.

        $pathToMatch = "#^$path$#";

        // ce code est utilisé pour vérifier si la chaîne $url correspond à l'expression régulière définie par $pathToMatch. Si une correspondance est trouvée, les sous-chaînes correspondantes sont stockées dans la propriété $this->matches, et la fonction renvoie true. 
        // Sinon, elle renvoie false. 

        if(preg_match($pathToMatch,$url,$matches))
        {
            $this->matches = $matches;
            return true;
        } else {
            return false;   
        }
    }

    public function execute()
    {
        $params = explode("@",$this->action);

        // création d'un controller de type premier élément de mon tableau de params
        $controller = new $params[0](new DBConnection(DB_NAME,DB_HOST,DB_USER,DB_PASSWORD));
        $method = $params[1];
        return isset($this->matches[1]) ? $controller->$method($this->matches[1]) : $controller->$method();
    }
}
