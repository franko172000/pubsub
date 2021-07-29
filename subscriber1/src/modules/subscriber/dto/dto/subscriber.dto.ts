import { IsNotEmpty, IsString } from 'class-validator';

export class SubscriberDTO {
  @IsString()
  @IsNotEmpty()
  url: string;
}
