function showInput(){  
    let radio_teacher = document.getElementById('teacher-radio');
    let radio_user = document.getElementById('user-radio');
    let div = document.getElementById('hidden-div');
    let form = document.getElementById('teacher-form');
    if (radio_user.checked) {
        div.style.display = 'none';
    }
    if (radio_teacher.checked) {
        div.style.display = 'block';
    }
}
