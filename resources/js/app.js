import Alpine from 'alpinejs';
import Swal from 'sweetalert2';
import '../css/input.css';

window.Alpine = Alpine;
Alpine.start();

// Thêm hàm toàn cục để sử dụng SweetAlert2
window.showAlert = (title, text, icon = 'success') => {
	Swal.fire({
		title,
		text,
		icon,
		confirmButtonText: 'OK',
	});
};
