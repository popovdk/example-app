
# Nginx instance
FROM alpine:3.20
RUN apk add --no-cache \
    tzdata nginx nginx-mod-http-brotli \
    && rm -rf /var/cache/apk/ \
    && rm -rf /root/.cache \
    && rm -rf /tmp/* \
## Create nginx fastcgi_cache_path cache
    && mkdir /var/cache/nginx \
    && chown nginx:nginx /var/cache/nginx
USER nginx
COPY ./docker/nginx/config/ /etc/nginx/
WORKDIR /var/www/html

COPY --chown=nginx:nginx --from=app-builder:latest /var/www/html/public ./public

EXPOSE 8080
ENTRYPOINT ["nginx"]
CMD ["-g", "daemon off;"]
