<?php
$img_dir = './image/';
function getPictures()
{
    global $img_dir;
    if ($handle = opendir($img_dir)) {
        while (($file = readdir($handle)) !== false) {
            $path = $img_dir . $file;
            if (!is_dir($path)) {
                $split = explode('.', $file);
                $name = $split[0];
                $ext = $split[count($split) - 1];
                if (($type = getPictureType($ext)) == '') {
                    continue;
                }
                echo '<img class="image" src="' . $path . '" width="240" alt="' . $file . '">';
                echo "</a>\n";
            }
        }
    }
}
//写真の拡張子をextに返すメソッド
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
