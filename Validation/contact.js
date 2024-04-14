function validateForm() {
    var isValid = true;

    var name = document.getElementById('name').value;
    var nameError = document.getElementById('nameError');

    var email = document.getElementById('email').value;
    var emailError = document.getElementById('emailError');
    var emailInput = document.getElementById('email').value; // フォームの入力値
    var domainPattern = /^[^\s@]+\.[^\s@]+$/; // ドメイン名を入力しなさい
    var emailPattern = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/; // RFC 5322 準拠の正規表現

    var title = document.getElementById('title').value;
    var titleError = document.getElementById('titleError');

    var contact_body = document.getElementById('contact_body').value;
    var contact_bodyError = document.getElementById('contact_bodyError');

    if (name.trim() !== '') {
        nameError.textContent = ''; 
    } else {
        nameError.textContent = '氏名を入力してください';
        nameError.classList.add('error-message');
        isValid = false;
    }
    if (email.trim() !== '') {
        if (!email.includes('@')) {
            emailError.textContent = '「@」マークを忘れずに入力してください';
            emailError.classList.add('error-message');
            isValid = false;
        } else if (!domainPattern.test(email.split('@')[1])) {
            emailError.textContent = '@の後ろにドメイン名を入力してください';
            emailError.classList.add('error-message');
            isValid = false;
        } else if (!emailPattern.test(email)) {
                emailError.textContent = '有効なメールアドレスを入力してください';
                emailError.classList.add('error-message');
                isValid = false;
        } else {
            emailError.textContent = '';
            emailError.classList.remove('error-message');
        }
    } else {
        emailError.textContent = 'メールアドレスを入力してください';
        emailError.classList.add('error-message');
        isValid = false;
    }
    if (title.trim() !== '') {
        titleError.textContent = ''; 
    } else {
        titleError.textContent = '題名を入力してください';
        titleError.classList.add('error-message');
        isValid = false;
    }
    if (contact_body.trim() !== '') {
        contact_bodyError.textContent = ''; 
    } else {
        contact_bodyError.textContent = '内容を入力してください';
        contact_bodyError.classList.add('error-message');
        isValid = false;
    }

    return isValid;
}