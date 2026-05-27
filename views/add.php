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
                New Event
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

        <form id="createEventForm" method="POST">

            <div class="attr">
                <div class="horizontalSect">
                <div class="subtitle">
                    Name:
                </div>
                <input name="name" type="text" class="input" required>
                </div>
            </div>

            <div class="attr">
                <div class="horizontalSect">
                    <div class="subtitle">When?</div>
                    <div class="selectWrapper">
                        <select id="monthSelect" name="month" class="smallInput" style="height: 55px; width:140px" required>
                            <option value="1">January</option>
                            <option value="2">February</option>
                            <option value="3">March</option>
                            <option value="4">April</option>
                            <option value="5">May</option>
                            <option value="6">June</option>
                            <option value="7">July</option>
                            <option value="8">August</option>
                            <option value="9">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                    </div>
                    <input id="daySelect" name="day" type="number" class="smallInput" required min='1' max='31'>
                    <div class="selectWrapper">
                        <select id="yearSelect" name="year" class="smallInput" style="height: 55px; width:140px">
                            <?php foreach ($nextYears as $year):?>
                                <option value="<?= $year ?>"><?= $year?></option>
                            <?php endforeach?>
                        </select>
                    </div>
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
                        <input id="repeatRelated" name="repeatDuration" type="number" class="smallInput" required min='1' style="width: 60px">
                        <div class="selectWrapper">
                            <select id="repeatRelated" name="repeatType" class="smallInput" style="height: 55px; width:140px">
                                <option value="day">days</option>
                                <option value="week">weeks</option>
                                <option value="month">months</option>
                                <option value="year">years</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="attr">
                    <div class="subtitle">
                        Description:
                    </div>
                    <textarea class="bigInput" name="description" rows="5" cols="40"></textarea>
            </div>

            <div class="attr" style="border-bottom: none">
                <div class="subtitle">
                    Task or deadline?
                </div>
                <div class="horizontalSect" style="margin-bottom: 10px">
                    <input name="isDeadline" value="t" class="radioButton" type="radio" checked>
                    <div class="text" style="margin-left: 10px">
                        Task
                    </div>
                </div>

                <div class="horizontalSect" style="margin-top: 10px">
                    <input name="isDeadline" value="d" class="radioButton" type="radio">
                    <div class="text" style="margin-left: 10px">
                        Deadline
                    </div>
                </div>
            </div>
        </form>
    </div>

    <Button class="bigButton" type="submit" form="createEventForm">Create</Button>

    <script src="/js/add.js"></script>

</body>
</html>