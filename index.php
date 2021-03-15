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
}

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="style.css">
    <title><?php if($fileExists) echo 'P5 Sketch - '.$sketchname; else echo 'P5 Sketches'; ?></title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.3.0/p5.min.js" integrity="sha512-tGZFF1kxT/c9C+kv77mKkZ9Ww1VyU8TMX6HLUSzbPrDLuptbiRFBfti8A33ip+BBIHYUsybuZD9OKLmIqdLmaQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.3.0/addons/p5.sound.min.js" integrity="sha512-wM+t5MzLiNHl2fwT5rWSXr2JMeymTtixiw2lWyVk1JK/jDM4RBSFoH4J8LjucwlDdY6Mu84Kj0gPXp7rLGaDyA==" crossorigin="anonymous"></script>
    <?php if ($fileExists): ?>
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
    <div id="canvas">
        
    </div>

    <?php else: ?>
    <div id="list">
        <?php foreach(glob("sketches/*.js") as $sketch):
            $sketchname = basename($sketch, '.js');    
        ?>
            <a href="<?php echo $baseUri.'?s='.$sketchname ?>"><p><?php echo $sketchname.'.js' ?></p><img src="p5-logo.jpeg"></img></a>
        <?php endforeach; ?>
    </div>
    <?php endif ?>
</body>
</html>