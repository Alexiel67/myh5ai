<?php
$color="";
function getFile(){
    $nb_fichier = 0;
    echo '<ul>';

    if($dossier = opendir('./home'))
    {
        while(false !== ($fichier = readdir($dossier)))
        {
            $realfile = './home/' . $fichier;
            if (is_file($realfile)){
                $color = '#4b1189';
                $octet = "( " . filesize($realfile) . " octets )";
            }
            else {
                $color = '#122ab0';
                $octet = '';
            }
            if($fichier != '.' && $fichier != '..' && $fichier != 'index.php')
            {
                $nb_fichier++;
                echo '<div class="listAi">
                    <li class="far '.getTypeExt($fichier).'"><a href="./home' . $fichier . '"  style="color:'. $color.'"> ' . $fichier . '  ' . $octet .' </a></li>
                  </div>';
            }
        }

        echo '</ul><br />';

        echo '
                <div class="row">  
                    <div class="col-md-2"></div>
                    <div class="col-md-8 alert alert-light infoDiv">
                        Il y a <strong>' . $nb_fichier .'</strong> élément(s) dans le dossier !
                    </div>
                    <div class="col-md-2"></div>
                </div>';

        closedir($dossier);

    }
    else

        echo 'Le dossier n\' a pas pu être ouvert';
}

function getTypeExt($file) {
    $type = pathinfo($file);

    if (!isset($type['extension'])) {
        return "fa-folder fa-2x";
    }

    $fileExtension = $type['extension'];

    switch($fileExtension)
    {
        case "txt":
            return "fa-file-alt fa-2x";
            break;

        case "pdf":
            return "fa-file-pdf fa-2x";
            break;

        case "jpg":
        case "jpeg":
        case "png":
            return "fa-file-image fa-2x";
            break;

        case "": // Handle file extension for files ending in '.'
        default: // Handle no file extension
            break;
    }
   // echo $fileExtension . '<br/>'; // Returns .html
}
getFile();