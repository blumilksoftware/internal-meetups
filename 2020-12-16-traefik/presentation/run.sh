docker-compose up -d && \
docker-compose exec node npm install && \
docker-compose exec node node serve.js
