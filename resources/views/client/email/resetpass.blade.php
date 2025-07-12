<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <h1>Quên mật khẩu</h1>
    <p>Xin chào {{ $email }}!</p>
    <p>Đây là email đặt lại mật khẩu.</p>
    <p>Hãy nhấp vào đường dẫn này </p>

    <a href="{{ route('fromDoiMatKhau', ['customer_token' => $random]) }}">Tạo mới mật khẩu</a>
    <br>
    <p>Thời gian gửi: {{ now() }}</p>
</body>
</html>