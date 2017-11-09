README

myVotePH User Manual

myVotePH is a website that seeks to track the progress of the 2016 Philippine Presidential Elections.
To do this, it monitors all twitter activity related to each of the five candidates, and displays
this data in three sections: Twitter Activity, Recent Tweets, and Top Tweets.

The home page of the website is found in public/home.php. On this page are pictures of all five candidates.
Clicking on a picture sends the user to that candidate's page, where information on his/her twitter activity
can be found.

On the candidate's page, twitter activity is a graph displaying the total number of tweets containing the name
of the candidate per hour. The chart is generated using the Chart.js library. If the user hovers his cursor over
the chart, tooltips will emerge informing on each data point: specifically, the hour and number of tweets are shown.
In order to gather this data, my website uses the Twitter Streaming API, and downloads all tweets related to
the candidates to a php MyAdmin SQL database. When the user loads the webpage, an asynchronous HTTP request is sent via
AJAX to a php file on my server. This file makes query requests to the database, and returns the number of tweets per hour.

Recent tweets uses the twitter REST API to ask twitter for all recent tweets related to a candidate. The API is asked to
return a maximum of 10 tweets.

Top tweets is like recent tweets, but twitter is asked to return popular tweets. This is measured in number of 'favorite's
and number of 'retweets', as well as the reach of the user (followers+friends).

Interesting trends can be noticed. For example there is a daily spike of tweeting at around 9pm. Where the site returns 0 tweets,
this usually means that my server's connection to twitter was lost. This could be because I hadn't started the listener yet, or
because I had to make a change. Giant spikes in twitter activity correspond to new advertisements or news items being released.


Design of myVotePH

The most important part of this website is the twitter_stream.php file and the
ctwitter_stream.php file. The first thing to do is php the twitter_stream.php file,
after specifying the key words relating to various candidates. This file will then
pass this information to ctwitter_stream.php. ctwitter_stream.php is a listener which
runs on an infinite loop (should always be running on one ide terminal. its purpose
is to use the twitter streaming api to receive all tweets related to the candidate
keywords as they happen. The tweet is then stored in the sql database. Most of the
code code for ctwitter_stream was sourced from the internet, however the process_tweet
function is where I specify how each tweet should be treated as it comes in. This
function checks which candidate the tweet is pertinent to. It does this by using the 
strpos function to check whether certain candidate keywords are present. If they are,
a boolean variable for that candidate is set to true. The function then stores the tweet
in the sql database, along with which candidates it is germane to.

The fetch.php file is integral to the Twitter Activity section of the website. Its purpose
is to query the database as to how many tweets were made in each of the 168 hours (1 week) previous to
current time. It then returns a JSON file to whichever webpage requested it with this information.

fetch_top.php is important to the recent tweets and top tweets sections of the website. This is mostly
adapted code from another developer. Its purpose is the use the twitter 'rest' api to
search for all recent tweets, and then all popular tweets relevant to the candidates, and return a JSON
file with this information.

CS50's render function has been changed so that it renders header, then twitter_form, then footer.

The public/home.php contains the home page of the website. it contains links to gpoe.php, jbinay.php,
rduterte.php, and msantiago.php, and mroxas.php, which render each of the candidate's pages.

header.php displays the candidates image.
footer.php merely displays some footer text.
twitter_form.php displays the middle of the webpage. it calls the javascript functions plot, fetch_recent, and fetch_top.
plot takes information from fetch.php on how many tweets were made per hour, then displays the information in a graph.
fetch_recent and fetch_top interact with fetch_top.php in order to get the most recent and most popular tweets pertinent to
the candidate. Both these functions generate html document elements (rows in the table) in order to display
different numbers of tweets.

Thank you and enjoy!