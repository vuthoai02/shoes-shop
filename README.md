**HƯỚNG DẪN DEPLOY**
1. Cài đặt môi trường
- Cập nhật service:
    _sudo yum update -y_
    _sudo yum upgrade -y_
- Cài đặt Web Server:
    _sudo yum install httpd -y_
- Cài đặt package aws:
  Xác định đường dẫn được thiết lập:
    _which amazon-linux-extras_ (Kết quả hiện ra: _/usr/bin/amazon-linux-extras_)
  Cài đặt package:
    _sudo yum install -y amazon-linux-extras_
- Cài đặt ngôn ngữ PHP
  Kiểm tra các phiên bản có trong package aws:
    _sudo  amazon-linux-extras | grep php_
  Cài đặt version PHP:
    _sudo amazon-linux-extras enable php8.2_
  Cài đặt package PHP:
    _sudo yum clean metadata_
    _sudo yum install -y php php-{pear,cgi,common,curl,mbstring,gd,mysqlnd,gettext,bcmath,json,xml,fpm,intl,zip,imap}_
  Cài đặt mod_ssl(à mô đun Apache được sử dụng để hỗ trợ SSL v2/v3, TLS v1 và kích hoạt HTTPS trong Apache Web Server):
    _sudo yum install -y mod_ssl_
  Cài đặt mysql:
    _sudo yum install -y mysql mysqli_
  Cài đặt git:
    _sudo yum install -y git_
  Kiểm tra:
    _php -v_
    _mysql -v_
    _sudo sysyemctl status httpd_
2. Cấu hình Web Server và cơ sở dữ liệu
- Cấu hình Web Server:
  Cài đặt mã nguồn trang web:
    _git clone [link]_
  Chuyển tiếp mã nguồn vào thư mục hiển thị web của server:
    _sudo cp -R shoes_store/* /var/www/html
  Cấu hình file mặc định hiển thị trên web:
    Truy cập sửa đổi file httpd.conf:
      _sudo vi /etc/httpd/conf/httpd.conf_
    Tìm kiếm dòng có ghi:
      _<IfModule dir_module>
      DirectoryIndex index.html
      </IfModule>_
    Thêm index của file php vào, server sẽ tự động tìm kiếm file php và ưu tiên hiển thị file php:
      _<IfModule dir_module>
      DirectoryIndex index.php index.html
      </IfModule>_
  Khởi chạy web server:
    _sudo systemctl start httpd_
  Kiểm tra xem web server đã active chưa:
    _sudo systemctl status httpd_
- Cấu hình Database:
  Kiểm tra kết nối mysql và tồn tại database không:
    _mysql -h [endPoint RDS mysql] -u username - p_
    _show databases;_
  Tại thư mục có chứa tệp tin sql, thực hiện import file sql và database:
    _mysql -h [endPoint RDS mysql] -u username - p shoes < shoes_store.sql_
