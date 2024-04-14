function validateForm() {
    var isValid = true;

    var password = document.getElementById('password').value;
    var passwordError = document.getElementById('passwordError');

    var email = document.getElementById('email').value;
    var emailError = document.getElementById('emailError');
    var domainPattern = /^[^\s@]+\.[^\s@]+$/; // ドメイン名を入力しなさい
    var emailPattern = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/; // RFC 5322 準拠の正規表現

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

    if (password.trim() !== '') {
        //
    } else {
        passwordError.textContent = 'パスワードを入力してください';
        passwordError.classList.add('error-message');
        isValid = false;
    }

    return isValid;
}


// ボールスイッチ
function togglePasswordVisibility() {
    var passwordInput = document.getElementById("password");
    var passwordCheckInput = document.getElementById("check_password");
    var toggleSwitch = document.getElementById("toggleSwitch");

    if (toggleSwitch.checked) {
        passwordInput.type = "text";
        passwordCheckInput.type = "text";
    } else {
        passwordInput.type = "password";
        passwordCheckInput.type = "password";
    }
}

