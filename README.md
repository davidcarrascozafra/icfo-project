# icfo-project
Install Nginx server, php7, php7.2-fpm

sudo apt install nginx php7.2-fpm
Create structure directories for the project /home/ubuntu/icfo-project/

mkdir icfo-project
Modify /etc/nginx/sites-enabled/default:

    `location / {`
	`# First attempt to serve request as file, then`
	`# as directory, then fall back to displaying a 404.`
	`try_files $uri $uri/ =404;`
	`auth_basic	"Secure";`
	`auth_basic_user_file	/etc/nginx/.htpasswd;`
`}`

    `location /python {`
            `# First attempt to serve request as file, then`
            `# as directory, then fall back to displaying a 404.`
            `try_files $uri $uri/ =404;`
	`rewrite ^/python$ http://www.python.org/ permanent;`
`}`

    `location /days {`
            `# First attempt to serve request as file, then`
            `# as directory, then fall back to displaying a 404.`
            `#auth_basic      "Secure";`
            `#auth_basic_user_file    /etc/nginx/.htpasswd;`
    `}`

`# pass PHP scripts to FastCGI server`
`#`
`location ~* \.php$ {`
	`include snippets/fastcgi-php.conf;`

`#	# With php-fpm (or other unix sockets):`
	`fastcgi_pass unix:/run/php/php7.2-fpm.sock;`
	`include         fastcgi_params;`
		`fastcgi_param   SCRIPT_FILENAME    $document_root$fastcgi_script_name;`
		`fastcgi_param   SCRIPT_NAME        $fastcgi_script_name;`
`#	# With php-cgi (or other tcp sockets):`
`#	fastcgi_pass 127.0.0.1:9000;`
`}`

Modify the file /etc/php/7.2/fpm/php.ini

(({sed -i 's/;cgi.fix_pathinfo=1/cgi.fix_pathinfo=0/g' /etc/php/7.2/fpm/php.ini}))
