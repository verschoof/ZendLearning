<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Yaml\Parser;
use Symfony\Component\Filesystem\Filesystem;

$yaml = new Parser();
$fs   = new Filesystem();

if (!$fs->exists(__DIR__ . '/../data/config.yml')) {
    exit(sprintf('Missing "%s", copy the config file.', realpath(__DIR__ . '/../data') . '/config.yml'));
}

if (!$fs->exists(__DIR__ . '/../data/userdata.json')) {
    $fs->dumpFile(__DIR__ . '/../data/userdata.json', '[]');
}

$questions  = $yaml->parse(file_get_contents(__DIR__ . '/../data/questions.yml'));
$categories = $questions['categories'];

$configYaml = $yaml->parse(file_get_contents(__DIR__ . '/../data/config.yml'));
$config     = $configYaml['config'];

$userData = json_decode(file_get_contents(__DIR__ . '/../data/userdata.json'));
?>

<html>
    <head>
        <title>Exam Information- PHP5</title>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="js/application.js" type="text/javascript"></script>

        <link href='css/application.css' rel='stylesheet' type='text/css' />
    </head>
    <body>

    </body>
</html>
<h2>Exam Information</h2>
<small>(<a href="http://www.zend.com/en/services/certification/php-5-certification" target="_blank">http://www.zend.com/en/services/certification/php-5-certification</a>)</small><br>
<br>

<div class="question-list">
    <?php
    $i=1;
    foreach ($categories as $category => $questions) {
        ?>
        <div class="category">
            <div class="header"><?php echo $category; ?></div>
            <div class="links">
                <ul>
                    <?php
                    foreach ($questions as $question) {
                        $validLink  = (!empty($question['link']) && $question['link'] != "#");
                        $uniqueName = str_replace(' ', '_', strtolower($category)) . '-' . str_replace(' ', '_', strtolower($question['label']));
                        $done       = in_array($uniqueName, $userData);

                        $class = '';
                        if (!$validLink) {
                            $class = ' no-link';
                        } elseif ($done) {
                            $class = ' done';
                        }

                        ?>
                        <li class="question<?php echo $class; ?>">
                            <?php
                            if ($validLink) {
                                echo '<input type="checkbox" id="' . $uniqueName . '" class="question-box" ' . ($done ? 'checked="checked"' : '') . ' /> ';

                                echo '<a href="' . $config['php_base_url'] . $question['link'] . '" target="_blank">' . $question['label'] . '</a>';
                            } else {
                                echo $question['label'];
                            }
                            ?>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
        <?php

        if ($i%3 == 0) {
            echo '<div style="clear: both;"></div>';
        }

        $i++;
    }
    ?>
</div>
