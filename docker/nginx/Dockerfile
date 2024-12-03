FROM nginx:1.26.2-alpine-slim
RUN apk add --no-cache gettext
COPY conf/default.conf.template /etc/nginx/templates/default.conf.template
CMD ["/bin/sh", "-c", "envsubst '${SCHOOL_ERP_BACKEND_PORT}' < /etc/nginx/templates/default.conf.template > /etc/nginx/conf.d/default.conf && nginx -g 'daemon off;'"]
