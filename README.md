# phpure

phpure là một framework MVC đơn giản được viết bằng PHP để giúp người mới học và khám phá cách hoạt
động bên trong của một ứng dụng web theo mô hình MVC.

---

## **Gặp Gỡ phpure** 🌟

Ngoài kia có rất nhiều framework PHP mạnh mẽ như Laravel, Symfony, CodeIgniter, Zend, Yii, và
nhiều framework khác nữa. Những công cụ này cung cấp vô số tính năng hữu ích, giúp việc phát triển
ứng dụng web trở nên nhanh chóng và thuận tiện hơn. Tuy nhiên, đối với người mới học PHP, việc tiếp
cận các framework lớn đôi khi có thể gây khó khăn và làm giảm hứng thú. Tôi từng rơi vào tình huống
này khi mới làm quen với [Laravel](https://laravel.com). Với một người mới như tôi, Laravel thật
phức tạp và đầy rẫy những "phép thuật" khó hiểu.

Đầu năm 2025, tôi bước vào học kỳ mới với nhiều môn học thú vị, trong đó có môn Lập trình Web và Ứng
dụng nâng cao. Một trong những yêu cầu của môn học là xây dựng ứng dụng web PHP thuần túy (Pure PHP)
theo mô hình MVC mà không sử dụng bất kỳ framework lớn nào như Laravel. Mục đích là để hiểu rõ cách
các thành phần hoạt động từ gốc rễ. Nhận ra cơ hội này, tôi đã quyết định tạo ra `phpure` — một
framework PHP đơn giản nhưng đủ mạnh mẽ để giúp những người mới bắt đầu dễ dàng nắm bắt cách xây
dựng một ứng dụng web theo mô hình MVC. Tôi là [Mai Trần Tuấn Kiệt](https://github.com/mttk2004),
một sinh viên IT chuyên ngành Phát triển Web và là người sáng lập `phpure`. Đây là dự án mã nguồn mở
đầu tiên của tôi, và tôi rất vui được chia sẻ nó với bạn.

Tôi muốn gọi `phpure` là "framework dành cho người mới bắt đầu" vì nó được thiết kế đơn giản,
gọn nhẹ, dễ hiểu và dễ sử dụng. Nếu bạn đang tìm hiểu PHP hoặc muốn hiểu rõ cách hoạt động của một
ứng dụng web theo mô hình MVC, hãy thử trải nghiệm `phpure` để cảm nhận sự khác biệt. Điều thú vị
là, nếu bạn có ý định học Laravel sau này, việc nắm vững cách vận hành của `phpure` sẽ giúp bạn rất
nhiều, `phpure` được xây dựng với cấu trúc tương tự Laravel nhưng đơn giản và tinh gọn hơn. Là một
fan cuồng nhiệt của Laravel, tôi đã cố gắng mang những yếu tố "tinh tế" của framework này
vào `phpure`.

`phpure` không chỉ phù hợp để xây dựng các ứng dụng web đơn giản mà còn có thể mở rộng và tùy chỉnh
theo ý muốn bằng cách thêm các tính năng mới. Tôi tin rằng, nếu bạn đang chuẩn bị bắt đầu học mô
hình MVC với PHP, `phpure` sẽ là người bạn đồng hành đáng tin cậy.

Hãy cùng khám phá `phpure` và tạo ra những ứng dụng web tuyệt vời!

---

## **Bắt Đầu** 🚀

### **1. Cài Đặt** 📥

#### **Yêu cầu hệ thống**

Để cài đặt và sử dụng `phpure`, bạn cần đảm bảo môi trường của mình đáp ứng các yêu cầu sau:

- **PHP**: Phiên bản từ 8.0 trở lên.
- **Composer**: Phiên bản từ 2.8.4 trở lên.
- **npm**: Phiên bản từ 11.0.0 trở lên.

#### **Các bước cài đặt**

Đầu tiên, mở terminal hoặc command prompt, sau đó chạy các lệnh dưới đây:

   ```bash
   git clone https://github.com/mttk2004/phpure.git
   cd phpure
   ```  

- **`git clone`**: Tải mã nguồn `phpure` từ GitHub về máy của bạn.
- **`cd phpure`**: Di chuyển vào thư mục vừa tải về.

Giờ đây, bạn đã sẵn sàng để thực hiện các bước tiếp theo như cài đặt các phụ thuộc và thiết lập dự
án.

### **2. Cấu hình** ⚙️

Để bắt đầu sử dụng `phpure`, bạn cần thực hiện một số bước thiết đặt cơ bản sau khi tải mã nguồn về.

---

#### **Cài đặt các gói Composer và npm**

Đầu tiên, bạn cần cài đặt các gói phụ thuộc cần thiết. Sử dụng lệnh sau trong terminal để Composer
cài đặt các gói PHP và npm cài đặt các gói front-end:

```bash
composer install
npm install
```

Composer sẽ tải về các thư viện cần thiết để dự án hoạt động, trong khi npm sẽ chuẩn bị các tài
nguyên front-end.

---

#### **Cấu hình file `.env`**

Dự án sử dụng file `.env` để quản lý các thông số cấu hình như kết nối cơ sở dữ liệu, tên ứng dụng,
v.v.  
Hãy tạo file `.env` từ file mẫu có sẵn:

```bash
cp .env.example .env
```

Sau đó, mở file `.env` và cập nhật các thông tin cần thiết, ví dụ:

```env
# APP
APP_ENV=development

# DATABASE
DB_ADAPTER=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_NAME=my_database
DB_USER=root
DB_PASS=
DB_CHARSET=utf8mb4

```

File `.env` chứa các biến môi trường cần thiết cho ứng dụng. Đảm bảo rằng bạn đã cập nhật đầy đủ
thông tin trong file này. Vì đây là nơi lưu trữ thông tin nhạy cảm như mật khẩu cơ sở dữ liệu,
bạn nên giữ file `.env` riêng tư và không chia sẻ nó trên GitHub hoặc bất kỳ nơi nào khác. Tôi
đã đưa file `.env` vào file `.gitignore` để tránh việc bạn vô tình tải lên thông tin nhạy cảm lên
GitHub.

---

#### **Cấu hình cho Phinx**

`phpure` sử dụng **Phinx** để quản lý cơ sở dữ liệu. Cấu hình của Phinx nằm trong file `phinx.
php`. Tuy nhiên bạn không cần phải chỉnh sửa file này, mọi cấu hình cần thiết đã được đặt trong
file `.env`. Nói về Phinx, đây là một công cụ mạnh mẽ giúp bạn quản lý cơ sở dữ liệu một cách dễ
dàng và hiệu quả. Bạn có thể tạo bảng, thêm cột, chỉnh sửa cấu trúc cơ sở dữ liệu mà không cần
thực hiện thủ công. Chúng ta sẽ tìm hiểu thêm về Phinx trong phần sau.

---

### **3. Cấu Trúc Thư Mục** 📂

Tiếp theo, hãy tìm hiểu cấu trúc thư mục của `phpure` để hiểu rõ hơn về cách tổ chức và quản lý dự án.

Cấu trúc thư mục của **phpure** được thiết kế nhằm đảm bảo tính nhất quán, dễ hiểu, và khả năng mở rộng tối ưu. Mô hình MVC (Model-View-Controller) được áp dụng làm nền tảng, giúp tách biệt các thành phần xử lý logic, giao diện, và dữ liệu một cách rõ ràng. Điều này không chỉ giúp quản lý dự án hiệu quả mà còn tạo tiền đề để mở rộng khi ứng dụng phát triển.

#### **Thư mục `app/`**
Thư mục này chứa phần lớn logic ứng dụng. Các thành phần trong thư mục này bao gồm:
- `Controllers/`: Chứa các lớp controller xử lý logic của ứng dụng, nhận yêu cầu từ người dùng, thực thi logic và trả về phản hồi.
- `Listeners/`: Tập hợp các lớp lắng nghe và xử lý sự kiện do ứng dụng hoặc hệ thống kích hoạt.
- `Middlewares/`: Chứa các lớp middleware để xử lý yêu cầu HTTP trước hoặc sau khi đến controller (như xác thực, kiểm tra quyền truy cập).
- `Models/`: Chứa các lớp model chịu trách nhiệm tương tác với cơ sở dữ liệu, quản lý dữ liệu ứng dụng.
- `events.php`: File đăng ký và quản lý các sự kiện của ứng dụng, giúp bạn dễ dàng kết nối sự kiện với các listener tương ứng.
- `routes.php`: File định nghĩa tất cả các tuyến đường (routes) của ứng dụng, ánh xạ URL tới controller và phương thức tương ứng.

#### **Thư mục `core/`**
Đây là phần "xương sống" của framework, chứa các lớp cốt lõi:
- `Http/`:
    - `Middleware.php`: Quản lý và đăng ký các middleware.
    - `Request.php`: Xử lý thông tin từ yêu cầu HTTP, bao gồm dữ liệu GET, POST và thông tin tiêu đề (headers).
    - `Response.php`: Tạo phản hồi HTTP và gửi chúng đến trình duyệt người dùng.
    - `ResponseCode.php`: Định nghĩa các mã trạng thái HTTP phổ biến như 200, 404, 500.
    - `Router.php`: Hệ thống định tuyến, ánh xạ các yêu cầu URL đến controller và phương thức tương ứng.
- `App.php`: Lớp cốt lõi khởi động và quản lý toàn bộ ứng dụng, kết nối các thành phần với nhau.
- `Controller.php`: Lớp cơ sở cho tất cả các controller, cung cấp các chức năng cơ bản như render view.
- `Database.php`: Quản lý kết nối cơ sở dữ liệu, thực hiện các truy vấn SQL và xử lý dữ liệu.
- `Event.php`: Hỗ trợ hệ thống sự kiện, cho phép kích hoạt và lắng nghe các sự kiện.
- `ExceptionHandler.php`: Quản lý và xử lý các lỗi (exception) xảy ra trong ứng dụng.
- `Logger.php`: Ghi log thông tin, lỗi, và sự kiện quan trọng để theo dõi hoạt động của ứng dụng.
- `Model.php`: Lớp cơ sở cho các model, hỗ trợ tương tác cơ sở dữ liệu thông qua ORM hoặc truy vấn SQL.
- `Session.php`: Quản lý phiên làm việc (session), lưu trữ thông tin tạm thời giữa các yêu cầu của người dùng.
- `Storage.php`: Quản lý lưu trữ file như tải lên, cache hoặc lưu trữ tạm thời.
- `Twig.php`: Tích hợp và quản lý template engine Twig, giúp tạo giao diện linh hoạt hơn.
- `Validation.php`: Quản lý và thực thi kiểm tra dữ liệu đầu vào (validation).

#### **Thư mục `database/`**
- `migrations/`: Chứa các file quản lý thay đổi cấu trúc cơ sở dữ liệu (migration), cho phép áp dụng hoặc hoàn tác các thay đổi.
- `seeds/`: Chứa các file seeding, dùng để tạo dữ liệu mẫu hoặc dữ liệu mặc định cho ứng dụng.

#### **Thư mục `public/`**
Thư mục này chứa các tệp công khai có thể truy cập từ trình duyệt:
- `assets/`: Chứa tài nguyên tĩnh như CSS, JS, và hình ảnh.
- `index.php`: Điểm vào chính của ứng dụng, nhận và chuyển hướng tất cả các yêu cầu tới hệ thống định tuyến.

#### **Thư mục `resources/`**
Tập trung vào giao diện và tài nguyên giao diện của ứng dụng:
- `css/input.css`: Tệp CSS tùy chỉnh, dùng để định nghĩa giao diện.
- `js/app.js`: Tệp JavaScript tùy chỉnh, quản lý logic giao diện động.
- `views/`: Chứa các file giao diện (template/view), giúp tách biệt hoàn toàn logic và giao diện.

#### **Thư mục `storage/`**
- `cache/`: Chứa dữ liệu tạm thời hoặc cache được tạo bởi ứng dụng.
- `logs/app.log`: Ghi log hoạt động của ứng dụng.
- `uploads/`: Chứa các file người dùng tải lên.

#### **Thư mục `utils/`**
- `helpers.php`: Chứa các hàm tiện ích có thể tái sử dụng trên toàn bộ ứng dụng.

#### **Các tệp cấu hình quan trọng**
- `.env.example`: File mẫu chứa các cấu hình môi trường như thông tin cơ sở dữ liệu hoặc key bảo mật.
- `.gitignore`: Quy định các file và thư mục không được theo dõi bởi Git.
- `.htaccess`: File cấu hình Apache, chuyển hướng mọi yêu cầu đến `index.php`.
- `composer.json`: Danh sách các thư viện PHP phụ thuộc, được quản lý bằng Composer.
- `tailwind.config.js`: File cấu hình Tailwind CSS, định nghĩa các tuỳ chỉnh về giao diện.
- `webpack.config.js`: Cấu hình Webpack để quản lý và đóng gói các tài nguyên như CSS, JS.

Với cấu trúc này, phpure không chỉ dễ sử dụng mà còn dễ mở rộng và bảo trì. Mọi thành phần được tổ chức chặt chẽ và rõ ràng, tạo điều kiện cho các lập trình viên tập trung vào phát triển mà không bị phân tán.

Dưới đây là mô tả chi tiết về từng thư mục và file:

```plaintext
phpure/
├── app/
│   ├── Controllers/           # Chứa các lớp xử lý logic ứng dụng, nhận và phản hồi yêu cầu từ người dùng.
│   ├── Listeners/             # Chứa các lớp lắng nghe và xử lý sự kiện trong hệ thống.
│   ├── Middlewares/           # Chứa các lớp middleware để xử lý các yêu cầu HTTP trước hoặc sau khi tới controller.
│   ├── Models/                # Chứa các lớp mô hình (model) để tương tác với cơ sở dữ liệu.
│   ├── events.php             # File đăng ký và quản lý các sự kiện trong ứng dụng.
│   ├── routes.php             # File định nghĩa các tuyến đường (route) cho ứng dụng.
├── core/
│   ├── Http/
│   │   ├── Middleware.php     # Lớp quản lý middleware, đăng ký và xử lý các middleware.
│   │   ├── Request.php        # Lớp xử lý thông tin từ yêu cầu HTTP (request).
│   │   ├── Response.php       # Lớp tạo và gửi phản hồi HTTP (response).
│   │   ├── ResponseCode.php   # Định nghĩa các mã trạng thái HTTP (HTTP status codes).
│   │   ├── Router.php         # Lớp định tuyến, ánh xạ yêu cầu HTTP tới controller.
│   ├── App.php                # Lớp cốt lõi của framework, khởi tạo và quản lý ứng dụng.
│   ├── Controller.php         # Lớp cơ sở cho tất cả các controller, hỗ trợ render view.
│   ├── Database.php           # Lớp quản lý kết nối cơ sở dữ liệu và truy vấn SQL.
│   ├── Event.php              # Quản lý hệ thống sự kiện (event) và các listener.
│   ├── ExceptionHandler.php   # Xử lý các lỗi (exception) xảy ra trong ứng dụng.
│   ├── Logger.php             # Lớp ghi log thông tin, lỗi và sự kiện quan trọng.
│   ├── Model.php              # Lớp cơ sở cho tất cả các model, hỗ trợ ORM.
│   ├── Session.php            # Quản lý phiên làm việc (session) của người dùng.
│   ├── Storage.php            # Quản lý lưu trữ file, như tải lên hoặc lưu cache.
│   ├── Twig.php               # Tích hợp và quản lý template engine Twig.
│   ├── Validation.php         # Quản lý và thực hiện kiểm tra dữ liệu (validation).
├── database/
│   ├── migrations/            # Chứa các file quản lý thay đổi cấu trúc cơ sở dữ liệu (migration).
│   ├── seeds/                 # Chứa các file tạo dữ liệu mẫu (seeding).
├── public/
│   ├── assets/                # Chứa các tài nguyên tĩnh như CSS, JS, và hình ảnh.
│   ├── index.php              # File khởi tạo ứng dụng, là điểm vào chính của framework.
├── resources/
│   ├── css/input.css          # Chứa file CSS tùy chỉnh của dự án.
│   ├── js/app.js              # Chứa file JavaScript tùy chỉnh của dự án.
│   ├── views/                 # Chứa các file giao diện (template/view) của ứng dụng.
├── storage/
│   ├── cache/                 # Chứa dữ liệu cache được tạo bởi ứng dụng.
│   ├── logs/app.log           # File ghi log của ứng dụng.
│   ├── uploads/               # Chứa các file được tải lên từ người dùng.
├── utils/
│   ├── helpers.php            # Chứa các hàm tiện ích được sử dụng trong toàn bộ dự án.
├── .env.example               # File mẫu cấu hình môi trường, chứa thông tin kết nối và thiết lập cơ bản.
├── .gitignore                 # File định nghĩa các tệp/thư mục bị Git bỏ qua.
├── .htaccess                  # File cấu hình Apache, chuyển hướng tất cả yêu cầu tới index.php.
├── composer.json              # File cấu hình Composer, liệt kê các thư viện phụ thuộc.
├── LICENSE                    # File chứa thông tin bản quyền của dự án.
├── package.json               # File cấu hình npm, liệt kê các gói JavaScript phụ thuộc.
├── phinx.php                  # File cấu hình Phinx cho việc quản lý cơ sở dữ liệu.
├── phpcs.xml                  # File cấu hình chuẩn mã nguồn PHP.
├── postcss.config.js          # File cấu hình PostCSS.
├── README.md                  # Hướng dẫn sử dụng framework `phpure`.
├── tailwind.config.js         # File cấu hình Tailwind CSS.
├── webpack.config.js          # File cấu hình Webpack cho việc đóng gói tài nguyên.
```  

Với cách tổ chức trên, `phpure` giúp bạn dễ dàng xây dựng và bảo trì ứng dụng từ nhỏ đến lớn.

### Hướng dẫn đóng góp cho `phpure`

Nếu bạn muốn đóng góp cho dự án `phpure`, bạn có thể làm theo các bước sau:

#### 1. Fork và Clone Repository

Đầu tiên, bạn cần fork repository này và clone nó về máy tính của mình:

```sh
git clone https://github.com/mttk2004/phpure.git
```

#### 2. Tạo Branch Mới

Trước khi bắt đầu làm việc, hãy tạo một branch mới từ branch `main` hoặc `develop`:

```sh
git checkout -b ten-branch-cua-ban
```

#### 3. Thực hiện Thay Đổi

Thực hiện các thay đổi cần thiết trên branch mới của bạn. Đảm bảo rằng bạn tuân thủ các nguyên tắc
coding và phong cách của dự án.

#### 4. Kiểm tra Thay Đổi

Chạy các bài kiểm tra để đảm bảo rằng những thay đổi của bạn không phá vỡ bất kỳ tính năng nào hiện
có:

```sh
phpunit
```

#### 5. Commit và Push Thay Đổi

Khi bạn đã sẵn sàng, hãy commit và push thay đổi của bạn lên repository fork của bạn:

```sh
git add .
git commit -m "Mô tả ngắn gọn về thay đổi"
git push origin ten-branch-cua-ban
```

#### 6. Tạo Pull Request

Cuối cùng, tạo một pull request từ repository của bạn về repository gốc. Hãy mô tả chi tiết những
thay đổi bạn đã thực hiện và lý do tại sao.

#### 7. Liên hệ và Thảo Luận

Nếu bạn cần bất kỳ sự giúp đỡ nào, bạn có thể liên hệ với maintainer chính của dự án qua GitHub
Issues hoặc Discussions.

#### Liên hệ Maintainer:

- **GitHub:** [mttk2004](https://github.com/mttk2004)

Chúng tôi rất mong nhận được sự đóng góp của bạn! Cảm ơn bạn đã giúp `phpure` trở nên tốt hơn.

---

_Last updated: January 12, 2025_
