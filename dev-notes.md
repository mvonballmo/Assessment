# TODO

- ~~Set up Docker~~
- ~~Set up Mysql~~
- ~~Get price~~
- ~~Show price with SSR~~
- ~~Get historical prices from database~~
- ~~Show historical prices~~
- ~~Store price~~
- ~~Purge prices older than 120 days~~
- ~~Clean up style/formatting~~
- Add tests for purging and retrieval
- Change API to REST instead of using and access with reactive client

# Developer Notes

1. Create folder
2. Set up README
3. Commit to Git
4. Share on GitHub
5. Set up Docker
   - Configure database
   - Set up schema for table
6. Set up PHP server w/PHPMyAdmin
7. Install Compose into project
8. Install PHPUnit
9. Verify PHP is up and running
10. Find out how to get Bitcoin exchange rate
11. Find [better page for getting exchange rate ](https://developers.coinbase.com/docs/wallet/guides/price-data)
12. Update PHP display code (clean up gross copy/pasted code)
13. Set up cheap and insecure connection to MySql (password is in PHP file 🤔)
14. Error; Hmmmm
15. Password on database seems to be wrong
16. Shell into Docker image for database
17. Verify that database set in docker-compose.yml is correct
18. Well, it was correct, but I wrote "localaccess", which included the quotes in the password 🤷🏼‍♂️
19. Rebuild db image (otherwise the new password isn't picked up...)
20. All right. Docker doesn't want to pick up the new password
21. Moving on...
22. I'll have to create the schema manually in PHPMyAdmin because the shell script didn't like the quotes in the password
23. OK. Halfway through the time. Let's make sure we get it done, then make it pretty
24. Everything goes in the index.php until we have functional coverage
25. Finished getting prices
26. Fixed up page formatting a bit
27. Now for storing...
28. Storage done
29. Working on purging old records
30. Records can be purged
31. Add styles
32. Review:
    - Docker setup
    - Readme
    - Implementation
    - Notes
33. That's all I've got time for. POC is ready. Have to add tests for Common.php later.