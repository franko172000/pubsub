import { Body, Controller, Get, Params, Post } from 'routing-controllers';
import { Service } from 'typedi';
import config from '../../config';
import { SubscriberDTO } from './dto/dto/subscriber.dto';
const store = require('data-store')({ path: config.filePath });

@Service()
@Controller('/subscribe')
export class SubscriberController {
  @Post('/:topic')
  async subscribe(@Params() params: any, @Body() body: SubscriberDTO) {
    store.set(params.topic, params.topic);
    const { url, topic } = body;
    return {
      url,
      topic,
    };
  }
}
