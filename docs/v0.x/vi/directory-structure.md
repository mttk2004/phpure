# Cấu Trúc Thư Mục

Cấu trúc thư mục của **PHPure** được thiết kế với sự rõ ràng và mục đích cụ thể. Nó tuân theo mô hình MVC (Model-View-Controller) để giúp phân tách các thành phần trong ứng dụng của bạn, làm cho nó dễ hiểu, dễ bảo trì và dễ mở rộng khi dự án phát triển.

## Tổng Quan

Dưới đây là cái nhìn tổng thể về cấu trúc thư mục của PHPure:

```plaintext
phpure/
├── app/                        # Mã nguồn ứng dụng
│   ├── Controllers/            # Các lớp Controller xử lý logic ứng dụng
│   ├── Listeners/              # Các lớp lắng nghe sự kiện
│   ├── Middlewares/            # Các lớp middleware xử lý request HTTP
│   ├── Models/                 # Các lớp Model tương tác với cơ sở dữ liệu (nếu có)
│   ├── events.php              # Đăng ký và cấu hình sự kiện
│   ├── routes.php              # Định nghĩa các route của ứng dụng
├── config/                     # Các tệp cấu hình
│   ├── app.php                 # Cài đặt ứng dụng chính
│   ├── cache.php               # Cấu hình bộ nhớ đệm
│   ├── database.php            # Cài đặt kết nối cơ sở dữ liệu
│   ├── paths.php               # Định nghĩa đường dẫn ứng dụng
│   ├── phinx.php               # Cấu hình migration cơ sở dữ liệu
│   ├── storage.php             # Cài đặt lưu trữ tệp
├── core/                       # Các thành phần cốt lõi của framework
│   ├── Http/
│   │   ├── Middleware.php      # Quản lý middleware
│   │   ├── Request.php         # Xử lý request HTTP
│   │   ├── Response.php        # Tạo response HTTP
│   │   ├── ResponseCode.php    # Định nghĩa mã trạng thái HTTP
│   │   ├── Router.php          # Ánh xạ URL đến controller
│   ├── App.php                 # Khởi động ứng dụng
│   ├── Cache.php               # Quản lý bộ nhớ đệm
│   ├── Controller.php          # Lớp controller cơ sở
│   ├── Database.php            # Kết nối cơ sở dữ liệu và tạo truy vấn
│   ├── Event.php               # Hệ thống quản lý sự kiện
│   ├── ExceptionHandler.php    # Xử lý lỗi và ngoại lệ
│   ├── Form.php                # Tiện ích xử lý biểu mẫu
│   ├── Logger.php              # Ghi log ứng dụng
│   ├── Model.php               # Model cơ sở với chức năng ORM
│   ├── Pagination.php          # Hỗ trợ phân trang dữ liệu
│   ├── Session.php             # Quản lý phiên làm việc
│   ├── Storage.php             # Hệ thống lưu trữ tệp
│   ├── Twig.php                # Tích hợp công cụ template
│   ├── Validation.php          # Tiện ích xác thực dữ liệu
├── database/                   # Các tệp liên quan đến cơ sở dữ liệu
│   ├── migrations/             # Các tệp migration cơ sở dữ liệu
│   ├── seeds/                  # Các tệp seed dữ liệu mẫu
├── public/                     # Tệp truy cập web
│   ├── assets/                 # Tài nguyên biên dịch (CSS, JS, hình ảnh)
│   ├── index.php               # Điểm vào ứng dụng
│   ├── .htaccess               # Quy tắc viết lại URL
├── resources/                  # Tệp tài nguyên thô
│   ├── css/                    # Tệp nguồn CSS
│   ├── js/                     # Tệp nguồn JavaScript
│   ├── views/                  # Các template Twig
├── storage/                    # Lưu trữ ứng dụng
│   ├── cache/                  # Tệp bộ nhớ đệm
│   ├── logs/                   # Tệp log
│   ├── uploads/                # Tệp người dùng tải lên (nếu được cấu hình)
├── utils/                      # Hàm tiện ích
│   ├── helpers.php             # Các hàm helper toàn cục
├── .env                        # Biến môi trường
├── .env.example                # Ví dụ cấu hình môi trường
├── .gitignore                  # Tệp và thư mục bị bỏ qua bởi Git
├── composer.json               # Phụ thuộc PHP và metadata dự án
├── package.json                # Phụ thuộc frontend và scripts
├── phinx.php                   # Cấu hình Phinx gốc (chuyển hướng đến config/phinx.php)
├── postcss.config.js           # Cấu hình PostCSS
├── tailwind.config.js          # Cấu hình Tailwind CSS
├── vite.config.js              # Cấu hình công cụ build Vite
```

## Giải Thích Các Thư Mục Chính

### Thư Mục App

Thư mục `app/` là nơi chứa hầu hết mã nguồn tùy chỉnh của ứng dụng. Đây là nơi bạn sẽ dành phần lớn thời gian phát triển:

- **Controllers/**: Chứa các lớp xử lý request HTTP và điều khiển luồng ứng dụng. Mỗi controller thường nhóm các chức năng liên quan, như `UserController` cho các hoạt động liên quan đến người dùng.

- **Listeners/**: Chứa các lớp lắng nghe sự kiện được kích hoạt trong ứng dụng, cho phép bạn thực thi mã khi các hành động cụ thể xảy ra.

- **Middlewares/**: Chứa các lớp middleware xử lý request HTTP trước khi chúng đến controller. Middleware rất phù hợp cho các tác vụ như xác thực, kiểm tra dữ liệu đầu vào hoặc xử lý CORS.

- **Models/**: Chứa các lớp model tương tác với các bảng trong cơ sở dữ liệu. Model đại diện cho cấu trúc dữ liệu và cung cấp phương thức để thao tác với dữ liệu đó.

- **events.php**: Tệp cấu hình nơi bạn đăng ký các listener sự kiện với hệ thống sự kiện.

- **routes.php**: Định nghĩa tất cả các route URL của ứng dụng, ánh xạ chúng đến các hành động controller cụ thể.

### Thư Mục Config

Thư mục `config/` chứa các tệp cấu hình xác định cách ứng dụng của bạn hoạt động:

- **app.php**: Cài đặt ứng dụng cốt lõi như tên ứng dụng, môi trường, tùy chọn gỡ lỗi và nhiều hơn nữa.

- **cache.php**: Cấu hình cho hệ thống bộ nhớ đệm, bao gồm driver nào sử dụng và cài đặt thời gian tồn tại của bộ nhớ đệm.

- **database.php**: Tham số kết nối cơ sở dữ liệu bao gồm máy chủ, tên cơ sở dữ liệu, tên người dùng, mật khẩu và các tùy chọn kết nối.

- **paths.php**: Định nghĩa các đường dẫn tệp quan trọng được sử dụng trong toàn bộ ứng dụng để đảm bảo tính nhất quán.

- **phinx.php**: Cấu hình cho công cụ migration cơ sở dữ liệu Phinx, xác định cách thực hiện migration.

- **storage.php**: Cài đặt cho hệ thống lưu trữ tệp, bao gồm đường dẫn và quyền truy cập.

### Thư Mục Core

Thư mục `core/` chứa bản thân framework PHPure. Mặc dù bạn thường không sẽ sửa đổi các tệp này, việc hiểu chúng giúp bạn sử dụng framework hiệu quả:

- **Http/**: Chứa các lớp xử lý HTTP:

  - **Middleware.php**: Quản lý hàng đợi và thực thi middleware.
  - **Request.php**: Xử lý dữ liệu request HTTP đến.
  - **Response.php**: Tạo và gửi response HTTP.
  - **ResponseCode.php**: Định nghĩa mã trạng thái HTTP tiêu chuẩn.
  - **Router.php**: Khớp URL với các hành động controller.

- **App.php**: Lớp chính khởi động ứng dụng.

- **Cache.php**: Cung cấp phương thức để lưu trữ và truy xuất dữ liệu đã lưu trong bộ nhớ đệm.

- **Controller.php**: Lớp controller cơ sở mà các controller của bạn kế thừa từ đó.

- **Database.php**: Chức năng kết nối cơ sở dữ liệu và tạo truy vấn.

- **Event.php**: Hệ thống phân phối và xử lý sự kiện.

- **Model.php**: Lớp model cơ sở với khả năng ORM (Object-Relational Mapping).

- **Session.php**: Quản lý phiên người dùng một cách an toàn.

- **Validation.php**: Cung cấp phương thức để xác thực dữ liệu đầu vào.

### Thư Mục Public

Thư mục `public/` là thư mục duy nhất nên được truy cập qua web. Nó đóng vai trò là thư mục gốc cho máy chủ web của bạn:

- **assets/**: Chứa tài nguyên đã được biên dịch và tối ưu hóa sẵn sàng cho sản phẩm.

- **index.php**: Điểm vào cho tất cả các request HTTP đến ứng dụng của bạn.

- **.htaccess**: Chứa các quy tắc cho Apache để bật URL sạch (viết lại URL).

### Thư Mục Resources

Thư mục `resources/` chứa tài nguyên thô, chưa biên dịch sẽ được xử lý:

- **css/**: Tệp nguồn CSS, có thể sử dụng Tailwind CSS.

- **js/**: Tệp nguồn JavaScript sẽ được xử lý bởi Vite.

- **views/**: Tệp template Twig định nghĩa cấu trúc HTML của ứng dụng.

### Thư Mục Storage

Thư mục `storage/` chứa các tệp được tạo bởi ứng dụng của bạn:

- **cache/**: Lưu trữ bộ nhớ đệm dựa trên tệp.

- **logs/**: Tệp log ứng dụng để gỡ lỗi và giám sát.

- **uploads/**: Nơi lưu trữ các tệp do người dùng tải lên (nếu bạn cấu hình tính năng này).

### Các Tệp Quan Trọng Khác

- **.env**: Chứa các biến cấu hình đặc thù cho môi trường như thông tin đăng nhập cơ sở dữ liệu và khóa API. Tệp này không nên được commit vào hệ thống quản lý phiên bản.

- **composer.json**: Định nghĩa phụ thuộc PHP, cài đặt autoloading và scripts.

- **package.json**: Định nghĩa phụ thuộc JavaScript và script build cho frontend.

- **tailwind.config.js**: Cấu hình cho Tailwind CSS, nếu bạn đang sử dụng nó cho styling.

- **vite.config.js**: Cấu hình cho Vite, công cụ build và tối ưu hóa tài nguyên frontend.

## Các Thực Hành Tốt Nhất

Khi làm việc với cấu trúc thư mục của PHPure, hãy ghi nhớ những thực hành này:

1. **Giữ Controller Gọn Nhẹ**: Controller nên điều phối giữa model và view, không chứa logic nghiệp vụ phức tạp.

2. **Sử Dụng Model Cho Logic Nghiệp Vụ**: Đặt thao tác dữ liệu và quy tắc nghiệp vụ trong model của bạn.

3. **Không Sửa Đổi Các Tệp Core**: Thay vì thay đổi các tệp core, hãy mở rộng chức năng thông qua các lớp của riêng bạn.

4. **Tổ Chức Route Một Cách Hợp Lý**: Nhóm các route liên quan trong tệp routes.php của bạn.

5. **Sử Dụng Biến Môi Trường**: Đặt cấu hình nhạy cảm hoặc đặc thù cho môi trường trong tệp .env của bạn.

Bằng cách hiểu và tuân theo cấu trúc thư mục của PHPure, bạn có thể phát triển ứng dụng hiệu quả hơn và bảo trì chúng dễ dàng hơn theo thời gian.
