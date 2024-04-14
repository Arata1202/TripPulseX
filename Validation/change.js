function validateForm() {
    var isValid = true;

    var password = document.getElementById('password').value;
    var passwordError = document.getElementById('passwordError');
    
    var check_password = document.getElementById('check_password').value;
    var check_passwordError = document.getElementById('check_passwordError');

    var name = document.getElementById('name').value;
    var nameError = document.getElementById('nameError');

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

