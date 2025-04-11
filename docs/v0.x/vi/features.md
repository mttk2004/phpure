# Các Tính Năng Bổ Sung

PHPure cung cấp nhiều tính năng bổ sung ngoài các khái niệm cốt lõi để nâng cao trải nghiệm phát triển web của bạn. Những tính năng này được thiết kế để giải quyết các thách thức phổ biến và làm cho quy trình phát triển của bạn hiệu quả hơn.

## Các Hàm Trợ Giúp Tiện Lợi

PHPure bao gồm một bộ hàm trợ giúp toàn cục trong `utils/helpers.php` giúp đơn giản hóa các tác vụ thông thường:

```php
// Chuyển hướng đến một URL khác
redirect('/dashboard');

// Lấy URL hiện tại
$currentUrl = current_url();

// Tạo URL cho một route
$url = url('/users/profile');

// Định dạng ngày tháng
$formattedDate = format_date('2023-04-15', 'd/m/Y');

// Tạo đầu ra HTML đã được mã hóa an toàn
echo e('<script>alert("XSS")</script>'); // Kết quả: &lt;script&gt;alert(&quot;XSS&quot;)&lt;/script&gt;

// Kiểm tra xem môi trường hiện tại có phải là development không
if (is_development()) {
    // Hiển thị thông tin gỡ lỗi
}
```

Sử dụng các hàm trợ giúp này làm cho mã của bạn ngắn gọn và dễ đọc hơn, đặc biệt đối với các thao tác thông thường.

## Thông Báo Flash

Thông báo flash cung cấp phản hồi tạm thời cho người dùng, tồn tại chính xác một lần yêu cầu trang. Chúng hoàn hảo để hiển thị thông báo thành công, lỗi hoặc thông tin sau khi gửi biểu mẫu hoặc các hành động khác:

```php
// Trong một action của controller
Session::flash('success', 'Hồ sơ của bạn đã được cập nhật!');
redirect('/dashboard');

// Trong template Twig của bạn
{% if flash('success') %}
    <div class="alert alert-success">
        {{ flash('success') }}
    </div>
{% endif %}

{% if flash('error') %}
    <div class="alert alert-danger">
        {{ flash('error') }}
    </div>
{% endif %}
```

Thông báo flash tự động xóa sau khi được truy xuất một lần, đảm bảo người dùng không nhìn thấy thông báo đã cũ.

## Bảo Mật Biểu Mẫu với Bảo Vệ CSRF

Cross-Site Request Forgery (CSRF) là một lỗ hổng bảo mật phổ biến. Lớp `Form` của PHPure cung cấp bảo vệ tích hợp:

```php
// Trong template Twig của bạn
<form method="post" action="{{ url('/users/update') }}">
    {{ csrf_field() }}

    <!-- Các trường của biểu mẫu -->
    <input type="text" name="name" value="{{ user.name }}">

    <button type="submit">Cập nhật</button>
</form>

// Trong controller của bạn
public function update()
{
    // Xác minh token CSRF (tự động ném ngoại lệ nếu không hợp lệ)
    Form::verifyCsrfToken();

    // Xử lý dữ liệu biểu mẫu
    $name = Request::input('name');
    // ...
}
```

Hàm `csrf_field()` trong Twig chèn một trường input ẩn với token bảo mật. PHPure tự động xác thực token này khi gửi biểu mẫu, bảo vệ ứng dụng của bạn khỏi các cuộc tấn công CSRF.

## Phân Trang Thông Minh

Khi làm việc với tập dữ liệu lớn, phân trang trở nên thiết yếu. Hệ thống phân trang của PHPure vừa mạnh mẽ vừa dễ sử dụng:

```php
// Trong controller của bạn
public function index()
{
    $page = (int) Request::query('page', 1);
    $perPage = 15;

    // Lấy tổng số
    $total = Database::table('articles')->count();

    // Tạo đối tượng phân trang
    $pagination = new Pagination($total, $perPage, $page);

    // Lấy dữ liệu đã phân trang
    $articles = Database::table('articles')
        ->orderBy('created_at', 'DESC')
        ->limit($perPage)
        ->offset($pagination->offset())
        ->get();

    $this->render('articles/index', [
        'articles' => $articles,
        'pagination' => $pagination
    ]);
}

// Trong template Twig của bạn
<div class="pagination">
    {% if pagination.hasPrevious() %}
        <a href="{{ url('/articles?page=' ~ pagination.previousPage()) }}">&laquo; Trước</a>
    {% endif %}

    {% for i in pagination.getPages() %}
        <a href="{{ url('/articles?page=' ~ i) }}"
           class="{{ i == pagination.currentPage ? 'active' : '' }}">
            {{ i }}
        </a>
    {% endfor %}

    {% if pagination.hasNext() %}
        <a href="{{ url('/articles?page=' ~ pagination.nextPage()) }}">Sau &raquo;</a>
    {% endif %}
</div>
```

Lớp `Pagination` xử lý tất cả các tính toán phức tạp cho bạn, cung cấp các phương thức để xác định:

- Trang hiện tại
- Tổng số trang
- Số trang trước/sau
- Liệu có trang trước/sau hay không
- Những số trang nào hiển thị trong điều hướng

## Hệ Thống Cache Tăng Hiệu Suất

Lưu trữ cache là yếu tố quan trọng cho hiệu suất ứng dụng. PHPure cung cấp một hệ thống cache linh hoạt:

```php
// Lưu trữ dữ liệu trong cache trong 60 phút
Cache::put('homepage_data', $data, 60);

// Lấy dữ liệu từ cache
$data = Cache::get('homepage_data');

// Lưu trữ dữ liệu vĩnh viễn (cho đến khi bị xóa thủ công)
Cache::forever('site_settings', $settings);

// Kiểm tra xem một mục có tồn tại trong cache không
if (Cache::has('api_response')) {
    // Sử dụng dữ liệu đã lưu trong cache
}

// Xóa một mục khỏi cache
Cache::delete('user_stats');

// Xóa tất cả dữ liệu đã lưu trong cache
Cache::flush();

// Mẫu ghi nhớ (lấy từ cache hoặc thực thi callback và lưu kết quả)
$users = Cache::remember('active_users', 30, function() {
    return Database::table('users')
        ->where('status', '=', 'active')
        ->get();
});
```

Hệ thống cache hỗ trợ các driver khác nhau (file, array), và bạn có thể cấu hình trong `config/cache.php`.

## Xử Lý Lỗi Nâng Cao

PHPure bao gồm một hệ thống xử lý ngoại lệ mạnh mẽ giúp bạn quản lý lỗi một cách duyên dáng:

```php
// Đăng ký trình xử lý ngoại lệ (được thực hiện tự động trong bootstrap)
ExceptionHandler::register();
```

Sau khi đăng ký, trình xử lý ngoại lệ sẽ:

- Bắt tất cả các lỗi và ngoại lệ PHP
- Ghi lại thông tin lỗi chi tiết
- Hiển thị thông báo lỗi phù hợp dựa trên môi trường:
  - Trong development: thông tin lỗi chi tiết với stack traces
  - Trong production: trang lỗi thân thiện với người dùng

Để tùy chỉnh trang lỗi, tạo template Twig trong `resources/views/errors/`:

- `404.html.twig` - Cho lỗi "không tìm thấy"
- `403.html.twig` - Cho lỗi "cấm"
- `500.html.twig` - Cho lỗi máy chủ

## Hệ Thống Lưu Trữ Tệp

Lớp `Storage` cung cấp một giao diện sạch sẽ cho các thao tác tệp:

```php
// Lưu trữ một tệp (từ một upload)
$path = Storage::put('avatars/user123.jpg', $_FILES['avatar']);

// Kiểm tra xem một tệp có tồn tại không
if (Storage::exists('documents/report.pdf')) {
    // Tệp tồn tại
}

// Lấy nội dung của một tệp
$content = Storage::get('config/settings.json');

// Lấy kích thước của một tệp (tính bằng byte)
$size = Storage::size('uploads/large-file.zip');

// Xóa một tệp
Storage::delete('temp/old-file.txt');

// Tạo URL công khai cho một tệp
$url = Storage::url('images/logo.png');
```

Hệ thống lưu trữ được cấu hình trong `config/storage.php`, nơi bạn có thể xác định đường dẫn lưu trữ và quyền.

## Thông Tin Request và Lọc Đầu Vào

PHPure mở rộng việc xử lý request cơ bản với các phương thức hữu ích cho các tác vụ thông thường:

```php
// Lấy đầu vào đã được làm sạch (ngăn chặn XSS)
$name = Request::sanitize('name');
$email = Request::sanitize('email', FILTER_VALIDATE_EMAIL);

// Lấy đầu vào JSON từ thân request
$data = Request::json();

// Kiểm tra phương thức request
if (Request::isMethod('POST')) {
    // Xử lý request POST
}

// Kiểm tra xem request có phải là request AJAX không
if (Request::isAjax()) {
    // Trả về JSON thay vì HTML
}

// Lấy địa chỉ IP của client
$ip = Request::ip();

// Lấy user agent
$userAgent = Request::userAgent();

// Lấy header của request
$token = Request::header('Authorization');
```

Những phương thức này giúp dễ dàng làm việc với dữ liệu request trong khi vẫn duy trì các thực hành bảo mật tốt nhất.

## Hệ Thống Sự Kiện

PHPure bao gồm một hệ thống sự kiện đơn giản nhưng mạnh mẽ để tách rời các thành phần:

```php
// Đăng ký một listener sự kiện
Event::listen('user.registered', function($user) {
    // Gửi email chào mừng
    Mailer::send('welcome', $user->email, [
        'name' => $user->name
    ]);
});

// Kích hoạt một sự kiện
Event::fire('user.registered', $user);

// Listener dựa trên lớp
class WelcomeEmailListener
{
    public function handle($user)
    {
        // Gửi email chào mừng
    }
}

// Đăng ký listener dựa trên lớp
Event::listen('user.registered', [WelcomeEmailListener::class, 'handle']);
```

Hệ thống sự kiện hoàn hảo cho:

- Gửi email sau các hành động nhất định
- Ghi log các hoạt động quan trọng
- Cập nhật dữ liệu liên quan khi một bản ghi thay đổi
- Bất kỳ tác vụ nào không nên trực tiếp là trách nhiệm của controller

## Tích Hợp Vite cho Quản Lý Tài Nguyên

PHPure tích hợp mượt mà với Vite cho quản lý tài nguyên frontend hiện đại:

```php
// Trong layout.html.twig
<!DOCTYPE html>
<html>
<head>
    <title>Ứng dụng của tôi</title>
    {{ vite_assets() }}
</head>
<body>
    <!-- Nội dung -->
</body>
</html>
```

Hàm `vite_assets()` tự động bao gồm các script và style cần thiết được xử lý bởi Vite, cung cấp cho bạn:

- Hot Module Replacement trong quá trình phát triển
- Trích xuất CSS tự động
- Fingerprinting tài nguyên để phá vỡ cache
- Đóng gói và tối ưu hóa module JavaScript

Cấu hình được xử lý trong `vite.config.js` ở thư mục gốc của dự án.

## Ví Dụ Mã Hoàn Chỉnh

### Làm Việc với Thông Báo Flash và Biểu Mẫu

```php
// UserController.php
public function showLoginForm()
{
    $this->render('auth/login');
}

public function login()
{
    // Xác thực token CSRF
    Form::verifyCsrfToken();

    // Lấy đầu vào
    $email = Request::sanitize('email');
    $password = Request::input('password');

    // Xác thực thông tin đăng nhập
    $user = Database::table('users')
        ->where('email', '=', $email)
        ->first();

    if (!$user || !password_verify($password, $user['password'])) {
        Session::flash('error', 'Email hoặc mật khẩu không hợp lệ');
        redirect('/login');
        return;
    }

    // Đăng nhập người dùng
    Session::set('user_id', $user['id']);
    Session::set('user_name', $user['name']);

    Session::flash('success', 'Chào mừng trở lại, ' . $user['name'] . '!');
    redirect('/dashboard');
}

// login.html.twig
{% extends 'layouts/app.html.twig' %}

{% block content %}
    <h1>Đăng nhập</h1>

    {% if flash('error') %}
        <div class="alert alert-danger">
            {{ flash('error') }}
        </div>
    {% endif %}

    <form method="post" action="{{ url('/login') }}">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
        </div>

        <div class="form-group">
            <label for="password">Mật khẩu:</label>
            <input type="password" name="password" id="password" required>
        </div>

        <button type="submit" class="btn btn-primary">Đăng nhập</button>
    </form>
{% endblock %}
```

Bằng cách kết hợp các tính năng bổ sung này, PHPure cung cấp cho bạn mọi thứ cần thiết để xây dựng các ứng dụng web tinh vi vừa có hiệu suất cao vừa dễ bảo trì.
