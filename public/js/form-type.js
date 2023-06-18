function switch_form_type(form_type) {
    if (form_type === 'first_year') {
        document.getElementById('first-year-form').classList.add('show');
        document.getElementById('senior-form').classList.remove('show');
    } else {
        document.getElementById('first-year-form').classList.remove('show');
        document.getElementById('senior-form').classList.add('show')
    }
}
