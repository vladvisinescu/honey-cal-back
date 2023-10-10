git clone --depth 1 --branch latest https://github.com/php-amqp/php-amqp.git
cd php-amqp
phpize
./configure
make
make install
