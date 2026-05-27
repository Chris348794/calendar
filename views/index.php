<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>php</title>
    <link rel="stylesheet" href="styles/index.css">
</head>


<body>
    <div class="mainBlock">
        <?php foreach ($columns as $col): ?>
            <div class="column">
                <div class="columnTitle"> <?=$col[1]?> </div>
                <div class="columnList">
                    <?php foreach ($col[0] as $event) : ?>
                        <?php $done = $event['completed'];
                            $task = !$event['isDeadline'] ?>
                        <a href= "event.php?id=<?= $event['id']?>" class="taskBlock" <?php if ($done) echo "style='border-color: rgb(0, 255, 0); box-shadow: 0px 0px 20px 0px rgb(0, 255, 0, 0.5);'";?>>
                            <?php if($task): ?>
                                
                                <svg class="coolCheckBox" width="60px" viewBox="0 0 26 26"> 
                                    <?php  if($done): ?>
                                        <polyline class="greenCheck" points="20 7 11 16 7 12"></polyline>
                                    <?php endif ?>
                                    <a href= "togglecomplete.php?id=<?=$event['id']?>">
                                        <circle cx="13" cy="13" r="12" stroke="<?=$done ? 'rgb(0, 255, 0)' : 'rgb(255, 255, 255)'?>" stroke-width="1" fill="rgb(0, 0, 0, 0)"/>
                                    </a>
                                </svg>
                                
                            <?php endif;?>
                            <div class="taskName" <?php if($done) echo "style='color: rgb(0, 255, 0)'";?>>
                                <?=$event['name']?>
                            </div>
                        </a>
                    <?php endforeach;?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="addButton">
        <a href= "add.php">
        <svg fill="#ffffff" height="100%" width="100%" 
            viewBox="0 0 36.5 32" xml:space="preserve">
        <path d="M16,2C8.3,2,2,8.3,2,16s6.3,14,14,14s14-6.3,14-14S23.7,2,16,2z M20,17h-3v3c0,0.6-0.4,1-1,1s-1-0.4-1-1v-3h-3
            c-0.6,0-1-0.4-1-1s0.4-1,1-1h3v-3c0-0.6,0.4-1,1-1s1,0.4,1,1v3h3c0.6,0,1,0.4,1,1S20.6,17,20,17z"/>
        </svg>
        </a>
    </div>
</body>
</html>