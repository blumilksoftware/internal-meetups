FROM httpd:2.4-alpine

RUN sed -i "s/#LoadModule\ rewrite_module/LoadModule\ rewrite_module/" /usr/local/apache2/conf/httpd.conf;

COPY fpm.apache.conf /usr/local/apache2/conf/fpm.apache.conf
RUN echo "Include /usr/local/apache2/conf/fpm.apache.conf" >> /usr/local/apache2/conf/httpd.conf


COPY --from=composer /usr/bin/composer /usr/bin/composer


WORKDIR /app
