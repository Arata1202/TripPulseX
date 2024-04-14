function validateForm() {
    var isValid = true;

    var comment = document.getElementById('comment').value;
    var commentError = document.getElementById('commentError');

    if (comment.trim() !== '') {
        commentError.textContent = ''; 
    } else {
        commentError.textContent = 'コメントを入力してください';
        commentError.classList.add('error-message');
        isValid = false;
    }

    return isValid;
}
