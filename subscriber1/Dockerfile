FROM node:lts-alpine
WORKDIR /app
COPY package.json /app
RUN npm install typescript ts-node nodemon -g && npm install
COPY . /app
CMD ["npm", "start"]