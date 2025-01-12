import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

import { Notyf } from 'notyf';
import 'notyf/notyf.min.css';

const notyf = new Notyf();

// Thêm các hàm toàn cục để sử dụng trong HTML
window.showSuccess = (message) => notyf.success(message);
window.showError = (message) => notyf.error(message);
