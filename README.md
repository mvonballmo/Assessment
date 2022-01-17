# Bitcoin Price Tracker

The following instructions are for local testing and development.

See the [Development Journal](dev-notes.md) for how this project was developed.

## Requirements

- Docker
- Composer

## Setup

- `cd ./bitcoin-docker`
- `docker-compose up -d`
- Browse to [http://localhost:80](http://localhost:80)
- Browse to [http://localhost:8080](http://localhost:8080) for PHPMyAdmin

## Troubleshooting

If the database is created but the table is not, then the initialization script didn't run properly.

In that case, just open [PHPMyAdmin(http://localhost:8080) and execute the following SQL manually:

```sql
CREATE TABLE `BitcoinPrices` (
                                 `id` int(6) NOT NULL AUTO_INCREMENT,
                                 `price_in_usd` decimal(10,3) NOT NULL DEFAULT '',
                                 `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
                                 PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 PACK_KEYS=1;
```