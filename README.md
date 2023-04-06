# decembre_de_fleur
<pre>
how to setting virtual host 

C:\Windows\System32\drivers\etc
127.0.0.1       eshop.abc

C:\xampp\apache\conf\extra
<VirtualHost *:80>
    DocumentRoot "C:\xampp\htdocs\eshop"
    ServerName eshop.abc
    ##ErrorLog "logs/dummy-host2.example.com-error.log"
    ##CustomLog "logs/dummy-host2.example.com-access.log" common
</VirtualHost>
</pre>
