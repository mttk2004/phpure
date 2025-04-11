# Bắt đầu với PHPure

Hướng dẫn này sẽ giúp bạn thiết lập và bắt đầu sử dụng PHPure cho việc phát triển ứng dụng web của bạn.

## Yêu cầu hệ thống

Trước khi cài đặt PHPure, hãy đảm bảo môi trường của bạn đáp ứng các yêu cầu sau:

- **PHP**: Phiên bản 8.0 trở lên
- **Composer**: Phiên bản 2.8.4 trở lên
- **npm**: Phiên bản 11.0.0 trở lên

Việc cài đặt đúng các công cụ này sẽ đảm bảo quá trình thiết lập suôn sẻ và trải nghiệm phát triển ổn định.

## Cài đặt

Mở terminal và chạy các lệnh sau:

```bash
composer create-project mttk2004/phpure ten-du-an
cd ten-du-an
```

Các lệnh này tải xuống framework PHPure và đưa bạn vào thư mục dự án mới của bạn.

## Thiết lập dự án

### Cài đặt các gói phụ thuộc

Chạy các lệnh sau để cài đặt tất cả các gói phụ thuộc cần thiết:

```bash
npm install
```

### Cấu hình môi trường

PHPure sử dụng tệp `.env` để lưu trữ các giá trị cấu hình có thể thay đổi giữa các môi trường hoặc chứa thông tin nhạy cảm.

Tạo tệp môi trường của bạn bằng cách sao chép từ mẫu:

```bash
cp .env.example .env
```

Sau đó mở tệp `.env` trong trình soạn thảo của bạn và cập nhật các giá trị cho phù hợp với nhu cầu của bạn.

Dưới đây là ý nghĩa của từng cài đặt trong tệp `.env`:

#### Cài đặt ứng dụng

```env
# APP
APP_NAME=PHPure              # Tên ứng dụng của bạn
APP_ENV=development          # Môi trường: development, production, hoặc testing
APP_TIMEZONE=Asia/Ho_Chi_Minh # Múi giờ của ứng dụng
APP_DEBUG=true               # Bật thông báo lỗi chi tiết (nên đặt false trong môi trường production)
APP_URL=http://localhost:8000 # URL cơ sở của ứng dụng
APP_HOST_PORT=localhost:8000  # Host và cổng cho phát triển cục bộ
```

#### Cài đặt cơ sở dữ liệu

```env
# DATABASE
DB_ADAPTER=mysql            # Loại cơ sở dữ liệu (mysql, sqlite, v.v.)
DB_HOST=127.0.0.1           # Địa chỉ máy chủ cơ sở dữ liệu
DB_PORT=3306                # Cổng máy chủ cơ sở dữ liệu
DB_NAME=my_database         # Tên cơ sở dữ liệu của bạn
DB_USER=root                # Tên người dùng cơ sở dữ liệu
DB_PASS=                    # Mật khẩu cơ sở dữ liệu
DB_CHARSET=utf8mb4          # Bảng mã ký tự cho kết nối cơ sở dữ liệu
```

Hãy nhớ rằng tệp `.env` chứa thông tin nhạy cảm và không bao giờ nên được đưa vào hệ thống quản lý phiên bản. PHPure tự động thêm nó vào `.gitignore` để bảo mật cho bạn.

## Tìm hiểu các tệp cấu hình

PHPure tổ chức cấu hình của nó trong thư mục `/config`. Mỗi tệp xử lý một khía cạnh cụ thể của framework:

### app.php

Chứa các cài đặt cốt lõi của ứng dụng:

- Tên ứng dụng
- Môi trường (development, production, testing)
- Chế độ debug
- Cài đặt múi giờ
- Bảng mã ký tự

Các giá trị này thường được lấy từ tệp `.env` của bạn với các giá trị mặc định hợp lý.

### database.php

Quản lý kết nối cơ sở dữ liệu:

- Loại kết nối mặc định
- Tham số kết nối cho các hệ thống cơ sở dữ liệu khác nhau
- Hỗ trợ nhiều cấu hình kết nối

Tệp này đọc từ cài đặt `.env` của bạn nhưng có thể được tùy chỉnh cho các thiết lập phức tạp.

### paths.php

Xác định đường dẫn thư mục cho:

- Mã ứng dụng
- Tài nguyên công khai
- Kho lưu trữ (cache, logs, uploads)
- Tài nguyên (views, CSS, JavaScript)
- Tệp cơ sở dữ liệu (migrations, seeds)

Các đường dẫn này giúp PHPure tự động định vị các tệp quan trọng.

### cache.php

Điều khiển hệ thống cache:

- Thời lượng cache mặc định
- Vị trí lưu trữ cache
- Cài đặt dọn dẹp cache

Cache đúng cách cải thiện hiệu suất ứng dụng của bạn.

### storage.php

Quản lý lưu trữ tệp:

- Thư mục tải lên
- Quyền tệp tin
- Phần mở rộng tệp được phép
- Kích thước tệp tối đa

Điều này giúp bảo mật việc tải lên tệp trong ứng dụng của bạn.

### phinx.php

Cấu hình công cụ migration cơ sở dữ liệu Phinx:

- Vị trí tệp migration và seed
- Kết nối cơ sở dữ liệu theo môi trường cụ thể

Bạn thường không cần chỉnh sửa tệp này trực tiếp vì nó đọc từ cài đặt database.php và .env của bạn.

## Thiết lập cơ sở dữ liệu với Phinx

PHPure sử dụng Phinx cho việc migration cơ sở dữ liệu. Sau khi cấu hình kết nối cơ sở dữ liệu trong `.env`, bạn có thể sử dụng các lệnh script Composer sau:

1. Tạo migration:

   ```bash
   composer migrate:create TenMigrationCuaBan
   ```

2. Chạy migrations:

   ```bash
   composer migrate
   ```

3. Kiểm tra trạng thái migration:

   ```bash
   composer migrate:status
   ```

4. Hoàn tác migrations:

   ```bash
   composer migrate:rollback
   ```

5. Tạo tệp seed:

   ```bash
   composer seed:create TenSeederCuaBan
   ```

6. Chạy các tệp seed:
   ```bash
   composer seed
   ```

Những lệnh tiện lợi này là các phím tắt cho công cụ CLI Phinx, giúp việc quản lý cơ sở dữ liệu dễ dàng hơn.

## Khởi động ứng dụng

Khi cấu hình hoàn tất, bạn có thể khởi động môi trường phát triển:

```bash
# Khởi động máy chủ phát triển Vite cho tài nguyên frontend
npm run dev

# Khởi động máy chủ phát triển PHP
npm run serve

# Hoặc, khởi động cả hai máy chủ cùng lúc
npm run dev:all
```

Sau đó truy cập http://localhost:8000 trong trình duyệt của bạn để xem ứng dụng PHPure mới của bạn.

## Định dạng mã nguồn

PHPure bao gồm PHP-CS-Fixer để duy trì phong cách mã nguồn nhất quán. Bạn có thể sử dụng các lệnh sau:

```bash
# Định dạng tất cả các tệp PHP
composer format

# Kiểm tra vấn đề về phong cách mã nguồn mà không sửa chữa
composer format-check
```

## Các bước tiếp theo

Bây giờ khi bạn đã cài đặt và chạy PHPure, bạn đã sẵn sàng để bắt đầu xây dựng ứng dụng web của mình! Hãy kiểm tra các phần tài liệu khác để tìm hiểu về:

- Các khái niệm cốt lõi
- Xây dựng ứng dụng
- Cấu trúc thư mục
- Kỹ thuật nâng cao

Chúc bạn lập trình vui vẻ với PHPure! 🚀
