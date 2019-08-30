# Weather. Component for export weather data by location.

### Install
`composer install`

### Usage
`php console/index.php Севастополь json`

`php console/index.php Москва xml`


### Run tests
`./vendor/bin/codecept run unit domain/weatherData/GetWeatherDataServiceTest.php -c weather/codeception.dist.yml`
