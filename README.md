
## About 
Сервис каждый час обновляет инфу о текущей температуре в Братске
и делает ее доступной по адресам:

* /weatherService/latest/json
* /weatherService/latest

В .env добавить **GISMETEO_API_TOKEN**

В **cron** добавить
`0 * * * * cd /path-to-your-project && ./vendor/bin/sail artisan weather:fetchCurrent >> /dev/null 2>&1 `
