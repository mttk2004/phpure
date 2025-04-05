# Tiêu Chuẩn Mã Nguồn PHP

## Giới thiệu

Dự án phpure tuân theo tiêu chuẩn PSR-12 và một số quy tắc bổ sung để đảm bảo tính nhất quán và dễ đọc của mã nguồn. Tài liệu này mô tả các tiêu chuẩn mã nguồn được sử dụng trong dự án và cách thực hiện kiểm tra và sửa lỗi mã nguồn.

## Tiêu chuẩn mã nguồn

Dự án tuân theo các tiêu chuẩn sau:

1. **PSR-12**: Tiêu chuẩn mã hóa mở rộng của PHP-FIG
2. **Cấu trúc mảng ngắn gọn**: Sử dụng cú pháp `[]` thay vì `array()`
3. **Sắp xếp import**: Các lệnh `use` được sắp xếp theo thứ tự chữ cái
4. **Không gian trắng**: Quy tắc về khoảng cách giữa các toán tử
5. **Định dạng PHPDoc**: Quy tắc về cách viết tài liệu cho code

## Cài đặt và sử dụng PHP-CS-Fixer

PHP-CS-Fixer là công cụ được sử dụng để kiểm tra và sửa mã nguồn theo các tiêu chuẩn đã định nghĩa. Công cụ này đã được cài đặt sẵn trong dự án.

### Cài đặt

PHP-CS-Fixer đã được cài đặt qua composer:

```bash
composer require --dev friendsofphp/php-cs-fixer
```

### Kiểm tra mã nguồn

Để kiểm tra xem mã nguồn của bạn có tuân thủ tiêu chuẩn không, sử dụng lệnh:

```bash
composer run format-check
```

Lệnh này sẽ quét toàn bộ mã nguồn và hiển thị các lỗi nếu có.

### Sửa lỗi tự động

Để tự động sửa các lỗi định dạng trong mã nguồn:

```bash
composer run format
```

## Cấu hình PHP-CS-Fixer

Cấu hình cho PHP-CS-Fixer được định nghĩa trong file `.php-cs-fixer.dist.php`. File này chỉ định các quy tắc và thư mục được quét.

### Các quy tắc chính

```php
return $config->setRules([
    '@PSR12' => true,
    'array_syntax' => ['syntax' => 'short'],
    'ordered_imports' => ['sort_algorithm' => 'alpha'],
    'no_unused_imports' => true,
    'not_operator_with_successor_space' => true,
    'trailing_comma_in_multiline' => true,
    'phpdoc_scalar' => true,
    'unary_operator_spaces' => true,
    'binary_operator_spaces' => true,
    'blank_line_before_statement' => [
        'statements' => ['break', 'continue', 'declare', 'return', 'throw', 'try'],
    ],
    'phpdoc_single_line_var_spacing' => true,
    'phpdoc_var_without_name' => true,
    'class_attributes_separation' => [
        'elements' => [
            'method' => 'one',
        ],
    ],
    'method_argument_space' => [
        'on_multiline' => 'ensure_fully_multiline',
        'keep_multiple_spaces_after_comma' => true,
    ],
    'single_trait_insert_per_statement' => true,
])
```

## Tích hợp liên tục (CI)

Nếu bạn đang sử dụng CI/CD, khuyến nghị thêm kiểm tra mã nguồn vào quy trình CI để đảm bảo mọi thay đổi đều tuân thủ tiêu chuẩn mã nguồn trước khi được hợp nhất.

### Ví dụ cho GitHub Actions

```yaml
name: PHP Coding Standards

on:
  push:
    branches: [main]
  pull_request:
    branches: [main]

jobs:
  phpcs:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v2
      - name: Set up PHP
        uses: shivammathur/setup-php@v2
        with:
          php-version: "8.0"
      - name: Install dependencies
        run: composer install --prefer-dist --no-progress
      - name: Check coding standards
        run: composer run format-check
```

## Lợi ích

Việc tuân thủ các tiêu chuẩn mã nguồn mang lại nhiều lợi ích:

1. **Tính nhất quán**: Mã nguồn nhất quán dễ đọc và hiểu hơn
2. **Dễ bảo trì**: Mã nguồn được định dạng tốt dễ bảo trì hơn
3. **Hợp tác**: Các tiêu chuẩn chung giúp các nhà phát triển làm việc hiệu quả hơn
4. **Giảm lỗi**: Một số lỗi cú pháp có thể được phát hiện và sửa chữa tự động
5. **Tuân thủ giấy phép MIT**: Tất cả các công cụ sử dụng trong dự án đều có giấy phép MIT, đảm bảo tính tương thích với giấy phép của phpure.
