<?php
$img_dir = './image/';
function getPictures()
{
    global $img_dir;
    if ($handle = opendir($img_dir)) {
        echo '<div class="images">';
        echo "\n";
        while (($file = readdir($handle)) !== false) {
            $path = $img_dir . $file;
            if (!is_dir($path)) {
                $split = explode('.', $file);
                $name = $split[0];
                $ext = $split[count($split) - 1];
                if (($type = getPictureType($ext)) == '') {
                    continue;
                }
                echo '<a class="image-link" href="' . $path . '" data-lightbox="imgs" ';
                echo 'data-title="' . $name, '">';
                echo '<img class="image" src="' . $path . '" width="240" alt="' . $file . '">';
                echo "</a>\n";
            }
        }
        echo '</div>';
        echo "\n";
    }
}

function getPictureType($ext)
{
    if (preg_match('/jpg|jpeg/i', $ext)) {
        return 'jpg';
    } else if (preg_match('/png/i', $ext)) {
        return 'png';
    } else if (preg_match('/gif/i', $ext)) {
        return 'gif';
    } else {
        return '';
    }
}
