# HelloLera

**Test php-project of the Telegram Bot, without third-party libraries**

_Main notes:_
- place the bot code only on the https domain;
- register bot with the BotFather;
- register webhook https://api.telegram.org/bot\<token\>/setWebhook?url=https:path_to_webhook_file.php
- full information: https://core.telegram.org/bots/api/

_Commands of this bot_
- /help - information
- /alientest - comic test to identify aliens among us

_Used features:_
- sending text messages;
- sending text messages with custom keyboard for answering;
- processing a commands;
- working with mySql database