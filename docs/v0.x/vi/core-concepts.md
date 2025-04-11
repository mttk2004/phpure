# Các Khái Niệm Cốt Lõi

Để thực sự hiểu và tận dụng tối đa PHPure, bạn cần nắm vững một số khái niệm cơ bản và cách thức hoạt động của framework. Hãy bắt đầu với **vòng đời của request**.

## Vòng Đời Request

PHPure hoạt động dựa trên mô hình MVC (Model-View-Controller), một kiến trúc phổ biến trong phát triển web giúp phân tách rõ ràng các phần khác nhau của ứng dụng. **Model** chịu trách nhiệm quản lý dữ liệu và logic nghiệp vụ, **View** quản lý giao diện người dùng, và **Controller** là cầu nối giữa Model và View, xử lý các yêu cầu của người dùng và trả về các phản hồi thích hợp.

### Tiếp Nhận Request

Tất cả các request từ trình duyệt đều được gửi đến tệp `index.php` trong thư mục `public`. Đây là điểm vào chính của ứng dụng. Tại đây, framework được khởi động thông qua phương thức `App::bootstrap()`, nơi các thành phần quan trọng như router, middleware, session, v.v., được cấu hình.

### Phân Tích Router

Sau khi khởi động, router có nhiệm vụ ánh xạ URL từ request đến các route được định nghĩa trước trong tệp `routes.php`. Router kiểm tra xem URL được yêu cầu có khớp với bất kỳ route đã đăng ký nào không. Nếu không tìm thấy, nó sẽ trả về lỗi 404.

### Xử Lý Middleware

Trước khi router gọi controller, middleware được kích hoạt nếu route có middleware đính kèm. Middleware là các lớp xử lý trung gian, được sử dụng để kiểm tra hoặc sửa đổi request trước khi chuyển tiếp. Ví dụ, middleware có thể kiểm tra xem người dùng đã đăng nhập chưa (auth) hoặc đảm bảo rằng chỉ những khách chưa đăng nhập mới có thể truy cập một số trang nhất định (guest). Nếu middleware phát hiện lỗi, request sẽ bị dừng lại và phản hồi được trả về ngay tại đó.

### Gọi Controller

Sau khi đi qua middleware, router gọi controller được chỉ định cùng với action (phương thức cụ thể). Controller nhận thông tin từ request, xử lý logic nghiệp vụ, và chuẩn bị dữ liệu để truyền cho View. Ví dụ, một controller có thể lấy dữ liệu người dùng từ cơ sở dữ liệu hoặc kiểm tra các điều kiện nghiệp vụ trước khi tiến hành.

### Kết Nối Với View Thông Qua Twig

Sau khi xử lý, controller thường kết thúc bằng cách gọi một template để hiển thị giao diện. PHPure sử dụng Twig, một template engine mạnh mẽ, để kết hợp dữ liệu từ controller và các template HTML đã định nghĩa. Twig cung cấp nhiều tính năng hữu ích như vòng lặp, kiểm tra điều kiện, và kế thừa layout, giúp việc xây dựng giao diện trở nên dễ dàng và linh hoạt.

### Trả Về Phản Hồi

Sau khi Twig tạo ra giao diện hoàn chỉnh (HTML), framework gửi nội dung đó trở lại trình duyệt dưới dạng phản hồi. Người dùng sẽ thấy trang web được hiển thị, hoàn chỉnh với dữ liệu đã được xử lý từ controller.

### Tóm Tắt

Vòng đời của một request trong PHPure bao gồm các bước từ việc nhận URL, phân tích và ánh xạ route, kiểm tra middleware, xử lý logic trong controller, và cuối cùng là hiển thị giao diện thông qua Twig. Kiến trúc MVC đảm bảo rằng mỗi phần của ứng dụng có một nhiệm vụ rõ ràng, giúp code dễ hiểu, dễ bảo trì và dễ mở rộng. Với luồng hoạt động rõ ràng này, ngay cả người mới bắt đầu cũng có thể nhanh chóng hiểu được cách ứng dụng hoạt động và bắt đầu phát triển các tính năng mới.

## Các Tính Năng Cốt Lõi

### Định Tuyến (Routing)

Định tuyến ánh xạ URL đến các hành động của controller và là một phần cơ bản của PHPure. Tất cả các route được định nghĩa trong `app/routes.php`. Lớp Router cung cấp cú pháp gọn gàng và trực quan để định nghĩa các loại route khác nhau:

```php
<?php
use Core\Http\Router;

$router = new Router();

// Route cơ bản: ánh xạ trang chủ đến phương thức index của HomeController
$router->get('', ['HomeController', 'index']);

// Route với tham số: ID bài viết động trong URL
$router->get('posts/{id}', ['PostController', 'show']);

// Route với middleware: Yêu cầu xác thực
$router->get('dashboard', ['DashboardController', 'index'])
    ->middleware('auth');

// Các phương thức HTTP khác nhau
$router->post('posts', ['PostController', 'store']);
$router->put('posts/{id}', ['PostController', 'update']);
$router->delete('posts/{id}', ['PostController', 'destroy']);

// Bắt đầu định tuyến
$router->dispatch();
```

Router tự động trích xuất tham số từ URL, làm cho chúng có sẵn cho các phương thức controller của bạn. Ví dụ, khi người dùng truy cập `/posts/5`, router sẽ truyền `5` dưới dạng tham số `$id` cho phương thức `show` của `PostController`.

### Middleware

Middleware hoạt động như một cơ chế lọc cho các HTTP request trong ứng dụng của bạn. Nó cung cấp cách thuận tiện để kiểm tra và lọc các request HTTP trước khi chúng đi vào ứng dụng. Middleware có thể thực hiện các tác vụ như:

- Xác thực: Kiểm tra xem người dùng đã đăng nhập chưa
- Phân quyền: Xác minh rằng người dùng có quyền truy cập vào tài nguyên
- Bảo vệ CSRF: Ngăn chặn tấn công giả mạo yêu cầu trên nhiều trang web
- Làm sạch đầu vào: Vệ sinh dữ liệu người dùng trước khi đến controllers

Trong PHPure, middleware được triển khai thông qua lớp `Middleware` trong namespace `Core\Http`. Bạn có thể áp dụng middleware cho các route như đã thấy trong ví dụ về định tuyến:

```php
// Áp dụng middleware auth cho một route
$router->get('dashboard', ['DashboardController', 'index'])
    ->middleware('auth');

// Áp dụng nhiều middleware cho một route (theo thứ tự)
$router->get('admin/settings', ['AdminController', 'settings'])
    ->middleware('auth')
    ->middleware('admin');
```

Tạo một middleware tùy chỉnh rất đơn giản:

```php
<?php
namespace App\Middleware;

use Core\Http\Middleware;
use Core\Session;

class AuthMiddleware extends Middleware
{
    public function handle(): bool
    {
        // Nếu người dùng chưa đăng nhập, chuyển hướng đến trang đăng nhập
        if (!Session::has('user_id')) {
            redirect('/login');
            return false; // Dừng xử lý request
        }

        return true; // Tiếp tục xử lý request
    }
}
```

Để đăng ký middleware của bạn, thêm nó vào trình giải quyết middleware trong quá trình bootstrap của ứng dụng:

```php
// Đăng ký middleware
Middleware::register('auth', \App\Middleware\AuthMiddleware::class);
Middleware::register('admin', \App\Middleware\AdminMiddleware::class);
```

Middleware cung cấp cách rõ ràng để tách biệt các vấn đề chung khỏi controllers của bạn, dẫn đến code dễ bảo trì và module hóa hơn.

### Models và ORM

PHPure cung cấp một hệ thống ORM (Object-Relational Mapping) nhẹ giúp các thao tác cơ sở dữ liệu trở nên trực quan và hướng đối tượng hơn. Models mở rộng từ lớp `Model` cơ sở và đại diện cho các bảng trong cơ sở dữ liệu:

```php
<?php
namespace App\Models;

use Core\Model;

class User extends Model
{
    // Định nghĩa bảng liên kết với model này
    protected string $table = 'users';

    // Bật soft delete nếu cần
    protected bool $softDelete = true;
}
```

Với định nghĩa model đơn giản này, bạn có thể thực hiện các thao tác cơ sở dữ liệu khác nhau:

```php
// Tìm người dùng theo ID
$user = User::find(1);

// Lấy tất cả người dùng
$users = User::all();

// Tạo người dùng mới
$user = new User();
$user->create([
    'name' => 'Nguyễn Văn A',
    'email' => 'nguyenvana@example.com',
    'password' => password_hash('secret', PASSWORD_DEFAULT)
]);

// Cập nhật người dùng
$user->update(['name' => 'Nguyễn Văn B'], 1);

// Xóa người dùng
$user->delete(1);

// Với soft delete được bật, khôi phục người dùng
$user->restore(1);

// Lấy chỉ những người dùng đã bị xóa mềm
$deletedUsers = User::onlyTrashed();
```

Lớp Model cũng cung cấp các phương thức quan hệ để định nghĩa kết nối giữa các bảng:

```php
// Quan hệ Một-Một
$profile = $user->hasOne(Profile::class, 'user_id');

// Quan hệ Một-Nhiều
$posts = $user->hasMany(Post::class, 'user_id');

// Quan hệ Nhiều-Nhiều
$roles = $user->belongsToMany(
    Role::class,
    'user_roles',
    'user_id',
    'role_id'
);
```

### Trình Xây Dựng Truy Vấn (Query Builder)

Đối với các truy vấn phức tạp hơn, PHPure cung cấp một trình xây dựng truy vấn linh hoạt thông qua lớp `Database`:

```php
use Core\Database;

// Truy vấn cơ bản
$users = Database::table('users')->get();

// Với điều kiện
$activeUsers = Database::table('users')
    ->where('status', '=', 'active')
    ->where('created_at', '>', '2023-01-01')
    ->orderBy('name')
    ->limit(10)
    ->get();

// Chỉ lấy bản ghi đầu tiên
$user = Database::table('users')
    ->where('email', '=', 'nguyenvana@example.com')
    ->first();

// Đếm số bản ghi
$count = Database::table('users')
    ->where('status', '=', 'active')
    ->count();

// Thêm bản ghi
Database::table('users')->insert([
    'name' => 'Nguyễn Văn A',
    'email' => 'nguyenvana@example.com'
]);

// Cập nhật bản ghi
Database::table('users')
    ->where('id', '=', 1)
    ->update(['status' => 'inactive']);

// Xóa bản ghi
Database::table('users')
    ->where('status', '=', 'inactive')
    ->delete();

// SQL thuần khi cần thiết
$results = Database::raw(
    "SELECT * FROM users WHERE email LIKE ?",
    ['%@example.com']
);
```

### Controllers

Controllers xử lý các request và điều phối logic ứng dụng. Các controllers trong PHPure mở rộng từ lớp `Controller` cơ sở:

```php
<?php
namespace App\Controllers;

use Core\Controller;
use App\Models\Post;
use Core\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        // Lấy tất cả bài viết
        $posts = Post::all();

        // Truyền dữ liệu cho view
        $this->render('posts/index', [
            'posts' => $posts,
            'title' => 'Tất Cả Bài Viết'
        ]);
    }

    public function show($id)
    {
        // Tìm bài viết theo ID
        $post = Post::find($id);

        // Xử lý trường hợp không tìm thấy
        if (!$post) {
            return $this->renderError(404, 'Không tìm thấy bài viết');
        }

        // Hiển thị view với dữ liệu bài viết
        $this->render('posts/show', [
            'post' => $post,
            'title' => $post->title
        ]);
    }

    public function store(Request $request)
    {
        // Tạo bài viết mới
        $post = new Post();
        $result = $post->create([
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'user_id' => $request->session('user_id')
        ]);

        // Chuyển hướng sau khi tạo thành công
        if ($result) {
            $this->redirect('/posts');
        }
    }
}
```

### Views với Twig

PHPure sử dụng Twig, một template engine mạnh mẽ, để hiển thị views. Twig cung cấp các tính năng như kế thừa template, tự động escaping, bộ lọc, và nhiều tính năng khác:

```twig
{# layout.twig #}
<!DOCTYPE html>
<html>
<head>
    <title>{% block title %}PHPure{% endblock %}</title>
    {{ vite_assets() }}
</head>
<body>
    <header>
        {% include 'partials/navigation.twig' %}
    </header>

    <main>
        {% block content %}{% endblock %}
    </main>

    <footer>
        {% include 'partials/footer.twig' %}
    </footer>
</body>
</html>

{# posts/index.twig #}
{% extends 'layout.twig' %}

{% block title %}{{ title }}{% endblock %}

{% block content %}
    <h1>Tất Cả Bài Viết</h1>

    {% for post in posts %}
        <article>
            <h2>{{ post.title }}</h2>
            <p>{{ post.content|slice(0, 200) }}...</p>
            <a href="{{ url('posts/' ~ post.id) }}">Đọc tiếp</a>
        </article>
    {% else %}
        <p>Không tìm thấy bài viết nào.</p>
    {% endfor %}
{% endblock %}
```

PHPure mở rộng Twig với một số hàm hữu ích:

- `asset()`: Tạo URL cho tài nguyên tĩnh
- `url()`: Tạo URL ứng dụng
- `session()`: Truy cập dữ liệu session
- `flash()`: Lấy và xóa thông báo flash
- `vite_assets()`: Bao gồm tài nguyên được xử lý bởi Vite

### Xác Thực Form

PHPure sử dụng Respect/Validation, một thư viện xác thực mạnh mẽ, để xác thực đầu vào form:

```php
use Core\Validation;
use Respect\Validation\Validator as v;

$validator = new Validation();
$valid = $validator->validate($_POST, [
    'name' => v::notEmpty()->alpha()->length(2, 50),
    'email' => v::notEmpty()->email(),
    'password' => v::notEmpty()->length(8, null)
]);

if (!$valid) {
    // Lấy lỗi xác thực
    $errors = $validator->errors();
    // Xử lý lỗi (ví dụ: hiển thị cho người dùng)
}
```

### Quản Lý Session

Lớp `Session` cung cấp một giao diện sạch sẽ để làm việc với session PHP:

```php
use Core\Session;

// Bắt đầu session (được framework tự động gọi)
Session::start();

// Lưu trữ dữ liệu
Session::set('user_id', 123);

// Lấy dữ liệu
$userId = Session::get('user_id');

// Kiểm tra nếu khóa session tồn tại
if (Session::has('user_id')) {
    // Thực hiện hành động
}

// Xóa một giá trị session cụ thể
Session::remove('user_id');

// Hủy toàn bộ session
Session::destroy();

// Flash message (dữ liệu tạm thời cho request tiếp theo)
Session::flash('success', 'Hồ sơ của bạn đã được cập nhật');

// Sau đó, lấy và xóa thông báo flash
$message = Session::flash('success');
```

### Ghi Log

Lớp `Logger`, được xây dựng trên Monolog, cung cấp khả năng ghi log mạnh mẽ:

```php
use Core\Logger;

// Ghi log ở các cấp độ khác nhau
Logger::debug('Thông tin debug chi tiết');
Logger::info('Người dùng đã đăng nhập', ['id' => 123]);
Logger::warning('Phát hiện hoạt động đáng ngờ');
Logger::error('Không thể kết nối đến cơ sở dữ liệu');
```

### Migration và Seeding với Phinx

PHPure tích hợp Phinx cho migration và seeding cơ sở dữ liệu:

```php
// Ví dụ tệp migration
use Phinx\Migration\AbstractMigration;

class CreateUsersTable extends AbstractMigration
{
    public function change()
    {
        $this->table('users')
            ->addColumn('name', 'string', ['limit' => 100])
            ->addColumn('email', 'string', ['limit' => 100])
            ->addColumn('password', 'string')
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime', ['null' => true])
            ->addIndex(['email'], ['unique' => true])
            ->create();
    }
}

// Ví dụ tệp seeder
use Phinx\Seed\AbstractSeed;

class UsersSeeder extends AbstractSeed
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

        $this->table('users')->insert($data)->save();
    }
}
```

Những tính năng cốt lõi này tạo nên nền tảng của PHPure, cung cấp các công cụ thiết yếu bạn cần cho việc phát triển web hiệu quả trong khi vẫn duy trì sự đơn giản và rõ ràng.
