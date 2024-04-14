function validateForm() {
    var isValid = true;

    var password = document.getElementById('password').value;
    var passwordError = document.getElementById('passwordError');
    
    var check_password = document.getElementById('check_password').value;
    var check_passwordError = document.getElementById('check_passwordError');

    var name = document.getElementById('name').value;
    var nameError = document.getElementById('nameError');

    var id = document.getElementById('id').value;
    var idError = document.getElementById('idError');

    var email = document.getElementById('email').value;
    var emailError = document.getElementById('emailError');
    var emailInput = document.getElementById('email').value; // フォームの入力値
    var domainPattern = /^[^\s@]+\.[^\s@]+$/; // ドメイン名を入力しなさい
    var emailPattern = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/; // RFC 5322 準拠の正規表現

    var tel = document.getElementById('tel').value;
    var telError = document.getElementById('telError');
    var telPattern = /^\d{10,11}$/;

    if (name.trim() !== '') {
        if (name.length > 20) {
            nameError.textContent = '氏名は20文字以内で入力してください';
            nameError.classList.add('error-message');
            isValid = false;
        } else {
            nameError.textContent = '';
            nameError.classList.remove('error-message');
        }
    }

    if (id.trim() !== '') {
        if (!/^[a-zA-Z0-9]+$/.test(id)) {
            idError.textContent = '会員IDは英数字で入力してください';
            idError.classList.add('error-message');
            isValid = false;
        } else {
            idError.textContent = '';
            idError.classList.remove('error-message');
        }
    } else {
        idError.textContent = '会員IDを入力してください';
        idError.classList.add('error-message');
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

    if (password.trim() !== '') {
        if (password.length < 8) {
            passwordError.textContent = 'パスワードは8文字以上である必要があります';
            passwordError.classList.add('error-message');
            isValid = false;
        } else if (password.length > 20) {
            passwordError.textContent = 'パスワードは20文字以内で入力してください';
            passwordError.classList.add('error-message');
            isValid = false;
        } else if (!/[a-z]/.test(password)) {
            passwordError.textContent = 'パスワードは小文字を含んでいる必要があります';
            passwordError.classList.add('error-message');
            isValid = false;
        } else if (!/[A-Z]/.test(password)) {
            passwordError.textContent = 'パスワードは大文字を含んでいる必要があります';
            passwordError.classList.add('error-message');
            isValid = false;
        } else if (!/\d/.test(password)) {
            passwordError.textContent = 'パスワードは数字を含んでいる必要があります';
            passwordError.classList.add('error-message');
            isValid = false;
        } else if (!/^[a-zA-Z0-9!@#$%^&*(),.?":{}|<>]+$/.test(password)) {
            passwordError.textContent = '文字、数字、一般的な句読点のみを使用してください';
            passwordError.classList.add('error-message');
            isValid = false;
        } else {
            passwordError.textContent = '';
            passwordError.classList.remove('error-message');
        }
    } else {
        passwordError.textContent = 'パスワードを入力してください';
        passwordError.classList.add('error-message');
        isValid = false;
    }

    if (check_password.trim() !== '') {
        if (check_password !== password) {
            check_passwordError.textContent = '確認用パスワードが一致しません';
            check_passwordError.classList.add('error-message');
            isValid = false;
        } else {
            check_passwordError.textContent = '';
            check_passwordError.classList.remove('error-message');
        }
    } else {
        check_passwordError.textContent = '確認用パスワードを入力してください';
        check_passwordError.classList.add('error-message');
        isValid = false;
    }

    if (tel.trim() !== '') {
        if (!telPattern.test(tel)) {
            telError.textContent = '有効な電話番号を入力してください';
            telError.classList.add('error-message');
            isValid = false;
        } else {
            telError.textContent = '';
            telError.classList.remove('error-message');
        }
    } else {
        telError.textContent = '';
        telError.classList.remove('error-message');
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

