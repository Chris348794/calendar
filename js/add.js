//checkbox hide/show
button = document.querySelector(".coolCheckBox")
outline = document.querySelector(".repeatsOutline");

function updateCheckbox(repeats) {
    elements = document.querySelectorAll("#repeatsShow");
    required = document.querySelectorAll('#repeatRelated');

    if (repeats) {
        elements.forEach(x => x.style.display = "block");
        outline.setAttribute('stroke', 'rgb(0, 255, 0)');
        required.forEach(x => x.required = true);
    } else {
        elements.forEach(x => x.style.display = "none");
        outline.setAttribute('stroke', 'rgb(255, 255, 255)');
        required.forEach(x => x.required = false);
    }
    button.setAttribute('data', repeats)
}

let repeats = JSON.parse(button.getAttribute('data'));
updateCheckbox(repeats);

outline.addEventListener('click', function() {
    let repeats = JSON.parse(button.getAttribute('data'));
    repeats = !repeats;
    updateCheckbox(repeats);
});

//add checkbox state to submission

function addEvent(f) {
    let repeats = button.getAttribute('data');
    f.action = `/createevent.php?repeats=${encodeURIComponent(repeats)}`;
}


editForm = document.getElementById('editEventForm');
if (editForm) {
    editForm.addEventListener('submit', function() {
        let repeats = button.getAttribute('data');
        editForm.action = `/editevent.php?repeats=${encodeURIComponent(repeats)}&id=${id}`;
    });
}

createForm = document.getElementById('createEventForm');
if (createForm) {
    createForm.addEventListener('submit', function() {
        addEvent(createForm);
    });
}

//date restrictions
day = document.getElementById('daySelect');
month = document.getElementById('monthSelect');
year = document.getElementById('yearSelect');
function updateRestriction() {
    console.log("test");
    lastDay = new Date(year.value, month.value, 0).getDate();
    day.max = lastDay;
    day.placeholder = `Must be between 1 and ${lastDay}`;
  }
  month.addEventListener('change', updateRestriction);
  year.addEventListener('change', updateRestriction);