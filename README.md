# This is a work in progress  [![endorse](http://api.coderwall.com/jcode/endorse.png)](http://coderwall.com/jcode)
### Most functions will work however some many not.
<br/><br/>

Server Notification Scripts
-------
This is a small collection of scripts and functions I've made to interact with Twitter and MailGun to alert people hosted on the PartyCat Network as to what is happening with the server in real time.
If the server is under high load, running out of memory or using the database too much it will 'tweet' away letting people know what's going on.

<br/><br/>
Uptime
-------
At the start of the month the script will get the uptime of the server, format it into a human readable string and proudly show everyone how long it's been since the last restart.
<br/><br/>
Error logs
-------
Every day call out people and their websites who generate error. After this script is run, the logrotate script should be executed over the offending logs, stopping old errors from being counted towards the new days total. 
<br/><br/>
Network Activity
-------
Each month, show the sent and received data, formatted into categories based on the size of the data. For example, for data over 1023MB, display it as 1GB. This is sometimes referred to has Human Readable Format (HRF)
<br/><br/>
Disk Usage
-------
Here we keep an eye out to make sure the disk doesn't fill up and ruin everybodies day. Full disks are the worst when you want to upload pictures.
<br/><br/>
Network Load
-------
Checks the other servers on the PartyCat Network (Although you can make your own network load checker).
Database schema not available just yet, still working on features for this.
<br/><br/>
Database Load
-------
Don't you just hate it when certain scripts (I'm looking at you WordPress) overuse the database and make it slow for everyone else? I sure do, and now I can monitor database load and access without watching the server every minute of the day.
<br/><br/>
Server Load
-------
A simple load checker that notifys everyone when your server has too much on its plate and would rather throw it all in the bin. 
<br/><br/>
Memory Monitor
-------
Watches server RAM and Swap, tell everyone when it gets out of hand. 
