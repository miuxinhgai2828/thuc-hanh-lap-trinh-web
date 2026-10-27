# CRUD – Quản lý tài khoản Ban tổ chức

## 1. Mục tiêu
Hoàn thiện và kiểm thử các thao tác CRUD đối với bảng tài khoản Ban tổ chức trong project Quản lý sự kiện sinh viên:
- **Create:** Tạo tài khoản Ban tổ chức.
- **Read:** Hiển thị danh sách tài khoản.
- **Update:** Chỉnh sửa thông tin tài khoản.
- **Delete:** Xóa tài khoản theo quy tắc liên kết dữ liệu của hệ thống. Nếu tài khoản có dữ liệu liên quan, ưu tiên khóa tài khoản hoặc xử lý liên kết an toàn thay vì xóa trực tiếp.

Bổ sung chức năng tìm kiếm theo tên, email hoặc tên câu lạc bộ.

## 2. Phạm vi chức năng

| Chức năng | Mô tả | Kết quả mong đợi |
|---|---|---|
| Thêm (Create) | Nhập họ tên, email, câu lạc bộ và mật khẩu ban đầu | Tài khoản hợp lệ được lưu vào cơ sở dữ liệu |
| Xem (Read) | Hiển thị danh sách tài khoản Ban tổ chức | Danh sách lấy từ cơ sở dữ liệu, không phải dữ liệu viết cứng |
| Sửa (Update) | Cập nhật thông tin được phép sửa | Thông tin mới được lưu và hiển thị sau khi tải lại trang |
| Xóa/Khóa (Delete) | Xóa hoặc khóa tài khoản theo quy tắc của hệ thống | Không làm hỏng dữ liệu liên quan đến câu lạc bộ hoặc sự kiện |
| Tìm kiếm | Tìm theo tên, email hoặc câu lạc bộ | Danh sách kết quả phù hợp với từ khóa |

## 3. Năm test case nhập dữ liệu đúng/sai

| STT | Dữ liệu kiểm thử | Thao tác | Kết quả mong đợi | Phân loại |
|---|---|---|---|---|
| TC01 | Họ tên hợp lệ; email hợp lệ chưa tồn tại; câu lạc bộ hợp lệ; mật khẩu đạt yêu cầu | Tạo tài khoản | Tạo thành công; tài khoản xuất hiện trong danh sách | Đúng |
| TC02 | Để trống họ tên hoặc email | Tạo tài khoản | Hiển thị thông báo yêu cầu nhập trường bắt buộc; không lưu dữ liệu | Sai |
| TC03 | Email sai định dạng, ví dụ `abc@` | Tạo tài khoản | Hiển thị thông báo email không hợp lệ; không lưu dữ liệu | Sai |
| TC04 | Email đã được tài khoản khác sử dụng | Tạo tài khoản | Hiển thị thông báo email đã tồn tại; không tạo tài khoản trùng | Sai |
| TC05 | Họ tên và email hợp lệ | Sửa thông tin một tài khoản, lưu rồi tải lại trang | Thông tin mới vẫn được hiển thị chính xác | Đúng |

## 4. Truy vấn SQL tham khảo cho chức năng tìm kiếm

```sql
SELECT *
FROM tai_khoan
WHERE ho_ten LIKE :tu_khoa
   OR email LIKE :tu_khoa
ORDER BY id DESC;
```

## 5. Checklist kiểm thử

- [ ] Tạo tài khoản hợp lệ và kiểm tra dữ liệu trong cơ sở dữ liệu.
- [ ] Thử gửi biểu mẫu thiếu trường bắt buộc.
- [ ] Thử email sai định dạng.
- [ ] Thử email bị trùng.
- [ ] Sửa tài khoản, tải lại trang và kiểm tra dữ liệu vẫn còn.
- [ ] Tìm kiếm bằng một phần tên hoặc email.
- [ ] Kiểm tra thao tác xóa/khóa không làm ảnh hưởng dữ liệu liên quan.
- [ ] Kiểm tra quyền truy cập để chỉ người có quyền quản trị mới được thực hiện thao tác.