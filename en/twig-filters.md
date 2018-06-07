# Twig Filters

On top of the template filters that Twig comes with, Twitter plugin provides a few of its own.

## autoLinkTweet

Turns mentions, hashtags and urls contained in a text of a tweet into links.

    {{ tweet.text|autoLinkTweet }}

Customize auto-linking with options:

    {{ tweet.text|autoLinkTweet({
        cashtagClass: "twitter-cashtag",
        external: false,
        hashtagClass: "twitter-hashtag",
        listClass: "twitter-list",
        noFollow: false,
        noOpener: false,
        target: "_blank"
        urlClass: "twitter-url",
        usernameClass: "twitter-username",
    }) }}

Available options:

- `cashtagClass`
- `external`
- `hashtagClass`
- `listClass`
- `noFollow`
- `noOpener`
- `target`
- `urlClass`
- `usernameClass`