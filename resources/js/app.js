import Alpine from 'alpinejs';
import Swal from 'sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

window.Alpine = Alpine;
window.Swal = Swal;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    const flash = window.ayiiFlash;

    if (!flash?.success) {
        return;
    }

    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: flash.success,
        confirmButtonColor: '#f97316',
        timer: 3000,
        timerProgressBar: true,
    });
});
