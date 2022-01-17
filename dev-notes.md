# TODO

- ~~Set up Docker~~
- ~~Set up Mysql~~
- ~~Get price~~
- ~~Show price with SSR~~
- ~~Get historical prices from database~~
- ~~Show historical prices~~
- Store price
- Purge prices older than 120 days
- Clean up style/formatting
- Create API instead of SSR
- Generate React client to query API

# Developer Notes

- Create folder
- Set up README
- Commit to Git
- Share on GitHub
- Set up Docker
  - Configure database
  - Set up schema for table
- Set up PHP server w/PHPMyAdmin
- Install Compose into project
- Install PHPUnit
- Verify PHP is up and running
- Find out how to get Bitcoin exchange rate
- Find [better page for getting exchange rate ](https://developers.coinbase.com/docs/wallet/guides/price-data)
- Update PHP display code (clean up gross copy/pasted code)
- Set up cheap and insecure connection to MySql (password is in PHP file 🤔)
- Error; Hmmmm
- Password on database seems to be wrong
- Shell into Docker image for database
- Verify that database set in docker-compose.yml is not correct
- Well, it was correct, but I wrote "localaccess", which included the quotes in the password 🤷🏼‍♂️
- Rebuild db image (otherwise the new password isn't picked up...)
- All right. Docker doesn't want to pick up the new password
- Moving on...
- I'll have to create the schema manually in PHPMyAdmin because the shell script didn't like the quotes in the password
- OK. Halfway through the time. Let's make sure we get it done, then make it pretty
- Everything goes in the index.php until we have functional coverage
- Finished getting prices
- Fixed up page formatting a bit
- Now for storing...
- Storage done
- Working on purging old records