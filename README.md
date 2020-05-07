# icfo-project
Install Nginx server, php7, php7.2-fpm

	sudo apt install nginx php7.2-fpm

Create structure directories for the project /home/ubuntu/icfo-project/

	mkdir icfo-project

Create a "icfo" user for Nginx:

	sudo htpasswd -c /etc/nginx/.htpasswd icfo	

Modify /etc/nginx/sites-enabled/default:

    location / {
	# First attempt to serve request as file, then
	# as directory, then fall back to displaying a 404.
	try_files $uri $uri/ =404;
	auth_basic	"Secure";
	auth_basic_user_file	/etc/nginx/.htpasswd;
	}

    location /python {
            # First attempt to serve request as file, then
            # as directory, then fall back to displaying a 404.
            try_files $uri $uri/ =404;
	    rewrite ^/python$ http://www.python.org/ permanent;
	}

    location /days {
            # First attempt to serve request as file, then
            # as directory, then fall back to displaying a 404.
            #auth_basic      "Secure";
	    #auth_basic_user_file    /etc/nginx/.htpasswd;
    	}

	# pass PHP scripts to FastCGI server
	#
     location ~* \.php$ {
		include snippets/fastcgi-php.conf;
		## With php-fpm (or other unix sockets):
		fastcgi_pass unix:/run/php/php7.2-fpm.sock;
		include         fastcgi_params;
		fastcgi_param   SCRIPT_FILENAME    $document_root$fastcgi_script_name;
		fastcgi_param   SCRIPT_NAME        $fastcgi_script_name;
		## With php-cgi (or other tcp sockets):
		#	fastcgi_pass 127.0.0.1:9000;
	}
Modifying this file, we can access directly to www.python.org when we type http://$URL/python

	rewrite ^/python$ http://www.python.org/ permanent;

We force an authetication with these sentences:

	auth_basic	"Secure";
	auth_basic_user_file	/etc/nginx/.htpasswd

Modify the file /etc/php/7.2/fpm/php.ini

	sed -i 's/;cgi.fix_pathinfo=1/cgi.fix_pathinfo=0/g' /etc/php/7.2/fpm/php.ini

Restart services

	sudo systemctl restart php7.2-fpm
	sudo systemctl restart nginx

MAIN Index:
We only have three link, two internals and one to the github documentaion.

	<a href="/python">
	<a href="/date">
	<a href="https://github.com/davidcarrascozafra/icfo-project ">

DATE Index:
The main action in this file is this form to select a date and Post it to "days.php" to process. I add some navigation buttons to help us.

	<form action="days.php" method="post">
 	 <input type="date" name="days">
 	 <p><input type="submit" value="CALCULATE">
 	 <input type="reset" value="RESET"><p>
	</form>

DATE days.php:
This file process selected date in the prev page and process it with this code:

	<?php 
 
	if (isset($_POST["days"]))
	{
		$now = date_create(date("Y-m-d"));
		$your_date = date_create($_POST["days"]);
		$datediff = date_diff($now,$your_date);
		echo $datediff->format("%R%a days");
	}
	?>

This code catch the selected date and convert to date.object:

	$your_date = date_create($_POST["days"]);

Obtain our date:

	$now = date_create(date("Y-m-d"));

It uses "date_diff" function to calculate the difference between two date.object:

	$datediff = date_diff($now,$your_date);

And shows the result selecting some date.object attributes:

	echo $datediff->format("%R%a days");
