# phpure 🚀

phpure là một framework MVC đơn giản được viết bằng PHP để giúp người mới học và khám phá cách hoạt 
động bên trong của một ứng dụng web theo mô hình MVC.

---

## **Gặp Gỡ phpure** 🌟

Ngoài kia có rất nhiều framework PHP mạnh mẽ như Laravel, Symfony, CodeIgniter, Zend, Yii, và 
nhiều framework khác nữa. Những công cụ này cung cấp vô số tính năng hữu ích, giúp việc phát triển ứng dụng web trở nên nhanh chóng và thuận tiện hơn. Tuy nhiên, đối với người mới học PHP, việc tiếp cận các framework lớn đôi khi có thể gây khó khăn và làm giảm hứng thú. Tôi từng rơi vào tình huống này khi mới làm quen với [Laravel](https://laravel.com). Với một người mới như tôi, Laravel thật phức tạp và đầy rẫy những "phép thuật" khó hiểu.

Đầu năm 2025, tôi bước vào học kỳ mới với nhiều môn học thú vị, trong đó có môn Lập trình Web và Ứng dụng nâng cao. Một trong những yêu cầu của môn học là xây dựng ứng dụng web PHP thuần túy (Pure PHP) theo mô hình MVC mà không sử dụng bất kỳ framework lớn nào như Laravel. Mục đích là để hiểu rõ cách các thành phần hoạt động từ gốc rễ. Nhận ra cơ hội này, tôi đã quyết định tạo ra `phpure` — một framework PHP đơn giản nhưng đủ mạnh mẽ để giúp những người mới bắt đầu dễ dàng nắm bắt cách xây dựng một ứng dụng web theo mô hình MVC. Tôi là [Mai Trần Tuấn Kiệt](https://github.com/mttk2004), một sinh viên IT chuyên ngành Phát triển Web và là người sáng lập `phpure`. Đây là dự án mã nguồn mở đầu tiên của tôi, và tôi rất vui được chia sẻ nó với bạn.

Tôi muốn gọi `phpure` là "framework dành cho người mới bắt đầu" vì nó được thiết kế đơn giản, 
gọn nhẹ, dễ hiểu và dễ sử dụng. Nếu bạn đang tìm hiểu PHP hoặc muốn hiểu rõ cách hoạt động của một ứng dụng web theo mô hình MVC, hãy thử trải nghiệm `phpure` để cảm nhận sự khác biệt. Điều thú vị là, nếu bạn có ý định học Laravel sau này, việc nắm vững cách vận hành của `phpure` sẽ giúp bạn rất nhiều, `phpure` được xây dựng với cấu trúc tương tự Laravel nhưng đơn giản và tinh gọn hơn. Là một fan cuồng nhiệt của Laravel, tôi đã cố gắng mang những yếu tố "tinh tế" của framework này vào `phpure`.

`phpure` không chỉ phù hợp để xây dựng các ứng dụng web đơn giản mà còn có thể mở rộng và tùy chỉnh theo ý muốn bằng cách thêm các tính năng mới. Tôi tin rằng, nếu bạn đang chuẩn bị bắt đầu học mô hình MVC với PHP, `phpure` sẽ là người bạn đồng hành đáng tin cậy.

Hãy cùng khám phá `phpure` và tạo ra những ứng dụng web tuyệt vời!

---

## **Bắt Đầu** 🚀

### **1. Hướng Dẫn Cài Đặt `phpure`** 📥

#### **Yêu Cầu Hệ Thống**
Để cài đặt và sử dụng `phpure`, bạn cần đảm bảo môi trường của mình đáp ứng các yêu cầu sau:
- **PHP**: Phiên bản từ 8.0 trở lên.
- **Composer**: Phiên bản từ 2.8.4 trở lên.
- **npm**: Phiên bản từ 11.0.0 trở lên.

#### **Các Bước Cài Đặt**

   Đầu tiên, mở terminal hoặc command prompt, sau đó chạy các lệnh dưới đây:
   ```bash
   git clone https://github.com/mttk2004/phpure.git
   cd my-php-mvc-framework
   ```  
   - **`git clone`**: Tải mã nguồn `phpure` từ GitHub về máy của bạn.
   - **`cd my-php-mvc-framework`**: Di chuyển vào thư mục vừa tải về.

Giờ đây, bạn đã sẵn sàng để thực hiện các bước tiếp theo như cài đặt các phụ thuộc và thiết lập dự án. 🚀

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
Thực hiện các thay đổi cần thiết trên branch mới của bạn. Đảm bảo rằng bạn tuân thủ các nguyên tắc coding và phong cách của dự án.

#### 4. Kiểm tra Thay Đổi
Chạy các bài kiểm tra để đảm bảo rằng những thay đổi của bạn không phá vỡ bất kỳ tính năng nào hiện có:
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
Cuối cùng, tạo một pull request từ repository của bạn về repository gốc. Hãy mô tả chi tiết những thay đổi bạn đã thực hiện và lý do tại sao.

#### 7. Liên hệ và Thảo Luận
Nếu bạn cần bất kỳ sự giúp đỡ nào, bạn có thể liên hệ với maintainer chính của dự án qua GitHub Issues hoặc Discussions.

#### Liên hệ Maintainer:
- **GitHub:** [mttk2004](https://github.com/mttk2004)

Chúng tôi rất mong nhận được sự đóng góp của bạn! Cảm ơn bạn đã giúp `phpure` trở nên tốt hơn.

---

_Last updated: January 12, 2025_
