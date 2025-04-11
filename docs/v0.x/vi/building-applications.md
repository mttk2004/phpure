# Xây Dựng Ứng Dụng với PHPure

Trong phần này, chúng ta sẽ cùng xây dựng một ứng dụng Danh Sách Công Việc (Todo List) hoàn chỉnh để minh họa cách PHPure hoạt động trong thực tế. Bằng cách làm theo hướng dẫn, bạn sẽ được trải nghiệm thực tế với các tính năng cốt lõi của framework và hiểu cách các thành phần khác nhau hoạt động cùng nhau.

## Ứng Dụng Todo List

Ứng dụng Todo của chúng ta sẽ cho phép người dùng:

- Xem danh sách các công việc
- Thêm công việc mới
- Đánh dấu công việc là hoàn thành hoặc chưa hoàn thành
- Xóa công việc

Bắt đầu xây dựng nào!

### Bước 1: Thiết Lập Dự Án

Trước tiên, hãy đảm bảo dự án PHPure của bạn được thiết lập và chạy đúng cách:

```bash
# Cài đặt các phụ thuộc PHP
composer install

# Cài đặt các phụ thuộc frontend
npm install

# Khởi động máy chủ phát triển
npm run dev:all
```

Script `dev:all` sẽ khởi động cả máy chủ PHP và Vite để biên dịch tài nguyên.

### Bước 2: Thiết Lập Cơ Sở Dữ Liệu

Hãy tạo một migration cho bảng `todos` sử dụng script đã được định nghĩa trong `composer.json`:

```bash
# Tạo một migration mới
composer run migrate:create CreateTodosTable
```

Lệnh này sẽ tạo một tệp migration mới trong thư mục `database/migrations`. Mở tệp đó và định nghĩa cấu trúc bảng:

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

Bây giờ chạy migration bằng script từ `composer.json`:

```bash
# Chạy migration
composer run migrate
```

Bạn có thể kiểm tra trạng thái migration với:

```bash
# Kiểm tra trạng thái migration
composer run migrate:status
```

### Bước 3: Tạo Model

Tạo một tệp mới `app/Models/Todo.php`:

```php
<?php

namespace App\Models;

use Core\Model;

class Todo extends Model
{
    // Định nghĩa bảng liên kết với model này
    protected string $table = 'todos';
}
```

Lớp đơn giản này cung cấp cho chúng ta tất cả các chức năng cần thiết để tương tác với bảng `todos`, nhờ vào hệ thống ORM của PHPure.

### Bước 4: Tạo Controller

Tạo tệp `app/Controllers/TodoController.php`:

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
    /**
     * Hiển thị danh sách tất cả công việc
     */
    public function index()
    {
        // Lấy tất cả công việc, sắp xếp theo ngày tạo (mới nhất trước)
        $todos = Todo::query()
            ->orderBy('created_at', 'DESC')
            ->get();

        // Render view với dữ liệu todos
        $this->render('todos/index', [
            'todos' => $todos,
            'title' => 'Danh Sách Công Việc'
        ]);
    }

    /**
     * Hiển thị form để tạo công việc mới
     */
    public function create()
    {
        $this->render('todos/create', [
            'title' => 'Tạo Công Việc Mới'
        ]);
    }

    /**
     * Lưu công việc mới
     */
    public function store()
    {
        // Xác minh token CSRF
        Form::verifyCsrfToken();

        // Xác thực đầu vào form
        $validator = new Validation();
        $valid = $validator->validate([
            'title' => v::notEmpty()->length(3, 255)
        ]);

        if (!$valid) {
            // Nếu xác thực thất bại, chuyển hướng trở lại với lỗi
            Session::flash('errors', $validator->errors());
            Session::flash('old_input', Request::all());
            redirect('/todos/create');
            return;
        }

        // Tạo công việc mới
        $todo = new Todo();
        $todo->create([
            'title' => Request::sanitize('title'),
            'completed' => false,
            'user_id' => Session::get('user_id') ?? null,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        // Chuyển hướng với thông báo thành công
        Session::flash('success', 'Thêm công việc thành công!');
        redirect('/todos');
    }

    /**
     * Chuyển đổi trạng thái hoàn thành của công việc
     */
    public function toggle($id)
    {
        // Tìm công việc theo ID
        $todo = Todo::find($id);

        // Kiểm tra xem công việc có tồn tại không
        if (!$todo) {
            Session::flash('error', 'Không tìm thấy công việc!');
            redirect('/todos');
            return;
        }

        // Chuyển đổi trạng thái hoàn thành và cập nhật
        $todo->update([
            'completed' => !$todo->completed,
            'updated_at' => date('Y-m-d H:i:s')
        ], $id);

        // Chuyển hướng trở lại danh sách
        redirect('/todos');
    }

    /**
     * Xóa một công việc
     */
    public function delete($id)
    {
        // Tìm công việc theo ID
        $todo = Todo::find($id);

        // Kiểm tra xem công việc có tồn tại không
        if (!$todo) {
            Session::flash('error', 'Không tìm thấy công việc!');
            redirect('/todos');
            return;
        }

        // Xóa công việc
        $todo->delete($id);

        // Chuyển hướng với thông báo thành công
        Session::flash('success', 'Xóa công việc thành công!');
        redirect('/todos');
    }
}
```

Controller này cung cấp tất cả các chức năng chúng ta cần cho ứng dụng Todo của mình.

### Bước 5: Định Nghĩa Routes

Bây giờ hãy thiết lập các route trong `app/routes.php`:

```php
<?php

use Core\Http\Router;

$router = new Router();

// Route trang chủ
$router->get('', ['HomeController', 'index']);

// Các route cho Todo
$router->get('todos', ['TodoController', 'index']);
$router->get('todos/create', ['TodoController', 'create']);
$router->post('todos', ['TodoController', 'store']);
$router->get('todos/{id}/toggle', ['TodoController', 'toggle']);
$router->get('todos/{id}/delete', ['TodoController', 'delete']);

// Khởi động router
$router->dispatch();
```

Các route này định nghĩa các URL mà người dùng có thể truy cập để tương tác với ứng dụng Todo của chúng ta.

### Bước 6: Tạo Views

Hãy tạo các template Twig cần thiết cho ứng dụng Todo của chúng ta.

Đầu tiên, tạo tệp layout ở `resources/views/layouts/app.html.twig`:

```twig
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ title ?? 'Ứng Dụng Todo' }} - PHPure</title>
    {{ vite_assets() }}
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-blue-600 text-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-xl font-bold">Ứng Dụng Todo PHPure</a>
            <ul class="flex space-x-4">
                <li><a href="{{ url('/') }}" class="hover:underline">Trang chủ</a></li>
                <li><a href="{{ url('/todos') }}" class="hover:underline">Công việc</a></li>
            </ul>
        </div>
    </nav>

    <main class="container mx-auto p-4 mt-6">
        {% block content %}{% endblock %}
    </main>

    <footer class="bg-gray-200 p-4 mt-10">
        <div class="container mx-auto text-center text-gray-600">
            &copy; {{ "now"|date("Y") }} Ứng Dụng Todo PHPure
        </div>
    </footer>
</body>
</html>
```

Tiếp theo, tạo trang index cho todos ở `resources/views/todos/index.html.twig`:

```twig
{% extends 'layouts/app.html.twig' %}

{% block content %}
    <div class="mb-6">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">Danh Sách Công Việc Của Tôi</h1>
            <a href="{{ url('/todos/create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Thêm Công Việc Mới
            </a>
        </div>

        {% if flash('success') %}
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 my-4 rounded" role="alert">
                {{ flash('success') }}
            </div>
        {% endif %}

        {% if flash('error') %}
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 my-4 rounded" role="alert">
                {{ flash('error') }}
            </div>
        {% endif %}
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        {% if todos|length > 0 %}
            <ul class="divide-y divide-gray-200">
                {% for todo in todos %}
                    <li class="p-4 flex justify-between items-center {% if todo.completed %}bg-gray-50{% endif %}">
                        <div class="flex items-center">
                            <span class="{% if todo.completed %}line-through text-gray-500{% endif %}">
                                {{ todo.title }}
                            </span>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ url('/todos/' ~ todo.id ~ '/toggle') }}"
                               class="{% if todo.completed %}bg-yellow-500 hover:bg-yellow-600{% else %}bg-green-500 hover:bg-green-600{% endif %} text-white px-3 py-1 rounded text-sm">
                                {% if todo.completed %}
                                    Đánh Dấu Chưa Hoàn Thành
                                {% else %}
                                    Đánh Dấu Hoàn Thành
                                {% endif %}
                            </a>
                            <a href="{{ url('/todos/' ~ todo.id ~ '/delete') }}"
                               class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm"
                               onclick="return confirm('Bạn có chắc chắn muốn xóa công việc này?')">
                                Xóa
                            </a>
                        </div>
                    </li>
                {% endfor %}
            </ul>
        {% else %}
            <div class="p-6 text-center text-gray-500">
                <p>Không tìm thấy công việc nào. Hãy tạo công việc đầu tiên của bạn!</p>
            </div>
        {% endif %}
    </div>
{% endblock %}
```

Cuối cùng, tạo form để thêm công việc mới ở `resources/views/todos/create.html.twig`:

```twig
{% extends 'layouts/app.html.twig' %}

{% block content %}
    <div class="bg-white shadow-md rounded-lg p-6 max-w-lg mx-auto">
        <h1 class="text-2xl font-bold mb-6">Tạo Công Việc Mới</h1>

        {% if flash('errors') %}
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mb-4 rounded" role="alert">
                <ul class="list-disc pl-5">
                    {% for field, errors in flash('errors') %}
                        {% for error in errors %}
                            <li>{{ error }}</li>
                        {% endfor %}
                    {% endfor %}
                </ul>
            </div>
        {% endif %}

        <form action="{{ url('/todos') }}" method="post">
            {{ csrf_field() }}

            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-medium mb-2">Tiêu Đề Công Việc</label>
                <input type="text"
                       name="title"
                       id="title"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ flash('old_input')['title'] ?? '' }}"
                       required>
                <p class="text-gray-600 text-sm mt-1">Nhập tiêu đề mô tả cho công việc của bạn</p>
            </div>

            <div class="flex justify-between">
                <a href="{{ url('/todos') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                    Hủy
                </a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    Lưu Công Việc
                </button>
            </div>
        </form>
    </div>
{% endblock %}
```

### Bước 7: Thêm Styles với Tailwind CSS

PHPure đi kèm với tích hợp Tailwind CSS. Hãy thiết lập một số style cơ bản cho ứng dụng Todo của chúng ta. Tạo hoặc chỉnh sửa tệp `resources/css/app.css`:

```css
@tailwind base;
@tailwind components;
@tailwind utilities;

/* Các style tùy chỉnh có thể được thêm vào đây */
```

### Bước 8: Khởi Động Ứng Dụng

Bây giờ hãy chạy ứng dụng của chúng ta:

```bash
# Khởi động máy chủ phát triển với hot reloading
npm run dev:all
```

Truy cập `http://localhost:8000` trong trình duyệt của bạn để xem ứng dụng Todo hoạt động.

## Cách Tất Cả Hoạt Động Cùng Nhau

Hãy dành một chút thời gian để hiểu cách các phần khác nhau của ứng dụng hoạt động cùng nhau:

1. **Vòng Đời Request**: Khi người dùng truy cập một URL, request đi qua hệ thống routing của PHPure, nó sẽ ánh xạ URL đến action controller thích hợp.

2. **Controllers**: `TodoController` của chúng ta xử lý logic nghiệp vụ, như truy xuất công việc từ cơ sở dữ liệu, xác thực đầu vào biểu mẫu và render views.

3. **Models**: Model `Todo` cung cấp một giao diện hướng đối tượng đến cơ sở dữ liệu, cho phép chúng ta dễ dàng tạo, đọc, cập nhật và xóa bản ghi.

4. **Views**: Các template Twig định nghĩa cấu trúc HTML của ứng dụng và hiển thị dữ liệu động được truyền từ controllers.

5. **CSS Styling**: Tailwind CSS cung cấp các lớp tiện ích để tạo style cho ứng dụng mà không cần viết CSS tùy chỉnh.

6. **Xử Lý Form**: Chúng ta sử dụng các tính năng xử lý form và xác thực của PHPure để xử lý đầu vào người dùng một cách an toàn.

7. **Thông Báo Flash**: Thông báo flash phiên cho phép chúng ta hiển thị phản hồi cho người dùng sau khi gửi biểu mẫu hoặc các hành động khác.

## Mở Rộng Ứng Dụng

Từ đây, bạn có thể mở rộng ứng dụng theo nhiều cách:

- Thêm xác thực người dùng để cho phép mỗi người dùng quản lý các công việc của riêng họ
- Triển khai danh mục hoặc thẻ cho công việc
- Thêm ngày đến hạn và cấp độ ưu tiên
- Tạo chức năng tìm kiếm hoặc lọc
- Thêm tùy chọn sắp xếp

Kiến trúc linh hoạt của PHPure giúp dễ dàng thêm các tính năng này khi ứng dụng của bạn phát triển.

## Kết Luận

Thông qua ứng dụng Todo đơn giản này, bạn đã thấy cách PHPure cung cấp một cấu trúc rõ ràng, có tổ chức để xây dựng ứng dụng web. Các thành phần của framework hoạt động cùng nhau một cách liền mạch, cho phép bạn tập trung vào việc xây dựng tính năng thay vì lo lắng về cơ sở hạ tầng.

Khi bạn tiếp tục làm việc với PHPure, bạn sẽ phát hiện ra rằng thiết kế đơn giản của nó giúp dễ dàng hiểu những gì đang xảy ra ở mỗi bước, làm cho nó trở thành một công cụ học tập tuyệt vời cho phát triển PHP.
