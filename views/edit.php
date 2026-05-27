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
            <div class="title">
                <?=$event['name']?>
            </div>
            <a href="/" class="xbutton">
                <svg fill="#ffffff" height="60" width="60"
                    viewBox="0 0 30 30">

                <path d="M16,2C8.3,2,2,8.3,2,16s6.3,14,14,14s14-6.3,14-14S23.7,2,16,2z M19.5,18.1c0.4,0.4,0.4,1,0,1.4c-0.2,0.2-0.5,0.3-0.7,0.3
                    s-0.5-0.1-0.7-0.3L16,17.4l-2.1,2.1c-0.2,0.2-0.5,0.3-0.7,0.3s-0.5-0.1-0.7-0.3c-0.4-0.4-0.4-1,0-1.4l2.1-2.1l-2.1-2.1
                    c-0.4-0.4-0.4-1,0-1.4s1-0.4,1.4,0l2.1,2.1l2.1-2.1c0.4-0.4,1-0.4,1.4,0s0.4,1,0,1.4L17.4,16L19.5,18.1z"/>
                </svg>
            </a>
        </div>


        <form id="editEventForm" method="POST">

            <div class="attr">
                <div class="horizontalSect">
                <div class="subtitle">
                    Name:
                </div>
                <input name="name" type="text" class="input" value="<?=$event['name']?>" required>
                </div>
            </div>

            <div class="attr">
                <div class="horizontalSect">
                    <div class="subtitle">When?</div>
                    <select id="monthSelect" name="month" class="smallInput" required>

                        <?php foreach ($months as $monthNum => $label): ?>
                            <option value="<?= $monthNum ?>" <?= ($monthNum == $month) ? 'selected' : '' ?>>
                                <?= $label ?>
                            </option>
                        <?php endforeach; ?>

                    </select>
                    <input id="daySelect" name="day" type="number" class="smallInput" required min='1' max='31' placeholder="Must be between 1 and 31" value=<?=$day?>>
                    <select id="yearSelect" name="year" class="smallInput">

                        <?php foreach ($nextYears as $yearOption):?>
                            <option value="<?= $yearOption ?>" <?= ($year == $yearOption) ? 'selected' : '' ?>>
                                <?= $yearOption?>
                            </option>
                        <?php endforeach?>

                    </select>
                </div>
            </div>

            <div class="attr">
                <div class="horizontalSect">
                    <div class="subtitle">Repeats?</div>
                    <svg class="coolCheckBox" data="<?=json_encode($repeats)?>" width="60px" height="60px" viewBox="0 0 26 26"> 
                        <polyline id="repeatsShow" class="greenCheck" points="20 8 11 17 7 13"></polyline>
                        <circle class="repeatsOutline" cx="13" cy="13" r="12" stroke='rgb(255, 255, 255)'; stroke-width="1" fill="rgb(0, 0, 0, 0)" style="cursor: pointer"/>
                    </svg>
                    <input type="hidden" name="repeats" id="repeatsInput">
                </div>

                <div id="repeatsShow" style="display:none;">
                    <div class="horizontalSect">
                        <div class="text">Every</div>
                        <input id="repeatRelated" name="repeatDuration" type="number" class="smallInput" required min='1' style="width: 60px" <?php if($repeats): ?> value="<?=$reDuration?>" <?php endif?>>
                        <select id="repeatRelated" name="repeatType" class="smallInput" style="height: 55px">
                            <option value="day" <?= ($reType == "day") ? 'selected' : '' ?>>days</option>
                            <option value="week" <?= ($reType == "week") ? 'selected' : '' ?>>weeks</option>
                            <option value="month" <?= ($reType == "month") ? 'selected' : '' ?>>months</option>
                            <option value="year" <?= ($reType == "year") ? 'selected' : '' ?>>years</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="attr">
                    <div class="subtitle">
                        Description:
                    </div>
                    <textarea class="bigInput" id="message" name="description" rows="5" cols="40"><?=$event['description']?></textarea>
            </div>

            <div class="attr" style="border-bottom: none">
                <div class="subtitle">
                    Task or deadline?
                </div>
                <div class="horizontalSect" style="margin-bottom: 10px">
                    <input name="isDeadline" value="t" class="radioButton" type="radio" <?= (!$isDeadline) ? 'checked' : '' ?>>
                    <div class="text" style="margin-left: 10px">
                        Task
                    </div>
                </div>

                <div class="horizontalSect" style="margin-top: 10px">
                    <input name="isDeadline" value="d" class="radioButton" type="radio" <?= ($isDeadline) ? 'checked' : '' ?>>
                    <div class="text" style="margin-left: 10px">
                        Deadline
                    </div>
                </div>
            </div>
        </form>
    </div>

    <Button class="bigButton" type="submit" form="editEventForm">Save</Button>

    <script>
        var id = <?php echo json_encode($id); ?>;
    </script>

    <script src="/js/add.js"></script>

</body>
</html>