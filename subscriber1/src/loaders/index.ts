import express from 'express';
import expressLoader from './express';

export default async (expressApp: express.Application) => {
  //load express app
  expressLoader(expressApp);
};
