<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>php</title>
    <link rel="stylesheet" href="styles/sub.css">
</head>

<body>
    <div class="mainBlock">
        <div class="top">
            <div class="title"><?=$event['name']?></div>
            <a href="/" class="xbutton">
                <svg fill="#ffffff" height="60" width="60"
                    viewBox="0 0 30 30">

                <path d="M16,2C8.3,2,2,8.3,2,16s6.3,14,14,14s14-6.3,14-14S23.7,2,16,2z M19.5,18.1c0.4,0.4,0.4,1,0,1.4c-0.2,0.2-0.5,0.3-0.7,0.3
                    s-0.5-0.1-0.7-0.3L16,17.4l-2.1,2.1c-0.2,0.2-0.5,0.3-0.7,0.3s-0.5-0.1-0.7-0.3c-0.4-0.4-0.4-1,0-1.4l2.1-2.1l-2.1-2.1
                    c-0.4-0.4-0.4-1,0-1.4s1-0.4,1.4,0l2.1,2.1l2.1-2.1c0.4-0.4,1-0.4,1.4,0s0.4,1,0,1.4L17.4,16L19.5,18.1z"/>
                </svg>
            </a>
        </div>

        <div class="attr">
            <div class="subtitle">
                    <?="{$dateMsg}" ?>
            </div>
        </div>

        <?php if($event['description']):?>
            <div class="attr">
                <div class="subtitle">
                        <?=$event['description']?>
                </div>
            </div>
        <?php endif?>


        <horizontalSect style='place-self: center'>
            <Button class="bigButton" onclick="window.location.href= '/edit.php?id=<?=$event['id']?>'">Edit</Button>
            <Button class="bigRedButton" onclick="window.location.href='/deleteevent.php?id=<?=$event['id']?>';">Delete</Button>
        </horizontalSect>
    </div>
</body>
</html>