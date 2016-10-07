FROM h1bertobarbosa/php7-nginx

RUN userdel -r deploy

RUN rm /etc/nginx/sites-available/simplescrum
RUN rm /etc/nginx/sites-enabled/simplescrum

RUN apt-get update && apt-get install -y \
	sudo \ 
	git

RUN apt-get upgrade -y

### CHANGE HERE YOUR GROUP ID TO DEVELOPMENT
ENV PERM_GROUP_ID 1000

### CHANGE HERE YOUR USER ID TO DEVELOPMENT
ENV PERM_USER_ID 1000

### CREATE GROUP FOR DEVELOPMENT
RUN groupadd --gid ${PERM_GROUP_ID} deploy

### CREATE USER FOR DEVELOPMENT
RUN echo "%sudo ALL=(ALL) NOPASSWD: ALL" >> /etc/sudoers && \
   useradd -u ${PERM_USER_ID} -G users,www-data,sudo -g deploy -d /deploy --shell /bin/bash -m deploy && \
   echo "secret\nsecret" | passwd deploy

### IMPORT FILES TO ENVIRONMENT
COPY ./bash.bashrc       /deploy/.bashrc
COPY ./docker-entrypoint.sh /etc/entrypoint.sh
COPY ./server.default /etc/nginx/sites-available/default

RUN chmod +x /etc/entrypoint.sh
RUN chown deploy:deploy /deploy/.bashrc
RUN composer self-update

### SET DEFAULT USER TO DEVELOPMENT
USER deploy
WORKDIR /var/www/portabilis

EXPOSE 80

CMD ["/bin/bash"]
ENTRYPOINT ["/etc/entrypoint.sh"]
