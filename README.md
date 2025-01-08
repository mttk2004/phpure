# phpure 🚀

Một framework MVC đơn giản được viết bằng PHP để giúp người mới học và khám phá cách hoạt động bên trong của một ứng dụng web theo mô hình MVC. Framework này được xây dựng từng bước để dễ dàng mở rộng và bảo trì.  

---

## **1. Cài đặt** 📥  

### **Yêu cầu hệ thống:**
- **PHP >= 7.4**  
- **Composer** (nếu thêm thư viện sau này).  

### **Hướng dẫn cài đặt:**
1. **Clone repository**:
   ```bash
   git clone https://github.com/username/my-php-mvc-framework.git
   cd my-php-mvc-framework
   ```

2. **Chạy server PHP tích hợp:**
   ```bash
   php -S localhost:8000 -t public/
   ```

3. **Truy cập trình duyệt:**
   ```
   http://localhost:8000/
   ```

---

## **2. Cấu trúc thư mục** 📂

```plaintext
my-framework/
├── app/
│   ├── Controllers/      # Xử lý logic yêu cầu từ người dùng
│   ├── Middleware/       # Xử lý quyền truy cập và xác thực
│   ├── Models/           # Tương tác với cơ sở dữ liệu
│   ├── Views/            # Hiển thị giao diện người dùng
├── core/
│   ├── Http/
│   │   ├── Middleware.php # Quản lý middleware
│   │   ├── Router.php     # Xử lý định tuyến
│   │   ├── Request.php    # Quản lý request HTTP
│   │   ├── Response.php   # Quản lý response HTTP
│   ├── App.php           # Quản lý ứng dụng
│   ├── Controller.php    # Base controller để render view
│   ├── Session.php       # Quản lý phiên (Session)
├── utils/
│   ├── helpers.php       # Các hàm tiện ích (Helper functions)
├── public/
│   ├── index.php         # Điểm vào chính của ứng dụng
├── .htaccess             # Chuyển hướng tất cả request đến index.php
├── composer.json         # File cấu hình Composer (tùy chọn)
├── README.md             # Hướng dẫn sử dụng framework
```

---

## **3. Cách sử dụng** 🛠️

### **Thêm Route mới**
- Mở file **`core/App.php`**.
- Thêm route mới sử dụng Router:

```php
use Core\Router;

$router->get('about', ['HomeController', 'about']);
$router->post('users/store', ['UserController', 'store'])->middleware('auth');
```

### **Tạo Controller mới**
1. Tạo file mới trong thư mục **app/Controllers/**.
2. Ví dụ: **`UserController.php`**

```php
<?php

namespace App\Controllers;

use Core\Controller;

class UserController extends Controller
{
    public function index()
    {
        $this->render('user/index', ['message' => 'Hello World!']);
    }
}
```

3. Tạo View trong **app/Views/user/index.php**:

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Page</title>
</head>
<body>
    <h1><?= $message ?></h1>
</body>
</html>
```

---

## **4. Luồng hoạt động** 🔄

1. Người dùng truy cập vào URL, ví dụ:
   ```
   http://localhost:8000/users/store
   ```
2. **Router** sẽ khớp URL với một **Controller** và **Action** đã định nghĩa.
3. **Middleware** sẽ kiểm tra quyền truy cập (nếu có).
4. Nếu pass middleware, Controller được gọi để xử lý dữ liệu và render view.

---

## **5. Gợi ý mở rộng** 🌟

- **Thêm Middleware mới:**
    - Tạo class trong `app/Middleware/`.
    - Đăng ký middleware trong `core/Middleware.php`.

- **Thêm Model mới:**
    - Tạo class trong `app/Models/` để tương tác với cơ sở dữ liệu.

- **Validation dữ liệu đầu vào:**
    - Tạo Helper hoặc Middleware để kiểm tra dữ liệu người dùng gửi lên.

- **Bảo vệ CSRF:**
    - Sử dụng Session để lưu token và kiểm tra trước khi xử lý form.

---

## **6. Đóng góp** 🤝

Nếu bạn muốn đóng góp hoặc cải thiện framework này, hãy tạo một pull request hoặc mở issue trên GitHub.

---

## **7. Giấy phép** 📜

Framework này được phát hành dưới giấy phép **MIT**. Bạn có thể tự do sử dụng, chỉnh sửa và phân phối.

---

## **8. Tác giả** 🧑‍💻

[Mai Trần Tuấn Kiệt](https://github.com/mttk2004)

---

_Last updated: 2025_
