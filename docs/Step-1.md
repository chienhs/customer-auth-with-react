## 1. Xác thực và Phân Quyền Người Dùng

-   Đăng ký/Đăng nhập: Xây dựng hệ thống xác thực người dùng.

-   Api : Registration, Login, logout -> custom tận gốc không dùng của thư viện

-   FE: Sử dụng andt và tự xậy dựng dự theo thiết của laravel bootcamp

## Luồng Đăng ký

-   Người dùng truy cập trang đăng ký:

-   Hiển thị form đăng ký với các trường như: tên, email, mật khẩu, xác nhận mật khẩu.
-   Người dùng điền thông tin và gửi form:

-   Frontend gửi yêu cầu POST đến API endpoint /register với dữ liệu người dùng.
    Backend nhận yêu cầu và xử lý:

-   Kiểm tra dữ liệu (email đã tồn tại, mật khẩu đủ mạnh, xác nhận mật khẩu khớp).
-   Nếu có lỗi, trả về thông báo lỗi cho frontend.
-   Nếu hợp lệ, mã hóa mật khẩu và lưu thông tin người dùng vào cơ sở dữ liệu.
-   Tạo một token xác thực (JWT hoặc session) và trả về cho frontend.
    Frontend nhận phản hồi:

-   Nếu đăng ký thành công, lưu token và chuyển hướng người dùng đến trang chủ hoặc dashboard.
-   Nếu có lỗi, hiển thị thông báo lỗi.

## Luồng Đăng nhập

-   Người dùng truy cập trang đăng nhập:

-   Hiển thị form đăng nhập với các trường: email, mật khẩu.
-   Người dùng điền thông tin và gửi form:

-   Frontend gửi yêu cầu POST đến API endpoint /login với dữ liệu người dùng.
-   Backend nhận yêu cầu và xử lý:

-   Xác thực email và mật khẩu (kiểm tra email có tồn tại và mật khẩu đúng).
-   Nếu có lỗi, trả về thông báo lỗi cho frontend.
-   Nếu hợp lệ, tạo một token xác thực (JWT hoặc session) và trả về cho frontend.
-   Frontend nhận phản hồi:

-   Nếu đăng nhập thành công, lưu token và chuyển hướng người dùng đến trang chủ hoặc dashboard.
-   Nếu có lỗi, hiển thị thông báo lỗi.

## Luồng Đăng xuất

-   Người dùng nhấp vào nút đăng xuất:

-   Frontend gửi yêu cầu POST đến API endpoint /logout.
-   Backend nhận yêu cầu và xử lý:

-   Hủy token xác thực (nếu sử dụng JWT, chỉ cần xóa token phía client; nếu sử dụng session, hủy session trên server).
-   Frontend nhận phản hồi:

-   Xóa token lưu trữ trên client và chuyển hướng người dùng đến trang đăng nhập.
