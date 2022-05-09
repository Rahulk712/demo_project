#######################################################
FROM centos:7
RUN yum install -y lynx wget rsync vim bash-completion curl unzip net-tools git httpd httpd-tools sed
RUN mkdir -p /home/skblistaging.baryons.net/public_html;
RUN yum -y install https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm 
RUN yum -y install https://rpms.remirepo.net/enterprise/remi-release-7.rpm
COPY . /home/skblistaging.baryons.net/public_html
RUN yum -y install yum-utils 
RUN yum-config-manager --enable remi-php74;yum update -y;yum install php php-cli -y;
RUN yum install php  php-cli php-fpm php-mysqlnd php-zip php-devel php-gd php-mcrypt php-mbstring php-curl php-xml php-pear php-bcmath php-json -y
EXPOSE 80
WORKDIR /home/skblistaging.baryons.net/public_html
####Basic packages 
###disable selinux, disable firewall and hostname:
#RUN sed -i 's/SELINUX=enforcing/SELINUX=disabled/g' /etc/selinux/config
#RUN systemctl stop firewalld
#RUN systemctl disable firewalld
RUN yum install -y epel-release
RUN yum install -y htop
###customizing the httpd configuration file for multiple projects ##default config....###
RUN sed -i 's/DirectoryIndex index.html/DirectoryIndex index.html index.php/g' /etc/httpd/conf/httpd.conf
###this is the virtual host configuration for the projects  ### Default config...###
RUN echo "<VirtualHost *:80>" >> /etc/httpd/conf/httpd.conf
RUN echo "DocumentRoot /home/skblistaging.baryons.net/public_html" >> /etc/httpd/conf/httpd.conf
RUN echo "ServerName solutions3.baryons.net" >> /etc/httpd/conf/httpd.conf
RUN echo "</VirtualHost>" >> /etc/httpd/conf/httpd.conf

RUN sed -i 's/AllowOverride none/AllowOverride all/g' /etc/httpd/conf/httpd.conf
RUN sed -i 's/AllOverride none/AllOverride none/g' /etc/httpd/conf/httpd.conf
RUN sed -i 's/UserDir disabled/# UserDir disabled/g' /etc/httpd/conf.d/userdir.conf
RUN sed -i 's/#UserDir public_html/UserDir public_html/g' /etc/httpd/conf.d/userdir.conf

ENTRYPOINT ["/usr/sbin/httpd","-D","FOREGROUND"]


