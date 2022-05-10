#### Pulling the image from docker hub repository and other centos/mariadb55-centos7
FROM mariadb
#### Updating the packages
#RUN yum -y update
#### installing the basic packages
#RUN yum install -y lynx wget rsync vim bash-completion curl unzip net-tools
#### Exporting the ports outside
EXPOSE 3306
### running the service
CMD ["mysqld"]

