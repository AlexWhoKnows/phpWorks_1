'use strict';
window.addEventListener('load', function(){
    document.querySelector('.form-check').addEventListener('click', function () {
        if (document.querySelector('#viet').checked) {
            document.querySelector('.dop').removeAttribute('hidden');
        } else {
            document.querySelector('.dop').setAttribute('hidden', 'hidden');
        }
    })

})