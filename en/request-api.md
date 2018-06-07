# Requesting Twitter’s API

Twitter plugin allows you to perform requests on the Twitter API from inside templates.

## Perform GET requests

Sends a GET request and returns the API response. You can use any GET request listed in [Twitter REST API](https://dev.twitter.com/docs/api/1.1).

    {% set tweets = craft.twitter.get( uri ) %}

## Display Tweets

This example displays recent tweets by calling `statuses/user_timeline` API method :

    {% set tweets = craft.twitter.get('statuses/user_timeline') %}
    
    {% if tweets %}
    
        <h2>Recent Tweets</h2>
    
        <ul>
            {% for tweet in tweets %}
                <li>{{tweet.text}}</li>
            {% endfor %}
        </ul>
    {% endif %}

## Cache

When requesting the API, it is recommended to cache responses in order to reduce api calls and server load.

    {% cache for 1 day %}

        {% set tweets = craft.twitter.get('statuses/user_timeline') %}
        
        {% if tweets %}
        
            <h2>Recent Tweets</h2>
        
            <ul>
                {% for tweet in tweets %}
                    <li>{{tweet.text}}</li>
                {% endfor %}
            </ul>
        {% endif %}

    {% endcache %}