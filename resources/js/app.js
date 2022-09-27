import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

function countUp() {
    var element = document.getElementById('incrementText');
    var value = element.innerHTML;

    ++value;

    console.log(value);
    document.getElementById('incrementText').innerHTML = value;
}
