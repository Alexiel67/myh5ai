<?php
$color = '';
function scanFile()
{
    $nb_fichier = 0;
    echo '<ul>';

    $link = "http://$_SERVER[HTTP_HOST]/myh5ai/";

    $path = ($_SERVER['REQUEST_URI']);
    $parts = array_filter(explode('/', $path));
    array_shift($parts);
    $lastLink = $parts;
    array_pop($lastLink);
    $lastLink = implode($lastLink, '/');

    $path = implode('/', $parts);
    echo '<div class="row">  
                    <div class="col-md-2"></div>
                    <div class="col-md-8 alert alert-light infoDiv">
                        ' . $path . '
                    </div>
                    <div class="col-md-2"></div>
                </div>';

    $dirname = './home/' . $path;


        $dir = opendir($dirname);

        while ($file = readdir($dir)) {
            if ($file != '.' && $file != '..') {
                if (is_file($dirname . '/' . $file)) {
                    $nb_fichier++;
                    $octet = "( " . filesize($dirname . '/' . $file) . " octets )";
                    $modifDate = date ("F d Y H:i:s.", filemtime($dirname . '/' . $file));
                    echo '<div class="listAi"><li class="' . getTypeExt($file) . '"><a href="' . $dirname . '/' . $file . '" style="color:#4b1189"> ' . $file . '  ' . $octet . ' <span class="modifDate"> ' . $modifDate . ' </span></a></li></div>';
                }
                else {
                    $nb_fichier++;
                    echo '<div class="listAi"><li class="' . getTypeExt($file) . '"><a href="' . $_SERVER['REQUEST_URI'] . $file . '/" style="color:#122ab0"> ' . $file . '</a></li></div>';
                }
            }
        }

        echo '</ul>';

    echo '
                <div class="row">  
                    <div class="col-md-2"></div>
                    <div class="col-md-8 alert alert-light infoDiv">
                        Il y a <strong>' . $nb_fichier .'</strong> élément(s) dans le dossier !
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <div class="row">
                    <div class="col-md-5"></div>
                    <div class="col-md-1">
                        <a href="'. $link . $lastLink . '"><button type="button" class="btn btn-outline-light backButton"><span class="arrow">&larr;</span></button></a>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-outline-light backButton"><span class="arrow">&rarr;</span></button>
                    </div>
                    <div class="col-md-5"></div>
                </div>';

    closedir($dir);
}

function getTypeExt($file) {
    $type = pathinfo($file);

    if (!isset($type['extension'])) {
        return "far fa-folder fa-2x";
    }

    $fileExtension = $type['extension'];

    switch($fileExtension)
    {
        case "txt":
            return "far fa-file-alt fa-2x";
            break;

        case "pdf":
            return "far fa-file-pdf fa-2x";
            break;

        case "php":
            return "fab fa-php fa-2x";
            break;

        case "html":
            return "fab fa-html5";
            break;

        case "jpg":
        case "jpeg":
        case "png":
            return "far fa-file-image fa-2x";
            break;

        case "": // Handle file extension for files ending in '.'
        default: // Handle no file extension
            break;
    }
    // echo $fileExtension . '<br/>'; // Returns .html
}

/*function filDariane($lien)
{
    $filDariane = "";

    while( $lien != "./http://localhost/myh5ai" )
    {
        $lien = explode('/',$lien);
        if( count($lien) > 1 ) $dernier_dossier = array_pop($lien);
        $lien = implode('/',$lien);

        $filDariane = " > "."<a href='/home . $lien . "/".$dernier_dossier.">".$dernier_dossier.'</a>".$filDariane;
    }
    $filDariane = "<a href='/myh5ai'>Racine</a>".$filDariane;

    echo $filDariane."<br />";
}*/
scanFile();
/*filDariane("./http://localhost/myh5ai");*/
