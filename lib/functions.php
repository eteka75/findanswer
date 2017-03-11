<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function connect() {
    $database_name = 'qr';
    $username = 'root';
    $password = '';
    //$host = '172.10.245.23';
    $host = '127.0.0.1';
    $dns = 'sqlite:qr.sqlite';
    $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    );
    return $db = new Db($dns);
    /*
      $pdo='';
      try {
      //echo  dirname(__FILE__) . '\qr.sqlite';
      $pdo = new PDO($dir);
      $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // ERRMODE_WARNING | ERRMODE_EXCEPTION | ERRMODE_SILENT
      return $pdo;
      } catch (Exception $e) {
      echo "Impossible d'accéder à la base de données SQLite : " . $e->getMessage();
      return NULL;
      }
      return $pdo;
      // return $db = new Db('sqlite:host=' . $host . ';dbname=' . $database_name, $username, $password); */
}

function controle_login($page = 'login.php') {
    if (session_id()) {
        if (!isset($_SESSION['id'])) {
            return redirect($page);
        }
    }
}

function login($db, $conditions,$page='index.php') {
    //$db= connect();
    $is_connected = FALSE;
    $entreprise = $db->select("entreprises", $conditions, 'Limit 1');
    if (count($entreprise)) {
        $newuser = $entreprise[0];
        // $newuser = array_map('utf8_encode', $entreprise[0]);
        //print_r($newuser);
        $_SESSION['id'] = $newuser['id'];
        $_SESSION['user'] = serialize($newuser);
        $is_connected = TRUE;
        redirect($page);
    } else {
        return 'Login ou mot de passe incorrecte';
    }
    return NULL;
}

function date_fr($date, $format = NULL) {
    $nom_jour_fr = array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi");
    $mois_fr = Array("", "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août",
        "Septembre", "Octobre", "Novembre", "Décembre");
// on extrait la date du jour
    $mydat = date("w/d/n/Y", strtotime($date));
    list($nom_jour, $jour, $mois, $annee) = explode('/', $mydat);
    if ($format == "j") {
        return $nom_jour_fr[$nom_jour];
    }
    if ($format == "d") {
        return $jour;
    }
    if ($format == "m") {
        return $mois_fr[$mois];
    }

    if ($format == "jm") {
        return $nom_jour_fr[$nom_jour] . " " . $mois_fr[$mois];
        ;
    }

    if ($format == "y") {
        return $annee;
    }
    if ($format == "ma") {
        return $mois_fr[$mois] . " " . $annee;
    }


    return $nom_jour_fr[$nom_jour] . ' ' . $jour . ' ' . $mois_fr[$mois] . ' ' . $annee;
}

function redirect($url, $permanent = false) {
    $url_infos = parse_url($url);
    if (!array_key_exists('scheme', $url_infos)) {
        $url = (empty($_SERVER['HTTPS']) || strtolower($_SERVER['HTTPS']) == 'off') ? 'http' : 'https';
        $url .= '://';
        $url .= $_SERVER['HTTP_HOST'];
        if ($_SERVER['SERVER_PORT'] != '80')
            $url .= ':' . $_SERVER['SERVER_PORT'];

        if (preg_match('`^\/`', $url_infos['path']))
            $url .= $url_infos['path'];
        else {
            $url .= '/';

            $c_dirs = pathinfo($_SERVER['REQUEST_URI'] . 'x', PATHINFO_DIRNAME);
            $c_dirs = explode('/', trim($c_dirs, '/'));

            $t_dirs = explode('/', $url_infos['path']);
            foreach ($t_dirs as $d) {
                switch ($d) {
                    case '':
                    case '.': break;
                    case '..': array_pop($c_dirs);
                        break;
                    default: array_push($c_dirs, $d);
                }
            }
            if (array_pop($t_dirs) === '')
                array_push($c_dirs, '');

            $url .= implode('/', $c_dirs);
        }

        if (isset($url_infos['query']))
            $url .= '?' . $url_infos['query'];

        if (isset($url_infos['fragment']))
            $url .= '#' . $url_infos['fragment'];
    }


    if ($permanent)
        header("Status: 301 Moved Permanently", true, 301);
    else
        header("Status: 302 Found", true, 302);
    header("Location: {$url}");

    echo "The document has moved <a href=\"{$url}\">here</a>.";

    exit;
}

function imagethumb($image_src, $image_dest = NULL, $max_size = 100, $expand = FALSE, $square = FALSE) {
    if (!file_exists($image_src))
        return FALSE;

    // Récupère les infos de l'image
    $fileinfo = getimagesize($image_src);
    if (!$fileinfo)
        return FALSE;

    $width = $fileinfo[0];
    $height = $fileinfo[1];
    $type_mime = $fileinfo['mime'];
    $type = str_replace('image/', '', $type_mime);

    if (!$expand && max($width, $height) <= $max_size && (!$square || ($square && $width == $height) )) {
        // L'image est plus petite que max_size
        if ($image_dest) {
            return copy($image_src, $image_dest);
        } else {
            header('Content-Type: ' . $type_mime);
            return (boolean) readfile($image_src);
        }
    }

    // Calcule les nouvelles dimensions
    $ratio = $width / $height;

    if ($square) {
        $new_width = $new_height = $max_size;

        if ($ratio > 1) {
            // Paysage
            $src_y = 0;
            $src_x = round(($width - $height) / 2);

            $src_w = $src_h = $height;
        } else {
            // Portrait
            $src_x = 0;
            $src_y = round(($height - $width) / 2);

            $src_w = $src_h = $width;
        }
    } else {
        $src_x = $src_y = 0;
        $src_w = $width;
        $src_h = $height;

        if ($ratio > 1) {
            // Paysage
            $new_width = $max_size;
            $new_height = round($max_size / $ratio);
        } else {
            // Portrait
            $new_height = $max_size;
            $new_width = round($max_size * $ratio);
        }
    }

    // Ouvre l'image originale
    $func = 'imagecreatefrom' . $type;
    if (!function_exists($func))
        return FALSE;

    $image_src = $func($image_src);
    $new_image = imagecreatetruecolor($new_width, $new_height);

    // Gestion de la transparence pour les png
    if ($type == 'png') {
        imagealphablending($new_image, false);
        if (function_exists('imagesavealpha'))
            imagesavealpha($new_image, true);
    }

    // Gestion de la transparence pour les gif
    elseif ($type == 'gif' && imagecolortransparent($image_src) >= 0) {
        $transparent_index = imagecolortransparent($image_src);
        $transparent_color = imagecolorsforindex($image_src, $transparent_index);
        $transparent_index = imagecolorallocate($new_image, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
        imagefill($new_image, 0, 0, $transparent_index);
        imagecolortransparent($new_image, $transparent_index);
    }

    // Redimensionnement de l'image
    imagecopyresampled(
            $new_image, $image_src, 0, 0, $src_x, $src_y, $new_width, $new_height, $src_w, $src_h
    );

    // Enregistrement de l'image
    $func = 'image' . $type;
    if ($image_dest) {
        $func($new_image, $image_dest);
    } else {
        header('Content-Type: ' . $type_mime);
        $func($new_image);
    }

    // Libération de la mémoire
    imagedestroy($new_image);

    return TRUE;
}

function gen_slug($str) {
    # special accents
    $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'Ð', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', '?', '?', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', '?', '?', 'L', 'l', 'N', 'n', 'N', 'n', 'N', 'n', '?', 'O', 'o', 'O', 'o', 'O', 'o', 'Œ', 'œ', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'Š', 'š', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Ÿ', 'Z', 'z', 'Z', 'z', 'Ž', 'ž', '?', 'ƒ', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', '?', '?', '?', '?', '?', '?');
    $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o');
    return strtolower(preg_replace(array('/[^a-zA-Z0-9 -]/', '/[ -]+/', '/^-|-$/'), array('', '-', ''), str_replace($a, $b, $str)));
}

function Telecharger($inputImage, $Destination, $taille = 80) {
    $thumb_path1 = '';
    if (isset($_FILES[$inputImage]) && !$_FILES[$inputImage]['error'] && $imagesize = getimagesize($_FILES[$inputImage]['tmp_name'])) {
        $extension = str_replace(array('image/', 'jpeg'), array('', 'jpg'), $imagesize['mime']);
//        print_r($extension);
        $filename = time() . '.' . $extension;
        //$filename = gen_slug($filename) . '_' . rand(111, 9999);
        $thumb_path1 = $Destination . '/' . $filename;
        $thumb_path2 = $Destination . '/mini_' . $filename;

        move_uploaded_file($_FILES[$inputImage]['tmp_name'], $thumb_path1);
        imagethumb($thumb_path1, $thumb_path2, $taille);
        return $thumb_path1;
    } 
    return '';
}

function url() {
    return str_replace("\\", "/", dirname(__DIR__));
}

function asset($file) {
    return url() . '/' . $file;
}

function autolink($str, $attributes = array()) {
    $attrs = '';
    foreach ($attributes as $attribute => $value) {
        $attrs .= " {$attribute}=\"{$value}\"";
    }

    $str = ' ' . $str;
    $str = preg_replace(
            '`([^"=\'>])((http|https|ftp)://[^\s<]+[^\s<\.)])`i', '$1<a href="$2"' . $attrs . '>$2</a>', $str
    );
    $str = substr($str, 1);

    return $str;
}

function minify_css($str) {
    $str = str_replace(array("\r", "\n"), '', $str);
    $str = preg_replace('`([^*/])\/\*([^*]|[*](?!/)){5,}\*\/([^*/])`Us', '$1$3', $str);
    $str = preg_replace('`\s*({|}|,|:|;)\s*`', '$1', $str);
    $str = str_replace(';}', '}', $str);
    $str = preg_replace('`(?=|})[^{}]+{}`', '', $str);
    $str = preg_replace('`[\s]+`', ' ', $str);

    return $str;
}

function gras_Search($text, $mot) {
    return str_ireplace($mot, "<b>" . $mot . "</b>", $text);
}

function truncate($string, $max_length = 30, $replacement = '', $trunc_at_space = false) {
    $max_length -= strlen($replacement);
    $string_length = strlen($string);

    if ($string_length <= $max_length)
        return $string;

    if ($trunc_at_space && ($space_position = strrpos($string, ' ', $max_length - $string_length)))
        $max_length = $space_position;

    return substr_replace($string, $replacement, $max_length);
}
