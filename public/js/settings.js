function showForm(div){
    let form = div.getElementsByTagName('form')[0];   
    let link = div.getElementsByClassName('settings-link')[0];
        if (form.style.display == 'block') {
            form.style.display = 'none';
            link.innerHTML = 'Изменить';
        }
        else {
            form.style.display = 'block';
            link.innerHTML = 'Закрыть';
        }
}


