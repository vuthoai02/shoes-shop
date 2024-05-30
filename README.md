# HƯỚNG DẪN DEPLOY
## 1. Cài đặt môi trường
- Cập nhật service:
  
  >sudo yum update -y
  
  >sudo yum upgrade -y
  
- Cài đặt Web Server:
  
  >sudo yum install httpd -y
  
- Cài đặt package aws:
  
  - Xác định đường dẫn được thiết lập:
  
      which amazon-linux-extras
  
      (Kết quả hiện ra: _/usr/bin/amazon-linux-extras_)
  
  - Cài đặt package:
  
      >sudo yum install -y amazon-linux-extras
  
- Cài đặt ngôn ngữ PHP
  
  - Kiểm tra các phiên bản có trong package aws:
  
      >sudo  amazon-linux-extras | grep php
  
  - Cài đặt version PHP:
  
      >sudo amazon-linux-extras enable php8.2
  
  - Cài đặt package PHP:
  
      >sudo yum clean metadata
  
      >sudo yum install -y php php-{pear,cgi,common,curl,mbstring,gd,mysqlnd,gettext,bcmath,json,xml,fpm,intl,zip,imap}
  
  - Cài đặt mod_ssl(à mô đun Apache được sử dụng để hỗ trợ SSL v2/v3, TLS v1 và kích hoạt HTTPS trong Apache Web Server):
  
    >sudo yum install -y mod_ssl
  
- Cài đặt mysql:
  
    >sudo yum install -y mysql mysqli

- Cài đặt git:
  
    >sudo yum install -y git
  
- Kiểm tra:
  
    >php -v
  
    >mysql -v
  
    >sudo sysyemctl status httpd
  
## 2. Cấu hình Web Server và cơ sở dữ liệu
   
- Cấu hình Web Server:
  
  - Cài đặt mã nguồn trang web:
  
    >git clone [link]
  
  - Chuyển tiếp mã nguồn vào thư mục hiển thị web của server:
  
    >sudo cp -R shoes_store/* /var/www/html
  
  - Cấu hình file mặc định hiển thị trên web:
  
    - Truy cập sửa đổi file httpd.conf:

      >sudo vi /etc/httpd/conf/httpd.conf
  
    - Tìm kiếm dòng có ghi:
  
      ```
      <IfModule dir_module>
      DirectoryIndex index.html
      </IfModule>
      ```
  
    - Thêm index của file php vào, server sẽ tự động tìm kiếm file php và ưu tiên hiển thị file php:
  
      ```
      <IfModule dir_module>
          DirectoryIndex index.php index.html
      </IfModule>
      ```
      
  - Khởi chạy web server:
  
    >sudo systemctl start httpd
    
  - Kiểm tra xem web server đã active chưa:
  
    >sudo systemctl status httpd
    
- Cấu hình Database:
  
  - Kiểm tra kết nối mysql và tồn tại database không:
  
    >mysql -h [endPoint RDS mysql] -u username - p_
  
    >show databases;_
  
  - Tại thư mục có chứa tệp tin sql, thực hiện import file sql và database:
  
    >mysql -h [endPoint RDS mysql] -u username - p shoes < shoes_store.sql_
