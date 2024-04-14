function validateForm() {
    var isValid = true;

    var prefecture = document.getElementById('prefecture').value;
    var prefectureError = document.getElementById('prefectureError');
    
    var spot = document.getElementById('spot').value;
    var spotError = document.getElementById('spotError');

    var contents = document.getElementById('contents').value;
    var contentsError = document.getElementById('contentsError');

    var upload_image = document.getElementById('upload_image').value;
    var upload_imageError = document.getElementById('upload_imageError');

    if (prefecture.trim() !== '') {
        prefectureError.textContent = ''; 
    } else {
        prefectureError.textContent = '都道府県名を入力してください';
        prefectureError.classList.add('error-message');
        isValid = false;
    }
    if (spot.trim() !== '') {
        spotError.textContent = ''; 
    } else {
        spotError.textContent = '観光名称を入力してください';
        spotError.classList.add('error-message');
        isValid = false;
    }
    if (contents.trim() !== '') {
        contentsError.textContent = ''; 
    } else {
        contentsError.textContent = 'コメントを入力してください';
        contentsError.classList.add('error-message');
        isValid = false;
    }
    if (upload_image.trim() !== '') {
        upload_imageError.textContent = '';
    } else {
        upload_imageError.textContent = '写真を選択してください';
        upload_imageError.classList.add('error-message');
        isValid = false;
    }

    return isValid;
}
