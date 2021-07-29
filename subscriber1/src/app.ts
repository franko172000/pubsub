import 'reflect-metadata';
import express from 'express';
import http from 'http';
import Logger from './loaders/logger';
import loader from './loaders';
import redis from 'redis';
import config from './config';
import dotenv from 'dotenv';
dotenv.config();
const store = require('data-store')({ path: config.filePath });

const app = express();

const client = redis.createClient({
  host: process.env.REDIS_SERVER,
  port: parseInt(process.env.REDIS_PORT),
});
const subscriber = client;
subscriber.on('pmessage', function (pattern, channel, message) {
  if (store.has(channel)) {
    console.log({
      topic: channel,
      data: JSON.parse(message)
    });
  }
});

subscriber.psubscribe('*');

// /**
//  * Use TypeDI as TypeORM dependency injector
//  */
// useContainer(Container);

export const startServer = async () => {
  //load initial dependencies
  await loader(app);

  /**
   * Get port from environment and store in Express.
   */
  const port = 3000;
  const server = http.createServer(app);

  /**
   * Listen on provided port, on all network interfaces.
   */
  server.listen(port);
  server.on('error', err => {
    Logger.error(err);
    process.exit(1);
  });

  server.on('listening', () => {
    const addr = server.address();
    const bind = typeof addr === 'string' ? 'pipe ' + addr : 'port ' + addr.port;
    Logger.info('Listening on' + bind);
    console.log('Listening on ' + bind);
  });
};

startServer();
