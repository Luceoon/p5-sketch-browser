<?php

/*
**      MIT License
**  
**      Copyright (c) 2021 Lucas Jahn
**  
**      Permission is hereby granted, free of charge, to any person obtaining a copy
**      of this software and associated documentation files (the "Software"), to deal
**      in the Software without restriction, including without limitation the rights
**      to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
**      copies of the Software, and to permit persons to whom the Software is
**      furnished to do so, subject to the following conditions:
**  
**      The above copyright notice and this permission notice shall be included in all
**      copies or substantial portions of the Software.
**  
**      THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
**      IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
**      FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
**      AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
**      LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
**      OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
**      SOFTWARE.
*/

$baseUri = explode('?', $_SERVER['REQUEST_URI'], 2)[0];
$fileExists = false;
$filename = '';
$sketchname = '';

if (isset($_GET['s']))
{
    $filename = 'sketches/'.str_replace('.js', '', $_GET['s']).'.js';
    $sketchname = str_replace('.js', '', $_GET['s']);
    $fileExists = file_exists($filename);

    if (isset($_GET['download']) && $fileExists)
    {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Disposition: attachment; filename="'.$sketchname.'.js"');
        header('Content-Length: ' . filesize($filename));
        readfile($filename);
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="include/assets/img/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.6/styles/default.min.css">
    <link rel="stylesheet" href="include/assets/css/style.css">
    <title><?php if($fileExists) echo 'P5 Sketch - '.$sketchname; else echo 'P5 Sketches'; ?></title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.6.0/highlight.min.js" integrity="sha512-zol3kFQ5tnYhL7PzGt0LnllHHVWRGt2bTCIywDiScVvLIlaDOVJ6sPdJTVi0m3rA660RT+yZxkkRzMbb1L8Zkw==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.3.0/p5.min.js" integrity="sha512-tGZFF1kxT/c9C+kv77mKkZ9Ww1VyU8TMX6HLUSzbPrDLuptbiRFBfti8A33ip+BBIHYUsybuZD9OKLmIqdLmaQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.3.0/addons/p5.sound.min.js" integrity="sha512-wM+t5MzLiNHl2fwT5rWSXr2JMeymTtixiw2lWyVk1JK/jDM4RBSFoH4J8LjucwlDdY6Mu84Kj0gPXp7rLGaDyA==" crossorigin="anonymous"></script>
    <?php if ($fileExists): ?>
    <script src="include/assets/js/app.js"></script>
    <script src="<?php echo $filename ?>"></script>
    <?php endif ?>
</head>
<body>
    <div id="head">
        <div id="back-btn" class="header-item">
            <a <?php if (!$fileExists) echo 'class="hide"' ?> href="<?php echo $baseUri; ?>">Zurück</a>
        </div>
        <div id="title" class="header-item">
            <h1><?php if($fileExists) echo $sketchname; else echo 'P5 Sketches'; ?></h1>
        </div>
        <div class="header-item"></div>
    </div>

    <?php if ($fileExists): ?>
    <div>
        <div id="canvas">
            
        </div>
        <div id="code">
            <pre><code class="js"><?php echo str_replace('{{$link}}', '<a href="'.$baseUri.'?s='.$sketchname.'&download">Download</a> ('.round(filesize($filename) / 1024, 2).' KiB)', file_get_contents('include/assets/js/code-header.js')).file_get_contents($filename); ?></code></pre>
        </div>
    </div>
    <?php else: ?>
    <div id="list">
        <?php foreach(glob("sketches/*.js") as $sketch):
            $sketchname = basename($sketch, '.js');    
        ?>
            <a href="<?php echo $baseUri.'?s='.$sketchname ?>"><p><?php echo $sketchname.'.js' ?></p></a>
        <?php endforeach; ?>
    </div>
    <?php endif ?>
</body>
</html>