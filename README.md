# phpure

phpure là một framework MVC đơn giản được viết bằng PHP để giúp người mới học và khám phá cách hoạt
động bên trong của một ứng dụng web theo mô hình MVC.

---

## **Gặp Gỡ `phpure`** ✌️

Trong quá trình phát triển ứng dụng web, bạn sẽ nhanh chóng nhận ra rằng việc tổ chức mã nguồn
một cách có cấu trúc là điều không thể thiếu. Ban đầu, bạn có thể bắt đầu với những file PHP đơn
giản, nhưng khi ứng dụng của bạn lớn dần, mã nguồn sẽ trở nên khó kiểm soát, khó bảo trì và dễ
xảy ra lỗi. Đây chính là lý do tại sao bạn cần một framework. Framework không chỉ cung cấp cho
bạn một bộ công cụ sẵn có để xử lý những công việc thường gặp, mà còn giúp bạn tuân theo các
nguyên tắc thiết kế phần mềm tốt như mô hình MVC (Model-View-Controller). Nếu không sử dụng một
framework ngay từ đầu, rất có thể bạn sẽ tự mình xây dựng một hệ thống tương tự để giải quyết các
vấn đề tổ chức và tái sử dụng mã nguồn – về bản chất, bạn đang tự tạo ra framework của riêng
mình.

Ngoài kia, có rất nhiều framework PHP mạnh mẽ như Laravel, Symfony, CodeIgniter, Zend, Yii và nhiều
framework khác nữa. Những công cụ này mang đến vô vàn tính năng hữu ích, giúp việc phát triển ứng
dụng web trở nên nhanh chóng và dễ dàng hơn bao giờ hết. Tuy nhiên, đối với những người mới bắt đầu
học PHP, việc tiếp cận các framework lớn thường là một thử thách không nhỏ. Các khái niệm phức tạp
và hệ thống tính năng đồ sộ đôi khi có thể khiến họ cảm thấy choáng ngợp, thậm chí làm giảm hứng thú
học tập. Bản thân tôi cũng từng trải qua cảm giác này khi lần đầu làm quen với
[Laravel](https://laravel.com). Với một người mới như tôi thời điểm đó, Laravel dường như là một thế
giới đầy "phép thuật" khó hiểu và đòi hỏi nhiều nỗ lực để chinh phục.

Vào đầu năm 2025, khi bước vào học kỳ mới, tôi có cơ hội tham gia một môn học rất thú vị mang
tên "Lập trình Web và Ứng dụng nâng cao". Một trong những yêu cầu quan trọng của môn học là xây
dựng một ứng dụng web PHP thuần túy (Pure PHP) theo mô hình MVC mà không được sử dụng bất kỳ
framework lớn nào như Laravel. Đây là một bài tập có ý nghĩa nhằm giúp chúng tôi hiểu rõ cách
các thành phần của ứng dụng web hoạt động từ gốc rễ. Nhận thấy đây là cơ hội tuyệt vời để học hỏi và
thử nghiệm, tôi đã quyết định bắt tay vào phát triển `phpure` — **một framework PHP đơn giản, gọn
nhẹ nhưng đủ mạnh mẽ** để hỗ trợ người mới bắt đầu dễ dàng nắm bắt cách xây dựng ứng dụng web theo
mô hình MVC.

Tôi là [Mai Trần Tuấn Kiệt](https://github.com/mttk2004), một sinh viên chuyên ngành Phát triển Web,
và `phpure` chính là dự án mã nguồn mở đầu tay của tôi. Tôi rất vui mừng được chia sẻ dự án này với
cộng đồng.

Điều đặc biệt ở `phpure` là nó **được thiết kế hướng đến đối tượng người mới học**. Framework này
mang tính đơn giản, trực quan, dễ hiểu và dễ sử dụng. Nếu bạn đang tìm hiểu về PHP hoặc muốn
hiểu cách hoạt động của một ứng dụng web theo mô hình MVC, `phpure` chắc chắn sẽ là một công cụ
hữu ích. Hơn nữa, nếu sau này bạn có ý định học các framework lớn như Laravel, việc hiểu rõ cách
vận hành của `phpure` sẽ giúp bạn có nền tảng vững chắc để tiếp cận những khái niệm nâng cao hơn.
Thật vậy, `phpure` được **lấy cảm hứng từ cấu trúc của Laravel** nhưng được tối giản hóa để phù hợp
hơn với những người mới bắt đầu. Là một người yêu thích Laravel, tôi đã cố gắng mang những yếu tố
tinh tế nhất của framework này vào `phpure` để mang đến trải nghiệm học tập và lập trình tốt nhất.

Không chỉ giới hạn ở các ứng dụng web đơn giản, `phpure` còn có **khả năng mở rộng và tùy chỉnh
linh hoạt** để phù hợp với nhu cầu phát triển của bạn. Tôi tin rằng, với một công cụ như `phpure`,
hành trình học hỏi và xây dựng ứng dụng web của bạn sẽ trở nên dễ dàng và thú vị hơn rất nhiều.

Hãy thử khám phá `phpure` ngay hôm nay và cùng nhau tạo nên những ứng dụng web tuyệt vời! 🌟

---

## **Bắt Đầu** ⛹️

### **1. Cài đặt** 📥

#### **Yêu cầu hệ thống**

Trước khi bắt đầu cài đặt và sử dụng `phpure`, hãy đảm bảo rằng môi trường làm việc của bạn đáp ứng các yêu cầu sau:

- **PHP**: Tối thiểu phiên bản 8.0.
- **Composer**: Tối thiểu phiên bản 2.8.4.
- **npm**: Tối thiểu phiên bản 11.0.0.

Việc đảm bảo các công cụ trên đã được cài đặt đúng phiên bản không chỉ giúp bạn tránh gặp phải lỗi trong quá trình cài đặt mà còn đảm bảo ứng dụng hoạt động ổn định.

---

#### **Các bước cài đặt**

Bắt đầu bằng cách mở terminal hoặc command prompt và thực hiện các lệnh sau:

```bash
git clone https://github.com/mttk2004/phpure.git
cd phpure
```

- **`git clone`**: Tải toàn bộ mã nguồn `phpure` từ GitHub về máy tính của bạn.
- **`cd phpure`**: Điều hướng đến thư mục chứa mã nguồn vừa tải về.

Sau khi hoàn thành bước này, bạn đã sẵn sàng tiếp tục với các bước thiết lập dự án và cài đặt phụ thuộc.

---

### **2. Cấu hình** ⚙️

Để `phpure` hoạt động chính xác, bạn cần thực hiện một số bước cấu hình cơ bản sau khi tải mã nguồn.

---

#### **Cài đặt phụ thuộc**

Sử dụng các lệnh sau để cài đặt toàn bộ các gói phụ thuộc cần thiết:

```bash
composer install
npm install
```

- **`composer install`**: Tải về tất cả các thư viện PHP cần thiết để dự án hoạt động.
- **`npm install`**: Cài đặt các gói front-end hỗ trợ giao diện hoặc các công cụ build.

Hai lệnh này sẽ đảm bảo rằng bạn có đầy đủ công cụ để phát triển và vận hành ứng dụng.

---

#### **Cấu hình file `.env`**

Dự án sử dụng file `.env` để lưu trữ các thông tin cấu hình quan trọng như thông tin cơ sở dữ liệu, môi trường ứng dụng, và các thông số khác. Để tạo file `.env`, thực hiện lệnh sau:

```bash
cp .env.example .env
```

Tiếp theo, mở file `.env` vừa tạo và cập nhật các thông số phù hợp với môi trường của bạn. Dưới đây là một ví dụ về cấu hình cơ sở dữ liệu:

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

Một vài lưu ý quan trọng:

- File `.env` chứa các thông tin nhạy cảm, như mật khẩu cơ sở dữ liệu, nên bạn cần bảo mật và tránh chia sẻ công khai.
- `phpure` đã tự động thêm `.env` vào `.gitignore`, giúp bạn tránh tải file này lên GitHub.

---

#### **Cấu hình Phinx**

`phpure` sử dụng **Phinx**, một công cụ quản lý cơ sở dữ liệu mạnh mẽ, để thực hiện các tác vụ như tạo bảng, thêm cột, hoặc sửa đổi cấu trúc cơ sở dữ liệu.

Cấu hình của Phinx được lưu trong file `phinx.php`. Tuy nhiên, bạn không cần chỉnh sửa trực tiếp file này vì tất cả thông tin đã được tự động cấu hình thông qua file `.env`.

Phinx là một phần quan trọng trong việc quản lý cơ sở dữ liệu của `phpure`. Nó giúp tự động hóa quy trình, giảm thiểu các thao tác thủ công và đảm bảo tính nhất quán. Trong phần tiếp theo, chúng ta sẽ đi sâu hơn vào cách sử dụng Phinx để quản lý cơ sở dữ liệu hiệu quả.

---

Hoàn thành các bước trên, bạn đã sẵn sàng để bắt đầu hành trình phát triển với `phpure`! 🚀

### **3. Cấu trúc thư mục** 📂

Tiếp theo, hãy tìm hiểu cấu trúc thư mục của `phpure` để hiểu rõ hơn về cách tổ chức và quản lý dự án.

Cấu trúc thư mục của **phpure** được thiết kế nhằm **đảm bảo tính nhất quán, dễ hiểu, và khả năng
mở rộng tối ưu**. Mô hình MVC (Model-View-Controller) được áp dụng làm nền tảng, giúp tách biệt
các thành phần xử lý logic, giao diện, và dữ liệu một cách rõ ràng. Điều này không chỉ giúp quản lý dự án hiệu quả mà còn tạo tiền đề để mở rộng khi ứng dụng phát triển.

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
  - `ResponseCode.php`: Định nghĩa các mã trạng thái HTTP phổ biến như 200, 404, 500, ...
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
- `CODE_OF_CONDUCT.md`: Quy tắc ứng xử trong dự án.
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
│   ├── Validation.php         # Quản lý và thực thi kiểm tra dữ liệu (validation).
├── database/
│   ├── migrations/            # Chứa các file quản lý thay đổi cấu trúc cơ sở dữ liệu (migration).
│   ├── seeds/                 # Chứa các file tạo dữ liệu mẫu (seeding).
├── public/
│   ├── assets/                # Chứa các tài nguyên tĩnh như CSS, JS, và hình ảnh.
│   ├── index.php              # File khởi tạo ứng dụng, nhận và chuyển hướng tất cả các yêu cầu tới hệ thống định tuyến.
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
├── CODE_OF_CONDUCT.md         # Quy tắc ứng xử trong dự án.
├── composer.json              # File cấu hình Composer, liệt kê các thư viện phụ thuộc.
├── LICENSE                    # File chứa thông tin bản quyền của dự án.
├── package.json               # File cấu hình npm, liệt kê các gói JavaScript phụ thuộc.
├── phinx.php                  # File cấu hình Phinx cho việc quản lý cơ sở dữ liệu.
├── .php-cs-fixer.dist.php     # File cấu hình PHP-CS-Fixer để đảm bảo chuẩn mã nguồn PHP.
├── postcss.config.js          # File cấu hình PostCSS.
├── README.md                  # Hướng dẫn sử dụng framework `phpure`.
├── tailwind.config.js         # File cấu hình Tailwind CSS.
├── webpack.config.js          # File cấu hình Webpack cho việc đóng gói tài nguyên.
```

Tại thờ điểm này, có thể cấu trúc thư mục của `phpure` vẫn còn khá mới mẻ và phức tạp. Nhưng đừng lo, chúng ta sẽ đi sâu vào từng phần trong các phần tiếp theo để hiểu rõ hơn về cách hoạt động và sử dụng của từng thành phần.

---

## **Tăng Tốc** 🤾

Để thực sự hiểu rõ và tận dụng tối đa `phpure`, bạn cần hiểu rõ một số khái niệm cơ bản và cách
hoạt động của framework. Đầu tiên là **vòng đời của request**.

### **1. Luồng hoạt động và Mô hình MVC - Vòng đời của request** 🔄

`phpure` hoạt động dựa trên mô hình MVC (Model-View-Controller), một kiến trúc phổ biến trong phát
triển web giúp tách biệt rõ ràng các phần của ứng dụng. **Model** chịu trách nhiệm quản lý dữ
liệu và logic nghiệp vụ, **View** quản lý giao diện người dùng, còn **Controller** là cầu nối
giữa Model và View, xử lý các yêu cầu từ người dùng và trả về phản hồiphù hợp.

#### **Tiếp nhận request:**

Mọi request từ trình duyệt được gửi đến file `index.php` trong thư mục `public`. Đây là điểm
vào chính của ứng dụng. Tại đây, framework được khởi chạy thông qua phương thức
`App::bootstrap()`, nơi các thành phần quan trọng như router, middleware, và session, ... được
cấu hình.

#### **Router phân tích request:**

Sau khi khởi động, router chịu trách nhiệm ánh xạ URL từ request đến các route được định nghĩa
trước trong file `routes.php`. Router kiểm tra xem URL yêu cầu có khớp với bất kỳ route nào đã
đăng ký không. Nếu không tìm thấy, nó sẽ trả về lỗi 404.

#### **Xử lý middleware:**

Trước khi router gọi controller, middleware được kích hoạt nếu như route có gắn middlware.
Middleware là các lớp xử lý trung gian, dùng để kiểm tra hoặc thay đổi request trước khi chuyển
tiếp. Ví dụ, middleware có thể kiểm tra xem người dùng đã đăng nhập chưa (auth) hoặc đảm bảo rằng
chỉ khách chưa đăng nhập mới có thể truy cập một số trang nhất định (guest). Nếu middleware phát
hiện lỗi, request sẽ bị dừng lại và trả về phản hồi ngay tại đó.

#### **Gọi controller:**

Sau khi vượt qua middleware, router gọi controller được chỉ định cùng với action (phương thức cụ
thể). Controller nhận các thông tin từ request, xử lý logic nghiệp vụ, và chuẩn bị dữ liệu để
truyền cho View. Ví dụ, một controller có thể lấy dữ liệu người dùng từ cơ sở dữ liệu hoặc kiểm
tra điều kiện nghiệp vụ trước khi tiếp tục.

#### **Kết nối với View thông qua Twig:**

Sau khi xử lý, controller thường kết thúc bằng việc gọi một template để hiển thị giao diện.
`phpure` sử dụng Twig, một công cụ template mạnh mẽ, để kết hợp dữ liệu từ controller và các
template HTML đã định nghĩa. Twig cung cấp nhiều tính năng hữu ích như vòng lặp, kiểm tra điều
kiện, và kế thừa layout, giúp việc xây dựng giao diện dễ dàng và linh hoạt.

#### **Trả về response:**

Sau khi Twig tạo ra giao diện hoàn chỉnh (HTML), framework gửi nội dung đó trở lại trình duyệt
dưới dạng response. Người dùng sẽ thấy trang web được hiển thị, hoàn chỉnh với dữ liệu đã được
xử lý từ controller.

#### **Tóm lại**

Vòng đời của một request trong `phpure` bao gồm các bước từ tiếp nhận URL, phân tích và ánh xạ
route, kiểm tra middleware, xử lý logic trong controller, và cuối cùng là render giao diện thông
qua Twig. Kiến trúc MVC đảm bảo mỗi phần của ứng dụng có nhiệm vụ rõ ràng, giúp mã nguồn dễ hiểu,
dễ bảo trì và mở rộng. Với luồng hoạt động mạch lạc này, ngay cả người mới bắt đầu cũng có thể
nhanh chóng hiểu được cách ứng dụng hoạt động và bắt tay vào phát triển các tính năng mới.

Tôi khuyên bạn nên đọc qua mã nguồn của `phpure` để hiểu rõ hơn về cách hoạt động của framework.
Đây là cách tốt nhất để học hỏi và nắm vững kiến thức.

### **2. Các chức năng cốt lõi** 🎯

#### **Routing**

Routing là một phần quan trọng trong việc xác định cách ứng dụng xử lý các yêu cầu từ người dùng.
`phpure` sử dụng router để ánh xạ URL đến các controller và action tương ứng. Tất cả các route của
ứng dụng được định nghĩa trong file `app/routes.php`. Để định nghĩa một route, bạn
cần chỉ định URL, phương thức HTTP, controller và action tương ứng. Dưới đây là một ví dụ:

```php
<?php

use Core\Http\Router;


$router = new Router();

// TODO: Define routes here
$router->get('', ['HomeController', 'index']); // Thêm dòng này

$router->dispatch();
```

Khi dòng `$router->get('', ['HomeController', 'index']);` được thêm vào, nó sẽ ánh xạ URL rỗng
(`/`) đến phương thức `index` của controller `HomeController`. Điều này có nghĩa
là khi người dùng truy cập trang chủ của ứng dụng, controller `HomeController` sẽ được gọi và
phương thức `index` sẽ được thực thi.

Một số phương thức routing phổ biến khác được tích hợp trong `phpure` bao gồm `post`, `put`,
`patch`, `delete`, ... để xử lý các HTTP request khác nhau. `phpure` cũng hỗ trợ định nghĩa route
với tham số động, giúp xử lý các URL động một cách dễ dàng. Ví dụ `'/posts/{id}'` sẽ ánh xạ
URL `/posts/1`, `/posts/2`, ... đến cùng một controller và action nhưng với tham số `id` khác nhau,
để bạn truy xuất dữ liệu dựa trên tham số đó. Xem ví dụ dưới đây:

```php
$router->get('/posts/{id}', ['PostController', 'show']);
```

Với route này, URL `/posts/1` sẽ gọi phương thức `show` của controller `PostController` và truyền
tham số `1` vào phương thức đó.

Ngoài ra, router còn hỗ trợ middleware, middleware ngăn chặn hoặc xử lý yêu cầu trước khi chúng
đến controller. Điều này giúp bạn kiểm tra quyền truy cập, xác thực người dùng, hoặc thực hiện các
tác vụ trước khi xử lý logic chính. Ví dụ:

```php
$router->get('/admin', ['AdminController', 'index'], ['auth']);
```

Trong đoạn mã trên, middleware `auth` sẽ được kích hoạt trước khi yêu cầu đến controller
`AdminController`. Middleware này có thể kiểm tra xem người dùng đã đăng nhập chưa, nếu chưa sẽ
chuyển hướng người dùng đến trang đăng nhập. Nếu đã đăng nhập, yêu cầu sẽ được chuyển tiếp đến
controller để xử lý.

#### **Database và ORM** 💾

`phpure` cung cấp lớp `Database` để tương tác với cơ sở dữ liệu một cách đơn giản và hiệu quả. Lớp này được lấy cảm hứng từ Query Builder của Laravel nhưng được đơn giản hóa để dễ hiểu hơn. Dưới đây là một số ví dụ về cách sử dụng:

```php
// Lấy tất cả bản ghi từ bảng users
$users = Database::table('users')->get();

// Lấy người dùng có id = 1
$user = Database::table('users')->where('id', '=', 1)->first();

// Thêm người dùng mới
Database::table('users')->insert([
    'name' => 'Người dùng mới',
    'email' => 'user@example.com',
    'password' => password_hash('password', PASSWORD_DEFAULT)
]);

// Cập nhật thông tin người dùng
Database::table('users')
        ->where('id', '=', 1)
        ->update(['name' => 'Tên mới']);

// Xóa người dùng
Database::table('users')
        ->where('id', '=', 1)
        ->delete();
```

Ngoài ra, `phpure` còn cung cấp lớp `Model` trừu tượng để bạn có thể tạo các model tương ứng với bảng trong cơ sở dữ liệu. Ví dụ:

```php
<?php

namespace App\Models;

use Core\Model;

class User extends Model
{
    protected string $table = 'users';
    protected bool $softDelete = true; // Hỗ trợ xóa mềm
}
```

Sau khi định nghĩa model, bạn có thể sử dụng nó để tương tác với cơ sở dữ liệu:

```php
// Lấy tất cả người dùng
$users = User::all();

// Tìm người dùng theo ID
$user = User::find(1);

// Thêm người dùng mới
$user = new User();
$user->create([
    'name' => 'Người dùng mới',
    'email' => 'user@example.com',
    'password' => password_hash('password', PASSWORD_DEFAULT)
]);

// Cập nhật thông tin
$user->update(['name' => 'Tên mới'], 1);

// Xóa người dùng
$user->delete(1);
```

Đặc biệt, lớp `Model` còn hỗ trợ các mối quan hệ giữa các bảng như One-to-One, One-to-Many và Many-to-Many:

```php
// Định nghĩa quan hệ trong model User
public function posts()
{
    return $this->hasMany(Post::class, 'user_id');
}

// Sử dụng quan hệ
$user = User::find(1);
$posts = $user->posts();
```

#### **Controllers** 🎮

Các controller trong `phpure` kế thừa từ lớp `Controller` cơ sở và chịu trách nhiệm xử lý logic nghiệp vụ của ứng dụng. Ví dụ về một controller đơn giản:

```php
<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        $this->render('users/index', [
            'users' => $users
        ]);
    }

    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            abort(404);
        }

        $this->render('users/show', [
            'user' => $user
        ]);
    }

    public function create()
    {
        $this->render('users/create');
    }

    public function store()
    {
        // Xử lý thêm người dùng mới
    }
}
```

#### **Validation** ✅

`phpure` tích hợp thư viện [Respect/Validation](https://respect-validation.readthedocs.io/) để hỗ trợ việc kiểm tra dữ liệu đầu vào một cách đơn giản và mạnh mẽ. Dưới đây là một ví dụ về cách sử dụng:

```php
<?php

namespace App\Controllers;

use Core\Controller;
use Core\Validation;
use Respect\Validation\Validator as v;

class AuthController extends Controller
{
    public function register()
    {
        $this->render('auth/register');
    }

    public function postRegister()
    {
        $validation = new Validation();

        $validation->validate([
            'name' => v::notEmpty()->length(2, 50),
            'email' => v::notEmpty()->email(),
            'password' => v::notEmpty()->length(8, null)
        ]);

        if ($validation->failed()) {
            $this->render('auth/register', [
                'errors' => $validation->getErrors()
            ]);
            return;
        }

        // Xử lý đăng ký
    }
}
```

#### **Template Engine (Twig)** 🖌️

`phpure` sử dụng [Twig](https://twig.symfony.com/) làm template engine mặc định. Twig cung cấp một cú pháp đơn giản và mạnh mẽ để tạo các view. Ví dụ về một file template Twig:

```twig
{# resources/views/users/index.html.twig #}
{% extends 'layouts/app.html.twig' %}

{% block content %}
    <h1>Danh sách người dùng</h1>

    <ul>
        {% for user in users %}
            <li>{{ user.name }} - {{ user.email }}</li>
        {% else %}
            <li>Không có người dùng nào.</li>
        {% endfor %}
    </ul>
{% endblock %}
```

Trong controller, bạn có thể render view và truyền dữ liệu như sau:

```php
$this->render('users/index', [
    'users' => $users
]);
```

#### **Migrations và Seeds** 🌱

`phpure` sử dụng [Phinx](https://phinx.org/) để quản lý migrations và seeds. Đây là một cách hiệu quả để quản lý cấu trúc cơ sở dữ liệu và dữ liệu mẫu.

##### **Tạo migration mới**

```bash
vendor/bin/phinx create CreateUsersTable
```

Sau đó, bạn có thể định nghĩa cấu trúc bảng trong file migration:

```php
<?php

use Phinx\Migration\AbstractMigration;

class CreateUsersTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('users');
        $table->addColumn('name', 'string', ['limit' => 50])
              ->addColumn('email', 'string', ['limit' => 100])
              ->addColumn('password', 'string')
              ->addColumn('created_at', 'datetime')
              ->addColumn('updated_at', 'datetime', ['null' => true])
              ->addColumn('deleted_at', 'datetime', ['null' => true])
              ->addIndex(['email'], ['unique' => true])
              ->create();
    }
}
```

##### **Chạy migrations**

```bash
vendor/bin/phinx migrate
```

##### **Tạo seeder**

```bash
vendor/bin/phinx seed:create UserSeeder
```

Định nghĩa dữ liệu mẫu trong seeder:

```php
<?php

use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    public function run()
    {
        $faker = \Faker\Factory::create();
        $data = [];

        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s')
            ];
        }

        $this->table('users')
             ->insert($data)
             ->saveData();
    }
}
```

##### **Chạy seeds**

```bash
vendor/bin/phinx seed:run
```

#### **Middleware** 🔄

Middleware là một lớp xử lý trung gian giữa request và response, có thể được sử dụng để kiểm tra quyền truy cập, xác thực người dùng, và nhiều tác vụ khác. Ví dụ về một middleware đơn giản:

```php
<?php

namespace App\Middlewares;

use Core\Http\Middleware;
use Core\Session;

class AuthMiddleware extends Middleware
{
    public function handle(): bool
    {
        if (!Session::has('user_id')) {
            redirect('/login');
            return false;
        }

        return true;
    }
}
```

Để sử dụng middleware, bạn cần đăng ký nó trong file `core/Http/Middleware.php` và sau đó sử dụng nó trong route:

```php
// Đăng ký middleware
Middleware::register('auth', \App\Middlewares\AuthMiddleware::class);

// Sử dụng middleware trong route
$router->get('/admin', ['AdminController', 'index'])->middleware('auth');
```

#### **Events và Listeners** 📢

`phpure` hỗ trợ hệ thống sự kiện (events) và người lắng nghe sự kiện (listeners). Điều này cho phép bạn tách biệt các thành phần của ứng dụng và tăng tính bảo trì.

```php
// Đăng ký event và listener trong file app/events.php
<?php

use Core\Event;

// Đăng ký các events và listeners
Event::listen('user.registered', \App\Listeners\SendWelcomeEmail::class);
```

Kích hoạt event từ controller:

```php
Event::fire('user.registered', ['user' => $user]);
```

Định nghĩa listener:

```php
<?php

namespace App\Listeners;

class SendWelcomeEmail
{
    public function handle($data)
    {
        $user = $data['user'];
        // Gửi email chào mừng
    }
}
```

## **Khám phá các tính năng hữu ích** 🔍

Ngoài các tính năng cốt lõi đã trình bày, `phpure` còn cung cấp nhiều công cụ hữu ích khác để giúp bạn phát triển ứng dụng nhanh chóng và dễ dàng. Trong phần này, chúng ta sẽ tìm hiểu về một số tính năng thú vị này.

### **1. Thông báo Flash Message** 💬

Flash message là thông báo tạm thời hiển thị một lần sau khi điều hướng trang, rất hữu ích để thông báo kết quả của một hành động. `phpure` cung cấp phương thức `flash()` trong lớp `Session` để quản lý các thông báo này:

```php
// Đặt thông báo flash trong controller
Session::flash('success', 'Đăng ký tài khoản thành công!');
redirect('/login');

// Trong view, hiển thị thông báo (với Twig)
{% if flash('success') %}
    <div class="alert alert-success">
        {{ flash('success') }}
    </div>
{% endif %}
```

Thông báo flash rất hữu ích trong các tình huống như:

- Hiển thị thông báo thành công sau khi thêm, cập nhật hoặc xóa dữ liệu
- Hiển thị thông báo lỗi sau khi chuyển hướng
- Hiển thị hướng dẫn hoặc thông tin tạm thời cho người dùng

### **2. Quản lý Form và Bảo mật CSRF** 🔒

`phpure` cung cấp lớp `Form` để hỗ trợ việc tạo và bảo mật các biểu mẫu HTML. Đặc biệt, lớp này cung cấp các phương thức để tạo token CSRF (Cross-Site Request Forgery) để bảo vệ ứng dụng của bạn khỏi các cuộc tấn công giả mạo yêu cầu.

```php
// Trong controller, tạo view với form
public function create()
{
    $this->render('users/create');
}

// Trong view (users/create.html.twig)
<form method="post" action="{{ url('/users/store') }}">
    <input type="hidden" name="csrf_token" value="{{ form_token() }}">

    <div class="form-group">
        <label for="name">Tên:</label>
        {{ form_input('text', 'name', '', {'class': 'form-control', 'required': 'required'}) }}
    </div>

    <div class="form-group">
        <label for="email">Email:</label>
        {{ form_input('email', 'email', '', {'class': 'form-control', 'required': 'required'}) }}
    </div>

    <button type="submit" class="btn btn-primary">Đăng ký</button>
</form>

// Trong controller xử lý form
public function store()
{
    // Kiểm tra token CSRF
    $token = Request::input('csrf_token');
    if (!Form::validateToken($token)) {
        Session::flash('error', 'Token không hợp lệ!');
        redirect('/users/create');
        return;
    }

    // Xử lý dữ liệu form
    // ...
}
```

### **3. Phân trang (Pagination)** 📋

Phân trang là tính năng quan trọng khi hiển thị một lượng lớn dữ liệu. `phpure` cung cấp lớp `Pagination` để giúp bạn dễ dàng triển khai phân trang trong ứng dụng của mình:

```php
// Trong controller
public function index()
{
    $currentPage = (int) Request::query('page', 1);
    $perPage = 10;

    // Lấy tổng số bản ghi
    $total = Database::table('users')->count();

    // Khởi tạo đối tượng Pagination
    $pagination = new Pagination($total, $perPage, $currentPage);

    // Lấy dữ liệu với phân trang
    $users = Database::table('users')
                   ->orderBy('id', 'DESC')
                   ->limit($perPage)
                   ->offset($pagination->offset())
                   ->get();

    $this->render('users/index', [
        'users' => $users,
        'pagination' => $pagination->links()
    ]);
}

// Trong view (users/index.html.twig)
{# Hiển thị danh sách người dùng #}
<ul>
    {% for user in users %}
        <li>{{ user.name }} - {{ user.email }}</li>
    {% else %}
        <li>Không có người dùng nào.</li>
    {% endfor %}
</ul>

{# Hiển thị phân trang #}
<nav>
    <ul class="pagination">
        {% for link in pagination %}
            <li class="page-item {{ link.active ? 'active' : '' }}">
                <a class="page-link" href="{{ link.url }}">{{ link.page }}</a>
            </li>
        {% endfor %}
    </ul>
</nav>
```

### **4. Bộ nhớ đệm (Cache)** ⚡

Cache giúp tăng hiệu suất ứng dụng bằng cách lưu trữ dữ liệu tạm thời, tránh phải thực hiện các thao tác tốn kém như truy vấn cơ sở dữ liệu nhiều lần. `phpure` cung cấp một lớp `Cache` đơn giản nhưng hiệu quả:

```php
// Lưu dữ liệu vào cache
Cache::put('users', $users, 60); // Lưu trong 60 phút

// Lấy dữ liệu từ cache
$users = Cache::get('users');

// Ví dụ thực tế: Lấy danh sách người dùng từ cache hoặc database
public function index()
{
    // Thử lấy dữ liệu từ cache
    $users = Cache::get('users');

    // Nếu không có trong cache, lấy từ database và lưu vào cache
    if (!$users) {
        $users = User::all();
        Cache::put('users', $users, 30); // Lưu trong 30 phút
    }

    $this->render('users/index', [
        'users' => $users
    ]);
}

// Xóa cache
Cache::delete('users');

// Xóa tất cả cache
Cache::flush();
```

### **5. Xử lý lỗi nâng cao** 🛠️

`phpure` cung cấp lớp `ExceptionHandler` để xử lý lỗi một cách hiệu quả. Lớp này tự động bắt các lỗi và exception, ghi log và hiển thị thông báo lỗi phù hợp với môi trường:

```php
// Đăng ký exception handler trong file bootstrap
ExceptionHandler::register();

// Khi có lỗi xảy ra:
// - Trong môi trường development: Hiển thị chi tiết lỗi
// - Trong môi trường production: Hiển thị trang lỗi thân thiện với người dùng
```

Để tạo trang lỗi tùy chỉnh, bạn có thể tạo các file view tương ứng trong thư mục `resources/views/errors/`:

- `404.html.twig` - Trang không tìm thấy
- `500.html.twig` - Lỗi server

### **6. Lọc dữ liệu đầu vào an toàn** 🔍

`phpure` mở rộng lớp `Request` với phương thức `sanitize()` để lọc dữ liệu đầu vào, bảo vệ ứng dụng khỏi các mã độc hại:

```php
// Lấy dữ liệu đầu vào đã được lọc
$name = Request::sanitize('name');
$email = Request::sanitize('email');

// Kiểm tra xem yêu cầu có phải Ajax không
if (Request::isAjax()) {
    // Xử lý yêu cầu Ajax
}

// Lấy địa chỉ IP của người dùng
$userIp = Request::ip();
```

### **7. Hướng dẫn xử lý tệp tải lên** 📁

`phpure` cung cấp lớp `Storage` để quản lý việc tải lên và lưu trữ tệp. Dưới đây là một ví dụ hoàn chỉnh về cách xử lý tệp tải lên:

```php
// Trong view (form tải lên)
<form method="post" action="{{ url('/upload') }}" enctype="multipart/form-data">
    <input type="hidden" name="csrf_token" value="{{ form_token() }}">

    <div class="form-group">
        <label for="avatar">Ảnh đại diện:</label>
        <input type="file" name="avatar" id="avatar">
    </div>

    <button type="submit" class="btn btn-primary">Tải lên</button>
</form>

// Trong controller
public function upload()
{
    // Kiểm tra token CSRF
    $token = Request::input('csrf_token');
    if (!Form::validateToken($token)) {
        Session::flash('error', 'Token không hợp lệ!');
        redirect('/profile');
        return;
    }

    // Kiểm tra file tải lên
    if (!isset($_FILES['avatar']) || $_FILES['avatar']['error'] !== UPLOAD_ERR_OK) {
        Session::flash('error', 'Lỗi khi tải lên tệp!');
        redirect('/profile');
        return;
    }

    // Tạo tên file ngẫu nhiên
    $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
    $filename = uniqid() . '.' . $extension;

    // Lưu file
    $storagePath = 'avatars/' . $filename;
    $filepath = Storage::put($storagePath, $_FILES['avatar']);

    // Cập nhật profile của người dùng
    $userId = Session::get('user_id');
    User::update(['avatar' => $storagePath], $userId);

    Session::flash('success', 'Tải lên ảnh đại diện thành công!');
    redirect('/profile');
}
```

## **Xây dựng ứng dụng đầu tiên với phpure** 🏗️

Trong phần này, chúng ta sẽ xây dựng một ứng dụng Todo List đơn giản để hiểu rõ hơn về cách sử dụng `phpure` trong thực tế.

### **Bước 1: Thiết lập cơ sở dữ liệu**

Đầu tiên, tạo một migration để tạo bảng `todos`:

```bash
vendor/bin/phinx create CreateTodosTable
```

Sau đó, định nghĩa bảng trong file migration:

```php
<?php

use Phinx\Migration\AbstractMigration;

class CreateTodosTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('todos');
        $table->addColumn('title', 'string', ['limit' => 255])
              ->addColumn('completed', 'boolean', ['default' => false])
              ->addColumn('user_id', 'integer', ['null' => true])
              ->addColumn('created_at', 'datetime')
              ->addColumn('updated_at', 'datetime', ['null' => true])
              ->addIndex(['user_id'])
              ->create();
    }
}
```

Thực thi migration:

```bash
vendor/bin/phinx migrate
```

### **Bước 2: Tạo Model**

Tạo file `app/Models/Todo.php`:

```php
<?php

namespace App\Models;

use Core\Model;

class Todo extends Model
{
    protected string $table = 'todos';
}
```

### **Bước 3: Tạo Controller**

Tạo file `app/Controllers/TodoController.php`:

```php
<?php

namespace App\Controllers;

use Core\Controller;
use Core\Http\Request;
use Core\Session;
use Core\Validation;
use App\Models\Todo;
use Respect\Validation\Validator as v;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all();

        $this->render('todos/index', [
            'todos' => $todos
        ]);
    }

    public function create()
    {
        $this->render('todos/create');
    }

    public function store()
    {
        $validation = new Validation();
        $validation->validate([
            'title' => v::notEmpty()->length(3, 255)
        ]);

        if ($validation->failed()) {
            Session::flash('errors', $validation->errors());
            redirect('/todos/create');
            return;
        }

        $todo = new Todo();
        $todo->create([
            'title' => Request::sanitize('title'),
            'completed' => false,
            'user_id' => Session::get('user_id') ?? null,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        Session::flash('success', 'Thêm công việc thành công!');
        redirect('/todos');
    }

    public function toggle($id)
    {
        $todo = Todo::find($id);

        if (!$todo) {
            abort(404);
        }

        $todo->update([
            'completed' => !$todo->completed,
            'updated_at' => date('Y-m-d H:i:s')
        ], $id);

        redirect('/todos');
    }

    public function delete($id)
    {
        $todo = Todo::find($id);

        if (!$todo) {
            abort(404);
        }

        $todo->delete($id);

        Session::flash('success', 'Xóa công việc thành công!');
        redirect('/todos');
    }
}
```

### **Bước 4: Định nghĩa Routes**

Trong file `app/routes.php`:

```php
<?php

use Core\Http\Router;

$router = new Router();

// Trang chủ
$router->get('', ['HomeController', 'index']);

// Routes cho Todo
$router->get('todos', ['TodoController', 'index']);
$router->get('todos/create', ['TodoController', 'create']);
$router->post('todos', ['TodoController', 'store']);
$router->get('todos/{id}/toggle', ['TodoController', 'toggle']);
$router->get('todos/{id}/delete', ['TodoController', 'delete']);

$router->dispatch();
```

### **Bước 5: Tạo Views**

Tạo file `resources/views/todos/index.html.twig`:

```twig
{% extends 'layouts/app.html.twig' %}

{% block content %}
    <div class="container mt-5">
        <h1 class="mb-4">Danh sách công việc</h1>

        {% if flash('success') %}
            <div class="alert alert-success">
                {{ flash('success') }}
            </div>
        {% endif %}

        <a href="{{ url('/todos/create') }}" class="btn btn-primary mb-3">Thêm công việc mới</a>

        <div class="list-group">
            {% for todo in todos %}
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        {% if todo.completed %}
                            <s>{{ todo.title }}</s>
                        {% else %}
                            {{ todo.title }}
                        {% endif %}
                    </div>
                    <div>
                        <a href="{{ url('/todos/' ~ todo.id ~ '/toggle') }}" class="btn btn-sm btn-info">
                            {% if todo.completed %}
                                Đánh dấu chưa hoàn thành
                            {% else %}
                                Đánh dấu hoàn thành
                            {% endif %}
                        </a>
                        <a href="{{ url('/todos/' ~ todo.id ~ '/delete') }}" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
                    </div>
                </div>
            {% else %}
                <div class="alert alert-info">Không có công việc nào.</div>
            {% endfor %}
        </div>
    </div>
{% endblock %}
```

Tạo file `resources/views/todos/create.html.twig`:

```twig
{% extends 'layouts/app.html.twig' %}

{% block content %}
    <div class="container mt-5">
        <h1 class="mb-4">Thêm công việc mới</h1>

        {% if flash('errors') %}
            <div class="alert alert-danger">
                <ul>
                    {% for field, errors in flash('errors') %}
                        {% for error in errors %}
                            <li>{{ error }}</li>
                        {% endfor %}
                    {% endfor %}
                </ul>
            </div>
        {% endif %}

        <form action="{{ url('/todos') }}" method="post">
            <input type="hidden" name="csrf_token" value="{{ form_token() }}">

            <div class="form-group">
                <label for="title">Tên công việc:</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Thêm</button>
            <a href="{{ url('/todos') }}" class="btn btn-secondary mt-3">Hủy</a>
        </form>
    </div>
{% endblock %}
```

Tạo file `resources/views/layouts/app.html.twig`:

```twig
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ứng dụng Todo List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Todo App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/todos') }}">Công việc</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {% block content %}{% endblock %}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
```

Với ví dụ thực tế này, bạn đã thấy cách `phpure` hoạt động trong một ứng dụng đầy đủ chức năng. Bạn có thể mở rộng ứng dụng này bằng cách thêm chức năng đăng nhập, quản lý người dùng, hoặc bất kỳ tính năng nào khác!

## **Các kỹ thuật nâng cao** 🚀

### **1. Liên kết database với quan hệ nhiều-nhiều**

Để làm việc với quan hệ nhiều-nhiều (many-to-many), bạn có thể sử dụng phương thức `belongsToMany()` trong model:

```php
// Model User
public function roles()
{
    return $this->belongsToMany(
        Role::class,    // Model liên quan
        'user_roles',   // Bảng trung gian
        'user_id',      // Khóa ngoại của bảng hiện tại
        'role_id',      // Khóa ngoại của bảng liên quan
        'id',           // Khóa chính của bảng hiện tại
        'id'            // Khóa chính của bảng liên quan
    );
}

// Sử dụng
$user = User::find(1);
$roles = $user->roles();
```

### **2. Middleware kiểm tra vai trò người dùng**

Tạo middleware để kiểm tra vai trò của người dùng:

```php
<?php

namespace App\Middlewares;

use Core\Http\Middleware;
use Core\Session;
use App\Models\User;

class RoleMiddleware extends Middleware
{
    private array $allowedRoles;

    public function __construct(array $allowedRoles)
    {
        $this->allowedRoles = $allowedRoles;
    }

    public function handle(): bool
    {
        $userId = Session::get('user_id');

        if (!$userId) {
            redirect('/login');
            return false;
        }

        $user = User::find($userId);
        $userRoles = $user->roles();

        foreach ($userRoles as $role) {
            if (in_array($role->name, $this->allowedRoles)) {
                return true;
            }
        }

        abort(403); // Không có quyền truy cập
        return false;
    }
}

// Đăng ký middleware
Middleware::register('role', \App\Middlewares\RoleMiddleware::class);

// Sử dụng trong route
$router->get('/admin', ['AdminController', 'index'])->middleware('role:admin,super_admin');
```

### **3. Tạo Command Line Interface (CLI)**

Bạn có thể tạo các lệnh CLI cho `phpure` để tự động hóa các tác vụ:

```php
<?php
// commands/generate.php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../utils/helpers.php';

// Xử lý tham số dòng lệnh
$command = $argv[1] ?? null;
$name = $argv[2] ?? null;

if (!$command || !$name) {
    echo "Sử dụng: php commands/generate.php [controller|model|middleware] [name]\n";
    exit(1);
}

switch ($command) {
    case 'controller':
        generateController($name);
        break;
    case 'model':
        generateModel($name);
        break;
    case 'middleware':
        generateMiddleware($name);
        break;
    default:
        echo "Lệnh không hợp lệ. Các lệnh hợp lệ: controller, model, middleware\n";
        exit(1);
}

function generateController($name)
{
    $template = <<<PHP
<?php

namespace App\Controllers;

use Core\Controller;

class {$name}Controller extends Controller
{
    public function index()
    {
        \$this->render('{$name}s/index');
    }

    public function show(\$id)
    {
        \$this->render('{$name}s/show', ['id' => \$id]);
    }

    public function create()
    {
        \$this->render('{$name}s/create');
    }

    public function store()
    {
        // Xử lý logic
    }
}
PHP;

    $filename = __DIR__ . "/../app/Controllers/{$name}Controller.php";
    file_put_contents($filename, $template);
    echo "Controller {$name}Controller đã được tạo thành công!\n";
}

// Tương tự cho generateModel và generateMiddleware
```

Với những ví dụ và hướng dẫn cụ thể này, bạn đã có một bức tranh toàn diện về framework `phpure` và cách sử dụng nó để xây dựng các ứng dụng web hiện đại. Hãy bắt đầu thử nghiệm và khám phá thêm các khả năng của framework!

## **Tổng kết** 📝

`phpure` là một framework MVC đơn giản nhưng mạnh mẽ, được thiết kế đặc biệt cho những người mới học PHP. Với cấu trúc rõ ràng, tài liệu chi tiết và các ví dụ cụ thể, `phpure` là lựa chọn tuyệt vời để bạn hiểu cách hoạt động bên trong của một framework web trước khi chuyển sang các framework lớn hơn như Laravel.

Những kiến thức bạn học được từ `phpure` sẽ là nền tảng vững chắc cho hành trình phát triển web của bạn, giúp bạn trở thành một lập trình viên PHP tốt hơn.

Hãy tự tin khám phá, thử nghiệm và đóng góp cho `phpure` để cùng nhau xây dựng một cộng đồng học tập mạnh mẽ!

---

_Last updated: April 05, 2025_
